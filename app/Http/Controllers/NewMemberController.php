<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\ProfileRequest;
use App\Package;
use App\Http\Classes\Packages;
use App\Feature;
use App\User;
use App\Referral;
use Auth;
use Validator;
use Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;
use App\Coupons;
use App\Order;
use App\Logistic;
use App\Box;
use DateTime;
use DateInterval;
use App\CouponHistroy;
use App\AlertService;
use App\PointsService;

class NewMemberController extends MemberController
{
    /**
    * Schedule Pickup Exp(Warehouse)
    * 
    * @param Request $request
    * @return {\Illuminate\View\View|Request}
    */
    public function schedule_pickup_exp_back(Request $request){
        $isBack = "Y";
        return $this->warehouseGo($request, $isBack);
    }
    
    /**
    * Schedule Pickup Exp(Warehouse)
    * 
    * @param Request $request
    * @return {\Illuminate\View\View|Request}
    */
    public function schedule_pickup_exp(Request $request){
        $isBack = "N";
        return $this->warehouseGo($request, $isBack);
    }
    
    private function warehouseGo(Request $request, $isBack = "N"){
        $wareHouseActive = env("WARE_HOUSE_ACTIVE", "N");
        if($wareHouseActive == "N"){
            return Redirect::to('/member/comeinsoon');    
        }

        $userId = \Auth::user()->id;
        $rtAry = $this->boxesService->getWhareHouseBoxes($userId);
        $boxes = $rtAry['boxes'];
        $orders = $rtAry['orders'];
        //var_dump($orders);     
        $largeBoxes = $this->boxesService->getWhareHouseLargeBoxes($userId);     
        $rtnBoxes = $this->boxesService->getWhareHouseRtnBoxes($userId);
        $boxestabs = $this->boxesService->getWhareHouseInHouseBoxes($userId);
        
        //$orders = $this->boxesService->getOrderInfoFromLargeAndNormalBox($boxes, $largeBoxes);   

        $lastorder = Order::getLastOrderByUserId(\Auth::user()->id);
        //var_dump($rtnBoxes);

        //return view('member.pickup.pickup')->with(compact('request', 'boxes', 'pictures', 'lastorder'));
        return view('member.warehouse-new')->with(compact('request', 'boxes', 'pictures', 'lastorder', 'boxestabs', 'largeBoxes','rtnBoxes', 'orders', 'isBack'));        
    }
    
    public function warehouse(Request $request){
        $wareHouseActive = env("WARE_HOUSE_ACTIVE", "N");
        if($wareHouseActive == "N"){
            return Redirect::to('/member/comeinsoon');    
        }

        $userId = \Auth::user()->id;
        $boxes = DB::table('boxes')
            ->select('boxes.order_id as order_id', 'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id', 'boxes.package_id as package_id')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('boxes.package_id', Package::BOX_NORMAL)
            ->where('boxes.rtn', 0)
            ->where('boxes.closed', 0)
            ->where('boxes.picked', 0)
            ->where('boxes.boxed', 1)
            ->where('boxes.canceled', "0")
            ->paginate(8);
        //$orders = $rtAry['orders'];     
        //$largeBoxes = $this->boxesService->getWhareHouseLargeBoxes($userId)->paginate(8);     
        $boxestabs = DB::table('boxes')
            ->select('boxes.order_id as order_id', 'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id', 'boxes.package_id as package_id')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('boxes.package_id', Package::BOX_NORMAL)
            ->where('boxes.rtn', 0)
            ->where('boxes.closed', 0)
            ->where('boxes.picked', 0)
            ->where('boxes.boxed', 1)
            ->where('boxes.canceled', "0")
            ->paginate(8);   

        $lastorder = Order::getLastOrderByUserId(\Auth::user()->id);

        //return view('member.pickup.pickup')->with(compact('request', 'boxes', 'pictures', 'lastorder'));
        return view('member.warehouse-old')->with(compact('request', 'boxes', 'pictures', 'lastorder', 'boxestabs'));        
    }
    
