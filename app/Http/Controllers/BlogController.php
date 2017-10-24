<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\newsletter;
use App\Blog;
use Session;

class BlogController extends Controller
{
   
   
   public function index() {
	   
       
	   
	   $recentposts = Blog::orderBy('created_at', 'desc')->take(5)->get();
	   $posts = Blog::orderBy('created_at','desc')->paginate(5);
	   
	   return view('frontend.bloghome')->withPosts($posts)->withRecentpost($recentposts);
		
		
	   
	   
	   
   }
   
   
   
    public function getSingle ($reqid) {
	   
	    $post = Blog::where('id',$reqid)->first();
	  
		$recentposts = Blog::orderBy('id', 'desc')->take(5)->get();

		if($post->edm) $edm = '/uploads/edm/'.$post->edm;

	   return view('frontend.blogsingle')->with(compact('edm'))->withPost($post)->withRecentpost($recentposts);
   }
   
   
   
}
