<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\User;
use App\Http\Requests;
use App\Page;
use App\Package;
use App\Feature;
use DB;
use Carbon\Carbon;
use App\ActivationService;
use App\AlertService;
use App\Frontpage;


class FrontendController extends Controller
{

    public function __construct(ActivationService $activationService, AlertService $alertService) {				
		$this->activationService = $activationService;	
		$this->alertService = $alertService;
    }

    public function index()
    {

	    $page = Frontpage::findOrFail(3);

	    $entry = json_decode($page->value);

        $packages = Package::active()->get();

        $features = Feature::active()->get();

	    //$page = Frontpage::findOrFail(0);

	    $edm = DB::table( 'topbarnews' )->where( 'id', 1 )->first()->text;

	    if(!empty($edm)) $edm = '/uploads/edm/'.$edm;

        return view('frontend.welcome')->with(compact('page', 'packages', 'features', 'edm', 'entry'));
    }
	
	public function allin_enter(){

		$page = Frontpage::findOrFail(2);

		$entry = json_decode($page->value);

		return view('frontend.allin_enter')->with(compact('page', 'entry'));
	}

	public function self_storage()
	{
		$packages = Package::active()->get();

		$features = Feature::active()->get();

		$page = Frontpage::findOrFail(1);

		$data = json_decode($page->value);

		$edm = DB::table( 'topbarnews' )->where( 'id', 1 )->first()->text;

		if(!empty($edm)) $edm = '/uploads/edm/'.$edm;

		return view('frontend.self_storage')->with(compact('page', 'packages', 'features', 'edm', 'data'));
	}
	
	public function testAlert(Request $request)
	{
        $data = new \stdClass();
        $email = "mirae@kilikili.idv.tw";
        $subject = "月租訂單確認";
        $this->alertService->sendBillReviewAlert($email,$subject, $data);
        
        var_dump(\Auth::user());
        die();
        $mailData = new \stdClass();
        $mailData->subject = "派送空箱下單成功通知";
        $mailData->account = "mirae@kilikili.idv.tw";
        $mailData->name = "江大明";
        $mailData->mphone = "0936270515";
        $mailData->scheduleDate = (NULl !== $request->get('dropOffDate')) ? $request->get('dropOffDate') : NULL;
        $mailData->scheduleWeek = "一";
        $mailData->scheduleTime = (NULl !== $request->get('dropOffTime')) ? $request->get('dropOffTime') : NULL;
        $mailData->scheduleNum = (NULl !== $request->get('box_quantity')) ? $request->get('box_quantity') : 0;
        $mailData->address = (NULl !== $request->get('county')) ? sprintf("%s %s %s",$request->get('county'),$request->get('district'),$request->get('zipcode')): NULL;
        $mailData->floorFee = "是";
        $mailData->note = "上樓請通知";
        //return view('emails.new.schedule-new-box')->with(compact('mailData'));
        //die();
        $email = "mirae@kilikili.idv.tw";
        $subject = "預約空箱下單成功通知!!";
        $data = new \stdClass();
        $data->template = 'emails.new.schedule-new-box';
        $data->mailData = $mailData;
        
        //$data->request = $request;
        $this->alertService->sendScheduleNewBoxSuccessAlert($email,$subject, $data); 
	}

	public function resendVerify()
	{
        return view('auth/resendVerify');
	}

	public function resendVerifyAction(Request $request)
	{
		
		$email = $request->input("email");
		//$userdata = DB::table('users')->where('email', $email)->get();
		//var_dump($userdata);
		//die();
		$user = User::where("email",$email)->first();
		if(null !== $user){
			if(true === $this->activationService->reSendActivationMail($user)){
				$message = "驗證信已重寄，請至Email點選註冊驗證連結";
			}else{
				$message = "已是驗證會員";			
			}
		}else{
			$message = "尚未註冊!!";	
			return redirect('/register')->with('status', $message);
		}
		return redirect('/login')->with('status', $message);
	}

    public function pricing()
    {
        $packages = Package::active()->get();

        $features = Feature::active()->get();

        return view('frontend.pricing')->with(compact('packages', 'features'));
    }
	
    public function components()
    {
        return view('frontend.components');
    }
	
	 public function contactUs(Request $request)
    {
		return view('frontend.contact_us');
	} 
	public function ipano()
    {
		return view('frontend.ipano.allin');
	}
	public function viewfinder()
    {
		return view('frontend.view_finder');
	}

    public function contactUsSubmit(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
		$phone = $request->input('phone');
        $form_message = $request->input('message');

        $to_email = \Config::get('app.contact_email');

        \Mail::send('emails.contact',
            [
                'name' => $name,
                'email' => $email,
				'phone' => $phone,
                'subject' => $subject,
				
                'form_message' => $form_message
            ],
            function ($message) use ($to_email) {
                $message->to($to_email, getSetting('SITE_TITLE') . ' Support')->subject('Contact Form Message');
            }
        );

        return Redirect::back()->with(['success' => '您的表單已經送出，我們將會有專人於24小時內與您聯繫！']);
    }
	
    public function blog()
    {
        $posts_per_page = getSetting('POSTS_PER_PAGE');

        $posts = Page::published()->post()->paginate($posts_per_page);

        return view('frontend.blog')->with(compact('posts'));
    }

    public function post($slug = '')
    {
        $post = Page::whereSlug($slug)->published()->post()->get()->first();
        if ($post) {

            return view('frontend.post')->with(compact('post'));
        }

        abort(404);
    }

    public function staticPages($slug = '')
    {
        $page = Page::whereSlug($slug)->published()->page()->get()->first();

        if ($page) {

	        if($page->id == 9){

		        return view('frontend.page_terms')->with(compact('page'));
	        }


            return view('frontend.page')->with(compact('page'));
        }

        abort(404);
    }
}
