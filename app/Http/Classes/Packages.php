<?php

namespace App\Http\Classes;

use DB;
use App\PointsService;

class Packages
{
    
    public function getPackages()
    {
        return DB::table('pricings')->get();
    }

    public function getPackageDetails($id_package)
    {
        if (!$id_package)
            return;

        return DB::table('pricings')->where('id', '=', $id_package)->get();
    }

    public function saveSubscription($data, $tableName = "payments")
    {
        if (!$data || !is_array($data))
            return;

        return DB::table($tableName)->insertGetId($data);
    }

    public function saveSubscriptionNotify($data)
    {
        if (!$data || !is_array($data))
            return;

        return DB::table('notify_payments')->insertGetId($data);
    }

    public function updateTotalPayment($id, $total)
    {
        $where = [
            'id' => $id
        ];

        $data = [
            'total_payment' => $total
        ];

        return DB::table('payments')->where($where)->update($data);
    }

    public static function addDeposits($depositArr, $pointFlash = false){
        if($depositArr['p_cnt'] > 0){
            $rt = DB::table('deposits')->insertGetId($depositArr);
            if($pointFlash === true){
                PointsService::storeIn($depositArr['user_id'],$depositArr['p_cnt']);    
            }
        }else{
            return false;
        }       
    }

    public static function addExchange($exchangeArr, $pointFlash = false){
        if($exchangeArr['p_cnt'] > 0){
            $rt = DB::table('exchanges')->insertGetId($exchangeArr);
            if($pointFlash === true){
                PointsService::storeIn($exchangeArr['user_id'],$exchangeArr['p_cnt']);    
            }     
        }else{
            return false;
        }
    }    
}
