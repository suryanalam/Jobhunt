<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\Company;
use App\Models\Job;

use App\Models\CompanyIndustry;
use App\Models\CompanyLocation;
use App\Models\CompanyPhoto;
use App\Models\CompanyVideo;
use App\Models\CompanySize;

class CompanyListingController extends Controller
{
    public function index(Request $request){
        $companies = Company::withCount('rJob')->orderBy('r_job_count',"desc");
        
        $company_industries = CompanyIndustry::orderBy('name','asc')->get();
        $company_locations = CompanyLocation::orderBy('name','asc')->get();   
        $company_sizes = CompanySize::get();

        $search_name = $request->name;
        $search_industry = $request->industry;
        $search_location = $request->location;
        $search_size = $request->size;
        $search_founded = $request->founded;

        if( $request->name != null && $request->name != ""){
             $companies = $companies->where('company_name','LIKE','%'.$request->name.'%');
        }

        if( $request->industry != null && $request->industry != ""){
             $companies = $companies->where('company_industry_id',$request->industry);
        }

        if( $request->location != null && $request->location != ""){
             $companies = $companies->where('company_location_id',$request->location);
        }

        if( $request->size != null && $request->size != ""){
            $companies = $companies->where('company_size_id',$request->size);
        }

        if( $request->founded != null && $request->founded != ""){
            $companies = $companies->where('founded_on',$request->founded);
        }

        $companies = $companies->paginate(5);

        return view('front.company_listing',compact("company_industries","company_locations","company_sizes",
            "companies","search_name","search_industry","search_location","search_size","search_founded")
        ); 
   }

   public function detail($id){
        $company = Company::withCount('rJob')->where('id',$id)->first(); 
        $company_jobs = Job::where('company_id',$id)->take(2)->get();
        return view('front.company_detail',compact('company','company_jobs'));
   }

   public function company_enquery(Request $request){
     $request->validate([
          'visitor_name'=>'required',
          'visitor_email'=>'required',
          'visitor_phone'=>'required',
          'visitor_message'=>'required',
     ]);

     $subject = "Company Enquery";
     $message = "Visitor Name: $request->visitor_name <br> Visitor Email: $request->visitor_email 
     <br> Visitor Phone: $request->visitor_phone <br> Visitor Message: $request->visitor_message";

     \Mail::to("$request->company_email")->send(new Websitemail($subject,$message));
     
     return redirect()->back()->with('success','Enquiry is sent successfully !! We will contact you soon.');
   }
}
