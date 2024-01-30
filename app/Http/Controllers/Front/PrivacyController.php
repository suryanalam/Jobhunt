<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagePrivacyItem;

class PrivacyController extends Controller
{
    public function index(){
        $privacy = PagePrivacyItem::where('id',1)->first();
        return view('front.privacy',compact('privacy'));
    }
}
