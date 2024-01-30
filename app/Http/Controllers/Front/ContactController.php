<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\PageContactItem;
use App\Models\Admin;

class ContactController extends Controller
{
    public function index(){
        $contact_page_item = PageContactItem::where('id',1)->first();
        return view('front.contact',compact('contact_page_item'));
    }

    public function submit(Request $request){

        $request->validate([
            'person_name' => 'required',
            'person_email' => 'required|email',
            'person_message' => 'required',
        ]);

        $admin = Admin::where('id',2)->first();

        $subject = "Contact Form Message";
        $message = "Vistor Inofrmaton: <br> name: $request->person_name <br>  email: $request->person_email <br> message: $request->person_message";

        \Mail::to($admin->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','email is sent successfully ! we will contact you soon.');

    }
}