    /**
    * Schedule Pickup Post(Warehouse Into)
    * 
    * @param Request $request
    * @return {{\Illuminate\View\View|Request}
    */
    public function schedule_pickup_post(Request $request){
        //Session::put('wareHousePickInit', false);  
        if(Null !== $request->get('action') && ($request->get('action') === '預覽' || $request->get('action') === '送出')) {  
        }else{
            Session::put('wareHousePickInit', true);
            Session::forget('boxesbase');
        }  
        return $this->schedule_pickup($request);
    }
    
    /**
    * Schedule Pickup Get(Normal Into)
    * 
    * @param Request $request
    * @return {{\Illuminate\View\View|Request}
    */
    public function schedule_pickup_get(Request $request){
 
        //Session::put('wareHouseInit', false);    
        return $this->schedule_pickup($request);
    }
    
    /**
    * Schedule Item Post(Warehouse Into)
    * 
    * @param Request $request
    * @return {{\Illuminate\View\View|Request}
    */
    public function schedule_item_post(Request $request){
        //Session::put('wareHouseItemInit', false);  
        if(Null !== $request->get('action') && ($request->get('action') === '預覽' || $request->get('action') === '送出')) {
        }else{
            Session::put('wareHouseItemInit', true);
            Session::forget('boxesRtnbase');
        }

	    $lastorder = Order::getLastOrderByUserId(\Auth::user()->id);
	    if(\Auth::user()->total_credit < ($lastorder->monthly_cost + $lastorder->shipping_fee)){
		    return redirect('/member/home#desposit')->with('status', '您的餘額不足，請前往儲值，謝謝');
	    }

        return $this->schedule_pickup($request, 1);
    }
    
    /**
    * Schedule Item Get(Normal Into)
    * 
    * @param Request $request
    * @return {{\Illuminate\View\View|Request}
    */
    public function schedule_item_get(Request $request){
        //Session::put('wareHouseInit', false);    
        return $this->schedule_pickup($request, 1);
    }
    
