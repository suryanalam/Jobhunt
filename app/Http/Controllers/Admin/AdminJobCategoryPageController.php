<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageJobCategoryItem;

class AdminJobCategoryPageController extends Controller
{
    public function index(){
        $page_job_category_data = PageJobCategoryItem::where('id',1)->first();
        return view('admin.page_job_category',compact('page_job_category_data'));
    }

    public function update(Request $request){
        $page_job_category_data = PageJobCategoryItem::where('id',1)->first();

        $request->validate([
            'heading' => 'required',
        ]);

        $page_job_category_data->heading =  $request->heading;
        $page_job_category_data->title =  $request->title;
        $page_job_category_data->meta_description =  $request->meta_description;
        $page_job_category_data->update();       

        return redirect()->back()->with('success','Data is updated successfully');
    }
}
