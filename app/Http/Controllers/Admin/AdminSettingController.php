<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    public function index(){
        $settings_data = Setting::where('id',1)->first();
        return view('admin.setting',compact('settings_data'));
    }

    public function update(Request $request){
        $settings_data = Setting::where('id',1)->first();

        $request->validate([
            'footer_phone' => 'required',
            'footer_email' => 'required',
            'footer_address' => 'required',
            'footer_copyright_text' => 'required',
        ]);

        if($request->hasFile('logo')){

            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png',
            ]);

            unlink(public_path('uploads/'.$settings_data->logo));
            $ext = $request->file('logo')->extension();
            $final_name = 'logo_'.time().'.'.$ext;
            
            $request->file('logo')->move(public_path('uploads/'),$final_name);
            $settings_data->logo =  $final_name;
        }

        if($request->hasFile('favicon')){
            $request->validate([
                'favicon' => 'image|mimes:jpg,jpeg,png,ico',
            ]);

            unlink(public_path('uploads/'. $settings_data->favicon));
            $ext = $request->file('favicon')->extension();
            $final_name = 'favicon_'.time().'.'.$ext;

            $request->file('favicon')->move(public_path('uploads/'),$final_name);
            $settings_data->favicon = $final_name;
        }

        $settings_data->top_bar_phone =  $request->top_bar_phone;
        $settings_data->top_bar_email =  $request->top_bar_email;
        $settings_data->footer_phone =  $request->footer_phone;
        $settings_data->footer_email =  $request->footer_email;
        $settings_data->footer_address =  $request->footer_address;
        $settings_data->footer_facebook =  $request->footer_facebook;
        $settings_data->footer_instagram =  $request->footer_instagram;
        $settings_data->footer_twitter =  $request->footer_twitter;
        $settings_data->footer_linkedin =  $request->footer_linkedin;
        $settings_data->footer_copyright_text =  $request->footer_copyright_text;
        $settings_data->update();       

        return redirect()->back()->with('success','Data is updated successfully');
    }
}
