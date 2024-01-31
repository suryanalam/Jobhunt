<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageOtherItem;

class SignupController extends Controller
{
    public function index(){
        $other_page_item = PageOtherItem::where('id',1)->first();
        return view('front.signup',compact('other_page_item'));
    }
}
