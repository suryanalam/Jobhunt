<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagePrivacyItem;

class AdminPrivacyPageController extends Controller
{
    public function index(){
        $page_privacy_data = PagePrivacyItem::where('id',1)->first();
        return view('admin.page_privacy',compact('page_privacy_data'));
    }

    public function update(Request $request){
        $page_privacy_data = PagePrivacyItem::where('id',1)->first();

        $request->validate([
            'heading' => 'required',
            'content' => 'required',
        ]);

        $page_privacy_data->heading =  $request->heading;
        $page_privacy_data->content =  $request->content;
        $page_privacy_data->title =  $request->title;
        $page_privacy_data->meta_description =  $request->meta_description;
        $page_privacy_data->update();       

        return redirect()->back()->with('success','Data is updated successfully');
    }
}
