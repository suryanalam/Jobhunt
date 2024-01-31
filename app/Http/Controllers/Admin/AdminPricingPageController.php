<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagePricingItem;

class AdminPricingPageController extends Controller
{
    public function index(){
        $page_pricing_data = PagePricingItem::where('id',1)->first();
        return view('admin.page_pricing',compact('page_pricing_data'));
    }

    public function update(Request $request){
        $page_pricing_data = PagePricingItem::where('id',1)->first();

        $request->validate([
            'heading' => 'required',
        ]);

        $page_pricing_data->heading =  $request->heading;
        $page_pricing_data->title =  $request->title;
        $page_pricing_data->meta_description =  $request->meta_description;
        $page_pricing_data->update();       

        return redirect()->back()->with('success','Data is updated successfully');
    }
}
