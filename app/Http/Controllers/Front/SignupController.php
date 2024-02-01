<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\PageOtherItem;
use App\Models\Company;
use App\Models\Candidate;
use Hash;
use Auth;

class SignupController extends Controller
{
    public function index(){
        
        if(Auth::guard('candidate')->check()){
            return redirect()->route('candidate_dashboard');
        }
        
        if(Auth::guard('company')->check()){
            return redirect()->route('company_dashboard');
        }

        $other_page_item = PageOtherItem::where('id',1)->first();
        return view('front.signup',compact('other_page_item'));
    }

    public function company_signup(Request $request){
        $request->validate([
            'company_name' => 'required',
            'person_name' => 'required',
            'username' => 'required|unique:companies',
            'email' => 'required|email|unique:companies',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $token = hash('sha256',time());

        $company = new Company();
        $company->company_name = $request->company_name;
        $company->person_name = $request->person_name;
        $company->username = $request->username;
        $company->email = $request->email;
        $company->password = Hash::make($request->password);
        $company->token = $token;
        $company->status = 0;
        $company->save();

        $verify_link = url('company/signup-verify/'.$token.'/'.$request->email);
        $subject = 'Company Signup Verification';
        $message = 'Please click on the following link to verify:<br>';
        $message .= '<a href="'.$verify_link.'">Click here</a>';

        \Mail::to("$request->email")->send(new Websitemail($subject,$message));
        return redirect('login')->with('success','Please check your email to verify the given email address');
    }

    public function company_signup_verify($token,$email){

        $company = Company::where('token',$token)->where('email',$email)->first();
        if(!$company){
            return redirect('login')->with('error','company not found');
        }
        $company->status = 1;
        $company->token = "";
        $company->update();
        return redirect('login')->with('success','company verifed succesfully');
    }

    public function candidate_signup(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:candidates',
            'email' => 'required|email|unique:candidates',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $token = hash('sha256',time());

        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->username = $request->username;
        $candidate->email = $request->email;
        $candidate->password = Hash::make($request->password);
        $candidate->token = $token;
        $candidate->status = 0;
        $candidate->save();

        $verify_link = url('candidate/signup-verify/'.$token.'/'.$request->email);
        $subject = 'Candidate Signup Verification';
        $message = 'Please click on the following link to verify:<br>';
        $message .= '<a href="'.$verify_link.'">Click here</a>';

        \Mail::to("$request->email")->send(new Websitemail($subject,$message));
        return redirect('login')->with('success','Please check your email to verify the given email address');
    }

    public function candidate_signup_verify($token,$email){

        $candidate = Candidate::where('token',$token)->where('email',$email)->first();
        if(!$candidate){
            return redirect('login')->with('error','candidate not found');
        }
        $candidate->status = 1;
        $candidate->token = "";
        $candidate->update();
        return redirect('login')->with('success','candidate verifed succesfully');
    }
}
