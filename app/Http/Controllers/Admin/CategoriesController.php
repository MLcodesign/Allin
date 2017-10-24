<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Category;

class CategoriesController extends Controller
{
    /**
    * index Category
    * 
    */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
    * create Category
    * 
    */
    public function create()
    {
        //
    }

    /**
    * store Category
    * 
    * @param Request $request
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * show Category
    * 
    * @param Category $Category
    * @return {\Illuminate\View\View|Category}
    */
    public function show(Category $model)
    {
        return view('admin.categories.show')->with(compact('model'));
    }

    /**
    * edit Category
    * 
    * @param Category $Category
    * @param {Category|Request} $request
    */
    public function edit(Category $model, Request $request)
    {
        //
    }

    /**
    * update Category
    * 
    * @param Request $request
    * @param {Category|Request} $Category
    * @return {\Symfony\Component\HttpFoundation\Response|Category|Request}
    */
    public function update(Request $request, Category $model)
    {
        $isUpdate = false;
        if($isUpdate === true){
            return response()->json(['status' => 'success', 'success' => 'updated sucessfully!!']);
        } else {
            return response()->json(['status' => 'danger', 'success' => 'fail to updated.']);
        }
    }

    /**
    * delete Category
    * 
    * @param Category $Category
    * @param {Category|Request} $request
    * @return {\Symfony\Component\HttpFoundation\Response|Category|Request}
    */
    public function destroy(Category $model, Request $request)
    {
        //var_dump($Category);
        if ($request->ajax()) {
            $model->delete();
            //var_dump($Category->delete());
            return response()->json(['success' => 'It has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }
}
