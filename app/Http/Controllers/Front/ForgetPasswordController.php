<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageOtherItem;

class ForgetPasswordController extends Controller
{
    public function index(){
        $other_page_item = PageOtherItem::where('id',1)->first();
        return view('front.forget_password',compact('other_page_item'));
    }
}
