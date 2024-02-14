<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\Subscriber;

class SubscriberController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email|unique:subscribers',
        ]);

        $token = hash('sha256',time());

        $obj = new Subscriber();
        $obj->email = $request->email;
        $obj->token = $token;
        $obj->status = 0;
        $obj->save();

        $verify_link = url('subscriber/verify/'.$token.'/'.$request->email);
        $subject = 'Subscriber Verification';
        $message = 'Please click on the following link to verify:<br>';
        $message .= '<a href="'.$verify_link.'">Click here</a>';

        \Mail::to("$request->email")->send(new Websitemail($subject,$message));
        return redirect()->back()->with('success','Please check your email to verify the given email address');
    }

    public function verify($token,$email){
        $subscriber = Subscriber::where('token',$token)->where('email',$email)->first();
        if(!$subscriber){
            return redirect()->back()->with('error','Subscriber not found');
        }
        $subscriber->status = 1;
        $subscriber->token = "";
        $subscriber->update();
        return redirect()->back()->with('success','Subscriber verifed succesfully !!');
    }

}
