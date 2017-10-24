<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Mail;
use Hash;

class ResetpasswordController extends Controller
{
    public function emailreset(Request $request)
	{
		$email = $request->get('email');
		
		$password = str_random(8);
		
		$userdata = DB::table('users')->where('email', $email)->get();
		
		if(count($userdata) > 0){
			Mail::send('auth.emails.password', ['email' => $email, 'password' => $password], function($message) use ($email){
				$message->from('service@allin-storage.com', 'ALL IN 精品倉儲');
				$message->to($email);
				$message->subject('新密碼通知');
			});
			if(Mail::failures()){
				return redirect()->back()->withErrors(['email' => 'Email address invalid.']);
			} else{
				DB::table('users')->where('email', $email)->update(['password' => Hash::make($password)]);
				return redirect()->to('/');
			}
		} else{
			return redirect()->back()->withErrors(['email' => 'Email address invalid.']);
		}
	}
}
