<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'referal';
	protected $fillable = ['user_id', 'referral_id', 'referral_amount', 'bouns_ammount'];

    public function user() {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function referral() {
    	return $this->hasOne('App\User', 'id', 'referral_id');
    }
	
}
