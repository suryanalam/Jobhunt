<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageBlogItem;

class AdminBlogPageController extends Controller
{
    public function index(){
        $page_blog_data = PageBlogItem::where('id',1)->first();
        return view('admin.page_blog',compact('page_blog_data'));
    }

    public function update(Request $request){
        $page_blog_data = PageBlogItem::where('id',1)->first();

        $request->validate([
            'heading' => 'required',
        ]);

        $page_blog_data->heading =  $request->heading;
        $page_blog_data->title =  $request->title;
        $page_blog_data->meta_description =  $request->meta_description;
        $page_blog_data->update();       

        return redirect()->back()->with('success','Data is updated successfully');
    }
}
