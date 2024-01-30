<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageHomeItem;
use App\Models\JobCategory;
use App\Models\WhyChooseItem;
use App\Models\Testimonial;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(){
        $page_home_data = PageHomeItem::where('id',1)->first();
        $job_categories = JobCategory::orderBy('name','asc')->take(9)->get();
        $why_choose_items = WhyChooseItem::get();
        $testimonials = Testimonial::get();
        $posts = Post::orderBy('id','desc')->take(3)->get();
        return view('front.home',compact('page_home_data','job_categories','why_choose_items','testimonials','posts'));
    }
}
