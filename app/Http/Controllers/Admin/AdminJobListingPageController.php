<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageJobListingItem;

class AdminJobListingPageController extends Controller
{
    public function index(){
        $page_job_listing_data = PageJobListingItem::where('id',1)->first();
        return view('admin.page_job_listing',compact('page_job_listing_data'));
    }

    public function update(Request $request){
        $page_job_listing_data = PageJobListingItem::where('id',1)->first();

        $request->validate([
            'heading' => 'required',
        ]);

        $page_job_listing_data->heading =  $request->heading;
        $page_job_listing_data->title =  $request->title;
        $page_job_listing_data->meta_description =  $request->meta_description;
        $page_job_listing_data->update();       

        return redirect()->back()->with('success','Data is updated successfully');
    }
}
