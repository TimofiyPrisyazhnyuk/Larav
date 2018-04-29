<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ContactController extends Controller
{

    public function Contact(Request $request)
    {
        //TODO:Timofiy  ~ Need to change - This method need to update
        if (view()->exists('shop.contact')) {

            $messages = [
                'name' => 'required|max:2',
                'email' => 'max:3',
            ];

            $validator = Validator::make($request->all(), $messages);

            if ($validator->fails()) {
                dump($validator->errors()->all());
            }
        }


        return view('shop.contact');

    }
}
