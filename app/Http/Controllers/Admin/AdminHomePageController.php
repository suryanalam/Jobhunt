<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageHomeItem;

class AdminHomePageController extends Controller
{
    public function index(){
        $page_home_data = PageHomeItem::where('id',1)->first();
        return view('admin.page_home',compact('page_home_data'));
    }

    public function update(Request $request){
        $page_home_data = PageHomeItem::where('id',1)->first();

        $request->validate([
            'heading' => 'required',
            'job_title' => 'required',
            'job_location' => 'required',
            'job_category' => 'required',
            'search' => 'required',
            'job_category_heading' => 'required',
            'job_category_status' =>  'required',
            'why_choose_heading' => 'required',
            'why_choose_status' => 'required',
            'featured_jobs_heading' => 'required',
            'featured_jobs_status' => 'required',
            'testimonial_heading' => 'required',
            'testimonial_status' => 'required',
            'blog_heading' => 'required',
            'blog_status' => 'required',
        ]);

        if($request->hasFile('background')){
            $request->validate([
                'background' => 'image|mimes:jpg,jpeg,gif,png',
            ]);

            unlink(public_path('uploads/'.$page_home_data->background));
            $ext = $request->file('background')->extension();
            $final_name = 'banner_home'.'.'.$ext;

            $request->file('background')->move(public_path('uploads/'),$final_name);
            $page_home_data->background = $final_name;
        }

        if($request->hasFile('why_choose_background')){
            $request->validate([
                'why_choose_background' => 'image|mimes:jpg,jpeg,gif,png',
            ]);

            unlink(public_path('uploads/'.$page_home_data->why_choose_background));
            $ext1 = $request->file('why_choose_background')->extension();
            $final_name1 = 'why_choose_home_background'.'.'.$ext1;

            $request->file('why_choose_background')->move(public_path('uploads/'),$final_name1);
            $page_home_data->why_choose_background = $final_name1;
        }

        if($request->hasFile('testimonial_background')){
            $request->validate([
                'testimonial_background' => 'image|mimes:jpg,jpeg,gif,png',
            ]);

            unlink(public_path('uploads/'.$page_home_data->testimonial_background));
            $ext1 = $request->file('testimonial_background')->extension();
            $final_name1 = 'testmonial_home_background'.'.'.$ext1;

            $request->file('testimonial_background')->move(public_path('uploads/'),$final_name1);
            $page_home_data->testimonial_background = $final_name1;
        }

        $page_home_data->heading =  $request->heading;      
        $page_home_data->text =  $request->text;      
        $page_home_data->job_title =  $request->job_title;
        $page_home_data->job_location =  $request->job_location;
        $page_home_data->job_category =  $request->job_category;
        $page_home_data->search =  $request->search;
        $page_home_data->job_category_heading =  $request->job_category_heading;
        $page_home_data->job_category_subheading =  $request->job_category_subheading;
        $page_home_data->job_category_status =  $request->job_category_status;
        $page_home_data->why_choose_heading =  $request->why_choose_heading;
        $page_home_data->why_choose_subheading =  $request->why_choose_subheading;
        $page_home_data->why_choose_status =  $request->why_choose_status;
        $page_home_data->featured_jobs_heading =  $request->featured_jobs_heading;
        $page_home_data->featured_jobs_subheading =  $request->featured_jobs_subheading;
        $page_home_data->featured_jobs_status =  $request->featured_jobs_status;
        $page_home_data->testimonial_heading =  $request->testimonial_heading;
        $page_home_data->testimonial_status =  $request->testimonial_status;
        $page_home_data->blog_heading =  $request->blog_heading;
        $page_home_data->blog_subheading =  $request->blog_subheading;
        $page_home_data->blog_status =  $request->blog_status;
        $page_home_data->title =  $request->title;
        $page_home_data->meta_description =  $request->meta_description;
        $page_home_data->update();       

        return redirect()->back()->with('success','Data is updated successfully');
    }
}
