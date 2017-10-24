<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Package;
use App\Page;
use Yajra\Datatables\Datatables;
use App\User;
use App\Setting;
use App\Role;
use DB;
use App\Order;
use App\Logistic;
use App\Payment;
use App\Coupons;
use App\Deposit;
use App\Coupon;

class DatatablesController extends Controller
{

    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getUserdeposits($user_id){
		
        //$payments = Payment::all();
        //$payments = Payment::select(['temp_order_number' , 'id_user', 'amount', 'total_payment', 'payment_type', 'payment_time']);
        $deposits = Deposit::select(['deposits.created_at', 'deposits.api_memo_note', 'deposits.api_system_note', 'deposits.p_cnt', 'deposits.pay_amt', 'deposits.user_credit'])
			->where('deposits.user_id', "=", $user_id)
			->where(function($query){
				$query->where('deposits.category_id', '=' , '2')
							->orWhere('deposits.category_id', '=' , '4')
							->orWhere('deposits.category_id', '=' , '5');
			});
			
        return Datatables::of($deposits)
		->editColumn('created_at', function($deposit){
			return $deposit->created_at->format('Y-m-d');
		})
		->editColumn('p_cnt', function($deposit){
			return $deposit->p_cnt > 0 ? '+'.$deposit->p_cnt : $deposit->p_cnt;
		})
		->make(true);        
    }
	
	public function getPayments(){
		//$payments = Payment::all();
        //$payments = Payment::select(['temp_order_number' , 'id_user', 'amount', 'total_payment', 'payment_type', 'payment_time']);
        $payments = Payment::join('users', 'payments.id_user', '=', 'users.id')
            ->select(['payments.temp_order_number', 'payments.id_user', 'users.name', 'users.email', 'payments.amount', 'payments.total_payment',
             'payments.payment_type','payments.status', 'payments.create_t', 'payments.payment_time']);

		return Datatables::of($payments)
				->editColumn('temp_order_number', function($payment){
					return '#'.$payment->temp_order_number;
				})
				->editColumn('name', function($payment){
					return '<a href="' . url('admin/users/' . $payment->id_user) . '">'.$payment->name.'</a>';
				})
                
                ->editColumn('email', function($payment){
                    return '<a href="' . url('admin/users/' . $payment->id_user) . '">'.$payment->email.'</a>';
                })
				
				->addColumn('actions', function ($payment) {
                if (\Auth::user()->role->name == 'Admin') {
					
                    $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/payments/' . $payment->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                    $deleteBtn = '&nbsp;<a href="' . url('admin/payments/' . $payment->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';
					
                    $viewBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/payments/' . $payment->id ) . '"  title="View"><i class="fa fa-2 fa-eye"></i></a>';
					//$arrivedBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/deposits/' . $deposit->id . '/edit?action=arrived') . '"  title="Arrived"><i class="fa fa-2 fa-check"></i></a>';
                }
                $buttons = $viewBtn.$deleteBtn;
                return $buttons;
            })->make(true);
	}
	
	public function getOrders(){
		
		$orders = Order::all();
		
		return Datatables::of($orders)
			->editColumn('id', function($order){
				return '<a href="' . url('admin/orders/' . $order->id) . '">No. '.$order->id.'</a>';
			})
			->editColumn('name', function($order){
				//$user = DB::table('users')->where('id', $order->user_id)->value('name');
				return "<a href='". url('admin/users/' . $order->user_id)."'>$order->name</a>";
				//return $user;
			})
			->editColumn('status', function($order){
					return $order->getOrderStatus();
			})
			
			->editColumn('packages', function($order){
				return $order->getPricing();
				
			})
			->editColumn('address', function($order){
				return $order->county.' '.$order->district.' '.$order->zipcode.'<br/>'.
					   $order->address.'<br/>'.$order->phone;
			})
			
			->addColumn('billing_period', function($order){
				return $order->getBillingPeriod();
			})
			
            ->addColumn('actions', function ($order) {
                
				return $order->getAction();
				
            })->make(true);
	} 
    
    public function getLogistics(){
        
        $logistics = Logistic::all();
        
        return Datatables::of($logistics)
            ->editColumn('id', function($logistic){
                return '<a href="' . url('admin/logistics/' . $logistic->id) . '">No. '.$logistic->id.'</a>';
            })
			->editColumn('order_id', function($logistic){
				
				$order = $logistic->getOrder();
				if(!is_object($order)) return '';
				$order_id = $order->id;
				return '<a href="' . url('admin/orders/' . $order_id) . '">'.$order_id.'</a>';
			})
            ->editColumn('name', function($logistic){
				$order = $logistic->getOrder();
				if(!is_object($order)) return '';
				$user_id = $order->user_id;
				
                return "<a href='". url('admin/users/' . $user_id)."'>$logistic->name</a>";
            })
            ->editColumn('status', function($logistic){
                    return $logistic->getStatus();
            })

            ->editColumn('address', function($logistic){
                return $logistic->getAddress();
            })
            
            ->addColumn('actions', function ($logistic) {
                
                return $logistic->getAction();
                
            })->make(true);
    } 
    
