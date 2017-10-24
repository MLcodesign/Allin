<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Order;
use DB;
use App\Coupon;
use App\Services\BoxesService;
use App\Exchange;
use App\Http\Classes\Packages;
use App\Deposit;

class UsersController extends Controller
{
    protected $boxesService;

    /**
     * UsersController constructor.
     */
    public function __construct(BoxesService $boxesService)
    {
        $this->boxesService = $boxesService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id');

        $packages = Package::active()->lists('name', 'id');

        $job_titles = getSetting('JOB_TITLES');


        return view('admin.users.create_edit')->with(compact('roles', 'job_titles', 'packages'));
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {

        $account = [];

        $avatar = 'avatar.png';

        if ($request->hasFile('avatar')) {
            $destinationPath = public_path() . '/uploads/avatars';

            $avatar = hash('sha256', mt_rand()) . '.' . $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->move($destinationPath, $avatar);

            \Image::make(asset('uploads/avatars/' . $avatar))->fit(300, null, null, 'top-left')->save('uploads/avatars/' . $avatar);
        }

        $account['avatar'] = $avatar;

        $account['name'] = $request->input('name');
        $valid_package = true;
        if ($request->input('package_id')) {
            if ($request->input('package_id') == getSetting('DEFAULT_PACKAGE_ID')) {
                $account['package_id'] = getSetting('DEFAULT_PACKAGE_ID');
            } else {
                $valid_package = false;
            }
        }
        $account['email'] = $request->input('email');
        $account['mobile'] = $request->input('mobile');
        $account['job_title'] = $request->input('job_title');
        $account['address'] = $request->input('address');
        $account['role_id'] = $request->input('role');
		$account['referal_code'] = Coupon::generate(8);

        $user = new User($account);

        $user->password = bcrypt($request->input('password'));

        $user->save();

        $package_message = $valid_package ? '' : ' Please Note you can\'t add package without Stripe Subscription';

        $status_message = $user->name . ' has been added Successfully.' . $package_message;

        return redirect('admin/users')->with('success', $status_message);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function show(User $user)
    {
		$inHouseboxCnt = $this->boxesService->getInHouseBoxesCountByUserId($user->id);
        $closedboxCnt = $this->boxesService->getClosedHouseBoxesCountByUserId($user->id);
        return view('admin.users.show')->with(compact('user', 'inHouseboxCnt', 'closedboxCnt'));
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function edit(User $user)
    {
        $roles = Role::lists('name', 'id');

        $packages = Package::active()->lists('name', 'id');

        $job_titles = getSetting('JOB_TITLES');
        $deObj = new Deposit(); 
        $exObj = new Exchange();
        $deposits = $deObj->getRefundDepositsForHomeById($user->id);
        $exchanges = $exObj->getExchangesForHomeById($user->id);

        return view('admin.users.create_edit')->with(compact('user', 'roles', 'job_titles', 'packages','deposits','exchanges'));
    }
 
    /**
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {

        if ($request->hasFile('avatar')) {
            $destinationPath = public_path() . '/uploads/avatars';

            if ($user->avatar != "uploads/avatars/avatar.png") {
                @unlink($user->avatar);
            }

            $avatar = hash('sha256', mt_rand()) . '.' . $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->move($destinationPath, $avatar);

            \Image::make(asset('uploads/avatars/' . $avatar))->fit(300, null, null, 'top-left')->save('uploads/avatars/' . $avatar);

            $user->avatar = $avatar;
        }

        $user->name = $request->input('name');

        $valid_package = true;

        if ($request->input('package_id')) {
            if ($request->input('package_id') != getSetting('DEFAULT_PACKAGE_ID')) {
                /**
                 * check if the user subscribed and new package selected
                 */
                if ($user->subscribed('MEMBERSHIP')) {
                    /**
                     * Swap subscription plan
                     */
                    if ($request->input('package_id') != $user->package_id) {
                        $package = Package::find($request->input('package_id'));
                        $user->subscription('MEMBERSHIP')->swap($package->plan);
                        $user->package_id = $request->input('package_id');
                    }
                } else {
                    /**
                     * can't add package without Stripe Subscription
                     */
                    $valid_package = false;
                }
            } else {
                /**
                 * Assign Default free package to user
                 */
                $user->package_id = getSetting('DEFAULT_PACKAGE_ID');
                if ($user->subscribed('MEMBERSHIP')) {
                    $user->subscription('MEMBERSHIP')->cancel();
                }
            }
        } else {
            /**
             * reset user package
             */
            $user->package_id = 0;
        }
		
		//if admin made change to credit
		if($user->total_credit != $request->input('total_credit')){
		
			$depositArr = ["user_id" => $user->id ,
			   "p_cnt" => $request->input('total_credit') - $user->total_credit,
			   "pay_amt" => 0, 
			   "user_credit" => $request->input('total_credit'),
			   "created_at" => date("Y-m-d H:i:s"),
			   "created_by" => 1, 
			   "category_id" => 5,
			   "op_type" => "system",
			   "api_memo_note" => "管理者人工修改",
			   "api_system_note" => $request->input('note')
			  ];
			
			DB::table('deposits')->insertGetId($depositArr);
		}
		
		

        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->job_title = $request->input('job_title');
        $user->address = $request->input('address');
		$user->total_credit = $request->input('total_credit');
        $user->updated_at = \Carbon::now();
        $user->role_id = $request->input('role');

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
		
		

        $user->save();

        $package_message = $valid_package ? '' : ' Please Note you can\'t add package without Stripe Subscription';

        $status_message = $user->name . ' has been updated Successfully.' . $package_message;

        return redirect('admin/users')->with('success', $status_message);
    }

    public function sendCreditNotify($user_id){
	    if(isset($user_id)){

	    	$user = User::find($user_id);

		    $user_orders = Order::where('user_id', '=', $user->id)->get();
		    $order_credit = 0;
		    $to_email = $user->email;
		    foreach($user_orders as $user_order){
			    $order_credit += $user_order->monthly_cost;
		    }

		    $status_message = 'Email did not send!!';

		    if($user->total_credit < $order_credit){
			    //Send notify email
			    \Mail::send('emails.credit_notify',
				    [
					    'subject' => '點數餘額不足提醒通知',

				    ],
				    function ($message) use ($to_email) {
					    $message->to($to_email, getSetting('SITE_TITLE') . ' Support')->subject('點數餘額不足提醒通知');
				    }
			    );

			    $status_message = 'Email sent to '.$to_email;
		    }
		    if($user->total_credit < 0){
			    //Send notify email
			    \Mail::send('emails.low_credit_notify',
				    [
					    'subject' => '點數餘額不足提醒通知',

				    ],
				    function ($message) use ($to_email) {
					    $message->to($to_email, getSetting('SITE_TITLE') . ' Support')->subject('點數餘額不足提醒通知');
				    }
			    );

			    $status_message = 'Email sent to '.$to_email;
		    }

		    return redirect('admin/users')->with('success', $status_message);
	    }
	    else return redirect('admin/users');
    }

    /**
     * @param Request $request
     * @param User $user
     * @return string
     * @throws \Exception
     */
    public
    function destroy(Request $request, User $user)
    {
        if ($request->ajax()) {
            $user->delete();
            return response()->json(['success' => 'User has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }

}
