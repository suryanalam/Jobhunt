<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Hash;

use App\Models\Job;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateSkill;
use App\Models\CandidateExperience;
use App\Models\CandidateAward;
use App\Models\CandidateResume;
use App\Models\CandidateBookmark;
use App\Models\CandidateApplication;

class CandidateController extends Controller
{
    public function dashboard(){

        $bookmarked_jobs_count = CandidateBookmark::where('candidate_id',Auth::guard('candidate')->user()->id)->count();
        $applied_jobs_count = CandidateApplication::where('candidate_id',Auth::guard('candidate')->user()->id)->count();
        $approved_jobs_count =  CandidateApplication::where('candidate_id',Auth::guard('candidate')->user()->id)->where('status',"Approved")->count();
        $rejected_jobs_count =  CandidateApplication::where('candidate_id',Auth::guard('candidate')->user()->id)->where('status',"Rejected")->count();

        $recently_applied_jobs = CandidateApplication::where('candidate_id',Auth::guard('candidate')->user()->id)->take(3)->get();
        return view('candidate.dashboard',compact('recently_applied_jobs','bookmarked_jobs_count','applied_jobs_count','rejected_jobs_count','approved_jobs_count'));
    }

    public function education(){
        $educations = CandidateEducation::where('candidate_id',Auth::guard('candidate')->user()->id)->orderBy('id','desc')->get();
        return view('candidate.education',compact('educations'));
    }

    public function education_create(){
        return view('candidate.education_create');
    }

    public function education_store(Request $request){

        $request->validate([
            'level'=>'required',
            'institute'=>'required',
            'degree'=>'required',
            'passing_year'=>'required',
        ]);

        $obj = new CandidateEducation();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;   
        $obj->level = $request->level;        
        $obj->institute = $request->institute;
        $obj->degree = $request->degree;
        $obj->passing_year = $request->passing_year;
        $obj->save();

        return redirect()->back()->with('success','Education is added successfully');

    }

    public function education_edit($id){
        $education = CandidateEducation::where('id',$id)->first();
        return view('candidate.education_edit', compact('education'));
    }

    public function education_update(Request $request){
        $obj = CandidateEducation::where('id',$request->id)->first(); 

        $request->validate([
            'level'=>'required',
            'institute'=>'required',
            'degree'=>'required',
            'passing_year'=>'required',
        ]);

        $obj->level = $request->level;        
        $obj->institute = $request->institute;
        $obj->degree = $request->degree;
        $obj->passing_year = $request->passing_year;
        $obj->update();

        return redirect()->route('candidate_education')->with('success','Education is updated successfully');
    }

    public function education_delete($id){
        CandidateEducation::where('id',$id)->delete();
        return redirect()->back()->with('success','Education is deleted succesfully');
    }

    public function skill(){
        $skills = CandidateSkill::where('candidate_id',Auth::guard('candidate')->user()->id)->get();
        return view('candidate.skill',compact('skills'));
    }

    public function skill_create(){
        return view('candidate.skill_create');
    }

    public function skill_store(Request $request){
        $request->validate([
            'name' => 'required',
            'percentage' => 'required',
        ]);

        $obj = new CandidateSkill();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->name = $request->name;
        $obj->percentage = $request->percentage;
        $obj->save();

        return redirect()->back()->with('success','Skill is added successfully');
    }

    public function skill_edit($id){
        $skill = CandidateSkill::where('id',$id)->first();
        return view('candidate.skill_edit',compact('skill'));
    }

    public function skill_update(Request $request){
        $obj = CandidateSkill::where('id',$request->id)->first();

        $request->validate([
            'name' => 'required',
            'percentage' => 'required',
        ]);

        $obj->name = $request->name;
        $obj->percentage = $request->percentage;
        $obj->update();

        return redirect()->route('candidate_skill')->with('success','Skill is updated successfully');
    }

    public function skill_delete($id){
        CandidateSkill::where('id',$id)->delete();
        return redirect()->back()->with('success','Skill is deleted successfully');
    }

    public function experience(){
        $experiences = CandidateExperience::where('candidate_id',Auth::guard('candidate')->user()->id)->orderBy('id','desc')->get();
        return view('candidate.experience',compact('experiences'));
    }

