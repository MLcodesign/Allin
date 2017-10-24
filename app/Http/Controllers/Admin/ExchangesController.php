<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Exchange;

class ExchangesController extends Controller
{
    /**
    * index Exchange
    * 
    */
    public function index()
    {
        return view('admin.exchanges.index');
    }

    /**
    * create Exchange
    * 
    */
    public function create()
    {
        //
    }

    /**
    * store Exchange
    * 
    * @param Request $request
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * show Exchange
    * 
    * @param Exchange $Exchange
    * @return {\Illuminate\View\View|Exchange}
    */
    public function show(Exchange $model)
    {
        return view('admin.exchanges.show')->with(compact('model'));
    }

    /**
    * edit Exchange
    * 
    * @param Exchange $Exchange
    * @param {Exchange|Request} $request
    */
    public function edit(Exchange $model, Request $request)
    {
        //
    }

    /**
    * update Exchange
    * 
    * @param Request $request
    * @param {Exchange|Request} $Exchange
    * @return {\Symfony\Component\HttpFoundation\Response|Exchange|Request}
    */
    public function update(Request $request, Exchange $model)
    {
        $isUpdate = false;
        if($isUpdate === true){
            return response()->json(['status' => 'success', 'success' => 'Exchange is updated sucessfully!!']);
        } else {
            return response()->json(['status' => 'danger', 'success' => 'Exchange not updated.']);
        }
    }

    /**
    * delete Exchange
    * 
    * @param Exchange $Exchange
    * @param {Exchange|Request} $request
    * @return {\Symfony\Component\HttpFoundation\Response|Exchange|Request}
    */
    public function destroy(Exchange $model, Request $request)
    {
        //var_dump($Exchange);
        if ($request->ajax()) {
            $model->delete();
            //var_dump($Exchange->delete());
            return response()->json(['success' => 'Exchange has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }
}
