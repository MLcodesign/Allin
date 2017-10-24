<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\ProfileRequest;
use App\Package;
use App\Feature;
use App\User;
use App\Referral;
use App\Exchange;
use App\Deposit;
use Auth;
use Validator;
use Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;
use App\Coupons;
use App\Order;
use DateTime;
use DateInterval;
use App\CouponHistroy;
use App\AlertService;
use App\PointsService;
use App\Services\BoxesService;

class MemberController extends Controller
{
    protected $alertService;
    protected $pointsService;
    protected $boxesService;
    
    /**
     * HomeController constructor.
     */
    public function __construct(AlertService $alertService, PointsService $pointsService, BoxesService $boxesService)
    {
		$this->alertService = $alertService;
        $this->pointsService = $pointsService;
        $this->boxesService = $boxesService;

        if(!\Auth::guest())
        {
            if (\Auth::user()->package_id != getSetting('DEFAULT_PACKAGE_ID') && \Auth::user()->package_id != 0 && !\Auth::user()->subscribed('MEMBERSHIP')) {
                Session::put('warning', 'Your Subscription not valid!');
            }else
            {
                Session::forget('warning');
            }
        }
        $this->middleware('auth');
        $this->p = new \stdClass();
        $this->p->status = array(
            'WAIT_PAY' => '等待付款',
            'SUCCESS' => '付款成功',
            'MPG10001' => '商店代號空白',
            'MPG10002' => '串接程式版本參數值有誤',
            'MPG10003' => '回傳格式參數值錯誤',
            'MPG10005' => 'TimeStamp 錯誤',
            'MPG10006' => 'CheckValue [ 檢查碼 ]空白',
            'MPG10007' => '查無商店資料',
            'MPG10008' => 'CheckValue [ 檢查碼 ]驗證失敗',
            'MPG10009' => '商店訂單編號空白',
            'MPG10010' => '商店訂單編號格式錯誤 限英數字、底線，長度 20 字',
            'MPG10012' => '商店訂單金額空白',
            'MPG10013' => '金額填入非數字資訊',
            'MPG10014' => '訂單金額超過9999999999',
            'MPG10015' => '商品資訊空白',
            'MPG10016' => '繳費期限日期格式錯誤',
            'MPG10017' => '商店狀態關閉或暫停，無法交易',
            'MPG10018' => '商店 Form Post 資料加密失敗',
            'MPG10019' => '登入智付寶會員參數空白',
            'MPG10020' => '回傳參數資料不存在',
            'MPG10021' => '回傳參數資料解密失敗',
            'MPG10022' => '查無商店金流設定資料',
            'MPG10024' => '付款人電子信箱格式錯誤',
            'MPG10028' => '信用卡卡號格式錯誤',
            'MPG10029' => '未輸入信用卡有效期',
            'MPG10030' => '未輸入信用卡背面末三碼',
            'MPG10031' => '服務未啟用',
            'MPG10033' => '信用卡未選擇一次刷卡或是分期交易',
            'MPG10034' => '信用卡支付未選擇分期期數',
            'MPG10035' => '信用卡支付分期交易旗標空白或參數格式錯誤',
            'MPG10036' => 'URL 非為 http 或 https 開頭',
            'MPG10037' => 'URL 格式錯誤',
            'MPG10038' => '禁止使用 localhost 或是 127.0.0.1 的網址格式',
            'MPG20001' => '驗證資料不存在',
            'MPG20002' => '驗證資料空白-商店代號',
            'MPG20003' => '驗證資料空白-訂單金額',
            'MPG20004' => '驗證資料空白-商店自訂訂單編號',
            'MPG20005' => '頁面停留超過 30 分鐘',
            'MPG20006' => '未選擇金融機構別',
            'MPG20007' => '未選擇支付方式',
            'MPG20009' => '未選擇超商別',
            'TRA10003' => '總數量格式錯誤',
            'TRA10043' => '信用卡到期日格式錯誤',
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (\Auth::user()->role->name == 'Admin') {
            return redirect('admin/dashboard');
        }
        elseif(empty(\Auth::user()->address)) return redirect('/new-user');


        $orders = DB::table('orders')
            ->where('user_id', \Auth::user()->id)->get();

        $boxes = array();

        foreach($orders as $i => $order){
            $boxes[$order->id] = DB::table('boxes')
                ->join('orders', 'boxes.order_id', '=', 'orders.id')
                ->where('boxes.order_id', $order->id)
                ->where('orders.user_id', \Auth::user()->id)->get();
        }

        $all_boxes = DB::table('boxes')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', \Auth::user()->id)->get();


        $payment_status = $this->p->status;

        $order_status = array(
            '派送空箱',//'schedule new box'
            '進倉運送中',//'during pickup',
            '租用中', //'admin check in',
            '已退租',//'terminated',
        );
        $order_status_color = array(
            '派送空箱' => 'info',
            '進倉運送中' => 'warning',
            '租用中' => 'info',
            '已退租' => 'success',
        );

        $credit = DB::table('users')
            ->where('id', \Auth::user()->id)->value('total_credit');

        $payments  = DB::table('payments')
                        ->where('id_user', \Auth::user()->id)
                        ->orderBy('create_t','desc')
                        ->get();
                       
        $deObj = new Deposit(); 
        $deposits = $deObj->getRefundDepositsForHomeById(\Auth::user()->id);

        $subscriptions = DB::table('subscriptions')
                        ->where('user_id', \Auth::user()->id)
                        ->orderBy('created_at','desc')
                        ->get();
                        
        $exObj = new Exchange();
        $exchanges = $exObj->getExchangesForHomeById(\Auth::user()->id);

        //$referrals = Referral::where('referral_id' ,\Auth::user()->id)->get();

        $referrals = DB::table('referal')->where('referal.referral_id', Auth::User()->id)->orWhere('referal.user_id', Auth::User()->id)->get();

		$pricings =  DB::table('pricings')->where('pricings.is_test','0')->get();

        $uid = Auth::user()->id;
		
		$suercoupnid = Coupons::where([
				['coupntype', '=', 'newuser'],
				])->first();
				
		$gkd = 	$suercoupnid->coupon_id;	
		$inspoint = $suercoupnid->point;
		$Couponhistroycheck = CouponHistroy::where([
				['uid', '=', $uid],
				['cid', '=', $gkd],
				])->first();
		
		
		$referral_check = Referral::where([
			['user_id', '=', $uid]
		])->first();
		
		
		$referral_check = $referral_check === null ? true : false;
		
		//$Couponcheck = Coupons::where('code', '=',$reqcoupon,'coupntype', '=','newuser')->first();
		
		if ($Couponhistroycheck === null) {
		   
		    $bhfy = 0;
		   
		} else {
			
	        $bhfy = 1;
			
		}
		
		$usercouponhistroy = CouponHistroy::where([
				['uid', '=',$uid],
				])->orderBy('created_at','desc')->get();
	
		$depo = DB::table('deposits')
			->select(['created_at', 'api_memo_note', 'api_system_note', 'p_cnt', 'pay_amt', 'user_credit'])
			->where('user_id', "=", $uid)
			->where(function($query){
				$query->where('category_id', '=' , '2')
							->orWhere('category_id', '=' , '4')
							->orWhere('category_id', '=' , '5');
			})
			->orderby('created_at', 'desc')->get();
			
			
           return view('member.home')->with(compact('depo','inspoint','bhfy','page', 'pricings','orders', 'boxes', 'payment_status', 'all_boxes', 'order_status_color', 'order_status', 'credit', 'payments', 'referrals', 'referral_check', 'subscriptions', 'exchanges','deposits'));
    }


    public function new_user()
    {
        return view('frontend/booking/new-user');
    }

    public function postnew_user(Request $request)
    {

        $rules = [
            'name' => 'required',
            'mobile' => 'required|min:8|max:15',
            // 'country' => 'required',
            // 'district' => 'required',
            // 'zipcode' => 'required',
            'address' => 'required',
        ];

        $attributeNames = array (
            'name' => '請務必填寫完整個人資訊！',
            'mobile' => '請務必填寫完整個人資訊！',
            // 'country' => '欄位必填',
            // 'district' => '欄位必填',
            // 'zipcode' => '欄位必填',
            'address' => '請務必填寫完整個人資訊！',
        );

        $validator = Validator::make($request->all(), $rules);

        $validator->setAttributeNames ($attributeNames);

        if($validator->fails()){
            return redirect()->to('new-user')->withInput($request->all())->withErrors($validator);
        } else{

            $user = Auth::User();
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->county = $request->county;
            $user->district = $request->district;
            $user->zipcode = $request->zipcode;
            $user->save();

            return redirect()->to('schedule-new-box');
        }
    }


    /*
    * User Info
    *
    */
    public function userinfo()
    {
        if (\Auth::user()->role->name == 'Admin') {
            return redirect('admin/dashboard');
        }
        elseif(empty(\Auth::user()->address)) return redirect('/new-user');


        $orders = DB::table('orders')
            ->where('user_id', \Auth::user()->id)->get();

        $boxes = array();

        foreach($orders as $i => $order){
            $boxes[$order->id] = DB::table('boxes')
                ->join('orders', 'boxes.order_id', '=', 'orders.id')
                ->where('boxes.order_id', $order->id)
                ->where('orders.user_id', \Auth::user()->id)->get();
        }

        $all_boxes = DB::table('boxes')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', \Auth::user()->id)->get();


        $payment_status = $this->p->status;

        $order_status = array(
            '派送空箱',//'schedule new box'
            '進倉運送中',//'during pickup',
            '租用中', //'admin check in',
            '已退租',//'terminated',
        );
        $order_status_color = array(
            '派送空箱' => 'info',
            '進倉運送中' => 'warning',
            '租用中' => 'info',
            '已退租' => 'success',
        );

        $credit = DB::table('users')
            ->where('id', \Auth::user()->id)->value('total_credit');

        $payments  = DB::table('payments')
            ->where('id_user', \Auth::user()->id)->get();

        $subscriptions = DB::table('subscriptions')->where('user_id', \Auth::user()->id)->get();

        //$referrals = Referral::where('referral_id' ,\Auth::user()->id)->get();

        $referrals = DB::table('referal')->where('referal.user_id', Auth::User()->id)->get();

        return view('member.userinfo')->with(compact('orders', 'boxes', 'payment_status', 'all_boxes', 'order_status_color', 'order_status', 'credit', 'payments', 'referrals', 'subscriptions'));
    }

    public function deposit_success(Request $request){
        return view('member.payment_success')->with(compact('request'));
    }

    /*
    **
    */
	
	public function updateboxnameajax (Request $request) {
		
		
		
	        DB::table('boxes')
            ->where('id', $request->id)
            ->update(['name' => $request->name]);
		
		return 'success';
		
	}
	
	public function updateboximgajax (Request $request) {
		
		
		  // GET ALL THE INPUT DATA , $_GET,$_POST,$_FILES.
        try{
            $file = $request->file('pictureFile');      
            // VALIDATION RULES
            $rules = array(
                'pictureFile' => 'image|max:10000',
            );

           // PASS THE INPUT AND RULES INTO THE VALIDATOR
            $validation = Validator::make($request->all(), $rules);

            // CHECK GIVEN DATA IS VALID OR NOT
            if ($validation->fails()) {
                //die("dd");
                return response()->json(['status' => 'fail', 'response' => $validation->errors()->first()]);
                //return Redirect::to('/')->with('message', $validation->errors->first());
            }
            
      
        
            //$file = array_get($input,'pictureFile');
           // SET UPLOAD PATH
            $destinationPath = str_replace("\\","/",public_path()).'/uploads/boxes';
            // GET THE FILE EXTENSION
            $extension = $file->getClientOriginalExtension();
            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $fileName = md5(date("Y-m-d H:i:s").rand(111,999)) . '.' . $extension;
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            //echo $fileName;
            $upload_success = $file->move($destinationPath, $fileName);
            
            // IF UPLOAD IS SUCCESSFUL SEND SUCCESS MESSAGE OTHERWISE SEND ERROR MESSAGE
            if ($upload_success) {
                $box_id = $request->get("box_id");
                DB::table('boxes')
                    ->where('id', $box_id)
                    ->update([ 'image' =>  $fileName ]);

                return response()->json(['status' => 'success', 'response' => '檔案上傳成功!!']);
                //return Redirect::to('/')->with('status', 'Image uploaded successfully');
            }else{
                return response()->json(['status' => 'fail', 'response' => 'upload fail!!']);
            }
        
        } catch(\Exception $e){
            //return response()->json(['status' => 'fail', 'response' => $e->getMessage()]);        
            return response()->json(['status' => 'fail', 'response' => '照片超過10MB!請重新上傳10MB以下的照片！']);        
        }

		
		
		
	}

    public function booking($step, Request $request){

        //if(\Auth::user()->total_credit == 0) return redirect('/deposit')->with('status', 'Please deposit more credit before schedule new boxes');

        $steps = array(
            'Schedule',
            'Address',
            'Review',
            //'Billing',
            //'Confirm'
        );

        $steps_chinese = array(
            '選擇方案',
            '預約取件',
            '訂單確認',
            //'Billing',
            //'Confirm'
        );

        $packages = Package::active()->get();

        $current_step = $step;
        $current_package = DB::Table('packages')
            ->where('packages.id', $request->get('package_id'))
            ->first();

        $current_package_features = DB::Table('feature_package')
            ->where('package_id', $request->get('package_id'))
            ->get();

        $pricings = DB::table('pricings')->where('pricings.is_test','0')->get();
        //dd($pricings);

        if(NULL !== $request->get('pricing_id'))
            $current_pricing = DB::table('pricings')->where('id', $request->get('pricing_id'))->first();

        if(!isset($steps[$step-1])) return Redirect::back();

        if(!view()->exists('frontend.booking.'.strtolower($steps[$step-1]))) return Redirect::back();

        if(\Auth::user()->id && NULL !== $request->get('action') && $request->get('action') === 'submit'){

            $n = (int) $request->get('shipping');
            $amt_service = (int) $request->get('camera');
            $service_cost = (float) $current_package_features[6]->spec;

            $f = '$shipping_fee = '.str_replace('n', '$n', $current_package_features[5]->spec).';';
            eval($f);

            $monthly_fee = $current_package->cost * $n + $amt_service * $service_cost;

            $dropOffDate = strtotime($request->get('dropOffDate'));

            $shipping_date = $request->get('scheduleOption') == '1'
                ? $request->get('dropOffDate')
                : date('Y-m-d', strtotime($dropOffDate.' +7 days'));

            $next_subscription = date('Y-m-d', strtotime($shipping_date.' +1 month'));

            $order_id = DB::table('orders')
                ->insertGetId([
                    'user_id' => \Auth::user()->id,
                    'package_id' => $request->get('package_id'),
                    'pricing_id' => $request->get('pricing_id'),

                    'quantity' => $n,
                    'amt_service' => $request->get('camera'),


                    'shipping_date' => $shipping_date,

                    'latest_subscription' => $shipping_date,
                    'next_subscription' => $next_subscription,

                    'pickup_date' => $request->get('dropOffDate'),
                    'pickup_time' => $request->get('dropOffTime'),

                    'shipping_fee' => $shipping_fee,
                    'monthly_cost' => $monthly_fee,

                    'address' => $request->get('address'),
                    'county' => $request->get('county'),
                    'district' => $request->get('district'),
                    'zipcode' => $request->get('zipcode'),
                    'phone' => $request->get('phone'),
                    'note' => $request->get('special_instruction'),

                    'schedule_option' => $request->get('scheduleOption'),
                    'created_at' => new Carbon
                ]);

            for($i=0; $i < $n; $i++){

                $name = "空箱 $i";

                DB::table('boxes')
                    ->insert([
                        'order_id' => $order_id,
                        'name' => $name,
                        'created_at' => new Carbon
                    ]);
            }


            $original_credit = (float) DB::table('users')->where('id', \Auth::user()->id)->value('total_credit');

            if($request->get('scheduleOption') == '1'){
                DB::table('subscriptions')->insert([
                    'order_id' => $order_id,
                    'user_id' => \Auth::user()->id,
                    'monthly_cost' => $monthly_fee,
                    'shipping_fee' => $shipping_fee,
                    'billing_amount' => $monthly_fee + $shipping_fee,
                    'original_credit' => $original_credit,
                    'created_at' => new Carbon()
                ]);

                $remain_credit = $original_credit - ($monthly_fee + $shipping_fee);
                DB::table('users')->where('id', \Auth::user()->id)->update(['total_credit' => $remain_credit]);

            }


            DB::table('users')->where('id', \Auth::user()->id)->update([
                'address' => $request->get('address'),
                'county' => $request->get('county'),
                'district' => $request->get('district'),
                'zipcode' => $request->get('zipcode'),
                'mobile' => $request->get('phone'),
            ]);


            //Send Email
            $to_email = DB::table('users')->where('id', \Auth::user()->id)->value('email');

            \Mail::send('emails.review',
                [
                    'request' => $request,
                    'subject' => '帳單確認 Overview',
                    'current_package' => $current_package,
                    'current_package_features' => $current_package_features,
                    'current_pricing'	=> $current_pricing
                ],
                function ($message) use ($to_email) {
                    $message->to($to_email, getSetting('SITE_TITLE') . ' Support')->subject('帳單確認 Overview');
                }
            );

            //Has coupon been used, let's check it's valid.
            $referral_code = $request->coupon;
            $referrer = User::where('referal_code', $referral_code)->first();
            if(!empty($referrer)) {
                //Add credits to referrer.
                $current_credit = $referrer->total_credit;
                $referrer->total_credit = $current_credit + 300;
                $referrer->save();

                //Add credit to referal
                $user = User::find(Auth::user()->id);
                $user_current_credit = $user->total_credit;
                $user->total_credit = $user_current_credit + 200;
                $user->save();

                //Add data to table.
                $referral = new Referral;
                $referral->user_id  = Auth::user()->id;
                $referral->referral_id = $referrer->id;
                $referral->referral_amount = 300.00;
                $referral->bouns_ammount = 200.00;
                $referral->save();

            }

            //Has coupon been used, let's check it's valid  In Coupon Table.
            $coupon_code = $request->addcoupon;
            $couponadd = Coupons::where('code', $coupon_code)->first();
            if(!empty($couponadd)) {
                //Add credit to referal
                $user = User::find(Auth::user()->id);
                $user_current_credit = $user->total_credit;
                $user->total_credit = $user_current_credit + $couponadd->point;
                $user->save();


                //Add data to table.
                $referral = new Referral;
                $referral->user_id  = Auth::user()->id;
                $referral->referral_id = $referrer->id;
                $referral->referral_amount = $couponadd->point;
                $referral->bouns_ammount = $couponadd->point;
                $referral->save();

            }

            return Redirect('/package/subscribe/'.$current_package->id);
            //return Redirect('/member/home')->with('status', 'Information stored successfully!');
        }

        $referrals = Referral::where('user_id', Auth::user()->id)->first();

        return view('frontend.booking.'.strtolower($steps[$step-1]))->with(compact(
            'current_step',
            'steps',
            'steps_chinese',
            'packages',
            'request',
            'current_package',
            'current_package_features',
            'pricings',
            'referrals',
            'current_pricing'));
    }

    public function booking_page(){
        $packages = Package::active()->get();

        $features = Feature::active()->get();

        return view('frontend.booking.index')->with(compact('page', 'packages', 'features'));
    }

    public function deposit(){
        if(empty(\Auth::user()->address)) return redirect('/new-user');

        if(empty(\Auth::user()->address)) return redirect('/new-user');

        $pricings =  DB::table('pricings')->where('pricings.is_test','0')->get();

        return view('member.deposit')->with(compact('page', 'pricings'));
    }
    public function pricing()
    {
        $packages = Package::active()->get();

        $features = Feature::active()->get();

        return view('member.pricing')->with(compact('packages', 'features'));
    }

    public function profile()
    {
        $user = \Auth::user();

        return view('member.profile')->with(compact('user'));
    }

    public function editProfile()
    {
        $user = \Auth::user();

        $job_titles = getSetting('JOB_TITLES');

        return view('member.edit_profile')->with(compact('user', 'job_titles'));
    }

    public function updateProfile2(Request $request)
    {
        $user = \Auth::user();


        if(!Hash::check($request->input('current_password'),$user->password)) {
            return redirect('member/home')->with('status', '原密碼錯誤');
        }


        $user->name = $request->get('name');
        $user->mobile = $request->get('mobile');
        $user->address = $request->get('address');
        $user->county = $request->get('county');
        $user->district = $request->get('district');
        $user->zipcode = $request->get('zipcode');
        //$user->job_title = $request->input('job_title');

        if ($request->input('password')) {

            $user->password = bcrypt($request->get('password'));
        }
        $user->save();

        return redirect('member/home')->with('success', 'Your Profile Updated Successfully');
    }



    public function updateProfile(Request $request)
    {
        $user = \Auth::User();

        if(!empty($request->get('name')) && !empty($request->get('mobile'))){
            $user->name = $request->input('name');
            $user->mobile = $request->input('mobile');
        } else if (!empty($request->input('address')) && !empty($request->input('county')) && !empty($request->input('district')) && !empty($request->input('zipcode'))){
            $user->address = $request->input('address');
            $user->county = $request->input('county');
            $user->district = $request->input('district');
            $user->zipcode = $request->input('zipcode');
        }

        /*if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }*/


        /*if ($request->hasFile('avatar')) {

            $destinationPath = public_path() . '/uploads/avatars';

            if ($user->avatar != "uploads/avatars/avatar.png") {
                @unlink($user->avatar);
            }

            $avatar = hash('sha256', mt_rand()) . '.' . $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->move($destinationPath, $avatar);

            \Image::make(asset('uploads/avatars/' . $avatar))->fit(300, null, null, 'top-left')->save('uploads/avatars/' . $avatar);

            $user->avatar = $avatar;
        }*/

        $user->save();

        //return redirect('member/home')->with('success', 'Your Profile Updated Successfully');
        return response()->json(['status' => 'true','message' => '檔案更新成功！']);
    }

    public function changepassword(Request $request)
    {

        $old = $request->get('current_password');

        $dataOld = DB::table('users')->where('id', Auth::User()->id)->get();

        if(count($dataOld) > 0){

            if(Hash::check($old, $dataOld[0]->password)){
                $data = array(
                    'password' => Hash::make($request->get('password'))
                );

                DB::table('users')->where('id', Auth::User()->id)->update($data);
                return response()->json(['status' => 'true', 'message' => '檔案更新成功！']);
            } else{
                return response()->json(['status' => 'false','message' => '原密碼輸入錯誤']);
            }
        } else{
            return response()->json(['status' => 'false','message' => '原密碼輸入錯誤']);
        }
    }
}
