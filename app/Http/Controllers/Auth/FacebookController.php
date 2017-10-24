<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Laravel\Socialite\Contracts\Factory as Socialite;
use DB;
use Auth;
use App\ActivationService;
use Hash;
use App\Coupon;
use App\User;

class FacebookController extends Controller implements Authenticatable
{
	use AuthenticableTrait;
	 
	protected $activationService;
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService, Socialite $socialite) {
		$this->socialite = $socialite;
		$this->activationService = $activationService;
    }
	
	public function getSocialAuth($provider = null)
    {
        if (!config("services.$provider")) abort('404'); //just to handle providers that doesn't exist

        return $this->socialite->with($provider)->redirect();
    }

    public function getSocialAuthCallback( Request $request, $provider = null)
    {
	   if($request->input('error_code') == "200"){
			return redirect()->to('/login')->with('status', '登入失敗, 請重新登入!!');
	   }
       if ($user = $this->socialite->with($provider)->user()) {
            $data = (object)$user;


            $dataArray = [
                'name' => $data->name,
                'email' => $data->email,
                'role_id' => getSetting('DEFAUTL_USER_ROLE'),
                'referal_code' => Coupon::generate(8),
                'avatar' => $data->avatar,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'activated' => 1
            ];
			
			$userold = DB::table('users')->where('email', $data->email)->get();
		
			if(count($userold) > 0){
				$userfb = DB::table('users')->where('email', $data->email)->where('activated', '1')->get();
				if(count($userfb) > 0) {
					if(Auth::loginUsingId($userold[0]->id)){
						return redirect()->to('member/warehouse');
					} else{
						return redirect()->to('/');
					}
				} else{
					return redirect()->to('/login')->with('status', '您已經註冊但尚未完成驗證程序，請至信箱點選驗證');
				}
			} else{
				$userid = DB::table('users')->insertGetId($dataArray);

				$dataSocial = [
					'user_id' => $userid,
					'provider_user_id' => $data->id,
					'provider' => $provider,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
				];

				$social = DB::table('social_accounts')->insertGetId($dataSocial);
				
				if(count($social) > 0){
                    Auth::loginUsingId($userid);
                    return redirect()->to('member/warehouse');
					//return redirect('register')->with(['email' => $data->email, 'provider' => $provider, 'userid' => $userid]);
					//return view('auth.createpassword')->with('userid', $userid);
					
					//Auth::loginUsingId($userid);
					//return redirect()->to('/');
				} else{
					abort('404');
				}
			}
	    } else{
			abort('404');
		}
    }
	
	public function postcreatepassword(Request $request)
	{
		$rules = array (
				'email' => 'required|email|max:255|unique:users,email',
				'password' => 'required|min:6|max:12|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/'
		);

		$attributeNames = array (
				'email' => 'E-mail格式錯誤，請重新輸入',
				'password' => '您的密碼格式不正確，請重新輸入！' . ' 僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號',
		);

		$userid = $request->get('userid');
		$emailid = $request->get('email');
		$provider = $request->get('provider');

		$validator = Validator::make ($request->all(), $rules);

		$validator->setAttributeNames ($attributeNames);

		if ($validator->fails ()) {
			//return view('auth.createpassword')->with('userid', $userid);
			return redirect('register')->withErrors($validator)->with('email', $emailid)->with('provider', $provider)->with('userid',$userid);
		} else{
			$data = array(
				'password' => Hash::make($request->get('password'))
			);
			
			$id = $request->get('userid');
			
			DB::table('users')->where('id', $id)->update($data);
			
			$userdata = User::find($id);
			
			$this->activationService->sendActivationMail($userdata);

			return redirect('/login')->with('status', ' 註冊尚未完成，請至Email點選註冊驗證連結');
		}
	}
}