    public function getUsers()
    {
        $users = User::all();

        return Datatables::of($users)
            ->editColumn('name', '<a href="{{ url(\'admin/users/\'.$id) }}"><b>{{ $name }}</b></a>')
            /*->editColumn('name', function($user){
                //$user = DB::table('users')->where('id', $logistic->getOrder()->user_id)->value('name');
                //return $user;
                return "<a href='". url('admin/users/' . $user->id)."'>$user->name</a>";
            })*/
            ->editColumn('role_id', function ($user) {
                if (!is_null($user->role)) {
                    return $user->role->name;
                } else {
                    return '-';
                }
            })
            //->removeColumn("account_number")
            ->addColumn('credit', function ($user) {
                if (!is_null($user->total_credit)) {
                    return $user->total_credit;
                } else {
                    return '-';
                }
            })
            ->addColumn('actions', function ($user) {
                return $user->getActions(\Auth::user());
            })->make(true);
    }

    public function getSettings()
    {
        $settings = Setting::all();

        return Datatables::of($settings)
            ->editColumn('value', function ($setting) {
                return htmlentities(strlen($setting->getOriginal('value')) > 50 ? substr($setting->getOriginal('value'), 0, 50) : $setting->getOriginal('value'));
            })
            ->addColumn('actions', function ($setting) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/settings/' . $setting->id . '/edit/') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';

                return $editBtn;
            })->make(true);
    }

    public function getRoles()
    {
        $roles = Role::all();

        return Datatables::of($roles)
            ->editColumn('routes', function ($role) {
                return htmlentities(strlen($role->getOriginal('routes')) > 50 ? substr($role->getOriginal('routes'), 0, 50) : $role->getOriginal('routes'));
            })
            ->addColumn('actions', function ($role) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/roles/' . $role->id . '/edit/') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '';
                if ($role->name != 'Admin') {
                    $deleteBtn = '&nbsp;<a href="' . url('admin/roles/' . $role->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Permanent Delete"><i class="fa fa-2 fa-remove"></i></i></a>';
                }
                return $editBtn . $deleteBtn;
            })->make(true);
    }

    public function getMenus()
    {
        $menus = Menu::all();

        return Datatables::of($menus)
            ->addColumn('actions', function ($menu) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/menus/' . $menu->id . '/edit/') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/menus/' . $menu->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Permanent Delete"><i class="fa fa-2 fa-remove"></i></i></a>';
                return $editBtn . $deleteBtn;
            })->make(true);
    }

    public function getPackages()
    {
        $packages = Package::all();

        return Datatables::of($packages)
            ->editColumn('name', '<a href="{{ url(\'admin/packages/\'.$id) }}"><b>{{ $name }}</b></a>')
            ->editColumn('cost', function ($package) {
                return round($package->cost) . '/' . $package->cost_per;
            })
            ->addColumn('actions', function ($package) {
                $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/packages/' . $package->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/packages/' . $package->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';

                $buttons = '' . $editBtn . $deleteBtn;
                return $buttons;
            })->make(true);
    }

    public function getFeatures()
    {
        $features = Feature::all();

        return Datatables::of($features)
            //->editColumn('name', '<a href="{{ url(\'admin/features/\'.$id) }}"><b>{{ $name }}</b></a>')
            ->addColumn('actions', function ($feature) {
                $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/features/' . $feature->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/features/' . $feature->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';

                $buttons = '' . $editBtn . $deleteBtn;
                return $buttons;
            })->make(true);
    }

    public function getPages()
    {
        $page = Page::all();

        return Datatables::of($page)
            ->editColumn('title', '<a href="{{ url(\'admin/pages/\'.$id) }}" target="_blank"><b>{{ $title }}</b></a>')
            ->addColumn('actions', function ($page) {
                $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/pages/' . $page->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';

                $deleteBtn = '&nbsp;<a href="' . url('admin/pages/' . $page->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';

                $viewBtn = '<a style="margin-right: 0.2em;" href="' . url($page->slug) . '"  title="View" target="blank"><i class="fa fa-2 fa-eye"></i></a>';

                $buttons = '' . $editBtn . $viewBtn . $deleteBtn;
                return $buttons;
            })->make(true);
    }
	
	public function getCoupon()
    {
        $coupon = Coupons::all();

		//$coupon = DB::table('coupon')->get();
		
        return Datatables::of($coupon)
            ->editColumn('code', function ($coupon) {
                return $coupon->code;
            })
			->editColumn('date', function ($coupon) {
                return $coupon->from_date . ' - '. $coupon->to_date;
            })
			->editColumn('point', function ($coupon) {
                return $coupon->point;
            })
			->editColumn('status', function ($coupon) {
                if($coupon->status == '0'){
					return "Active";
				} else if($coupon->status == '1'){
					return "Deactive";
				}				

            })
            ->addColumn('actions', function ($coupon) {
                $editBtn = '<a style="margin-right: 0.1em;" href="' . url('/admin/coupon/' . $coupon->coupon_id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';

                $deleteBtn = '&nbsp;<a href="' . url('/admin/coupon/' . $coupon->coupon_id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';

                $buttons = '' . $editBtn . $deleteBtn;
                return $buttons;
            })->make(true);
    }
}
				