    public function experience_create(){
        return view('candidate.experience_create');
    }

    public function experience_store(Request $request){
        $request->validate([
            'company' => 'required',
            'designation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $obj = new CandidateExperience();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->company = $request->company;
        $obj->designation = $request->designation;
        $obj->start_date = $request->start_date;
        $obj->end_date = $request->end_date;
        $obj->save();

        return redirect()->back()->with('success','Experience is added successfully');
    }

    public function experience_edit($id){
        $experience = CandidateExperience::where('id',$id)->first();
        return view('candidate.experience_edit',compact('experience'));
    }

    public function experience_update(Request $request){
        $obj = CandidateExperience::where('id',$request->id)->first();

        $request->validate([
            'company' => 'required',
            'designation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $obj->company = $request->company;
        $obj->designation = $request->designation;
        $obj->start_date = $request->start_date;
        $obj->end_date = $request->end_date;
        $obj->update();

        return redirect()->route('candidate_experience')->with('success','Experience is updated successfully');
    }

    public function experience_delete($id){
        CandidateExperience::where('id',$id)->delete();
        return redirect()->back()->with('success','Experience is deleted successfully');
    }

    public function award(){
        $awards = CandidateAward::where('candidate_id',Auth::guard('candidate')->user()->id)->orderBy('id','desc')->get();
        return view('candidate.award',compact('awards'));
    }

    public function award_create(){
        return view('candidate.award_create');
    }

    public function award_store(Request $request){

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'date'=>'required',
        ]);

        $obj = new CandidateAward();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;   
        $obj->title = $request->title;        
        $obj->description = $request->description;
        $obj->date = $request->date;
        $obj->save();

        return redirect()->back()->with('success','Award is added successfully');
    }

    public function award_edit($id){
        $award = CandidateAward::where('id',$id)->first();
        return view('candidate.award_edit', compact('award'));
    }

    public function award_update(Request $request){
        $obj = CandidateAward::where('id',$request->id)->first();  

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'date'=>'required',
        ]);

        $obj->candidate_id = Auth::guard('candidate')->user()->id;   
        $obj->title = $request->title;        
        $obj->description = $request->description;
        $obj->date = $request->date;
        $obj->update();

        return redirect()->route('candidate_award')->with('success','Award is updated successfully');
    }

    public function award_delete($id){
        CandidateAward::where('id',$id)->delete();
        return redirect()->back()->with('success','Award is deleted succesfully');
    }

    public function resume(){
        $resumes = CandidateResume::where('candidate_id',Auth::guard('candidate')->user()->id)->orderBy('id','desc')->get();
        return view('candidate.resume',compact('resumes'));
    }

    public function resume_create(){
        return view('candidate.resume_create');
    }

    public function resume_store(Request $request){

        $request->validate([
            'name'=> 'required',
            'file' => 'required|mimes:pdf,doc,docx',
        ]);

        $ext = $request->file('file')->extension();
        $final_name = 'resume_'.time().'.'.$ext;

        $request->file('file')->move(public_path('uploads/'),$final_name);

        $obj = new CandidateResume();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;   
        $obj->name = $request->name; 
        $obj->file = $final_name;       
        $obj->save();

        return redirect()->back()->with('success','Resume is added successfully');
    }

    public function resume_edit($id){
        $resume = CandidateResume::where('id',$id)->first();
        return view('candidate.resume_edit', compact('resume'));
    }

    public function resume_update(Request $request){

        $request->validate([
            'name'=>'required',
        ]);

        $obj = CandidateResume::where('id',$request->id)->first();  

        if($request->hasFile('file')){
            $request->validate([
                'file'=>'required|mimes:pdf,doc,docx',
            ]);

            unlink(public_path('uploads/'.$obj->file));

            $ext = $request->file('file')->extension();
            $final_name = 'resume_'.time().'.'.$ext;

            $request->file('file')->move(public_path('uploads/'),$final_name);
            $obj->file = $final_name;
        }

        $obj->candidate_id = Auth::guard('candidate')->user()->id;   
        $obj->name = $request->name;        
        $obj->update();

        return redirect()->route('candidate_resume')->with('success','Resume is updated successfully');
    }

