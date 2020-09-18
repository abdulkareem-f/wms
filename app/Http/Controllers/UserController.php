<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;

class UserController extends Controller{
//---------------------------------------------------------//
    public function __construct(){
        $this->middleware('admin');
    }
//---------------------------------------------------------//
	public function index(){
		return view('users.index');
	}
//---------------------------------------------------------//
	public function usersDatatable(Request $request){
		$role = '';
		if(isset($request['query']['role']))
			$role = $request['query']['role'];

		if($role)
			$users = User::where('role', $role)->get();
		else
			$users = User::all();

        return Datatables::of($users)
        		->addColumn('full_name', function($col){
        			return $col->first_name.' '.$col->last_name;
        		})->make(true);
	}
//---------------------------------------------------------//
}
