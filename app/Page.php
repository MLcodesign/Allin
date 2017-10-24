<?php

namespace App;

//use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Page extends Model 
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
	 
	protected $table= "pages";
	 
    protected $guarded = ['id'];

    protected $dates = ['published_at'];

    function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    function scopePage($query)
    {
        return $query->where('blog_post', 0);
    }

    function scopePost($query)
    {
        return $query->where('blog_post', 1)->orderBy('published_at', 'desc');
    }

    function getPublishedAttribute()
    {
        return $this->attributes['published'] ? 'published' : 'not yet';
    }
	
	function getIdAttribute()
    {
        return $this->attributes['id'];
    }

    function getBlogPostAttribute()
    {		
		if($this->attributes['blog_post'] == 0) return 'Page';
		elseif($this->attributes['blog_post'] == 1) return 'Blog Post';
		elseif($this->attributes['blog_post'] == 2) return 'Homepage';
    }
	

    function getSlugAttribute()
    {
		if($this->attributes['blog_post'] == 0) return 'page/'.$this->attributes['slug'];
		elseif($this->attributes['blog_post'] == 1) return 'post/'.$this->attributes['slug'];
		elseif($this->attributes['blog_post'] == 2) return '';
		
    }
    function excerpt()
    {
		$content = preg_replace("/<img(.*?)>/si", "", $this->content);
		$content = preg_replace('/(<.*?>)|(&.*?;)/', '', $content)  ;

        return Str::words($content,30); 

    }	
	
}
