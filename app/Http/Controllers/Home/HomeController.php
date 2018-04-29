<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\User;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkAuth()
    {
        if (auth()->user()) {
            return redirect()->back();
        }
    }

    /**
     * Show user Account if admin or default user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $user = User::getAuthUser();
        if (auth()->user()->hasRole(['admin', 'manager'])) {

            return view('home.adminHome', ['user' => $user]);
        } else if (auth()->user()) {

            return view('home.userHome', ['user' => $user]);
        }
    }


}
