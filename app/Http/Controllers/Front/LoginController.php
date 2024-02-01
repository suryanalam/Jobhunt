<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageOtherItem;
use Hash;
use Auth;

class LoginController extends Controller
{
    public function index(){

        if(Auth::guard('candidate')->check()){
            return redirect()->route('candidate_dashboard');
        }
        
        if(Auth::guard('company')->check()){
            return redirect()->route('company_dashboard');
        }
        
        $other_page_item = PageOtherItem::where('id',1)->first();
        return view('front.login',compact('other_page_item'));
    }

    public function company_login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(Auth::guard('company')->attempt($credentials)){
            return redirect()->route('company_dashboard');
        }else{
            return redirect()->route('login')->with('error','Invalid credentials !!');
        }
    }

    public function company_logout(){
        Auth::guard('company')->logout();
        return redirect()->route('login');
    }

    public function candidate_login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(Auth::guard('candidate')->attempt($credentials)){
            return redirect()->route('candidate_dashboard');
        }else{
            return redirect()->route('login')->with('error','Invalid credentials !!');
        }
    }

    public function candidate_logout(){
        Auth::guard('candidate')->logout();
        return redirect()->route('login');
    }
}


