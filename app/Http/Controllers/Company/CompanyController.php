<?php

namespace App\Http\Controllers\company;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Hash;

use App\Models\CompanyLocation;
use App\Models\CompanyIndustry;
use App\Models\CompanySize;
use App\Models\CompanyPhoto;
use App\Models\CompanyVideo;

use App\Models\JobCategory;
use App\Models\JobExperience;
use App\Models\JobGender;
use App\Models\JobLocation;
use App\Models\JobSalaryRange;
use App\Models\JobType;

use App\Models\Candidate;
use App\Models\CandidateSkill;
use App\Models\CandidateAward;
use App\Models\CandidateResume;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateApplication;

use App\Models\Company;
use App\Models\Package;
use App\Models\Order;
use App\Models\Job;

class CompanyController extends Controller
{
    public function dashboard(){     
        $recent_jobs = Job::where('company_id',Auth::guard('company')->user()->id)->orderBy('id','desc')->take(2)->get();

        $open_jobs_count = Job::where('company_id',Auth::guard('company')->user()->id)->count(); 
        $featured_jobs_count = Job::where('company_id',Auth::guard('company')->user()->id)->where('is_featured',1)->count();

        return view('company.dashboard',compact('recent_jobs','open_jobs_count','featured_jobs_count'));
    }

    public function make_payment(){
        $current_plan = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        $packages = Package::get(); 
        return view('company.make_payment', compact('current_plan','packages'));
    }

