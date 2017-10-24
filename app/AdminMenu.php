<?php

namespace App;

use App\BaseModel;

class AdminMenu extends BaseModel
{
	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'admin_menus';
	protected $guarded = ['id'];


}
