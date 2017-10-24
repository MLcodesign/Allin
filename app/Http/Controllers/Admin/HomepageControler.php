<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use App\Page;

class PagesController extends Controller
{
    /**
     * PagesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param PageRequest $request
     * @return mixed
     */
    public function store(PageRequest $request)
    {
        $page = new Page($request->except('_token', 'page_id','published'));
		
		$page->published = 0;
		
		if($request->input('published'))
		{
			$page->published = 1;
		}
        
		if ($page->published) {
            $page->published_at = \Carbon::now();;
        }

        $page->save();

        return redirect('admin/pages')->with('success', $page->title . ' has been added Successfully');
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function edit(Page $page)
    {
        return view('admin.home', compact('page'));
    }//edit

    /**
     * @param PageRequest $request
     * @param Page $page
     * @return mixed
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->title = $request->input('title');

        $page->content = $request->input('content');

        $page->icon = $request->input('icon');

        if ($page->published == 0 && $request->input('published')) {
            $page->published_at = \Carbon::now();;
        }

        $page->published = $request->input('published');

        $page->blog_post = $request->input('blog_post');

        $page->slug = $request->input('slug');

        $page->meta_keywords = $request->input('meta_keywords');

        $page->meta_desc = $request->input('meta_desc');

        $page->updated_at = \Carbon::now();

        $page->save();

        return redirect('admin/home')->with('success', $page->title . ' has been Updated Successfully');
    }//update

}
