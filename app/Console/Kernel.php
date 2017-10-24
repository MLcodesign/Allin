<?php

namespace App\Console;

use DB;
use App\User;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Classes\Packages;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
		\App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
		
		$schedule->call(function () {


			//get all due date orders

			$orders = DB::table('orders')
						->whereDate('next_subscription','=', date('Y-m-d'))
						->where('status', '!=', 0)
						->where('status', '!=', 1)
						->where('status', '!=', 6)
						->where('status', '!=', 9)
						->where('status', '!=', 99)
			            ->get();

			if($orders) foreach($orders as $i => $order){


				//if($order->user_id != 1 && $order->user_id != 229) continue;

				$subscription = DB::table('subscriptions')
				                  ->where('order_id', $order->id)
				                  ->where( 'user_id', $order->user_id )->first();

				//$tmpCost = $order->monthly_cost;

				/*$boxes = DB::table('boxes')
				           ->select('*', 'boxes.id as box_id')
				           ->join('orders', 'boxes.order_id', '=', 'orders.id')
				           ->where('orders.id', $order->id)
				           ->get();


				$whereInAry = array();
				$cancelBoxes = array();
				foreach($boxes as $box){
					$whereInAry[] = $box->box_id;
					$cancelBoxes[] = $box;
				}

				$refunds = DB::table('deposits')
				             ->select('*', 'boxes.id as box_id, packages.id as orig_package_id, packages.name as package_name')
				             ->join('boxes', 'deposits.api_key', '=', 'boxes.id')
				             ->join('packages', 'boxes.package_id', '=', 'packages.id')
				             ->whereIn('api_key' , $whereInAry)
				             ->get();

				foreach($refunds as $refund){
					$refund->cost += 0;
					if(false !== strpos($refund->api_memo_note, "含影像處理費")){
						$refund->cost += 100;
					}
					$tmpCost = $tmpCost - $refund->cost;
					$tmpCost = ($tmpCost < 0) ? 0 : $tmpCost;
				}*/

				$exchange = DB::table('exchanges')->where('api_key', $order->id)->orderby('created_at', 'desc')->first();


				$user = DB::table('users')->where('id', $order->user_id)->first();
				$original_credit = (float) $user->total_credit;
				$to_email = $user->email;


				$depositMemo = $exchange->api_memo_note;



				//Check if user has enough credit
				if($original_credit >= $subscription->monthly_cost) {

					/*//Add New subscription
					$subscription_id = DB::table('subscriptions')->insertGetId([
						'order_id' => $order->id,
						'user_id' => $order->user_id,
						'monthly_cost' => $order->monthly_cost,
						'billing_amount' => $tmpCost,
						'original_credit' => $original_credit,
						'created_at' => new Carbon()
					]);*/

					$exchangeArr = ["user_id" => $user->id ,
					                "p_cnt" => $subscription->monthly_cost,
					                "pay_amt" => 0,
					                "created_at" => new Carbon(),
					                "created_by" => 1,
					                "category_id" => 6,
					                "op_type" => "system",
					                "api_key" => $order->id,
					                "api_memo_note" => $depositMemo
					];

					Packages::addExchange($exchangeArr);


					//Update user credit
					$remain_credit = $original_credit - $subscription->monthly_cost;
					DB::table('users')->where('id', $order->user_id)->update(['total_credit' => $remain_credit]);

					//Update next billing date
					DB::table('orders')->where('id', $order->id)->update([
						'latest_subscription' => date('Y-m-d'),
						'next_subscription' => date('Y-m-d', strtotime('next month')),
					]);

					//Send notify email

					\Mail::send('emails.monthly_bill',
						[
							'order' => $order,
							'subject' => 'Monthly Bill',

						],
						function ($message) use ($to_email) {
							$message->to($to_email, getSetting('SITE_TITLE') . ' Support')->subject('Monthly Bill');
						}
					);


					//Log the result
					Log::info("Order #$order->id - Email: $to_email - Refund from $order->monthly_cost to $subscription->monthly_cost");


				}
				else{
					//Send notify email
					\Mail::send('emails.deposit_notify',
						[
							'order' => $order,
							'subject' => '點數餘額不足',

						],
						function ($message) use ($to_email) {
							$message->to($to_email, getSetting('SITE_TITLE') . ' Support')->subject('點數餘額不足');
						}
					);

					Log::info("Remaining credit does not enough!! email notify sent Order #$order->id User: $order->user_id Credit: $original_credit");

				}

			}
			else Log::info('No order found! '.date('Y-m-d H:i:s'));


			/**
			 * Notify low credit
			 */
			$users = User::all();
			foreach($users as $user){

				if($user->id != 1 && $user->id != 229) continue;

				$user_orders = Order::where('user_id', '=', $user->id)->get();
				$order_credit = 0;
				$to_email = $user->email;
				foreach($user_orders as $user_order){
					$order_credit += $user_order->monthly_cost;
				}

				if($user->total_credit < $order_credit){
					//Send notify email
					\Mail::send('emails.credit_notify',
						[
							//'order' => $order,
							'subject' => '點數餘額不足提醒通知',

						],
						function ($message) use ($to_email) {
							$message->to($to_email, getSetting('SITE_TITLE') . ' Support')->subject('點數餘額不足提醒通知');
						}
					);
				}
				if($user->total_credit < 0){
					//Send notify email
					\Mail::send('emails.low_credit_notify',
						[
							//'order' => $order,
							'subject' => '點數餘額不足提醒通知',

						],
						function ($message) use ($to_email) {
							$message->to($to_email, getSetting('SITE_TITLE') . ' Support')->subject('點數餘額不足提醒通知');
						}
					);
				}
			}
           
		   
        })->dailyAt('1:00');
		
		 

    }
}
