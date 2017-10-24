<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Exchange extends Model
{
    protected $table = 'exchanges';
    
    public function getExchangesForHomeById($userId){
        return self::where('user_id', $userId)
               ->orderBy('created_at', 'desc')
               ->get();
    }
    
    public function getCategory(){
        return Category::find($this->category_id);
    }

}