    public function paypal(Request $request){

        $single_package_data = Package::where('id',$request->package_id)->first();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('company_paypal_success'),
                "cancel_url" => route('company_paypal_cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $single_package_data->package_price
                    ]
                ]
            ]
        ]);

        //dd($response);

        if(isset($response['id']) && $response['id']!=null) {
            foreach($response['links'] as $link) {
                if($link['rel'] === 'approve') {

                    session()->put('package_id',$single_package_data->id);
                    session()->put('package_price',$single_package_data->package_price);
                    session()->put('package_days',$single_package_data->package_days);

                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('company_paypal_cancel');
        }
    }

    public function paypal_success(Request $request){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        //dd($response);

        if(isset($response['status']) && $response['status'] == 'COMPLETED') {

            $days = session('package_days');

            $data['currently_active'] = 0;
            Order::where('company_id',Auth::guard()->user()->id)->update($data);

            //save order data into orders table in databse:
            $obj = new Order();
            $obj->company_id = Auth::guard()->user()->id;
            $obj->package_id = session('package_id');
            $obj->order_no = time();
            $obj->paid_amount = session('package_price');
            $obj->payment_method = 'PayPal';
            $obj->start_date = date('Y-m-d');
            $obj->expire_date = date('Y-m-d',strtotime("+$days days"));
            $obj->currently_active = 1;
            $obj->save();

            session()->forget('package_id');
            session()->forget('package_price');
            session()->forget('package_days');

            return redirect()->route('company_make_payment')->with('success', "Payment is successful!");
        } else {
            return redirect()->route('company_paypal_cancel');
        }
    }

    public function paypal_cancel(){
        return redirect()->route('company_make_payment')->with('error', "Payment is cancelled!");
    }

    public function stripe(Request $request){

        $single_package_data = Package::where('id',$request->package_id)->first();

        // dd($single_package_data->id);

        \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));
        $response = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $single_package_data->package_name
                        ],
                        'unit_amount' => $single_package_data->package_price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('company_stripe_success'),
            'cancel_url' => route('company_stripe_cancel'),
        ]);

        session()->put('package_id',$single_package_data->id);
        session()->put('package_price',$single_package_data->package_price);
        session()->put('package_days',$single_package_data->package_days);

        return redirect()->away($response->url);
        
    }

    public function stripe_success(){

        $days = session('package_days');

        $data['currently_active'] = 0;
        Order::where('company_id',Auth::guard()->user()->id)->update($data);

        //save order data into orders table in databse:
        $obj = new Order();
        $obj->company_id = Auth::guard()->user()->id;
        $obj->package_id = session('package_id');
        $obj->order_no = time();
        $obj->paid_amount = session('package_price');
        $obj->payment_method = 'Stripe';
        $obj->start_date = date('Y-m-d');
        $obj->expire_date = date('Y-m-d',strtotime("+$days days"));
        $obj->currently_active = 1;
        $obj->save();

        session()->forget('package_id');
        session()->forget('package_price');
        session()->forget('package_days');

        return redirect()->route('company_make_payment')->with('success', "Payment is successful!");
    }

    public function stripe_cancel(){
        return redirect()->route('company_make_payment')->with('error', "Payment is cancelled!");
    }

    public function job(){
        $jobs = Job::where('company_id',Auth::guard('company')->user()->id)->orderBy('id','desc')->get();
        return view('company.job',compact('jobs'));
    }

    public function job_create(){

        // check company have any current plan to post jobs:
        $order = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();

        if(!$order){
            return redirect()->back()->with('error','Buy a package to post jobs');
        }

        $package = Package::find($order->package_id);
        
        $no_of_jobs_posted = Job::where('company_id',Auth::guard('company')->user()->id)->count();
        $no_of_featured_jobs_posted = Job::where('company_id',Auth::guard('company')->user()->id)->where('is_featured',1)->count();

        // Check the job posting limit for the current plan except **gold** package
        if($package->package_name != "Gold"){
            if($no_of_jobs_posted >= $package->total_allowed_jobs){
                return redirect()->back()->with('error','Upgrade the current package to post more jobs');
            }
        }

        $job_categories = JobCategory::orderBy('name','asc')->get();
        $job_experiences = JobExperience:: get();
        $job_genders = JobGender::get();
        $job_locations = JobLocation::orderBy('name','asc')->get();       
        $job_salary_ranges = JobSalaryRange::get();
        $job_types = JobType::orderBy('name','asc')->get();
        return view('company.job_create',compact('job_categories','job_experiences','job_genders','job_locations','job_salary_ranges','job_types'));
    }

    public function job_store(Request $request){

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'deadline'=>'required',
            'vacancy'=>'required',
            'job_category_id'=>'required',
            'job_location_id'=>'required',
            'job_type_id'=>'required',
            'job_experience_id'=>'required',
            'job_gender_id'=>'required',
            'job_salary_range_id'=>'required',
        ]);

        $order = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        $package = Package::find($order->package_id);
        $no_of_featured_jobs_posted = Job::where('company_id',Auth::guard('company')->user()->id)->where('is_featured',1)->count();

        // Check for the limit of featured jobs for the current plan
        if($request->is_featured == 1){
            if($no_of_featured_jobs_posted >= $package->total_allowed_featured_jobs){
                return redirect()->back()->with('error','Upgrade the current package to add featured option for more jobs');
            }
        }

        $obj = new Job();
        $obj->company_id = Auth::guard('company')->user()->id;   
        $obj->title = $request->title;        
        $obj->description = $request->description;
        $obj->responsibility = $request->responsibility;
        $obj->skill = $request->skill;
        $obj->education = $request->education;
        $obj->benefit = $request->benefit;
        $obj->deadline = $request->deadline;
        $obj->vacancy = $request->vacancy;
        $obj->job_category_id = $request->job_category_id;
        $obj->job_location_id = $request->job_location_id;
        $obj->job_type_id = $request->job_type_id;
        $obj->job_experience_id = $request->job_experience_id;
        $obj->job_gender_id = $request->job_gender_id;
        $obj->job_salary_range_id = $request->job_salary_range_id;
        $obj->is_featured = $request->is_featured;
        $obj->is_urgent = $request->is_urgent;
        $obj->map_code = $request->map_code;
        $obj->save();

        return redirect()->back()->with('success','Job is added successfully');

    }

    public function job_edit($id){
        $job = Job::where('id',$id)->first();

        $job_categories = JobCategory::orderBy('name','asc')->get();
        $job_experiences = JobExperience:: get();
        $job_genders = JobGender::get();
        $job_locations = JobLocation::orderBy('name','asc')->get();       
        $job_salary_ranges = JobSalaryRange::get();
        $job_types = JobType::orderBy('name','asc')->get();

        return view('company.job_edit',compact('job','job_categories','job_experiences','job_genders','job_locations','job_salary_ranges','job_types'));
    }

    public function job_update(Request $request){
        $obj = Job::where('id',$request->id)->first();

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'deadline'=>'required',
            'vacancy'=>'required',
            'job_category_id'=>'required',
            'job_location_id'=>'required',
            'job_type_id'=>'required',
            'job_experience_id'=>'required',
            'job_gender_id'=>'required',
            'job_salary_range_id'=>'required',
        ]);

        $no_of_featured_jobs_posted = Job::where('company_id',Auth::guard('company')->user()->id)->where('is_featured',1)->count();
        $order = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        $package = Package::find($order->package_id);
     
        if( $obj->is_featured == 0 && $request->is_featured == 1){
            if($no_of_featured_jobs_posted >= $package->total_allowed_featured_jobs){
                return redirect()->back()->with('error','Upgrade the current package to add featured option for more jobs');
            }
        }

        $obj->company_id = Auth::guard('company')->user()->id;   
        $obj->title = $request->title;        
        $obj->description = $request->description;
        $obj->responsibility = $request->responsibility;
        $obj->skill = $request->skill;
        $obj->education = $request->education;
        $obj->benefit = $request->benefit;
        $obj->deadline = $request->deadline;
        $obj->vacancy = $request->vacancy;
        $obj->job_category_id = $request->job_category_id;
        $obj->job_location_id = $request->job_location_id;
        $obj->job_type_id = $request->job_type_id;
        $obj->job_experience_id = $request->job_experience_id;
        $obj->job_gender_id = $request->job_gender_id;
        $obj->job_salary_range_id = $request->job_salary_range_id;
        $obj->is_featured = $request->is_featured;
        $obj->is_urgent = $request->is_urgent;
        $obj->map_code = $request->map_code;
        $obj->update();

        return redirect()->route('company_job')->with('success','Job is updated succesfully');
    }

    public function job_delete($id){
        Job::where('id',$id)->delete();
        return redirect()->back()->with('success','Job is deleted succesfully');
    }

    public function orders(){
        $orders = Order::with('rPackage')->orderBy('id','desc')->where('company_id',Auth::guard('company')->user()->id)->get();
        // dd( $orders->rPackage);
        return view('company.orders',compact('orders'));
    }

    public function photos(){
        $order = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        
        if(!$order){
            return redirect()->back()->with('error','Buy a package to access the photo section');
        }

        $package = Package::find($order->package_id);

        if($package->total_allowed_photos == 0){
            return redirect()->back()->with('error','Upgrade the current package to access the photos section');
        }

        $photos = CompanyPhoto::where('company_id',Auth::guard('company')->user()->id)->get();
        return view('company.photos', compact('photos'));
    }

    public function photo_submit(Request $request){

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,gif,png',
        ]);

        $no_of_photos = CompanyPhoto::where('company_id',Auth::guard('company')->user()->id)->count();

        $order = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        
        if(!$order){
            return redirect()->back()->with('error','Buy a package to access the photo section');
        }

        $package = Package::find($order->package_id);

        if($no_of_photos >= $package->total_allowed_photos){
            return redirect()->back()->with('error','Upgrade the current package to add photos');
        }

        $ext = $request->file('photo')->extension();
        $final_name = 'company_photo_'.time().'.'.$ext;
        $request->file('photo')->move(public_path('uploads/'),$final_name);

        $obj = new CompanyPhoto();
        $obj->company_id = Auth::guard()->user()->id;
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success','photo added successfully');
    }

    public function photo_delete($id){
        $photo_single = CompanyPhoto::where('id',$id)->first();
        unlink(public_path('uploads/'.$photo_single->photo));
        CompanyPhoto::where('id',$id)->delete();
        return redirect()->back()->with('success','Photo deleted successfully');
    }

    public function videos(){
        $order = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        
        if(!$order){
            return redirect()->back()->with('error','Buy a package to access the video section');
        }

        $package = Package::find($order->package_id);

        if($package->total_allowed_videos == 0){
            return redirect()->back()->with('error','Upgrade the current package to access the videos section');
        }

        $videos = CompanyVideo::where('company_id',Auth::guard('company')->user()->id)->get();
        return view('company.videos', compact('videos'));
    }

    public function video_submit(Request $request){

        $request->validate([
            'video_id' => 'required',
        ]);
        
        $no_of_videos = CompanyVideo::where('company_id',Auth::guard('company')->user()->id)->count();

        $order = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        
        if(!$order){
            return redirect()->back()->with('error','Buy a package to access the video section');
        }

        $package = Package::find($order->package_id);

        if($no_of_videos >= $package->total_allowed_videos){
            return redirect()->back()->with('error','Upgrade the current package to add videos');
        }

        $obj = new CompanyVideo();
        $obj->company_id = Auth::guard()->user()->id;
        $obj->video_id = $request->video_id;
        $obj->save();

        return redirect()->back()->with('success','Video added successfully');
    }

    public function video_delete($id){
        CompanyVideo::where('id',$id)->delete();
        return redirect()->back()->with('success','Video deleted successfully');
    }

    public function candidate_application(){
        $jobs = Job::where('company_id',Auth::guard('company')->user()->id)->orderBy('id','desc')->get();
        return view('company.candidate_application',compact('jobs'));
    }

    public function job_applicants($id){
        $applicants = CandidateApplication::where('job_id',$id)->orderBy('id','desc')->get();
        $job_details = Job::select('title')->where('id',$id)->orderBy('id','desc')->first();
        return view('company.job_applicants',compact('applicants','job_details'));
    }

    public function applicant_details($id){
        $applicant_details = Candidate::where('id',$id)->orderBy('id','desc')->first();
        $applicant_educations = CandidateEducation::where('candidate_id',$applicant_details->id)->orderBy('id','desc')->get();
        $applicant_skills = CandidateSkill::where('candidate_id',$applicant_details->id)->orderBy('id','desc')->get();;
        $applicant_experiences = CandidateExperience::where('candidate_id',$applicant_details->id)->orderBy('id','desc')->get();;
        $applicant_awards = CandidateAward::where('candidate_id',$applicant_details->id)->orderBy('id','desc')->get();;
        $applicant_resumes = CandidateResume::where('candidate_id',$applicant_details->id)->orderBy('id','desc')->get();;

        return view('company.job_applicant_details',compact('applicant_details','applicant_educations',
            'applicant_skills', 'applicant_experiences','applicant_awards','applicant_resumes'));
    }

    public function applicant_status_update(Request $request){
        $request->validate([
            "status" => "required",
        ]);

        $application = CandidateApplication::where('candidate_id',$request->candidate_id)->where('job_id',$request->job_id)->first();
        $application->status = $request->status;
        $application->update();
        return redirect()->back()->with('success','Status updated successfully !!');
    }

    public function profile_edit(){
        $company_locations = CompanyLocation::orderBy('name','asc')->get();
        $company_industries = CompanyIndustry::orderBy('name','asc')->get();
        $company_sizes = CompanySize::get();

        return view('company.profile_edit', compact('company_locations','company_industries','company_sizes'));
    }

    public function profile_update(Request $request){

        $obj = Company::where('id',Auth::guard('company')->user()->id)->first();
        
        $request->validate([
            'company_name'=>'required',
            'person_name'=>'required',
            'username'=>["required",'alpha_dash',Rule::unique('companies')->ignore($obj->id)],
            'email'=>['required','email',Rule::unique('companies')->ignore($obj->id)],
        ]);

        if($request->hasFile('logo')){
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,gif,png',
            ]);

            if(Auth::guard('company')->user()->logo != "" ){
                unlink(public_path('uploads/'.$obj->logo));
            }

            $ext = $request->file('logo')->extension();
            $final_name = 'company_logo_'.time().'.'.$ext;

            $request->file('logo')->move(public_path('uploads/'),$final_name);
            $obj->logo = $final_name;
        }
        

        $obj->company_name = $request->company_name;
        $obj->person_name = $request->person_name;
        $obj->username = $request->username;
        $obj->email = $request->email;
        $obj->phone = $request->phone;
        $obj->address = $request->address;
        $obj->company_location_id = $request->company_location_id;
        $obj->company_industry_id = $request->company_industry_id;
        $obj->company_size_id = $request->company_size_id;
        $obj->founded_on = $request->founded_on;
        $obj->website = $request->website;
        $obj->description = $request->description;
        $obj->oh_mon = $request->oh_mon;
        $obj->oh_tue = $request->oh_tue;
        $obj->oh_wed = $request->oh_wed;
        $obj->oh_thu= $request->oh_thu;
        $obj->oh_fri = $request->oh_fri;
        $obj->oh_sat = $request->oh_sat;
        $obj->oh_sun = $request->oh_sun;
        $obj->map_code = $request->map_code;
        $obj->facebook = $request->facebook;
        $obj->twitter = $request->twitter;
        $obj->linkedin = $request->linkedin;
        $obj->instagram = $request->instagram;
        $obj->update();

        return redirect()->back()->with('success','profile updated successfully');
    }

    public function change_password(){
        return view('company.change_password');
    }

    public function change_password_update(Request $request){

        $obj = Company::where('id',Auth::guard('company')->user()->id)->first();
        
        $request->validate([
            'password'=>'required',
            'confirm_password'=>'required|same:password',
        ]);
        
        $obj->password = Hash::make($request->password);
        $obj->update();

        return redirect()->back()->with('success','password updated successfully');
    }

}
