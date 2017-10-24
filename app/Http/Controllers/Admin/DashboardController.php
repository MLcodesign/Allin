<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Package;
use App\Page;
use App\User;
use Illuminate\Http\Request;
use App\Frontpage;


class DashboardController extends Controller
{

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->count();
        $packages = Package::all()->count();
        $orders = Order::all()->count();
        $pages = Page::page()->count();
        $posts = Page::post()->count();
        $subscriptions = \DB::table('subscriptions')->count();
        
        return view('admin.dashboard')->with(compact('users', 'packages', 'orders', 'subscriptions', 'pages', 'posts'));
    }

    public function frontpages($id = ''){

	    $page = Frontpage::findOrFail($id);

	    $entries = json_decode($page->value);
	    return view('admin.frontpages')->with(compact('page', 'entries'));
    }


    public function update_frontpages(Request $request){

	    $page = Frontpage::findOrFail($request->id);

    	if(isset($request->entries)){
		    $page->value = json_encode($request->entries);
		    $page->save();
	    }

	    return redirect('admin/frontpages/'.$request->id)->with('success', 'Page Updated Successfully');
    }
	

}
