<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        if(Auth::id()){
            //this line check the usertype if it is inventory or admin or others
            $usertype = Auth()->user()->usertype;

            //this line will check if the user that login is inventory or admin or others
            if($usertype == 'inventory'){
                return view('inventory.inventory_home');
            }
            elseif($usertype == 'staff'){
                return view('staff.staff_home');
            }
            elseif($usertype == 'admin'){
                return view('admin.admin_home');
            }
            elseif($usertype == 'purchasing'){
                return view('purchasing.purchasing_home');
            }
            elseif($usertype == 'receiving'){
                return view('receiving.receiving_home');
            }
        }
    }

}
