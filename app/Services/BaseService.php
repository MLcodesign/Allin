<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BaseService extends Eloquent{
    
     public static function boot()
     {
        parent::boot();
     }
}