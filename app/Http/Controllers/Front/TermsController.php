<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageTermItem;

class TermsController extends Controller
{
    public function index(){
        $term = PageTermItem::where('id',1)->first();
        return view('front.terms',compact('term'));
    }
}
