<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function create(){
        $package = [
            'Sapphire'=>'Sapphire',
            'abcd'=>'abcd'
        ];
        return view('front-end.contact.contact', ['package'=>$package]);
    }

    public function store(Request $request){
        //dd(request()->all());
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'mobile'=>'required|numeric',
            'zone'=>'required',
            'package'=>'required',
            'address'=>'required',
            'message'=>'required'
        ]);

        Mail::to('salesinfo@ace.net.bd')->send(new ContactFormMail($data));
        //return view('front-end.thankyou')->with('success_message', 'Our Technical team will communicate with you soon');
        return redirect()->route('confirmation.index')->with('success_message', 'Our Technical team shall communicate with you soon');
    }
}