    /**
    * Schedule Pickup
    * 
    * @param Request $request
    * @return {\Illuminate\View\View|Request}
    */
    private function schedule_pickup(Request $request, $isItemBack = 0){

	    if(empty(\Auth::user()->address)) return redirect('/new-user');
	    elseif(\Auth::user()->total_credit == 0) return redirect('/deposit')->with('status', '您的餘額不足，請前往儲值，謝謝');

        $wareHouseInit = false;
        $wareHouseType = (null !== $request->get("wareHouseType")) ? $request->get("wareHouseType") :  "Normal" ;

	    $lastorder = Order::getLastOrderByUserId(\Auth::user()->id);
        /*
        if($wareHouseType !== "Normal"){
            Session::forget('boxesRtnbase'); 
            Session::forget('boxesbase');   
            Session::put('wareHouseItemInit', false);  
            Session::put('wareHousePickInit', false);           
        }
        */
        $boxAry = $request->get('boxesbase');
        if($isItemBack == 0){
            $boxTmp = Session::get('boxesbase');
        }else{
            $boxTmp = Session::get('boxesRtnbase');           
        }
        
        if(is_array($boxAry)) {
            ksort($boxAry);
            foreach($boxAry as $box){
                $rtnFlag = isset($box['rtnFlag'])? $box['rtnFlag'] : "false";
                if($rtnFlag == "true"){
                    $boxes[] = $this->boxesService->getSingleBoxesByRtnCondition(\Auth::user()->id, $box['id']);
                }else{
                    $boxes[] = $this->boxesService->getSingleBoxesByPickupCondition(\Auth::user()->id, $box['id'], $isItemBack, $isItemBack);
                }
            } 
            
            //var_dump($boxAry);   
            if($isItemBack == 0){
                Session::put('boxesbase', $boxes);  
            }else{
                Session::put('boxesRtnbase', $boxes);            
            }
        }else{
            //if($wareHouseType == "Normal"){
            $wareHouseInit = (Session::get("wareHousePickInit") || Session::get("wareHouseItemInit"));
            if($wareHouseInit !== true){
                $boxes = $this->boxesService->getMultiBoxesByPickupCondition(\Auth::user()->id, $isItemBack, $isItemBack);
            }else{
                $boxes = $boxTmp;
            }
        }
        //die();

        if($isItemBack == 0){
            if(count($boxes) == 0 && NULL === session('status')) return redirect('/schedule-new-box')->with('status', '請先預約空箱才能使用預約入倉取件！');
        }else{
            if(count($boxes) == 0 && NULL === session('status')) return redirect('/schedule-pickup')->with('status', '請先預約入倉取件才能使用預約出倉取件！或是品項正在入倉中！');
        }

        /*if ($request->hasFile('box_pickup_image')) {
            $files = $request->file('box_pickup_image');

            foreach($files as $file){
                if(NULL === $file) continue;
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = md5(date("Y-m-d H:i:s").rand(111,999)) . '.' . $extension;
                $destinationPath = base_path() . '/public/uploads/boxes';
                //$file->move($destinationPath, $picture);
                $pictures[] = $picture;
            }
        }*/

        if(Null !== $request->get('action') && $request->get('action') === '送出') {
            Session::put('wareHouseItemInit', false);  
            Session::put('wareHousePickInit', false);  
            $ship_date = date_create($request->get('ship_date'));
            $pickup_date = $ship_date->format('Y-m-d');
            $pickup_time = $request->get('ship_time');
            $logisticAction = NULL;

			//Schedule next subscription 1 day after pickup
	        //$next_subscription = date('Y-m-d', strtotime($ship_date->format('Y-m-d'). ' +1 day'));

            $exchangeFlag = false;
            if($isItemBack == 0){
                $logisticAction = Logistic::TYPE_PICUP;
                $dataAry = [
                            'user_id' => \Auth::user()->id,
                            'pickup_date' => $pickup_date,
                            'pickup_time' => $pickup_time,
                            
                            //'latest_subscription' => $ship_date->format('Y-m-d'),
                            //'next_subscription' => $next_subscription,
                            
                            'status'        => Order::SCHEDULE_DURING_PICKUP,
                            'address' => $request->get('address'),
                            'county' => $request->get('county'),
                            'district' => $request->get('district'),
                            'zipcode' => $request->get('zipcode'),
                            'phone' => $request->get('phone'),
                            'note' => $request->get('special_instruction'),
                            'updated_at' => new Carbon(),
                           ];
                $orders = Order::updateOrdersByCondition(\Auth::user()->id, Order::SCHEDULE_WAIT_PICKUP, $dataAry);


            }else{
                $logisticAction = Logistic::TYPE_DELIVERY;  
                $exchangeFlag = true;          
            }

            $this->saveLogistics($logisticAction,$request, $boxes, $pickup_date, $pickup_time, $exchangeFlag);

            if(is_array($request->get('box_pickup'))) {
                if($isItemBack == 0){
                    $picked = true;
                    $return = false;
                }else{
                    $picked = true;
                    $return = true;                 
                }
                
                foreach($request->get('box_pickup') as $i => $box_pickup){
                    $dataAry = ['picked' => $picked, 'rtn' => $return];
                    $this->boxesService->updateSingleBoxById($box_pickup['id'], $dataAry);
                }
            }

            if($isItemBack == 0){
                $subject = "預約入倉取件下單成功通知!!";
                $msg = '預約入倉取件已完成！';
            }else{
                $subject = "預約出倉返件下單成功通知!!";   
                $msg = '預約出倉返件已完成！';          
            }

            $data = new \stdClass();
            $data->request = $request;
            $data->boxes = $boxes;
            //$data->pictures = $pictures;
            $this->alertService->sendSchedulePickupSuccessAlert($subject, \Auth::user(), $data);

	        if(\Auth::user()->total_credit < ($lastorder->monthly_cost + $lastorder->shipping_fee) && $isItemBack == 0){

		        return redirect('/member/home#desposit')->with('status', '您的餘額不足，請前往儲值，謝謝');
	        }

            if($wareHouseInit !== true){
                return back()->with('status', $msg);  
            }else{
                return redirect('/member/warehouse')->with('status',$msg);   
            }
        }

    
        if($isItemBack == 0){
            $myTemplate = 'frontend.schedule-pickup';
        }else{
            $myTemplate = 'frontend.schedule-item';        
        }
        //return view('member.pickup.pickup')->with(compact('request', 'boxes', 'pictures', 'lastorder'));
        return view($myTemplate)->with(compact('request', 'boxes', 'pictures', 'lastorder'));

    }
    
