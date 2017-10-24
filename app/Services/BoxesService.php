<?php
namespace App\Services;

use DB;
use App\Package;

class BoxesService extends BaseService{
    
    public function getWhareHouseBoxes($userId){
        return $this->findWhareHouseBoxes($userId, Package::BOX_NORMAL);
    }

    private function findWhareHouseBoxes($userId, $boxType){
        $rtBoxes = array();
        $rtAry = array("boxes" => array(), "orders" => array());
        $boxes = DB::table('boxes')
            ->select('boxes.order_id as order_id', 'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id', 'boxes.package_id as package_id', 'boxes.picked as picked', 'boxes.boxed as boxed')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            //->where('boxes.package_id', Package::BOX_NORMAL)
            ->where('boxes.rtn', 0)
            ->where('boxes.closed', 0)
            //->where('boxes.picked', 0)
            //->where('boxes.boxed', 1)
            ->where('boxes.canceled', "0")
            //->paginate(8);
            ->get();
        $orderAry = array();
        foreach($boxes as $box){
            $orderAry[$box->order_id] = isset($orderAry[$box->order_id]) ? $orderAry[$box->order_id] : array('cnt' => 0, 'boxes' => array());
            $orderAry[$box->order_id]['cnt'] ++;
            $orderAry[$box->order_id]['boxes'][] = $box;    
        }
        
        //var_dump($orderAry);
        //$rtOrderAry = array();
        $rtOrderAry = array();
        foreach($orderAry as $key => $myAry){
            $dragFlag = "false";
            $cnt = DB::table('boxes')
            ->where('canceled', "0")
            ->where("order_id", $key)
            ->count();
            
            $compareCnt = DB::table('boxes')
            ->where('canceled', "0")
            ->where("order_id", $key)
            ->where('boxes.rtn', 0)
            ->where('boxes.closed', 0)
            ->where('boxes.picked', 0)
            ->where('boxes.boxed', 1)
            ->count();
            
            if($cnt == $compareCnt){
                $dragFlag = "true";
            }
            
            foreach($myAry['boxes'] as $box){
                $box->rtnFlag = "false";
                if($box->boxed == "1" && $box->picked == "0" && $box->package_id == $boxType){
                    //echo $cnt . "----" . $compareCnt . "<br>";
                    $box->dragFlag = $dragFlag;
                    $rtBoxes[] = $box; 
                }
            }
            
            $orderAry[$key]['cnt'] = $cnt;
            if($compareCnt > 0){
                $rtOrderAry[$key] = $orderAry[$key];
            }
        }
        
        //var_dump($rtBoxes);
        //die();
        $rtAry['boxes'] = $rtBoxes;
        //var_dump($rtOrderAry);
        $rtAry['orders'] = $rtOrderAry;
        //var_dump($rtBoxes);
        return $rtAry;        
    }
    
    public function getWhareHouseLargeBoxes($userId){
        $rtAry = $this->findWhareHouseBoxes($userId, Package::LARGE_ITEM);
        return $rtAry['boxes'];
    }
    
    public function getWhareHouseRtnBoxes($userId){
        $boxes = DB::table('boxes')
            ->select('boxes.order_id as order_id', 'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id', 'boxes.package_id as package_id', 'boxes.picked as picked', 'boxes.boxed as boxed')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            //->where('boxes.package_id', Package::BOX_NORMAL)
            ->where('boxes.rtn_cf', 1)
            ->where('boxes.closed', 0)
            //->where('boxes.picked', 0)
            //->where('boxes.boxed', 1)
            ->where('boxes.canceled', "0")
            //->paginate(8);
            ->get();
        $rtBoxes = array();
        foreach($boxes as $box){
            $box->dragFlag = "true";
            $box->rtnFlag = "true";
            $rtBoxes[] = $box; 
        }
        return $rtBoxes;
    }
    
    public function getOrderInfoFromLargeAndNormalBox($boxes, $largeBoxes){
        
    }
    
