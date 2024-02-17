<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageAuthItem;

class AdminAuthPageController extends Controller
{
    public function index(){
        $page_auth_data = PageAuthItem::where('id',1)->first();
        return view('admin.page_auth',compact('page_auth_data'));
    }

    public function update(Request $request){
        $page_auth_data = PageAuthItem::where('id',1)->first();

        $request->validate([
            'login_page_heading' => 'required',
            'signup_page_heading' => 'required',
            'forget_password_page_heading' => 'required',
        ]);

        $page_auth_data->login_page_heading =  $request->login_page_heading;
        $page_auth_data->login_page_title =  $request->login_page_title;
        $page_auth_data->login_page_meta_description =  $request->login_page_meta_description;
        $page_auth_data->signup_page_heading =  $request->signup_page_heading;
        $page_auth_data->signup_page_title =  $request->signup_page_title;
        $page_auth_data->signup_page_meta_description =  $request->signup_page_meta_description;
        $page_auth_data->forget_password_page_heading =  $request->forget_password_page_heading;
        $page_auth_data->forget_password_page_title =  $request->forget_password_page_title;
        $page_auth_data->forget_password_page_meta_description =  $request->forget_password_page_meta_description;

        $page_auth_data->update();       

        return redirect()->back()->with('success','Data is updated successfully');
    }
}
