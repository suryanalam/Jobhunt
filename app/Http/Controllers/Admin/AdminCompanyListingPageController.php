<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageCompanyListingItem;

class AdminCompanyListingPageController extends Controller
{
    public function index(){
        $page_company_listing_data = PageCompanyListingItem::where('id',1)->first();
        return view('admin.page_company_listing',compact('page_company_listing_data'));
    }

    public function update(Request $request){
        $page_company_listing_data = PageCompanyListingItem::where('id',1)->first();

        $request->validate([
            'heading' => 'required',
        ]);

        $page_company_listing_data->heading =  $request->heading;
        $page_company_listing_data->title =  $request->title;
        $page_company_listing_data->meta_description =  $request->meta_description;
        $page_company_listing_data->update();       

        return redirect()->back()->with('success','Data is updated successfully');
    }
}
