<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Mail\MyMail;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;

class ContactController extends Controller
{

    /**
     * Validate rules
     * @var array
     */
    public $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|email',
        'subject' => 'required|string|min:5',
        'mess' => 'required|string|min:7',
    ];

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('shop.contact');

    }

    /**
     * @param Request $request
     * @param Mailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request, Mailer $mailer)
    {
        $this->validate($request, $this->rules);
        $mailer->to($request->input('email'))
            ->send(new MyMail($request));

        return redirect()->back()
            ->with('messageSuccess', 'Your message send!');

    }


}
