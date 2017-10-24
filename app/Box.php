<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Package;

class Box extends Model
{
    protected $table = 'boxes';
    const FEE_FLOOR = 100;
    const FEE_BOX_BASE = 99;
    const FEE_BOX_NORMAL = 60;
    const FEE_BOX_LARGE = 90;
    const FEE_BOX_NORMAL_MONTHLY = 139;
    const FEE_BOX_LARGE_MONTHLY = 239;
    const FEE_AMT_SERVICE = 100;
    
    public static function calShippingFee($boxId){
        $boxFee = 0;
        $model = self::find($boxId);
        if($model->package_id == Package::BOX_NORMAL){
            $boxFee = self::FEE_BOX_NORMAL;
        }
        if($model->package_id == Package::LARGE_ITEM){
            $boxFee = self::FEE_BOX_LARGE;
        }
        return $boxFee;
    }
}
