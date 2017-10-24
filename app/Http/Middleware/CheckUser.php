<?php

namespace App\Http\Middleware;

use Closure;
use Validator;
use App\User;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        //$captchaInput = $request->input("g-recaptcha-response");
        if($request->segment(1) == "register" || $request->segment(1) == "login"){ 
            if($request->has('email') && $request->has('password')){      
                $client = new \GuzzleHttp\Client();
                
                $myData = [
                            'secret' => env("GOOGLE_CAPTCHA_SECURE_KEY"),
                            'response' => $request->input("g-recaptcha-response"),
                            'remoteip' => $_SERVER['REMOTE_ADDR'],
                            ];

                $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                                'form_params' => $myData
                            ]);

                
                $jsonObj = json_decode($response->getBody());
                
                if($jsonObj->success){
                    if(env("APP_PROTOCOL") . "://" . $jsonObj->hostname != env("APP_URL")){
                        return redirect()->back()->withErrors(['email' => '圖型驗證錯誤!!']);   
                    }
                }else{
                    return redirect()->back()->withErrors(['email' => '圖型驗證錯誤!!']);   
                }
                
                if($request->segment(1) == "login"){
                    $user = User::where('email',$request->get('email'))->first();
                    if(!$user){
                        return redirect()->back()->withErrors(['email' => '您尚未註冊，請先註冊會員']);
                    }
                }
            }
        }
		
        return $next($request);
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
}
