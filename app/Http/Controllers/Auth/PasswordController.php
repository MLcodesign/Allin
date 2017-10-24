<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'member/home';

    /**
     * Create a new password controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	public function postEmail(Request $request)
	{
		$this->validate($request, ['email' => 'required']);

		$response = $this->passwords->sendResetLink($request->only('email'), function($message)
		{			
			$message->subject('新密碼通知');
		});
	
		dd($response);
		switch ($response)
		{
			case PasswordBroker::RESET_LINK_SENT:
				//return redirect()->back()->with('status', trans($response));
        return redirect('/');
        break;

			case PasswordBroker::INVALID_USER:
				return redirect()->back()->withErrors(['email' => trans($response)]);
        break;
		}
    //return redirect('/');
	}
}
