<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\User;
use Auth;

//use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkAuth()
    {
        if (Auth::user()) {
            return redirect()->back();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        if (Auth::user()->hasRole(['admin', 'manager'])) {
            $user = User::getUser();
            return view('home.adminHome', ['user' => $user]);

        } else if (Auth::user()) {

            $user = User::getUser();
            return view('home.userHome', ['user' => $user]);
        }
    }


}
