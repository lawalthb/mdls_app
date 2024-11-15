<?php 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends Controller{
	/**
     * Index Action
     * @return \Illuminate\View\View
     */
	function index(){
		$user = auth()->user();
		if($user->hasRole('admin')){
			return view("pages.home.admin");
		}
		elseif($user->hasRole('user')){
			return view("pages.home.user");
		}
		elseif($user->hasRole('teacher')){
			return view("pages.home.teacher");
		}
		elseif($user->hasRole('director')){
			return view("pages.home.director");
		}
		else{
			return view("pages.home.index");
		}
	}
	
}
