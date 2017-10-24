<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Logistic;

class LogisticsController extends Controller
{
    /**
    * index Logistic
    * 
    */
    public function index()
    {
        return view('admin.logistics.index');
    }

    /**
    * create Logistic
    * 
    */
    public function create()
    {
        //
    }

    /**
    * store Logistic
    * 
    * @param Request $request
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * show Logistic
    * 
    * @param Logistic $logistic
    * @return {\Illuminate\View\View|Logistic}
    */
    public function show(Logistic $logistic)
    {
        $user = DB::table('users')
            ->where('id', $logistic->getOrder()->user_id)->first();

        return view('admin.logistics.show')->with(compact('logistic','user'));
    }

    /**
    * edit Logistic
    * 
    * @param Logistic $logistic
    * @param {Logistic|Request} $request
    */
    public function edit(Logistic $logistic, Request $request)
    {
        //
    }

    /**
    * update Logistic
    * 
    * @param Request $request
    * @param {Logistic|Request} $logistic
    * @return {\Symfony\Component\HttpFoundation\Response|Logistic|Request}
    */
    public function update(Request $request, Logistic $logistic)
    {
        $action = $request->get('actionType');
        $isUpdate = false;
        if($action == "ajax"){
            $isUpdate = $this->updateAjax($request, $logistic); 
                
            if($isUpdate === true){
                return response()->json(['status' => 'success', 'success' => 'Logistic is updated sucessfully!!']);
            } else {
                return response()->json(['status' => 'danger', 'success' => 'Logistic not updated.']);
            }   
        }else{
            if($isUpdate === true){
                return response()->json(['status' => 'success', 'success' => 'Logistic is updated sucessfully!!']);
            } else {
                return response()->json(['status' => 'danger', 'success' => 'Logistic not updated.']);
            }
        }
    }

    private function updateAjax($request, Logistic $logistic){
        $status = !empty($request->get('status')) ? $request->get('status') : "";
        
        $isUpdate=false;
        if (!empty($status)) {
            $logistic->status = $status;
            if(Logistic::CLOSED == $status){
                $logistic->actual_shipping_date = date("Y-m-d");   
            }
            $logistic->save();
            $isUpdate=true;
        }
        return $isUpdate;
    }
    
    /**
    * delete Logistic
    * 
    * @param Logistic $logistic
    * @param {Logistic|Request} $request
    * @return {\Symfony\Component\HttpFoundation\Response|Logistic|Request}
    */
    public function destroy(Logistic $logistic, Request $request)
    {
        //var_dump($logistic);
        if ($request->ajax()) {
            $logistic->delete();
            //var_dump($logistic->delete());
            return response()->json(['success' => 'Logistic has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }
}
