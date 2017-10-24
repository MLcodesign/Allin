<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Order extends Model
{
    const SCHEDULE_NEX_BOX = 0;
    const SCHEDULE_OVER_TIME_BOOKING = 1;
    const SCHEDULE_WAIT_PICKUP = 2;
    const SCHEDULE_DURING_PICKUP = 3;
    const SCHEDULE_ALREADY_PICKUP = 4;
    const SCHEDULE_ITEM = 5;
    const SCHEDULE_TERMINATED = 6;
    const SCHEDULE_WAIT_ITEM = 7;
    const SCHEDULE_PART_ITEM = 8;
    const SCHEDULE_CANCELED_ITEM = 9;
    const SCHEDULE_WAIT_PICK_TO_HOUSE = 10;
    const SCHEDULE_CANCELED = 99;
    
	protected $table = 'orders';
	protected $appends = ['name'];

	public function getNameAttribute(){
		
		$user_name =  DB::table('users')->where('id', $this->user_id)->value('name');
		
		return $user_name;

	}
	
	public function getOrderStatus($echo = false, $lastPickupDate = null){
        $status = $this->status;
		$order_status = array(
			self::SCHEDULE_NEX_BOX => '派送空箱',//'schedule new box'
            self::SCHEDULE_OVER_TIME_BOOKING => '超時未預約',//'over time for schedule pickup'
            self::SCHEDULE_WAIT_PICKUP => '等待預約取件',//waiting for schedule pickup
			self::SCHEDULE_DURING_PICKUP => '進倉運送中',//'during pickup',
            self::SCHEDULE_ALREADY_PICKUP => '已入倉',
            self::SCHEDULE_ITEM => '派送物品',
            self::SCHEDULE_WAIT_ITEM => '倉內有待退倉品項',//'terminated',
            self::SCHEDULE_PART_ITEM => '部份已退倉',//'terminated',
			self::SCHEDULE_TERMINATED => '已退倉',//'terminated',
            self::SCHEDULE_CANCELED_ITEM => '部份取消',//'terminated',
            self::SCHEDULE_WAIT_PICK_TO_HOUSE => '等待取件',//'terminated',
            self::SCHEDULE_CANCELED => '已取消',//'terminated',
		);

		$order_status_color = array(
			self::SCHEDULE_NEX_BOX => 'info',
            self::SCHEDULE_OVER_TIME_BOOKING => 'danger',
            self::SCHEDULE_WAIT_PICKUP => 'warning',
			self::SCHEDULE_DURING_PICKUP => 'warning',
            self::SCHEDULE_ALREADY_PICKUP => 'success',
            self::SCHEDULE_ITEM => 'warning',
            self::SCHEDULE_WAIT_ITEM => 'danger',
            self::SCHEDULE_PART_ITEM => 'info',
			self::SCHEDULE_TERMINATED => 'danger',
            self::SCHEDULE_CANCELED_ITEM => 'info',
            self::SCHEDULE_WAIT_PICK_TO_HOUSE => 'info',
            self::SCHEDULE_CANCELED => 'danger',
		);
		
        if($status == self::SCHEDULE_NEX_BOX || $status == self::SCHEDULE_WAIT_PICKUP ){
            //todo: 派送空箱後起算七天
            if($this->latest_subscription == ''){
            }else{
                if(strtotime(date("Y-m-d")) > strtotime($this->latest_subscription)){
                    $status = self::SCHEDULE_OVER_TIME_BOOKING;
                }
            }

	        /*if($this->newbox_date != '0000-00-00' && strtotime(date("Y-m-d")) > strtotime($this->newbox_date.' +14 days')){
		        $status = self::SCHEDULE_OVER_TIME_BOOKING;
	        }*/
        }
        
        $fiveStatus = false;
        if($status == self::SCHEDULE_DURING_PICKUP){
            if(strtotime(date("Y-m-d")) <= strtotime($this->pickup_date)){
                $fiveStatus = true;
            }
        }
        
        //$tmpAry = array();
        $secStatus = false;
        $thirdStatus = false;
        $fourthStatus = false;
        if($status < self::SCHEDULE_TERMINATED){
            foreach($this->getBoxes() as $box){
                //$tmpAry[] = $box->id;
                //$tmpAry[] = $box->rtn;
                //$tmpAry[] = $box->closed;
                if($box->rtn == 1 && $box->closed == 0){
                    $secStatus = true;
                } 
                if($box->rtn == 1 && $box->closed == 1){
                    $thirdStatus = true;
                }
                if($box->canceled == 1){
                    $fourthStatus = true;
                }       
            }
        }
        
		$strBase = '<label class="label label-%s">%s</label>';
        $str = sprintf($strBase,$order_status_color[$status],$order_status[$status]);
        if($secStatus === true){
            $str .= " ".sprintf($strBase, $order_status_color[self::SCHEDULE_WAIT_ITEM], $order_status[self::SCHEDULE_WAIT_ITEM]);
        }
        if($thirdStatus === true){
            $str .= " ".sprintf($strBase, $order_status_color[self::SCHEDULE_PART_ITEM], $order_status[self::SCHEDULE_PART_ITEM]);
        }
        if($fourthStatus === true){
            $str .= " ".sprintf($strBase, $order_status_color[self::SCHEDULE_CANCELED_ITEM], $order_status[self::SCHEDULE_CANCELED_ITEM]);
        }
        if($fiveStatus === true){
            $str .= " ".sprintf($strBase, $order_status_color[self::SCHEDULE_WAIT_PICK_TO_HOUSE], $order_status[self::SCHEDULE_WAIT_PICK_TO_HOUSE]);
        }
                
        
        if($echo) echo $str;
        else return $str;		
	}
    
    public function getBoxes(){
        $boxes = DB::table('boxes')
            ->where("order_id", $this->id)
            ->get();
        return $boxes;
    }
    
    public static function getLastOrderByUserId($userId){
        return self::where('user_id',$userId)->orderBy('id', 'desc')->first();
    }
    
    public static function updateOrdersByCondition($userId, $statusCondition, $updateAry){
        return DB::table('orders')
                    ->where('user_id', $userId)
                    ->where('status', '<=',   $statusCondition)
                    ->update($updateAry);        
    }
    
    public static function updateOrderById($orderId, $orderAry){
        return DB::table('orders')
            ->where('id', $orderId)
            ->update($orderAry);        
    }
    
    public static function insertOrder($orderAry, $selected_package){
        $orderId = DB::table('orders')
                ->insertGetId($orderAry);
                    
        
        foreach($selected_package as $package_id => $package){
            $order_item_id = DB::table('order_items')
                ->insertGetId([
                    'order_id' => $orderId,
                    'package_id' => $package_id,
                    'quantity' => $package['box_quantity'],
                    'addition_service' => $package['amt_service'],
                ]);
        }
            
        return $orderId;    
    }
	
	public function getPricing($echo = false){
		$str = '';
		$packages = DB::table('packages')
				->select('packages.id as id', 'order_items.quantity as quantity', 'order_items.addition_service as service', 'packages.cost as cost', 'packages.cost_per as cost_per')
				
				->join('order_items', 'packages.id', '=', 'order_items.package_id')
				->where('order_items.order_id', $this->id)
				->get();
				
		foreach($packages as $package){
			
			$service = $package->service > 0 ? '+ '.$package->service.' 影像加值' : '';
			
			$str .= '<a href="'.url('admin/packages/' . $package->id).'/edit"><small><b>'.$package->quantity.'x</b></small> '.round($package->cost).' 點 '.$package->cost_per.'</a>'.$service.'<br/>';
		
		}
				
		
		if($echo) echo $str;
		else return $str;
	}
	
	public function getUserCredit(){
		$user = DB::table('users')
				->select('users.id as id', 'total_credit')
				->join('orders', 'users.id', '=', 'orders.user_id')
				->where('orders.id', $this->id)->first();
	
		if($user ) return '<a target="_blank" href="' . url('admin/users/' . $user->id) . '">'.round($user->total_credit).'</a>';
		else return '';
	}
	
	public function updateOrderStatus($status){
		if(!is_numeric ($status)) return false;
		$this->status = $status;
		$this->save();
	}
	
	public function getBillingPeriod(){
		
		return '0000-00-00'
		
			=== $this->pickup_date
			? '-'
			: date_create($this->pickup_date)->format('Y/m/d').'~'. date_create($this->next_subscription)->format('m/d');
			
		
	}
	
	public function getAction(){
		if (\Auth::user()->role->name == 'Admin') {
					
			$editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/orders/' . $this->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
			$deleteBtn = '&nbsp;<a href="' . url('admin/orders/' . $this->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';
			
			$viewBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/orders/' . $this->id ) . '"  title="View"><i class="fa fa-2 fa-eye"></i></a>';

		}
		$buttons = $editBtn.$viewBtn.$deleteBtn;
		return $buttons;
	}
}
 