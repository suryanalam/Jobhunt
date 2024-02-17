<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\PageJobListingItem;
use App\Models\Advertisement;
use App\Models\Job;
use App\Models\Order;

use App\Models\JobCategory;
use App\Models\JobExperience;
use App\Models\JobGender;
use App\Models\JobLocation;
use App\Models\JobSalaryRange;
use App\Models\JobType;

class JobListingController extends Controller
{
     
     public function index(Request $request){
          $jobs = Job::orderBy('id',"desc");
          
          $job_categories = JobCategory::orderBy('name','asc')->get();
          $job_experiences = JobExperience:: get();
          $job_genders = JobGender::get();
          $job_locations = JobLocation::orderBy('name','asc')->get();       
          $job_salary_ranges = JobSalaryRange::get();
          $job_types = JobType::orderBy('name','asc')->get();

          $search_title = $request->title;
          $search_category = $request->category;
          $search_location = $request->location;
          $search_experience = $request->experience;
          $search_type = $request->type;
          $search_gender = $request->gender;
          $search_salary_range = $request->salary_range;

          if( $request->title != null && $request->title != ""){
               $jobs = $jobs->where('title','LIKE','%'.$request->title.'%');
          }

          if( $request->category != null &&$request->category != ""){
               $jobs = $jobs->where('job_category_id',$request->category);
          }

          if( $request->location != null && $request->location != ""){
               $jobs = $jobs->where('job_location_id',$request->location);
          }

          if( $request->experience != null && $request->experience != ""){
               $jobs = $jobs->where('job_experience_id',$request->experience);
          }

          if( $request->type != null && $request->type != ""){
               $jobs = $jobs->where('job_type_id',$request->type);
          }

          if( $request->gender != null && $request->gender != ""){
               $jobs = $jobs->where('job_gender_id',$request->gender);
          }

          if( $request->salary_range != null && $request->salary_range != ""){
               $jobs = $jobs->where('job_salary_range_id',$request->salary_range);
          }

          // Extract only those jobs where company has the active plan to post jobs:
          // $filtered_jobs = $jobs->get()->filter(function ($job) {
          //      $company_plan_info = \App\Models\Order::where('company_id', $job->company_id)->where('currently_active', 1)->first();
          //      return date('Y-m-d') <= $company_plan_info->expire_date;
          // });

          // $jobs->setCollection($filtered_jobs);

          $jobs = $jobs->paginate(5);

          // dd($jobs);

          $advertisement = Advertisement::select('job_listing_ad','job_listing_ad_url','job_listing_ad_status')->where('id',2)->first();

          $page_job_listing_item = PageJobListingItem::where('id',1)->first();

          return view('front.job_listing',compact('jobs', 'job_categories', 'job_locations','job_experiences','job_types','job_genders','job_salary_ranges','advertisement',
               'search_title', 'search_category', 'search_location', 'search_experience', 'search_type', 'search_gender', 'search_salary_range','page_job_listing_item')
          ); 
     }

     public function detail($id){
          $job = Job::where('id',$id)->first();
          $similar_jobs = Job::orderBy('id',"desc")->whereNotIn('id',[$id])->where('job_category_id',$job->job_category_id)->take(2)->get();
          return view('front.job_detail',compact('job','similar_jobs'));
     }

     public function job_enquery(Request $request){
          $request->validate([
               'visitor_name'=>'required',
               'visitor_email'=>'required',
               'visitor_phone'=>'required',
               'visitor_message'=>'required',
          ]);

          $subject = "Job Enquery for $request->job_title";
          $message = "Visitor Name: $request->visitor_name <br> Visitor Email: $request->visitor_email 
          <br> Visitor Phone: $request->visitor_phone <br> Visitor Message: $request->visitor_message";
  
          \Mail::to("$request->company_email")->send(new Websitemail($subject,$message));
          
          return redirect()->back()->with('success','Enquiry is sent successfully !! We will contact you soon.');
     }
}
