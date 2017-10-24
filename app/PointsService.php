<?php

namespace App;
use DB;

class PointsService {

    public static function storeIn($userId, $point){
        $user_total_credit = DB::table('users')->where('id', $userId)->value('total_credit');
        $user_total_credit += $point;
        DB::table('users')->where('id', $userId)->update([
            'total_credit' => $user_total_credit
        ]);
        return;
    }
    
    public static function exchangeOut($userId, $point){
        if($point > $user_total_credit){
            return false;
        }
        $user_total_credit = DB::table('users')->where('id', $userId)->value('total_credit');
        $user_total_credit = $user_total_credit - $point;
        DB::table('users')->where('id', $userId)->update([
            'total_credit' => $user_total_credit
        ]);
        return true;        
    }
}