<?php

namespace App;

use App\BaseModel;

class Coupons extends BaseModel
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupon';
    protected $guarded = ['id'];

	protected $primaryKey = 'coupon_id';
}
