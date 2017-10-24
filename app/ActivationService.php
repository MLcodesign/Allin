<?php

namespace App;


use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class ActivationService
{

    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(Mailer $mailer, ActivationRepository $activationRepo)
    {
        $this->mailer = $mailer;
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
      

        $this->mailer->send('emails.activation', ['user' => $user, 'link' => $link, 'subject' => '會員註冊驗證函'], function (Message $m) use ($user) {
            $m->to($user->email)->subject('會員註冊驗證函');
			$m->from('service@allin-storage.com', 'ALL IN 精品倉儲');
        });


    }

    public function reSendActivationMail($user)
    {

        if ($user->activated) {
            return false;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
      

        $this->mailer->send('emails.activation', ['user' => $user, 'link' => $link, 'subject' => '會員註冊驗證函'], function (Message $m) use ($user) {
            $m->to($user->email)->subject('會員註冊驗證函');
			$m->from('service@allin-storage.com', 'ALL IN 精品倉儲');
        });

		return true;
    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);
		
		
		$this->mailer->send('emails.welcome', ['user' => $user, 'link' => url('/'), 'subject' => '會員註冊確認函'], function (Message $m)  use ($user) {
			$m->from('service@allin-storage.com', 'ALL IN 精品倉儲');
            $m->to($user->email)->subject('會員註冊確認函');
        });

        return $user;

    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}