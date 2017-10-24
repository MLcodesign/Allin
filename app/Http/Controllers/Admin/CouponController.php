<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Classes\Packages;
use App\Http\Requests\CouponRequest;
use App\Coupons;
use Session;
use Auth;
use App\User;
use App\CouponHistroy;
use App\PointsService;

class CouponController extends Controller
{
    protected $pointsService;
	/**
     * DashboardController constructor.
     */
    public function __construct(PointsService $pointsService)
    {
        $this->pointsService = $pointsService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$coupon = Coupons::all();
        return view('admin.coupon.index')->with(compact('coupon'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create_edit');
    }
	
	
	public function newusercoupon (Request $request) {
		
		$reqcoupon = $request->reqcouponcode;
		
		
		
		$Couponcheck = Coupons::where([
				['code', '=', $reqcoupon],
				['coupntype', '=', 'newuser'],
				])->first();
				
	    $suercoupnid = Coupons::where([
				['coupntype', '=', 'newuser'],
				])->first();		
		
		
		$inspoint = $suercoupnid->point;
		$uid = Auth::user()->id;
		$cid = 	$suercoupnid->coupon_id;
		//$Couponcheck = Coupons::where('code', '=',$reqcoupon,'coupntype', '=','newuser')->first();
		
		if ($Couponcheck === null) {
		   
		    Session::flash('invalidcoupon', '優惠碼不存在，請重新輸入');
		   
		   return redirect('member/home#referal');
		   
		} else {
			
			Session::flash('success', '優惠碼已加值成功！');
			
			$CouponHistroy = new CouponHistroy;
			$CouponHistroy->uid = $uid;
			$CouponHistroy->cid = $cid;
			
			
			$CouponHistroy->save();
            $cp_id = $CouponHistroy->id;
			 
            
            $depositArr = ["user_id" => \Auth::user()->id ,
                       "p_cnt" => $inspoint,
                       "pay_amt" => 0,
					   "user_credit" => \Auth::user()->total_credit,
                       "created_at" => date("Y-m-d H:i:s"),
                       "created_by" => 1, 
                       "category_id" => 2,
                       "op_type" => "system",
                       "api_key" => $cp_id,
                       "api_memo_note" => "首次登入使用"
                      ];
            
            Packages::addDeposits($depositArr);			
			
			//user::where('id', $uid)->increment('total_credit', $inspoint);
            $this->pointsService->storeIn($uid, $inspoint);
			
		    return redirect('member/home#referal');
			
		}
		
		
		
		
		
	}
	
	public function couponcheckajax() {
		
		 $msg = "This is a simple message.";
         return response()->json(array('msg'=> $msg), 200);
		
	}
	
	
	
	
	public function normalusercoupon (Request $request) {
		
		$reqcoupon = $request->reqcouponcode;
		
		
		
		$Couponcheck = Coupons::where([
				['code', '=', $reqcoupon],
				['coupntype', '=', 'normal'],
			    ])->first();
				
	    // $suercoupnid = Coupons::where([
				// ['coupntype', '=', 'newuser'],
				// ])->first();		
		
		
		
		//$Couponcheck = Coupons::where('code', '=',$reqcoupon,'coupntype', '=','newuser')->first();
		
		if ($Couponcheck === null) {
		   
		    //Session::flash('invalidcoupon', 'fail');
		   
		     return response()->json(array('msg'=> 'fail'), 200);
		   
		} else {
			
			
			
			$inspoint = $Couponcheck->point;
			$uid = Auth::user()->id;
			$cid = 	$Couponcheck->coupon_id;
			//Session::flash('success', 'success');
			
			$CouponHistroy = new CouponHistroy;
			$CouponHistroy->uid = $uid;
			$CouponHistroy->cid = $cid;
			
			
			$CouponHistroy->save();
            $cp_id = $CouponHistroy->id;
			
            
            $depositArr = ["user_id" => \Auth::user()->id ,
                       "p_cnt" => $inspoint,
                       "pay_amt" => 0, 
					   "user_credit" => \Auth::user()->total_credit,
                       "created_at" => date("Y-m-d H:i:s"),
                       "created_by" => 1, 
                       "category_id" => 2,
                       "op_type" => "system",
                       "api_key" => $cp_id,
                       "api_memo_note" => "一般優惠碼"
                      ];
			
			Packages::addDeposits($depositArr);
			user::where('id', $uid)->increment('total_credit', $inspoint);;
			
			
			
		     return response()->json(array('msg'=> 'success'), 200);
			
		}
		
		
		
		
		
	}
	
	

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $coupon = Coupons::create($request->except('_token'));

        $coupon->save();

        return redirect('admin/coupon')->with('success', 'New Coupon Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupons $coupon)
    {
        return view('admin.coupon.create_edit')->with(compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, Coupons $coupon)
    {
        $coupon->code = $request->input('code');
        $coupon->point = $request->input('point');
        $coupon->from_date = $request->input('from_date');
        $coupon->to_date = $request->input('to_date');
        $coupon->status = ("Deactive" == $request->input('status')) ? 1 : 0;

        $coupon->save();

        return redirect('admin/coupon')->with('success', $coupon->code . ' Coupon Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Coupons $coupon)
    {
        if ($request->ajax()) {
            $coupon->delete();
            return response()->json(['success' => 'Coupon has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }
}