    /**
    * Schedule New Box
    * 
    * @param Request $request
    * @return {\Illuminate\View\View|Request}
    */
    public function schedule_new_box(Request $request){
        if(empty(\Auth::user()->address)) return redirect('/new-user');
        elseif(\Auth::user()->total_credit == 0) return redirect('/deposit')->with('status', '您的餘額不足，請前往儲值，謝謝');

        $packages = Package::active()->get();
        $features = Feature::active()->get();

        $packages_arr = Package::getPackageArray($packages);
        
        $largeFlag = false;
        if(NULL != $request->get("checktopleft")){
            //print_r($_POST);
            //die();
            $selectedPackages = $request->get('packages');
            if($selectedPackages[Package::LARGE_ITEM]['box_quantity'] > 0 && $selectedPackages[Package::BOX_NORMAL]['box_quantity'] == 0){
                $largeFlag = true;
            }
            
            $monthly_fee = $request->get("monthly_cost");
            $shipping_fee = $request->get("shipping_fee");
            $original_credit = (float) DB::table('users')->where('id', \Auth::user()->id)->value('total_credit');
            $remain_credit = $original_credit - ($monthly_fee + $shipping_fee);
            
            if($remain_credit < 0){
                return redirect('/deposit')->with('status', '您的餘額不足，請前往儲值，謝謝');                   
            }
        }

        $slug = NULL !== $request->get('slug') ? $request->get('slug') : '';
        
        $credit = DB::table('users')
            ->where('id', \Auth::user()->id)->value('total_credit');
            
        
        $lcheck = $request->checktopleft;     

        $boxes = $this->boxesService->getBoxByUserIdAndIsPicked(\Auth::user()->id);

       // if(count($boxes) == 0 && NULL === session('status')) return redirect('/schedule-new-box')->with('status', '請先預約空箱才能使用預約取件！');

        $pictures = array();

        $lastorder = Order::getLastOrderByUserId(\Auth::user()->id);
    
        return view('frontend.schedule-new-box'.$slug)->with(compact('request', 'packages', 'features', 'packages_arr','credit','lcheck', 'boxes', 'pictures', 'lastorder', 'largeFlag'));
    }

    /**
    * Schedule Pickup Large
    * 
    * @param Request $request
    * @return {\Illuminate\View\View|Request}
    */
    public function schedule_pickup_large(Request $request){
        return view('frontend.schedule-pickup-large')->with(compact('request', 'boxes', 'pictures'));
    }
    
