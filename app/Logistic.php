<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use \App\Box;

class Logistic extends Model
{
    const NEW_ONE = 0;
    const CONFIRMED = 1;
    const CLOSED = 2;
    
    const TYPE_NEW_BOX = 0;
    const TYPE_PICUP = 1;
    const TYPE_DELIVERY = 2;
    
	protected $table = 'logistics';
	protected $appends = ['name'];

	
	public function getNameAttribute(){
		$user_id =  DB::table('orders')->where('id', $this->order_id)->value('user_id');
		
		$user_name =  DB::table('users')->where('id', $user_id)->value('name');
		
		return $user_name;

	}
    
    public static function getMyType($myType){
        $typeMap = array(
            self::TYPE_NEW_BOX => "派送空箱",
            self::TYPE_PICUP => "取件",
            self::TYPE_DELIVERY => "退倉送件"
        );
        return $typeMap[$myType];
    }
	
	public function getStatus($echo = false){
        $status = $this->status;
		$order_status = array(
			self::NEW_ONE => '新建單',//'schedule new box'
            self::CONFIRMED => '已安排',//'over time for schedule pickup'
            self::CLOSED => '已完成',//waiting for schedule pickup
		);

		$order_status_color = array(
			self::NEW_ONE => 'info',
            self::CONFIRMED => 'warning',
            self::CLOSED => 'success',
		);

		$str = '<label class="label label-'.
		$order_status_color[$status].'">'.
		$order_status[$status].'</label>';
                
        
        if($echo) echo $str;
        else return $str;		
	}  

    public function getOrder(){
        $orderId = $this->order_id;
        if($orderId == 0){
            $myAry = (array)json_decode($this->shipping_items);
            foreach($myAry as $key => $val){
                $orderId = $key;
                break;
            }
        }
        return Order::find($orderId);
    }
    
    public function getAction(){
        if (\Auth::user()->role->name == 'Admin') {
                    
            $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/logistics/' . $this->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
            $deleteBtn = '&nbsp;<a href="' . url('admin/logistics/' . $this->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';
            
            $viewBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/logistics/' . $this->id ) . '"  title="View"><i class="fa fa-2 fa-eye"></i></a>';

        }
        $buttons = $viewBtn.$deleteBtn;
        return $buttons;
    }
    
    public function getAddress(){
        return $this->county.' '.$this->district.' '.$this->zipcode.'<br/>'.
               $this->address.'<br/>'.$this->phone;
    }
    
    public function getShippingItems(){
        $itemsJson = $this->shipping_items;
        $ary = json_decode($itemsJson);
        $rtnAry = array();
        foreach($ary as $boxAry){
            if($this->order_id == 0){
                foreach($boxAry as $boxAry2){
                    $rtnAry[] = Box::find($boxAry2[0]);     
                }
            }else{
                $rtnAry[] = Box::find($boxAry[0]);    
            }
        }
        return $rtnAry;
    }

}
 