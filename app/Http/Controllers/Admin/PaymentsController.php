<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Blog;
use App\Payment;
use App\News;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
  
  
     public function edittopbarnews()
    {
        
		$posts = Blog::paginate(10);
		$news = News::first();
		
		return view('admin.news.index')->withNews($news)->withPosts($posts);
		
		
    }
	
	
	
	public function editblogpost ($id) {
		
		
		   $post = Blog::find($id);
		 
		   
		   
		   return view('admin.news.editpost')->withPost($post);
			
		
		
	}
	
	
	public function editsaveblogpost ($id, Request $request) {
		
		
		//$post = Blog::find($id);
		
		$post = Blog::find($id);
		
		$post->title = $request->title;
		
		$post->body  = $request->body;
		
		$post->save();
		
		//Session::flash('success', 'This post was successfully saved.');

		//return redirect()->url('/top-bar-news');
		 return redirect('/admin/top-bar-news');  
	
		
	}
	public function savenewpost (Request $request) {
		
		
		
		$post = new Blog;
		$post->title = $request->title;
        $post->body = $request->body;
		
		$post->save();
		
		
		
		
		//Session::flash('success', 'This post was successfully saved.');

		//return redirect()->url('/top-bar-news');
		 return redirect('/admin/top-bar-news');  
	
		
	}
	
	public function destroypost($id)
    {
       $post = Blog::find($id);
	   $post->delete();
	  // Session::flash('success', 'This post was delted successfully!.');
	   return redirect('/admin/top-bar-news');  
	   
	}
	public function createnewpost () {
		
		
		
		 return view('admin.news.create');
		
		
	} 
	
	
	
	    public function savetopbarnews(Request $request)
    {
        
		
		$data = $request->topnews;
		
	    $savenews = News::first()->where('id', 0);
		
		DB::table('topbarnews')
            ->where('id', 0)
            ->update(['text' => $data]);
	   
		//$request->session()->flash('alert-success', 'Top News Updated Successfully!');
		
		//$news = News::first();
		//return view('admin.news.index')->withNews($news);
		//return redirect()->view('admin.news.index');
		return redirect('admin/top-bar-news')->with('alert-success', 'Top News Updated Successfully!');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {

        return view('admin.payments.show')->with(compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    } 
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment, Request $request)
    {
        if ($request->ajax()) {
            $payment->delete();
            return response()->json(['success' => 'Payment Record has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }
}