    /**
    * Checkout Order for new box and pickup requirement
    * 
    * @param Request $request
    * @return {\Illuminate\View\View|Request}
    */
    public function checkout(Request $request)
    {
            
        $moving_floor_flag = $request->get('moving_floor');
        $floor_fee = $request->get('floor_fee');
        
        $floorAry = $this->getMoveFloorFlag($moving_floor_flag, $floor_fee);
        
        $floor_fee = $floorAry['floor_fee'];
        $moving_floor = $floorAry['moving_floor'];
                
        $packages = Package::active()->get();
        $features = Feature::active()->get();
        
        $packages_arr = Package::getPackageArray($packages);
        
        if(\Auth::user()->id && NULL !== $request->get('action') && null !== $request->get('packages')){
            
            $shipping_fee = $monthly_fee = $total_box= 0;
            
            $selected_package = $request->get('packages');
            $package_features = array();
            
            $boxesAry = array();
            $boxCnt = 0;
            $amtServiceCnt = 0;
            foreach($selected_package as $package_id => $package){
                //var_dump($package);
                
                $current_package =  Package::getSinglePackage($package_id);

                $package_features[$package_id] = $current_package_features = Package::getFeaturePackageByPackageId($package_id);
                
                //$total_box += $n = (int) $package['box_quantity'];
                $n = (int) $package['box_quantity'];
                for($x = 0; $x < $n; $x ++){
                    $boxCnt ++;
                    $myBox = array();
                    $myBox['package_id'] = $package_id;
                    $myBox['sn'] = $boxCnt; 
                    $boxesAry[] = $myBox;     
                }
                $service_cost = (float) $current_package_features[6]->spec;
                $amt_service = (int) $package['amt_service'];
                //if(($amt_service * $service_cost) > 0){
                //    $amtServiceCnt ++;
                //}
                

                //$f = '$shipping_fee += '.str_replace('n', '$n', $current_package_features[5]->spec).';';
                //eval($f);
                $monthly_fee += $current_package->cost * $n + $amt_service * $service_cost;

            }
            $shipping_fee = $request->get('shipping_fee');

             //   : date('Y-m-d', strtotime($dropOffDate.' +7 days'));
 

	        //**Schedule next subscription after 15 days
	        $next_subscription = date('Y-m-d', strtotime(new Carbon().' +15 days'));


            if($request->get('newbox_date') != NULL){

                $latest_subscription = date('Y-m-d', strtotime($request->get('newbox_date').' +14 days'));



            }else{
                $latest_subscription = null;
            }

            if($request->get('moving_floor') == true){

            }
            
            
            $original_credit = (float) DB::table('users')->where('id', \Auth::user()->id)->value('total_credit');
            $remain_credit = $original_credit - ($monthly_fee + $shipping_fee + $floor_fee);
            
            if($remain_credit < 0){
                return redirect('/deposit')->with('status', '您的餘額不足，請前往儲值，謝謝');                   
            }
            
            
            
            $newbox_date = $request->get('newbox_date');
            $newbox_time = $request->get('newbox_time');
            
            $pickup_date = $request->get('pickup_date');
            $pickup_time = $request->get('pickup_time');
            
            $orderAry = [
                    'user_id' => \Auth::user()->id,
                    
                    'pickup_date' => $pickup_date,
                    'pickup_time' => $pickup_time,
              
                    'newbox_date' => $newbox_date,
                    'newbox_time' => $newbox_time,

                    'latest_subscription' => $latest_subscription,
                    'next_subscription' => $next_subscription,
                    'moving_floor' => $moving_floor,
                    'shipping_fee' => $shipping_fee,
                    'floor_fee' => $floor_fee,
                    'monthly_cost' => $monthly_fee,

                    'address' => $request->get('address'),
                    'county' => $request->get('county'),
                    'district' => $request->get('district'),
                    'zipcode' => $request->get('zipcode'),
                    'phone' => $request->get('phone'),
                    'note' => $request->get('special_instruction'),
                    'status' => Order::SCHEDULE_NEX_BOX,

                    'created_at' => new Carbon
                    ];
            
            $order_id = Order::insertOrder($orderAry, $selected_package);

            $total_box = count($boxesAry);
            $boxNum = 0;
            $itemNum = 0;
            $picked = 0;
            $boxed = 0;
            if($request->get('pickup_date') != NULL){
                $picked = 1;
            }
            
            $depositMemo = "月租";
            $boxName = "";
            $itemName = "";
            $amtName = "";

            if($amt_service > 0){
                $amtName = "影像處理 " . $amt_service;
            }
            for($i=0; $i < $total_box; $i++){
                $box = $boxesAry[$i];
                $package_id = $box['package_id'];
                $name = "Unknow";
                if($package_id == 1){
                    $boxNum ++;
                    $boxName = "空箱 " . $boxNum;
                    $name = $boxName;
                }
                
                if($package_id == 2){
                    $itemNum ++;
                    $itemName = "大型物品 " . $itemNum;
                    $boxed = 1;
                    $name = $itemName;
                }
                
                $boxAry = [
                        'order_id' => $order_id,
                        'name' => $name,
                        'package_id' => $package_id,
                        'picked' => $picked,
                        'boxed' => $boxed,
                        'created_at' => new Carbon
                        ];
                $this->boxesService->insertBox($boxAry);
            }
            
            $nameTmpAry = array($depositMemo);
            if($boxName != ""){
                $nameTmpAry[] = $boxName;
            }
            if($itemName != ""){
                $nameTmpAry[] = $itemName;
            }
            if($amtName != ""){
                $nameTmpAry[] = $amtName;
            }
            $depositMemo = join("/",$nameTmpAry);
            
            $boxes = $this->boxesService->getBoxesByOrderId($order_id);
            
            $this->saveLogistics(Logistic::TYPE_NEW_BOX,$request, $boxes, $newbox_date, $newbox_time);
            
            //只要有填預約日期
            if($picked == 1){
                //該訂單無空箱的狀態, 才須異動訂單狀態
                if($boxName == ""){  
                    $orderAry = [
                        'status'        => Order::SCHEDULE_DURING_PICKUP,
                        'updated_at' => new Carbon(),
                        ];
                    Order::updateOrderById($order_id, $orderAry);
                }
                $this->saveLogistics(Logistic::TYPE_PICUP,$request, $boxes, $pickup_date, $pickup_time);
            }else{
                //該訂單無空箱的狀態, 才須異動訂單狀態
                if($boxName == ""){  
                    $orderAry = [
                        'status'        => Order::SCHEDULE_WAIT_PICKUP,
                        'updated_at' => new Carbon(),
                        ];
                    Order::updateOrderById($order_id, $orderAry);
                }                
            }


            //if(null !== $request->get('pickup_date')){
            DB::table('subscriptions')->insert([
                'order_id' => $order_id,
                'user_id' => \Auth::user()->id,
                'monthly_cost' => $monthly_fee,
                'shipping_fee' => $shipping_fee,
                'floor_fee' => $floor_fee,
                'billing_amount' => $monthly_fee + $shipping_fee + $floor_fee,
                'original_credit' => $original_credit,
                'created_at' => new Carbon()
            ]);

            //Exchange Points
            //$exchangePoint = ($monthly_fee + $shipping_fee + $floor_fee);
            $exchangeArr = ["user_id" => \Auth::user()->id ,
                           "p_cnt" => $monthly_fee,
                           "pay_amt" => 0, 
                           "created_at" => date("Y-m-d H:i:s"),
                           "created_by" => 1, 
                           "category_id" => 6,
                           "op_type" => "system",
                           "api_key" => $order_id,
                           "api_memo_note" => $depositMemo
                          ];
            
            Packages::addExchange($exchangeArr);
            $exchangeArr['p_cnt'] = $shipping_fee;
            $exchangeArr['category_id'] = 4;
            $exchangeArr['api_memo_note'] = "運費";
            Packages::addExchange($exchangeArr);
            $exchangeArr['p_cnt'] = $floor_fee;
            $exchangeArr['category_id'] = 7;
            $exchangeArr['api_memo_note'] = "樓層處理";
            Packages::addExchange($exchangeArr);
            
            DB::table('users')->where('id', \Auth::user()->id)->update(['total_credit' => $remain_credit]);

            //}


            DB::table('users')->where('id', \Auth::user()->id)->update([
                'address' => $request->get('address'),
                'county' => $request->get('county'),
                'district' => $request->get('district'),
                'zipcode' => $request->get('zipcode'),
                'mobile' => $request->get('phone'),
            ]);

            $subject = "月租訂單內容確認通知!!";
            $data = new \stdClass();
            $data->request = $request;
            $data->packages_arr = $packages_arr;
            $this->alertService->sendBillReviewAlert($subject, \Auth::user(), $data);            

            return redirect('/member/warehouse');

        }

        $referrals = Referral::where('user_id', Auth::user()->id)->first();

        $lcheckfinal = $request->ppvheck; 
            
        
        return view('frontend.booking.checkout')->with(compact(
            'request',
            'packages',
            'features',
            'lcheckfinal',
            'packages_arr'
        ));
    }
    
