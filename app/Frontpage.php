<?php

namespace App;

use App\BaseModel;

class Frontpage extends BaseModel
{
	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'frontpages';
	protected $guarded = ['id'];


}
