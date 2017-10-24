<?php

namespace App;


use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class AlertService
{

    protected $mailer;
	protected $from = "service@allin-storage.com";
	protected $fromName = "ALL IN 精品倉儲";
    protected $prefix = "";
    protected $dateWeekAry = array("日","一","二","三","四","五","六");

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->fromName = env("APP_ENV_SERVICE_NAME",$this->fromName);
        $this->from = env("SYSTEM_FROM_MAIL", $this->from);
        $this->bcc = explode(",", env("SYSTEM_BCC_MAIL"));
        $this->prefix = env("APP_ENV_TEXT");
    }
    
    public function sendReferralMailAlert($emails, $subject, $data)
    {
        $this->mailer->send('emails.new.referal', $data, function (Message $m) use ($emails, $subject) {
            $m->subject($subject);
            $m->from($this->from, $this->fromName);
            //$m->to("");
            $m->bcc(array_merge($emails,$this->bcc));
        });       
    }



    public function sendPaymentSuccessAlert($email,$subject, $data)
	{
		$this->mailer->send($data->template, ['data' => $data, 'link' => url('/'), 'subject' => $subject], function (Message $m)  use ($email, $subject) {
			$m->from($this->from, $this->fromName);
            $m->to($email)->subject($this->prefix.$subject);
            $m->bcc($this->bcc);
        });

        return $data;
    }
    
    /**
    * 派送空箱下單成功通知
    * 
    * @param mixed $subject
    * @param mixed $user
    * @param mixed $data
    */
    public function sendScheduleNewBoxSuccessAlert($subject, $user, $data)
	{
        $request = $data->request;
        $mailData = new \stdClass();
        $mailData->subject = $subject;
        $mailData->account = $user->email;
        $mailData->name = $user->name;
        $mailData->mphone = $user->mobile;
        $mailData->scheduleDate = (NULl !== $request->get('dropOffDate')) ? $request->get('dropOffDate') : NULL;
        $mailData->scheduleWeek = "一";
        $mailData->scheduleTime = (NULl !== $request->get('dropOffTime')) ? $request->get('dropOffTime') : NULL;
        $mailData->scheduleNum = (NULl !== $request->get('box_quantity')) ? $request->get('box_quantity') : 0;
        $mailData->address = (NULl !== $request->get('county')) ? sprintf("%s %s %s",$request->get('county'),$request->get('district'),$request->get('zipcode')) : NULL;
        $mailData->floorFee = "是";
        $mailData->note = "上樓請通知";
        //return view('emails.new.schedule-new-box')->with(compact('mailData'));
        //die();
        $template = 'emails.new.schedule-new-box';
        $email = $mailData->account;        
		$this->mailer->send($template, ['mailData' => $mailData], function (Message $m)  use ($email, $subject) {
			$m->from($this->from, $this->fromName);
            $m->to($email)->subject($this->prefix.$subject);
            $m->bcc($this->bcc);
        });

        return $data;
    }
    
    /**
    * "預約取件(一般物品)下單成功通知!!"
    * 
    * @param mixed $subject
    * @param mixed $data
    */
    public function sendSchedulePickupSuccessAlert($subject,$user, $data)
	{
        $request = $data->request;
        $boxes = $data->boxes;
        //$pictures = $data->pictures;
        $mailData = new \stdClass();
        $mailData->subject = $subject;
        $mailData->account = $user->email;
        $mailData->name = $user->name;
        $mailData->mphone = $user->mobile;
        $mailData->shipDate = (NULl !== $request->get('ship_date')) ? $request->get('ship_date') : NULL;
        $mailData->shipTime = (NULl !== $request->get('ship_time')) ? $request->get('ship_time') : NULL;
        
        $dateWeekAry = $this->dateWeekAry;
        $mailData->shipWeek = $dateWeekAry[date("w", strtotime($mailData->shipDate))];
        $mailData->quantity = (NULl !== $request->get('quantity')) ? $request->get('quantity') : NULL;
        $mailData->address = (NULl !== $request->get('county')) ? sprintf("%s %s %s %s",$request->get('county'),$request->get('district'),$request->get('zipcode'),$request->get('address')) : NULL;
        $tmpAry = array();
        foreach($boxes as $i => $box) :
            $tmpAry[$i]['adminId'] = $box->admin_id;
            $tmpAry[$i]['name'] = $request->get('box_pickup')[$i+1]['name'];
            $tmpAry[$i]['pic'] = ($box->image != "") ? sprintf('<img style="height:80px; width:auto" src="/uploads/boxes/%s"/>',$box->image) : '<div class="img-none"></div>';
        endforeach;
        $mailData->boxesData = $tmpAry;

        $email = $mailData->account;
        $template = 'emails.new.schedule-pickup';
		$this->mailer->send($template, ['mailData' => $mailData ], function (Message $m)  use ($email, $subject) {
			$m->from($this->from, $this->fromName);
            $m->to($email)->subject($this->prefix.$subject);
            $m->bcc($this->bcc);
        });

        return $data;
    }

    /**
    * 月租訂單內容確認通知!!
    * 
    * @param mixed $subject
    * @param mixed $user
    * @param mixed $data
    */
    public function sendBillReviewAlert($subject, $user, $data)
	{
        $request = $data->request;
        $packages_arr = $data->packages_arr;
        
        $mailData = new \stdClass();
        $mailData->subject = "";
        $mailData->account = $user->email;
        $mailData->name = $user->name;
        $mailData->mphone = $user->mobile;
        $mailData->address = (NULL !== $request->get('county')) ? sprintf("%s %s %s %s",$request->get('county'),$request->get('district'),$request->get('zipcode'),$request->get('address')) : NULL;
        $mailData->mgmFlag = "";
        $mailData->note = (NULL !== $request->get('special_instruction')) ? $request->get('special_instruction') : ''; 
        $wording = array();
        //var_dump($request->get('packages'));
        //die();
        $i = 0;
        $monthlyTotalSum = 0;
        foreach($request->get('packages') as $package_id => $package) :
            $epdr = explode(".",$packages_arr[$package_id]['package']['cost']);
            //var_dump($epdr);
            if ($package['box_quantity']*$epdr[0] !== 0) { 
                $wording[$i]["num"] = $packages_arr[$package_id]['package']['name'] .  "    X    " . $package['box_quantity'];
                $epd = explode(".",$packages_arr[$package_id]['package']['cost']);
                $wording[$i]["point"] = $package['box_quantity']*$epd[0] . "點";
                $monthlyTotalSum += $package['box_quantity']*$epd[0];
            }
            
            $tmpAry = array();
            if($packages_arr[$package_id]['package']['id'] == 2) {
                $tmpAry["num"] = "即時影像加值服務" .  "    X    " . $package['amt_service'];
                $tmpAry["point"] = $package['amt_service']*$packages_arr[$package_id]['feature']['add-on service'] . "點";
                $monthlyTotalSum += $package['amt_service']*$packages_arr[$package_id]['feature']['add-on service'];
            }
            $i ++;
        endforeach;
        //var_dump($wording);
        if(count($tmpAry) > 0) {
            $wording[] = $tmpAry;
        }  
        //die();  
        
        /*
        $mailData->standBoxNum = "";
        $mailData->standBoxPoint = "";
        $mailData->bigItemBoxNum = "";
        $mailData->bigItemBoxPoint = "";
        $mailData->cameraServiceNum = "";
        $mailData->cameraServicePoint = "";
        */
        $mailData->items = $wording;
        //var_dump($mailData->items);
        //die();
        $mailData->monthlyTotalPoint = $monthlyTotalSum;

        $mailData->floorFee = $request->get('moving_floor') == 100 ? 100 : 0;

        $dateWeekAry = $this->dateWeekAry;
        $mailData->transferFee = $request->get('shipping_fee');
        $mailData->summary = $mailData->monthlyTotalPoint + $mailData->floorFee + $mailData->transferFee;
        $mailData->scheduleNewBoxDate = $request->get('newbox_date');
        $mailData->scheduleNewBoxWeek = $dateWeekAry[date("w", strtotime($mailData->scheduleNewBoxDate))];
        $mailData->scheduleNewBoxTime = $request->get('newbox_time');
        $mailData->schedulePickupDate = $request->get('pickup_date');
        $mailData->schedulePickupWeek = $dateWeekAry[date("w", strtotime($mailData->schedulePickupDate))];;
        $mailData->schedulePickupTime = $request->get('pickup_time');

		//$this->mailer->send($data->template, ['request' => $data->request, 'packages' => $data->packages, 'selected_package' => $data->selected_package,  'subject' => $subject, 'current_package_features' => $data->current_package_features, 'current_package' => $data->current_package ], function (Message $m)  use ($email, $subject) {
        $email = $mailData->account;
        $template = "emails.new.schedule-monthly-confirm";
        $this->mailer->send($template, ['mailData' => $mailData ], function (Message $m)  use ($email, $subject) {        
			$m->from($this->from, $this->fromName);
            $m->to($email)->subject($this->prefix.$subject);
            $m->bcc($this->bcc);
        });

        return $data;
    }

}