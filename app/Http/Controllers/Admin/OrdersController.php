<?php

namespace App\Http\Controllers\Admin;

use App\Box;
use App\Http\Classes\Packages;
use App\Http\Controllers\Controller;
use App\Order;
use App\Package;
use DB;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller {
	/**
	 * Display a listing of the order.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view( 'admin.orders.index' );
	}

	/**
	 * Show the form for creating a new order.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created order in order.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//
	}

	/**
	 * Display the specified order.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Order $order ) {
		$boxes = DB::table( 'boxes' )
		           ->select( '*', 'boxes.id as box_id' )
		           ->join( 'orders', 'boxes.order_id', '=', 'orders.id' )
		           ->where( 'orders.id', $order->id )
		           ->get();
		$user  = DB::table( 'users' )
		           ->where( 'id', $order->user_id )->first();

		$whereInAry  = array();
		$cancelBoxes = array();
		foreach ( $boxes as $box ) {
			$whereInAry[]  = $box->box_id;
			$cancelBoxes[] = $box;
		}


		$refunds = DB::table( 'deposits' )
		             ->select( '*', 'boxes.id as box_id, packages.id as orig_package_id, packages.name as package_name' )
		             ->join( 'boxes', 'deposits.api_key', '=', 'boxes.id' )
		             ->join( 'packages', 'boxes.package_id', '=', 'packages.id' )
		             ->whereIn( 'api_key', $whereInAry )
		             ->get();


		//var_dump($whereInAry);
		//var_dump($refunds);
		//die();

		return view( 'admin.orders.show' )->with( compact( 'order', 'boxes', 'user', 'refunds' ) );
	}

	/**
	 * Show the form for editing the specified order.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Order $order, Request $request ) {
		//$roles = Role::lists('name', 'id');

		//$packages = Package::active()->lists('name', 'id');

		//$job_titles = getSetting('JOB_TITLES');

		return view( 'admin.orders.create_edit' )->with( compact( 'order' ) );
	}

	/**
	 * Update the specified order in order.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Order $order ) {
		$action   = $request->get( 'actionType' );
		$isUpdate = false;
		if ( $action == "ajax" ) {
			$isUpdate = $this->updateBoxAjax( $request, $order );

			if ( $isUpdate === true ) {
				return response()->json( [ 'status' => 'success', 'success' => 'Order is updated sucessfully!!' ] );
			} else {
				return response()->json( [ 'status' => 'danger', 'success' => 'Order not updated.' ] );
			}
		} else {
			$order->phone    = $request->input( 'phone' );
			$order->county   = $request->input( 'county' );
			$order->district = $request->input( 'district' );
			$order->zipcode  = $request->input( 'zipcode' );
			$order->address  = $request->input( 'address' );
			$order->save();

			return redirect( 'admin/orders' )->with( 'success', $order->id . ' Order Updated Successfully' );
		}
	}

	private function updateBoxAjax( $request, Order $order ) {
		$quantity     = ! empty( $request->get( 'quantity' ) ) ? $request->get( 'quantity' ) : "";
		$box_id       = ! empty( $request->get( 'box_id' ) ) ? $request->get( 'box_id' ) : "";
		$boxed        = ! empty( $request->get( 'boxed' ) ) ? $request->get( 'boxed' ) : "";
		$canceled     = ! empty( $request->get( 'canceled' ) ) ? $request->get( 'canceled' ) : "";
		$arrived      = ! empty( $request->get( 'arrived' ) ) ? $request->get( 'arrived' ) : "";
		$terminated   = ! empty( $request->get( 'terminated' ) ) ? $request->get( 'terminated' ) : "";
		$rtn_cf       = ! empty( $request->get( 'rtn_cf' ) ) ? $request->get( 'rtn_cf' ) : "";
		$box_admin_id = ! empty( $request->get( 'box_admin_id' ) ) ? $request->get( 'box_admin_id' ) : "";

		//var_dump($request->all());

		if ( $arrived == "true" ) {
			$arrived = 1;
		}

		if ( $terminated == "true" ) {
			$terminated = 1;
		}

		if ( $rtn_cf == "true" ) {
			$rtn_cf = 1;
		}

		if ( $boxed == "true" ) {
			$boxed = 1;
		}

		if ( $canceled == "true" ) {
			$canceled = 1;
		}
		/*
		 else {
			$arrived = 0;
		}
		*/
		$isUpdate = false;
		if ( ! empty( $box_admin_id ) ) {
			DB::table( 'boxes' )->where( 'id', $box_id )->update( [
				'admin_id' => $box_admin_id
			] );
			$isUpdate = true;
		}

		if ( $arrived == 1 ) {
			DB::table( 'boxes' )->where( 'id', $box_id )->update( [
				'arrived' => $arrived
			] );

			/*$cnt = DB::table( 'boxes' )
			         ->where( 'order_id', $order->id )
			         ->where( 'canceled', "0" )
			         ->where( 'arrived', "0" )
			         ->count();*/
  
			$next_subscription = date('Y-m-d', strtotime(new Carbon().' +30 days'));
			$latest_subscription = date('Y-m-d', strtotime(new Carbon().' +1 day'));

			//if ( $cnt == 0 ) {
				DB::table( 'orders' )->where( "id", $order->id )->update( [
					'status' => Order::SCHEDULE_ALREADY_PICKUP,
					'next_subscription' => $next_subscription,
					'latest_subscription' => $latest_subscription
				] );
			//}
			$isUpdate = true;
		}

		if ( $canceled == 1 ) {
			$boxObj = DB::table( 'boxes' )->where( 'id', $box_id );
			$box    = $boxObj->first();
			if ( $box->canceled == "0" ) {
				$boxObj->update( [
					'canceled'    => $canceled,
					'canceled_at' => date( "Y-m-d H:i:s" )
				] );

				$box = $boxObj->first();

				$baseFee          = Box::FEE_BOX_BASE;
				$boxFee           = 0;
				$monthlyFee       = 0;
				$addAmtServiceFee = 0;
				$addWording       = "";
				if ( $box->package_id == Package::BOX_NORMAL ) {

					$n_cnt = DB::table( 'boxes' )
					           ->where( 'order_id', $box->order_id )
					           ->where( 'package_id', Package::BOX_NORMAL )
					           ->where( 'canceled', "0" )
					           ->count();

					$boxFee     = Box::FEE_BOX_NORMAL;
					$monthlyFee = Box::FEE_BOX_NORMAL_MONTHLY;
					/*
					if($n_cnt == 0){
						$baseFee = Box::FEE_BOX_BASE;
					}
					*/
					$category_id = 9;//標準箱取消
				}

				if ( $box->package_id == Package::LARGE_ITEM ) {

					$b_cnt = DB::table( 'boxes' )
					           ->where( 'order_id', $box->order_id )
					           ->where( 'package_id', Package::LARGE_ITEM )
					           ->where( 'canceled', "0" )
					           ->count();

					$boxFee     = Box::FEE_BOX_LARGE;
					$monthlyFee = Box::FEE_BOX_LARGE_MONTHLY;
					/*
					if($b_cnt == 0){
						$baseFee = Box::FEE_BOX_BASE;
					}
					*/
					$category_id = 10;//大型物品取消
				}


				$orderItem = DB::table( "order_items" )
				               ->where( "order_id", $order->id )
				               ->where( "package_id", $box->package_id )
				               ->first();

				if ( $orderItem->addition_service > 0 && $box->package_id == Package::LARGE_ITEM ) {
					$origQuantity        = $orderItem->quantity;
					$orderItem->quantity = $orderItem->quantity - 1;
					if ( $orderItem->addition_service > 0 && $orderItem->addition_service <= $origQuantity ) {
						$orderItem->addition_service = $orderItem->addition_service - 1;
						$addAmtServiceFee            = Box::FEE_AMT_SERVICE;
					}

					$orderItemAry = (array) $orderItem;
					DB::table( "order_items" )
					  ->where( "order_id", $order->id )
					  ->where( "package_id", $box->package_id )
					  ->update( $orderItemAry );
				}

				$monthlyFee += $addAmtServiceFee;
				$refundFee  = $monthlyFee + $boxFee;

				/*
				if($baseFee > 0){
					$addWording .= "(含基本費)";
				}
				*/

				if ( $addAmtServiceFee > 0 ) {
					$addWording .= "(含影像處理費)";
				}

				$subscription = DB::table( 'subscriptions' )
				                  ->where( 'user_id', $order->user_id )
				                  ->where( 'order_id', $order->id )
				                  ->first();
				$upFloorFee   = $subscription->floor_fee;

				//Update Subscriptions Data
				$upMonthlyCost = $subscription->monthly_cost - $monthlyFee;

				if ( $upMonthlyCost > 0 ) {
					$upShippingFee = $subscription->shipping_fee - $boxFee;
				} else {
					$addWording    .= "(含基本費返還)";
					$upShippingFee = $subscription->shipping_fee - ( $baseFee + $boxFee );
					$refundFee     += $baseFee;
					if ( $subscription->floor_fee > 0 ) {
						$addWording .= "(含樓層處理費)";
						$refundFee  += $subscription->floor_fee;
						$upFloorFee = 0;
					}
				}

				$upBillingAmount = $upMonthlyCost + $upShippingFee + $upFloorFee;

				$package    = new Packages;
				$depositArr = [
					"user_id"       => $order->user_id,
					"p_cnt"         => $refundFee,
					"pay_amt"       => 0,
					"created_at"    => date( "Y-m-d H:i:s" ),
					"created_by"    => 1,
					"category_id"   => $category_id,
					"op_type"       => "refund",
					"api_key"       => $box->id,
					"api_memo_note" => "取消返還" . $addWording
				];

				$package->addDeposits( $depositArr, true );

				$subDataArr = [
					"monthly_cost"   => $upMonthlyCost,
					"shipping_fee"   => $upShippingFee,
					"billing_amount" => $upBillingAmount,
					"floor_fee"      => $upFloorFee,
					"updated_at"     => date( "Y-m-d H:i:s" ),
				];

				DB::table( 'subscriptions' )
				  ->where( 'user_id', $order->user_id )
				  ->where( 'order_id', $order->id )
				  ->update( $subDataArr );

				/*
				$order->shipping_fee = $upShippingFee;
				$order->monthly_cost = $upMonthlyCost;
				$order->moving_floor = $upFloorFee;
				*/
				$order->save();

				$ccnt = DB::table( 'boxes' )
				          ->where( 'order_id', $order->id )
				          ->where( 'canceled', "0" )
				          ->count();

				if ( $ccnt == 0 ) {
					DB::table( 'orders' )->where( "id", $order->id )->update( [
						'status' => Order::SCHEDULE_CANCELED
					] );
				}

				$cknt = DB::table( 'boxes' )
				          ->where( 'order_id', $order->id )
				          ->where( 'canceled', "0" )
				          ->where( 'arrived', "0" )
				          ->count();
				if ( $cknt == 0 ) {
					DB::table( 'orders' )
					  ->where( "id", $order->id )
					  ->where( "status", "<", Order::SCHEDULE_ALREADY_PICKUP )
					  ->update( [
						  'status' => Order::SCHEDULE_ALREADY_PICKUP
					  ] );
				}
			}

			$isUpdate = true;
		}

		if ( $boxed == 1 ) {
			DB::table( 'boxes' )->where( 'id', $box_id )->update( [
				'boxed' => $boxed
			] );

			$cnt = DB::table( 'boxes' )
			         ->where( 'order_id', $order->id )
			         ->where( 'boxed', "0" )
			         ->where( 'canceled', "0" )
			         ->count();

			$pcnt = DB::table( 'boxes' )
			          ->where( 'order_id', $order->id )
			          ->where( 'boxed', "1" )
			          ->where( 'picked', "1" )
			          ->where( 'canceled', "0" )
			          ->count();

			$maxCnt = DB::table( 'boxes' )
			            ->where( 'order_id', $order->id )
			            ->where( 'canceled', "0" )
			            ->count();

			if ( $cnt == 0 && $order->status == Order::SCHEDULE_NEX_BOX ) {//全數空箱已送達, 此時不應是派送空箱的狀態
				if ( $maxCnt == $pcnt ) {//表示全數己預約取件入倉
					$myStatus = Order::SCHEDULE_DURING_PICKUP;
				} else {//表示部份仍待預約取件入倉
					$myStatus = Order::SCHEDULE_WAIT_PICKUP;
				}
				DB::table( 'orders' )->where( "id", $order->id )->update( [
					'status' => $myStatus
				] );
			}
			$isUpdate = true;
		}

		if ( $rtn_cf == 1 ) {
			DB::table( 'boxes' )->where( 'id', $box_id )->update( [
				'rtn_cf' => $rtn_cf
			] );


			/*
			 * Calc date
			 */

			$date_diff = $this->datediff('m', $order->date_create, date( "Y-m-d H:i:s" ));
			if($date_diff < 1){
				$subcription = DB::table( 'subscriptions' )
				  ->where( 'user_id', $order->user_id )
				  ->where( 'order_id', $order->id )->first();

				//Calculate fee that user haven't spent yet
				$return_fee = $subcription->monthly_cost - ($subcription->monthly_cost * $date_diff);

				$refund_user = User::find($order->user_id);
				$refund_user->total_credit += $return_fee;
				$refund_user->save();

			}


			$isUpdate = true;
		}

		if ( $terminated == 1 ) {
			DB::table( 'boxes' )->where( 'id', $box_id )->update( [
				'closed'    => $terminated,
				'closed_at' => date( "Y-m-d H:i:s" )
			] );

			$cnt = DB::table( 'boxes' )
			         ->where( 'order_id', $order->id )
				//->where('arrived', "1")
				//->where('picked', "1")
				//->where('rtn', "0")
				     ->where( 'canceled', "0" )
			         ->where( 'closed', "0" )
			         ->count();
			if ( $cnt == 0 ) {
				DB::table( 'orders' )->where( "id", $order->id )->update( [
					'status' => Order::SCHEDULE_TERMINATED
				] );
			}
			$isUpdate = true;
		}

		return $isUpdate;
	}

	/**
	 * Remove the specified order from order.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Order $order, Request $request ) {
		if ( $request->ajax() ) {
			$order->delete();

			return response()->json( [ 'success' => 'Order has been deleted successfully' ] );
		} else {
			return 'You can\'t proceed in delete operation';
		}
	}

	function datediff( $str_interval, $dt_menor, $dt_maior, $relative=false){

		if( is_string( $dt_menor)) $dt_menor = date_create( $dt_menor);
		if( is_string( $dt_maior)) $dt_maior = date_create( $dt_maior);

		$diff = date_diff( $dt_menor, $dt_maior, ! $relative);

		switch( $str_interval){
			case "y":
				$total = $diff->y + $diff->m / 12 + $diff->d / 365.25; break;
			case "m":
				$total= $diff->y * 12 + $diff->m + $diff->d/30 + $diff->h / 24;
				break;
			case "d":
				$total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
				break;
			case "h":
				$total = ($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h + $diff->i/60;
				break;
			case "i":
				$total = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i + $diff->s/60;
				break;
			case "s":
				$total = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;
				break;
		}
		if( $diff->invert)
			return -1 * $total;
		else    return $total;
	}
}
