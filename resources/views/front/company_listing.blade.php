@extends('front.layout.app')

@section('seo-title',"$page_company_listing_item->title")
@section('seo-meta-description',"$page_company_listing_item->meta_description")

@section('main_content')

    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $page_company_listing_item->heading }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="job-result">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="job-filter">
                        <form action="{{ route('company_listing') }}" method="get">

                            <div class="widget">
                                <h2>Company Name</h2>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Search Company Name ..." />
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget">
                                <h2>Company Industry</h2>
                                <select name="industry" class="form-control select2">
                                    <option value="">Company Industry</option>
                                    @foreach ($company_industries as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $search_industry == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget">
                                <h2>Company Location</h2>
                                <select name="location" class="form-control select2">
                                    <option value="">Company Location</option>
                                    @foreach ($company_locations as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $search_location == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget">
                                <h2>Company Size</h2>
                                <select name="size" class="form-control select2">
                                    <option value="">Company Size</option>
                                    @foreach ($company_sizes as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $search_size == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget">
                                <h2>Founded On</h2>
                                <select name="founded" class="form-control select2">
                                    <option value="">Founded On</option>
                                    @for ($i = 1900; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="clearfix"></div>
                            </div>

                            <div class="filter-button">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                            </div>

                        </form>

                        @if ($advertisement->company_listing_ad_status == 'Show')
                            <div class="advertisement">
                                @if ($advertisement->company_listing_ad_url != null && $advertisement->company_listing_ad_url != '')
                                    <a href="{{ $advertisement->company_listing_ad_url }}" target="_blank">
                                        <img src="{{ asset("uploads/$advertisement->company_listing_ad") }}"
                                            alt="company-listing-advertisement" />
                                    </a>
                                @else
                                    <img src="{{ asset("uploads/$advertisement->company_listing_ad") }}"
                                        alt="company-listing-advertisement" />
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="job">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="search-result-header">
                                        <i class="fas fa-search"></i> Search Result for Company Listing
                                    </div>
                                </div>
                                @foreach ($companies as $item)
                                    @php 
                                        $order_data = $item->rOrder;
                                        $order_data = $order_data->where('currently_active',1)->first();
                                        if(!$order_data || date('Y-m-d') > $order_data->expire_date ){
                                            continue; 
                                        }   
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="item d-flex justify-content-start">
                                            <div class="logo">
                                                <img src="{{ asset("uploads/$item->logo") }}" alt="" />
                                            </div>
                                            <div class="text">
                                                <h3>
                                                    <a
                                                        href="{{ route('company_detail', $item->id) }}">{{ $item->company_name }}</a>
                                                </h3>
                                                <div class="detail-1 d-flex justify-content-start">
                                                    <div class="category">{{ $item->rCompanyIndustry->name }}</div>
                                                    <div class="location">{{ $item->rCompanyLocation->name }}</div>
                                                </div>
                                                <div class="detail-2 d-flex justify-content-start">
                                                    {!! $item->description !!}
                                                </div>
                                                <div class="open-position">
                                                    <span class="badge bg-primary">({{ $item->r_job_count }}) Open
                                                        Positions</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    {{ $companies->appends($_GET)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