    public function getWhareHouseInHouseBoxes($userId){
        return DB::table('boxes')
            ->select('boxes.order_id as order_id', 'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id', 'boxes.package_id as package_id', 'orders.pickup_date as pickup_date')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('boxes.rtn', 0)
            ->where('boxes.closed', 0)
            ->where('boxes.arrived', 1)
            ->where('boxes.picked', 1)
            ->where('boxes.boxed', 1)
            ->where('boxes.canceled', "0")
            ->get();
            //->paginate(8); 
    }
    
    public function getInHouseBoxesCountByUserId($userId){
        return DB::table('boxes')
            ->select('boxes.order_id as order_id', 'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id', 'boxes.package_id as package_id', 'orders.pickup_date as pickup_date')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('boxes.rtn', 0)
            ->where('boxes.closed', 0)
            ->where('boxes.arrived', 1)
            ->where('boxes.picked', 1)
            ->where('boxes.boxed', 1)
            ->where('boxes.canceled', "0")
            ->count();
            //->paginate(8);         
    }
    
    public function getClosedHouseBoxesCountByUserId($userId){
        return DB::table('boxes')
            ->select('boxes.order_id as order_id', 'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id', 'boxes.package_id as package_id', 'orders.pickup_date as pickup_date')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('boxes.rtn', 1)
            ->where('boxes.closed', 1)
            ->where('boxes.arrived', 1)
            ->where('boxes.picked', 1)
            ->where('boxes.boxed', 1)
            ->where('boxes.canceled', "0")
            ->count();
            //->paginate(8);         
    }
    
    public function getSingleBoxesByPickupCondition($userId, $boxId, $isArrived, $isPicked){
        return DB::table('boxes')
            ->select('boxes.order_id as order_id','boxes.package_id as package_id',  'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('boxes.id', $boxId)
            ->where('boxes.arrived', $isArrived)
            ->where('boxes.rtn', 0)
            ->where('boxes.closed', 0)
            ->where('boxes.picked', $isPicked)
            ->where('boxes.canceled', "0")
            ->first();        
    }
    
    public function getSingleBoxesByRtnCondition($userId, $boxId){
        return DB::table('boxes')
            ->select('boxes.order_id as order_id','boxes.package_id as package_id',  'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('boxes.id', $boxId)
            ->where('boxes.rtn_cf', 1)
            ->where('boxes.closed', 0)
            ->where('boxes.canceled', "0")
            ->first();        
    }
    
    public function getMultiBoxesByPickupCondition($userId, $isArrived, $isPicked){
        return DB::table('boxes')
            ->select('boxes.order_id as order_id','boxes.package_id as package_id', 'boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('boxes.arrived', $isArrived)
            ->where('boxes.rtn', 0)
            ->where('boxes.closed', 0)
            ->where('boxes.boxed', 1)
            ->where('boxes.picked', $isPicked)
            ->where('boxes.canceled', "0")
            ->get();
    }
    
    public function updateSingleBoxById($boxId, $dataAry){
        if($dataAry["rtn"] == false){
			$box = DB::table('boxes')
            ->where('id', $boxId)
            ->first();
            if($box->rtn_cf == "1"){
                $dataAry = ['arrived' => "0", 'picked' => "1", 'rtn' => "0", 'rtn_cf' => "0"];
            }
        }
        DB::table('boxes')
        ->where('id', $boxId)
        ->update($dataAry);
    }
    
    public function getBoxByUserIdAndIsPicked($userId, $isPicked = 0){
        return DB::table('boxes')
            ->select('boxes.id as id', 'boxes.name as name', 'boxes.image as image', 'boxes.admin_id as admin_id')
            ->join('orders', 'boxes.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('boxes.picked', $isPicked)
            ->where('boxes.canceled', "0")
            ->get();       
    }
    
    public function insertBox($boxAry){
        return DB::table('boxes')
            ->insert($boxAry);
    }
    
    public function getBoxesByOrderId($order_id){
        return DB::table('boxes')
            ->where('order_id',$order_id)
            ->where('boxes.canceled', "0")
            ->get();
    }
}