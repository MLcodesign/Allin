<?php

namespace App\Http\Controllers\Admin;

use App\AdminMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMenusController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index( Request $request ) {
		$menus = AdminMenu::all();

		if ( isset( $request->menus ) ) {

			$input_menus = $request->input( 'menus' );

			if ( $menus ) {
				foreach ( $menus as $menu ) {

					if ( isset( $input_menus[ $menu->id ] ) && ! empty( $input_menus[ $menu->id ] ) ) {
						$menu->title = $input_menus[ $menu->id ];
						$menu->save();
					}
				}
			}

			return redirect('admin/adminMenus')->with('success', 'Menu Updated Successfully');
		} else {
			return view( 'admin.adminMenus.index' )->with( compact( 'menus' ) );
		}

	}


}
