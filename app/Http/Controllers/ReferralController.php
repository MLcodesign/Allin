<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\ProfileRequest;
use App\Package;
use App\Referral;
use App\User;
use Input;
use App\Feature;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;
use Auth;
use DateTime;
use Mail;
use App\AlertService;


class ReferralController extends Controller
{
    protected $alertService;
    
    public function __construct(AlertService $alertService)
    {
        $this->alertService = $alertService;
    }
    
    public function send(Request $request) {

    	$referrals = $request->referral_emails;
    	$emails = explode(',', $referrals);
    	$referal_code = Auth::user()->referal_code;
    	$referal_name = Auth::user()->name;
        $subject = $referal_name.'推薦您使用ALL IN精品倉儲';

    	$data['referal_code'] = $referal_code;
    	$data['referal_name'] = $referal_name;
    	$data['subject'] = $subject;

        //$data->pictures = $pictures;
        $this->alertService->sendReferralMailAlert($emails, $subject, $data);

    	return Redirect::back()->with('status', '您的推薦碼已經Email至朋友信箱！');
    }

    public function credit(Request $request) {
    	return $request->all();
    }
	
	public function apply(Request $request){
		
		$user = Auth::user();
		
		//**Check if user haven't apply referral code before
		$referral_check = Referral::where([
			['user_id', '=', $user->id]
		])->first();
		
		//**check if referral code exists
		$referral_user = User::where([
			['referal_code', '=', $request->referral_code],
		])->first();
		
		
		//**if user haven't apply referral code
		if(!$referral_check){
			
			
			
			if($referral_user){
				
				//Check if user apply him/herself referral code
				if($referral_user->id == $user->id)
					return Redirect::back()->with('status', '無效的推薦碼！請確認推薦碼是否正確！');
			
				//**All good. processing data
				
				//**add credit to referral user
				
				$referral_user_credit = $referral_user->total_credit;
				
				$referral_user->total_credit += getSetting('REFERAL_AMOUNT');
				
				$referral_user->save();
				
				//**add Credit to current user
				
				$user_credit = $user->total_credit;
				$user->total_credit += getSetting('BOUNS_AMOUNT');
				$user->save();

				
				//**Save this activity to referral table
				
				$referral_data= array(
					'user_id' => $user->id,
					'referral_id' => $referral_user->id,
					'referral_amount' => getSetting('REFERAL_AMOUNT'),
					'bouns_ammount' =>  getSetting('BOUNS_AMOUNT'),
				);
				
				$referral = new Referral($referral_data);
				$referral-> save();
				
				
				//**Save this activity to admin log

				$depositArr = ["user_id" => $user->id ,
				   "p_cnt" => getSetting('BOUNS_AMOUNT'),
				   "pay_amt" => 0, 
				   "user_credit" => $user->total_credit,
				   "created_at" => date("Y-m-d H:i:s"),
				   "created_by" => 1, 
				   "category_id" => 4,
				   "op_type" => "system",
				   "api_memo_note" => "推薦碼加值",
				  ];
				  
				  DB::table('deposits')->insertGetId($depositArr);
				
				$depositArr = ["user_id" => $referral_user->id ,
				   "p_cnt" => getSetting('REFERAL_AMOUNT'),
				   "pay_amt" => 0, 
				   "user_credit" => $referral_user->total_credit,
				   "created_at" => date("Y-m-d H:i:s"),
				   "created_by" => 1, 
				   "category_id" => 4,
				   "op_type" => "system",
				   "api_memo_note" => "推薦碼加值",
				  ];
				  
				DB::table('deposits')->insertGetId($depositArr);
				
				
				return Redirect::back()->with('status', '推薦碼已兌換成功！您與您的朋友皆獲得了500點！感謝您的使用!');
			}
			
			else 
			
				return Redirect::back()->with('status', '無效的推薦碼！請確認推薦碼是否正確！');
		}
		
		else return Redirect::back()->with('status', '您不能使用超過一組推薦碼！');
	}
}
