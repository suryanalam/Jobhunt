<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\PageFaqItem;

class FaqController extends Controller
{
    public function index(){
        $faq_page_item = PageFaqItem::where('id',1)->first();
        $faqs = Faq::get();
        return view('front.faq',compact('faqs','faq_page_item'));
    }
}