    private function saveLogistics($action, Request $request,$boxes,$ship_date, $ship_time, $exchangeFlag = false){  
        $logisticAry = array();
        $shippingFee = Box::FEE_BOX_BASE;
        $moving_floor = 0;
        $moving_floor_flag = $request->get('moving_floor');
        if($moving_floor_flag == "100"){
            $moving_floor = 1;    
            $shippingFee += $moving_floor_flag;
        }

        $fixOrder = "0";
        $checkShippingFeeAry = array();
        foreach($boxes as $box){
            $myType = "Full";
            if($action == Logistic::TYPE_NEW_BOX){
                if($box->package_id == Package::BOX_NORMAL){
                    $myType = "Empty";    
                }else{
                    continue;
                }
            }
            if($action == Logistic::TYPE_DELIVERY){
                $checkShippingFeeAry[$box->package_id] = 1;
                
                $logisticAry[$fixOrder] = isset($logisticAry[$fixOrder]) ? $logisticAry[$fixOrder] : array("shippingFee" => $shippingFee, "itemAry" => array());
                $logisticAry[$fixOrder]['shippingFee'] += Box::calShippingFee($box->id);
                $logisticAry[$fixOrder]['itemAry'][$box->order_id] = isset($logisticAry[$fixOrder]['itemAry'][$box->order_id]) ? $logisticAry[$fixOrder]['itemAry'][$box->order_id] : array();
                $logisticAry[$fixOrder]['itemAry'][$box->order_id][] = array($box->id, $box->package_id ,$myType);         
            }else{
                $logisticAry[$box->order_id] = isset($logisticAry[$box->order_id]) ? $logisticAry[$box->order_id] : array("shippingFee" => $shippingFee, "itemAry" => array());
                $logisticAry[$box->order_id]['shippingFee'] += Box::calShippingFee($box->id);
                $logisticAry[$box->order_id]['itemAry'][] = array($box->id, $box->package_id ,$myType);
            }
        }
      
        if($action == Logistic::TYPE_DELIVERY){
            //同時有大型物品和標準箱的狀況需計算兩次基本費
            /*
            if(count($checkShippingFeeAry) == 2){
                $shippingFee = $logisticAry[$fixOrder]['shippingFee'] += Box::FEE_BOX_BASE;    
            }
            */
            $shippingFee = $logisticAry[$fixOrder]['shippingFee'];
            $user = User::find(Auth::user()->id);
            $currentUserPoint = $user->total_credit;
            
            $remainCredit = $currentUserPoint - $shippingFee;

            if($remainCredit < 0){
                return false;
            }
        }
            
        foreach($logisticAry as $order_id => $tmpAry){
            $itemAry = $tmpAry['itemAry'];
            if($action == Logistic::TYPE_DELIVERY){
                if(count($itemAry) == 1){
                    $order_id = key($itemAry);
                    $itemAry = $itemAry[$order_id];
                }
            }
            $shippingFee = $tmpAry['shippingFee'];
            $logistic_id = DB::table('logistics')
                ->insertGetId([
                    'topic' => Logistic::getMyType($action),
                    
                    'order_id' => $order_id,
                    'shipping_items' => json_encode($itemAry),
                    'shipping_fee' => $shippingFee,
              
                    'user_shipping_date' => $ship_date,
                    'user_shipping_time' => $ship_time,
                    'moving_floor' => $moving_floor,
                    'address' => $request->get('address'),
                    'county' => $request->get('county'),
                    'district' => $request->get('district'),
                    'zipcode' => $request->get('zipcode'),
                    'phone' => $request->get('phone'),
                    'note' => $request->get('special_instruction'),
                    'status' => Logistic::NEW_ONE,

                    'created_at' => new Carbon
                ]);
        }
       
        if($action == Logistic::TYPE_DELIVERY){
            if($exchangeFlag == true){
                $exchangeArr = ["user_id" => \Auth::user()->id ,
                   "p_cnt" => $shippingFee,
                   "pay_amt" => 0, 
                   "created_at" => date("Y-m-d H:i:s"),
                   "created_by" => 1, 
                   "category_id" => 4,
                   "op_type" => "logistic",
                   "api_key" => $logistic_id,
                   "api_memo_note" => "運費"
                  ];
                
                Packages::addExchange($exchangeArr);
 
                $user->total_credit = $remainCredit;
                $user->save();
            }
        }
        return true;

    }
    
    private function getMoveFloorFlag($moving_floor_flag, $floor_fee){
        $rtData = array('floor_fee' => 0, 'moving_floor' => 0);
        //$floor_fee = 0;
        //$moving_floor = 0;
        if(NULL !== $moving_floor_flag){
            if($moving_floor_flag != ""){
                $rtData['floor_fee'] = $floor_fee;
                $rtData['moving_floor'] = 1;
            }    
        }    
        return $rtData;
    }

}