    public function resume_delete($id){
        $resume = CandidateResume::where('id',$id)->first();
        unlink(public_path("uploads/$resume->file"));
        $resume->delete();
        return redirect()->route('candidate_resume')->with('success','Resume is deleted succesfully');
    }

    public function profile_edit(){
        return view('candidate.profile_edit');
    }

    public function profile_update(Request $request){

        $obj = Candidate::where('id',Auth::guard('candidate')->user()->id)->first();
        
        $request->validate([
            'name'=>'required',
            'username'=>["required",'alpha_dash',Rule::unique('candidates')->ignore($obj->id)],
            'email'=>['required','email',Rule::unique('candidates')->ignore($obj->id)],
        ]);

        if($request->hasFile('photo')){
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,gif,png',
            ]);

            if(Auth::guard('candidate')->user()->photo != "" || Auth::guard('candidate')->user()->photo != null ){
                unlink(public_path('uploads/'.$obj->photo));
            }

            $ext = $request->file('photo')->extension();
            $final_name = 'candidate_photo_'.time().'.'.$ext;

            $request->file('photo')->move(public_path('uploads/'),$final_name);
            $obj->photo = $final_name;
        }
        
        $obj->name = $request->name;
        $obj->designation = $request->designation;
        $obj->username = $request->username;    
        $obj->email = $request->email;
        $obj->phone = $request->phone;
        $obj->biography = $request->biography;
        $obj->address = $request->address;
        $obj->country = $request->country;
        $obj->state = $request->state;
        $obj->city = $request->city;
        $obj->zip_code = $request->zip_code;
        $obj->gender = $request->gender;
        $obj->marital_status = $request->marital_status;
        $obj->date_of_birth = $request->date_of_birth;
        $obj->website = $request->website;

        $obj->update();

        return redirect()->back()->with('success','profile updated successfully');
    }

    public function change_password(){
        return view('candidate.change_password');
    }

    public function change_password_update(Request $request){
        $obj = Candidate::where('id',Auth::guard('candidate')->user()->id)->first();
        
        $request->validate([
            'password'=>'required',
            'confirm_password'=>'required|same:password',
        ]);
        
        $obj->password = Hash::make($request->password);
        $obj->update();

        return redirect()->back()->with('success','password updated successfully');
    }

    public function bookmarked_jobs(){
        $bookmarked_jobs = CandidateBookmark::where('candidate_id',Auth::guard('candidate')->user()->id)->get();
        return view('candidate.bookmark',compact('bookmarked_jobs'));
    }

    public function bookmark_add($id){

        $existed_bookmark = CandidateBookmark::where('candidate_id',Auth::guard('candidate')->user()->id)->where('job_id',$id)->count();

        if($existed_bookmark){
            return redirect()->back()->with('error','Job is already Bookmarked !!');
        }

        $obj = new CandidateBookmark();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->job_id = $id;
        $obj->save();
        return redirect()->back()->with('success','Bookmarked the job successfully !!');
    }

    public function bookmark_delete($id){
        CandidateBookmark::where('id',$id)->delete();
        return redirect()->back()->with('success','Bookmarked is removed for the job !!');
    }

    public function job_apply($id){

        $existed_application = CandidateApplication::where('candidate_id',Auth::guard('candidate')->user()->id)->where('job_id',$id)->count();

        if($existed_application){
            return redirect()->back()->with('error','You have already applied for the job !!');
        }

        $job = Job::select('id','title')->where('id',$id)->first();
        return view('candidate.job_apply',compact('job'));
    }

    public function job_apply_submit(Request $request){

        $request->validate([
            'job_id' => 'required',
            'cover_letter' => 'required',
        ]);

        $obj = new CandidateApplication();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->job_id = $request->job_id;
        $obj->cover_letter = $request->cover_letter;
        $obj->status = "Applied";
        $obj->save();

        // CandidateBookmark::where('candidate_id', Auth::guard('candidate')->user()->id)->where('job_id',$request->job_id)->delete();

        return redirect()->route('job_listing')->with('success','Your Application is sent succesfully !!');
    }

    public function applied_jobs(){
        $applied_jobs = CandidateApplication::where('candidate_id',Auth::guard('candidate')->user()->id)->get();
        return view('candidate.applied_jobs',compact('applied_jobs'));
    }

}
