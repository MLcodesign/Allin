<?php

namespace App\Http\Controllers;

use App\Package;
use App\Deposit;
use App\Exchange;
use App\ApiLog;
use Illuminate\Http\Request;
use App\AlertService;
use App\Services\SeqService;
use App\PointsService;

use App\Http\Requests;
use App\Http\Classes\Packages;
use Route;
use Auth;
use Session;
use DB;

class SubscriptionController extends Controller
{
    protected $alertService;
    protected $pointsService;
    protected $seqService;
    /**
     * SubscriptionController constructor.
     */
    public function __construct(AlertService $alertService, PointsService $pointsService, SeqService $seqService)
    {
		$this->alertService = $alertService;
        $this->pointsService = $pointsService;
        $this->seqService = $seqService;
        $p = new \stdClass();
        $p->url = env("PAYMENT_URL");
        $p->merchantId = env("PAYMENT_MERCHANT_ID");
        $p->key = env("PAYMENT_KEY");
        $p->iv = env("PAYMENT_IV");
        $p->version = env("PAYMENT_VERSION");
        $p->status = array(
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
        $tmpary = explode(",",env("PAYMENT_ALLOWS"));
        foreach($tmpary as $val){
            $ary = explode(":", $val);
            $p->allowPayments[$ary[0]] = $ary[1];    
        }
        //$p->allowPayments = explode("");
        $p->returnUrl = url("".env("PAYMENT_RETURN_URL"));
        $p->notifyUrl = url("".env("PAYMENT_NOTIFY_URL"));
        $this->p = $p;
        /*$current_path = Route::getCurrentRoute()->getPath();
        if ($current_path != 'package/subscribe/{id_package}/success')
            $this->middleware('auth');*/
    }

    public function getSubscribe($package_id)
    {
        $package = Package::findOrfail($package_id);

        if (\Auth::user()->subscribed('MEMBERSHIP') || $package->id == getSetting('DEFAULT_PACKAGE_ID')) {
            return view('member.confirm_subscription')->with(compact('package'));
        } else {
            return view('member.card_configuration')->with(compact('package'));
        }
    }

    public function getCard()
    {
        if (\Auth::user()->subscribed('MEMBERSHIP')) {
            return view('member.card_configuration');
        } else {
            return back()->with('error', ' You must have a Stripe Subscription to continue');
        }
    }

    public function postCard(Request $request)
    {
        $creditCardToken = $request->input('creditCardToken');

        $user = \Auth::user();

        $user->updateCard($creditCardToken);

        $user->save();

        return redirect('member/profile')->with('success', 'Your Card Details Updated Successfully');
    }

    public function postSetSubscription(Request $request)
    {
        $creditCardToken = $request->input('creditCardToken');

        $package = Package::findOrfail($request->input('package'));

        $user = \Auth::user();

        $user->newSubscription('MEMBERSHIP', $package->plan)->create($creditCardToken);

        $user->package_id = $package->id;

        $user->save();

        return redirect('member/profile')->with('success', $package->name . ' Package has been selected Successfully');
    }

    public function postSwapSubscription(Request $request)
    {
        $package = Package::findOrFail($request->input('package_id'));

        $user = \Auth::user();
        if ($package->id == getSetting('DEFAULT_PACKAGE_ID')) {
            /**
             * this handle changing package to free package
             */
            if ($user->subscribed('MEMBERSHIP')) {
                $user->subscription('MEMBERSHIP')->cancel();
            }
            $user->package_id = getSetting('DEFAULT_PACKAGE_ID');

            $user->save();

            return redirect('member/profile')->with('success', $package->name . ' Package has been selected Successfully');
        } elseif ($user && $user->subscribed('MEMBERSHIP')) {

            $user->subscription('MEMBERSHIP')->swap($package->plan);

            $user->package_id = $package->id;

            $user->save();

            return redirect('member/profile')->with('success', $package->name . ' Package has been selected Successfully');
        } else {
            return redirect('member/profile')->with('error', 'you are facing some errors');
        }
    }

    public function getInvoices(Request $request)
    {
        $user = \Auth::user();

        $invoices = [];

        if ($user->stripe_id) {
            $invoices = $user->invoices();
        }

        return view('member.invoices')->with(compact('invoices'));
    }

    public function getDownloadInvoice($invoice)
    {
        return \Auth::user()->downloadInvoice($invoice, [
            'vendor' => getSetting('SITE_TITLE'),
            'product' => getSetting('SITE_TITLE'),
        ]);
    }

    public function getCancel()
    {
        return view('member.confirm_cancel_subscription');
    }

    public function deleteCancel()
    {
        $user = \Auth::user();

        $package = Package::findOrfail($user->package->id);

        if ($user->subscribed('MEMBERSHIP')) {
            $user->subscription('MEMBERSHIP')->cancel();
        }

        $user->package_id = 0;

        $user->save();

        return redirect('member/profile')->with('success', $package->name . ' Package has been cancelled Successfully');
    }

    public function initPackages($id_package, Packages $package, Request $request)
    {
        if (!$id_package)
            return redirect('deposit');

        $packageData = $package->getPackageDetails($id_package);

        if (!$package)
            return redirect('deposit');

        $order_number = $this->seqService->getFormatNextval();
        $request->Session()->put('id_user', Auth::id());
        $request->Session()->put('id_package', $packageData[0]->id);
        
        $p = $this->p;
        $package = $packageData[0];
        $postData = [
            'MerchantID' => $p->merchantId,
            'RespondType' => 'JSON',
            'CheckValue' => $this->pay2goMerchantHash($order_number, $package->gift_amount),
            'TimeStamp' => strtotime(date('d-m-Y')),
            'Version' => $p->version,
            'MerchantOrderNo' => $order_number,
            'Amt' => $package->gift_amount,
            'ItemDesc' => $package->name,
            'test' => 'test',
            'CustomerURL' => url('/package/subscribe/success'),
            'ClientBackURL' => $p->returnUrl,
            'ReturnURL' => $p->returnUrl,
            'Email' => Auth::user()->email,
            'EmailModify' => "0",
            'LoginType' => "0",
            'OrderComment' => Auth::user()->id
        ];

        foreach($p->allowPayments as $key => $val){
            $postData[$key] = $val;
        }
        
        $data['postData'] = $postData;
        $data['actionUrl'] = $p->url;
        $data['package'] = $package;
        
        $data_arr = [
            'id_user' => Session::get('id_user'),
            'id_program' => Session::get('id_package'),
            'id_merchant' => $postData['MerchantID'],
            'amount' => $postData['Amt'],
            'temp_order_number' => $postData['MerchantOrderNo'],
            'payment_time' => $postData['TimeStamp'],
            'ip' => $_SERVER['REMOTE_ADDR'],
            'create_t' => date("Y-m-d H:i:s"),
            'json_data' => json_encode($data)
        ];
        
        //need to check about notify record, if notify record early, need to skip payment created
        $packageManager = new Packages();
        $id_payment = $packageManager->saveSubscription($data_arr, 'payments_tmp');

        return view('member.subscription-process')->with($data);
    }

    public function pay2goMerchantHash($order_number, $amount)
    {
        $mer_array = array(
         'MerchantID' => $this->p->merchantId,
         'TimeStamp' => strtotime(date('d-m-Y')),
         'MerchantOrderNo'=> $order_number,
         'Version' => $this->p->version,
         'Amt' => $amount,
        );

        ksort($mer_array);
        $check_merstr = http_build_query($mer_array);
        $CheckValue_str =
        "HashKey=" . $this->p->key . "&$check_merstr&HashIV=" . $this->p->iv;
        return strtoupper(hash("sha256", $CheckValue_str));
    }
    
    private function pay2goCheckCodeHash($resultObj){
        $check_code = array(
         "MerchantID" => $this->p->merchantId,
         "Amt" => $resultObj->Amt,
         "MerchantOrderNo" => $resultObj->MerchantOrderNo,
         "TradeNo" => $resultObj->TradeNo,
        );
        ksort($check_code);
        $check_str = http_build_query($check_code);
        $CheckCode = sprintf("HashIV=%s&%s&HashKey=%s", $this->p->iv, $check_str, $this->p->key);
        return strtoupper(hash("sha256", $CheckCode));      
    }

    public function subscriptionCapture(Request $request)
    {
		$this->subscriptionCaptureTwo($request);
        //header("HTTP/1.1 200 OK");
        //return $this->packageSubscriptionCapture();
		//return view('member.notify_url');
    }
	
	
    public function subscriptionCaptureTwo(Request $request)
    {
        //header("HTTP/1.1 200 OK");
        //return $this->packageSubscriptionCapture();
        $epaygoIpAllows = explode(",", env("PAYMENT_ALLOW_IPS"));
        //var_dump(count($epaygoIpAllows));
        if(trim($epaygoIpAllows[0]) == ""){
            //all pass
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
            //113.196.61.222[Lab]
            //113.196.61.171[Prod]
            if(!in_array($ip, $epaygoIpAllows)){
                echo "fail";
                return;
            }
        }
        if(null !== $request->input("JSONData")){
            file_put_contents("/tmp/json-".date("Y-m-d").".txt",$request->input("JSONData")."\n",FILE_APPEND);
            $data = json_decode($request->input('JSONData'));

            $result = json_decode($data->Result);
            
            $apiLog = new ApiLog();
            $apiLog->id_user = 1;//\Auth()->user()->id;
            $apiLog->status = $data->Status;
            $apiLog->ip = isset($result->IP) ? $result->IP : NULL;
            $apiLog->remote_ip = $_SERVER['REMOTE_ADDR'];
            $apiLog->created_at = date("Y-m-d H:i:s");
            $apiLog->my_check_code = isset($result->TradeNo) ? $this->pay2goCheckCodeHash($result) : NULL;
            $apiLog->check_code = isset($result->CheckCode) ? $result->CheckCode : NULL;
            $apiLog->message = $data->Message;
            $apiLog->json_data = $request->input("JSONData");
            $apiLog->save();
             
            if($data->Status != 'SUCCESS'){
                echo "status fail";//return redirect('deposit')->with('payment', 'failed');            
            }else{
                if($apiLog->my_check_code != $apiLog->check_code){
                    echo "checkcode fail";
                }
            }           
            
            $this->packageSubscriptionCaptureNotify($data, $request->input("JSONData"));
        }
		echo "ok";
        //return view('member.notify_url');
    }

	private function packageSubscriptionCaptureNotify($data, $jsonData)
	{

		$package = new Packages;
		$payment_methods = array(
			'CREDIT' =>    '信用卡',
			'WEBATM' =>    'WebATM',
			'VACC'   =>    'ATM轉帳',
			'CVS'    =>    '超商代碼繳費',
			'BARCODE'=>    '條碼繳費'
		);

        $result = json_decode($data->Result);
        $data_arr = [
            'status' => $data->Status,
			'message' => $data->Message,
            'id_user' => isset($result->OrderComment),
            'id_program' => "1",
            'id_merchant' => $result->MerchantID,
            'amount' => $result->Amt,
            'trade_number' => $result->TradeNo,
            'temp_order_number' => $result->MerchantOrderNo,
            'payment_time' => $result->PayTime,
            'auth' => isset($result->Auth),
            'card6_number' => isset($result->Card6No),
            'card6_number' => isset($result->Card4No),
            'payment_type' => $result->PaymentType,
            'response_type' => $result->RespondType,
			'escrow_bank' => $result->EscrowBank,
			'code_no' => isset($result->CodeNo),
			'check_code' => $result->CheckCode,
            'ip' => $result->IP, 
            'remote_ip' => $_SERVER['REMOTE_ADDR'],
            'json_data' => $jsonData 
        ];

        #確認是否已通知過
        $obj = DB::table('notify_payments')->where("trade_number", $result->TradeNo)->first();
        
        $id_payment = $package->saveSubscriptionNotify($data_arr);

        #確認目前等待付款狀態
        $obj = DB::table('payments')->where("trade_number", $result->TradeNo)->first();
        if(null !== $obj){
            if($obj->status == "WAIT_PAY"){
                if($data->Status == 'SUCCESS'){
                    /*
                    $user_total_credit = DB::table('users')->where('id', $obj->id_user)->value('total_credit');
                    $user_total_credit += $obj->total_payment;
                    DB::table('users')->where('id', $obj->id_user)->update([
                        'total_credit' => $user_total_credit
                    ]);
                    */

                    $depositArr = ["user_id" => $obj->id_user ,
                                   "p_cnt" => $result->Amt,
                                   "pay_amt" => $result->Amt, 
                                   "created_at" => date("Y-m-d H:i:s"),
                                   "created_by" => 1, 
                                   "category_id" => 1,
                                   "op_type" => "system",
                                   "api_key" => $obj->id,
                                   "api_memo_note" => "一般儲值"
                                  ];
                    
                    $package->addDeposits($depositArr);
                                    
                    $bonus = $obj->total_payment - $result->Amt;
                    if($bonus > 0){
                        $depositArr['p_cnt'] = $bonus;
                        $depositArr['pay_amt'] = 0;
                        $depositArr['api_memo_note'] = "儲值加碼紅利";
                        $depositArr['category_id'] = 3;
                        $depositArr['api_key'] = $obj->id;
                        
                        
                        $package->addDeposits($depositArr);
                    } 
                    
                    $this->pointsService->storeIn($obj->id_user, $obj->total_payment);
                    
                    DB::table('payments')->where('id', $obj->id)->update([
                        'status' => 'SUCCESS',
                        'payment_time' => $result->PayTime
                    ]);
                   
                    $subject = "儲值成功確認信!!";
                    $myData = new \stdClass();
                    $myData->template = 'emails.deposit_success';  
                          
                    $email = DB::table('users')->where('id', $obj->id_user)->value('email');
                    $myData->payment_type = $obj->payment_type;
                    $myData->subject = $subject;
                    $myData->total_payment = $obj->total_payment;
                    $this->alertService->sendPaymentSuccessAlert($email,$subject, $myData);                 
                }    
            }
        }else{
            //if notify early than real-time
        }
        
	}

    public function packageSubscriptionCapture(Request $request)
    {
        if (null === ($jsonData = $request->input("JSONData")))
            return redirect('deposit')->with('payment', 'failed');

        $package = new Packages;
        $request = new Request;

        $data = json_decode($jsonData);
        
        if (!$data)
            return redirect('deposit')->with('payment', 'failed');

        $result = json_decode($data->Result);
        
        $apiLog = new ApiLog();
        $apiLog->id_user = (null !== Session::get('id_user')) ? Session::get('id_user') : NULL;
        $apiLog->status = $data->Status;
        $apiLog->ip = isset($result->IP) ? $result->IP : NULL;
        $apiLog->remote_ip = $_SERVER['REMOTE_ADDR'];
        $apiLog->created_at = date("Y-m-d H:i:s");
        $apiLog->my_check_code = isset($result->TradeNo) ? $this->pay2goCheckCodeHash($result) : NULL;
        $apiLog->check_code = isset($result->CheckCode) ? $result->CheckCode : NULL;
        $apiLog->message = $data->Message;
        $apiLog->json_data = $jsonData;
        $apiLog->save();

        if($apiLog->id_user === NULL){
            return redirect('deposit')->with('payment', 'failed');     
        }
        
        if($data->Status != 'SUCCESS'){
            return redirect('deposit')->with('payment', 'failed');            
        }else{
            if($apiLog->my_check_code != $apiLog->check_code){
                return redirect('deposit')->with('payment', 'failed');
            }
        }

        //return $data->Result;

		$payment_methods = array(
			'CREDIT' =>    '信用卡',
			'WEBATM' =>    'WebATM',
			'VACC'   =>    'ATM轉帳',
			'CVS'    =>    '超商代碼繳費',
			'BARCODE'=>    '條碼繳費'
		);
        
        $nosendPayments = array('VACC','CVS','BARCODE');

/*{"Status":"SUCCESS","Message":"\u4ed8\u6b3e\u6210\u529f","Result":"{\"MerchantID\":\"32294146\",\"Amt\":2000,\"TradeNo\":\"16101402052490019\",\"MerchantOrderNo\":\"OD887325\",\"RespondType\":\"JSON\",\"CheckCode\":\"1612852C34AE63D2BA37DCC55B63363306BCE992E00D1FE30607BFFA1CC1AD1A\",\"IP\":\"219.85.156.161\",\"EscrowBank\":\"KGI\",\"PaymentType\":\"CVS\",\"CodeNo\":\"TEST0123456789\",\"PayTime\":\"2016-10-14 00:00:00\"}"}*/

        $payment_status = $data->Status;
        
        if( in_array($result->PaymentType, $nosendPayments) ){
            $payment_status = "WAIT_PAY";
        }

        $data_arr = [
            'status' => $payment_status,
            'id_user' => Session::get('id_user'),
            'id_program' => Session::get('id_package'),

            'id_merchant' => $result->MerchantID,
            'amount' => $result->Amt,
            'trade_number' => $result->TradeNo,
            'temp_order_number' => $result->MerchantOrderNo,
            'payment_time' => isset($result->PayTime) ? $result->PayTime : null,
            'auth' => isset($result->Auth),
            'card6_number' => isset($result->Card6No),
            'card6_number' => isset($result->Card4No),
            'payment_type' => isset($payment_methods[$result->PaymentType]) ? $payment_methods[$result->PaymentType] : $result->PaymentType,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'create_t' => date("Y-m-d H:i:s")
        ];
        
        //need to check about notify record, if notify record early, need to skip payment created

        $id_payment = $package->saveSubscription($data_arr);

        $packageData = $package->getPackageDetails(Session::get('id_package'))[0];

        $bonus_db = $packageData->get_points;
        $bonus = preg_replace('/[^0-9]+/', '', $bonus_db);

        $total = $result->Amt + $bonus;

        $package->updateTotalPayment($id_payment, $total);
        $data_arr['package_name'] = DB::table('pricings')->where('id',Session::get('id_package') )->value('name');

		//*Update user Total_ credit
        $data_arr['nocoupon'] = true;
        $myData = new \stdClass();
        $myData->codeNo = "";
        $myData->bankCode = "";
        $myData->amt = "";
        $myData->barCode1 = "";
        $myData->barCode2 = "";
        $myData->barCode3 = "";
		if ($payment_status == 'SUCCESS' || $payment_status == 'WAIT_PAY'){
            
            if( in_array($result->PaymentType, $nosendPayments) ){           
                $data_arr['nocoupon'] = false;
                $subject = "交易成功待付款確認信!!";
                $myData->expireDate = $result->ExpireDate;
                $myData->expireTime = $result->ExpireTime;
                if($result->PaymentType == "VACC"){
                    $myData->bankCode = $result->BankCode;
                    $myData->codeNo = $result->CodeNo;
                }
                
                if($result->PaymentType == "CVS"){
                    $myData->codeNo = $result->CodeNo;
                }
                
                if($result->PaymentType == "BARCODE"){
                    $myData->barCode1 = $result->Barcode_1;
                    $myData->barCode2 = $result->Barcode_2;
                    $myData->barCode3 = $result->Barcode_3;
                }
                $myData->amt = $data_arr['amount'];
                $myData->template = 'emails.deposit_wait_pay_success';            
            }else{
                $subject = "儲值成功確認信!!";
                $myData->template = 'emails.deposit_success';
                $myData->total_payment = $total;
                /*
			    $user_total_credit = DB::table('users')->where('id', \Auth::user()->id)->value('total_credit');
			    $user_total_credit += $total;

			    DB::table('users')->where('id', \Auth::user()->id)->update([
				    'total_credit' => $user_total_credit
			    ]);
                */

                $depositArr = ["user_id" => \Auth::user()->id ,
                               "p_cnt" => $result->Amt,
                               "pay_amt" => $result->Amt, 
                               "created_at" => date("Y-m-d H:i:s"),
                               "created_by" => 1, 
                               "category_id" => 1,
                               "op_type" => "system",
                               "api_key" => $id_payment,
                               "api_memo_note" => "一般儲值"
                              ];
                
                $package->addDeposits($depositArr);
                
                $depositArr['p_cnt'] = $bonus;
                $depositArr['pay_amt'] = 0;
                $depositArr['api_memo_note'] = "儲值加碼紅利";
                $depositArr['category_id'] = 3;
                $depositArr['api_key'] = $id_payment;
                
                
                $package->addDeposits($depositArr);                
                $this->pointsService->storeIn(\Auth::user()->id, $total);
                
			    //$data_arr['package_name'] = DB::table('packages')->where('id',Session::get('id_package') )->value('name')
            }

            $email = \Auth::user()->email;
            $myData->payment_type = $data_arr['payment_type'];
            $myData->payment_type_code = $result->PaymentType;
            $myData->subject = $subject;
            $this->alertService->sendPaymentSuccessAlert($email,$subject, $myData);
                
		}


        return view('member.payment_success')->with(compact('request', 'data_arr'));
    }


}
