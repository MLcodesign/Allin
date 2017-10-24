<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposits';
        
    public function getRefundDepositsForHomeById($userId){
        return self::where('user_id', $userId)
               ->where('op_type', 'refund')
               ->orderBy('created_at', 'desc')
               ->get();
    }
	
	public function depositMemoNote($code){
		$noteArr = array(
			"01" => "推薦碼加值", //Referral
			"02" => "管理者人工修改", //Admin change
			"03" => "儲值加碼紅利", //Bonus
			"04" => "取消返還", //cancel return
		);
		
		return $noteArr[$code] ? $noteArr[$code] : "";
		
		
	}
        
    public function getCategory(){
        return Category::find($this->category_id);
    }
}
