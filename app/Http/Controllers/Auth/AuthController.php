<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\ActivationService;
use App\Coupon;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
	 
	
    protected $redirectTo = "member/warehouse";
	
	protected $activationService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService) {		
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);		
		$this->activationService = $activationService;		
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
		$rules = array (
				'email' => 'required|email|max:255|unique:users,email',
				'password' => 'required|min:6|max:12|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/'
		);

		$attributeNames = array (
				'email' => 'E-mail格式錯誤，請重新輸入',
				'password' => '您的密碼格式不正確，請重新輸入！' . ' 僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號',
		);

		$validator = Validator::make ($data, $rules);

		$validator->setAttributeNames ($attributeNames);
		
        return $validator;
    }
	
	public function register(Request $request)
	{
		$validator = $this->validator($request->all());

        // {"type":"User"...'

		if ($validator->fails()) {
			$this->throwValidationException(
				$request, $validator
			);
		}

		$user = $this->create($request->all());

		$this->activationService->sendActivationMail($user);

		return redirect('/login')->with('status', ' 註冊尚未完成，請至Email點選註冊驗證連結');
	}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
		
        $user =  User::create([
					//'name' => $data['name'],
                    'email' => $data['email'],
                    'role_id' => getSetting('DEFAUTL_USER_ROLE'),
					'referal_code' => Coupon::generate(8),
                    'avatar' => 'avatar.png',
					//'mobile'			=> $data['phone'],
                    'password' => bcrypt($data['password']),

        ]);
		
		return $user;
    }
	
	
	public function authenticated(Request $request, $user)
	{
		if (!$user->activated) {
			$this->activationService->sendActivationMail($user);
			auth()->logout();
			return back()->with('warning', '請先至Email點選註冊驗證連結，才能完成會員加入程序.');
		}
		
		$name = $user->name;
		$mobile = $user->mobile;
		$address = $user->address;
		$country = $user->country;
		$district = $user->district;
		$zipcode = $user->zipcode;
		
		if ($user->created_at == '' Or $user->created_at == null) {
			
			    

				
				$date = date('Y-m-d H:i:s');
				
				
				
				
				$post = User::find($user->id);
				
				$post->created_at = $date;
			
				
				$post->save();
			
			
		} 
	    
		
		
		
		
		if(empty($name) || empty($mobile) || empty($address)){
			return redirect('new-user');
		} else{
            $roleId = $user->role_id;
            if($roleId == "1"){
			    return redirect()->intended($this->redirectAdminPath());
            }else{
                return redirect()->intended($this->redirectPath());   
            }
		}
	}
	
	public function activateUser($token)
	{
		if ($user = $this->activationService->activateUser($token)) {
			//auth()->login($user);
			return redirect('/login')->with('status', '啟用成功，請輸入帳號密碼進行登入');
		}
		return redirect('/login')->with('status', '啟用失敗，請洽系統管理員');
		//abort(404);
	}
    
    protected function redirectAdminPath(){
        return "admin/dashboard";
    }
}
