@extends('front.layout.app')

@section('seo-title', "$page_job_listing_item->title")
@section('seo-meta-description', "$page_job_listing_item->meta_description")

@section('main_content')

    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $page_job_listing_item->heading }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="job-result">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="job-filter">
                        <form action="{{ route('job_listing') }}" method="GET">
                            <div class="widget">
                                <h2>Job Title</h2>
                                <input type="text" name="title" class="form-control" placeholder="Search Titles ..."
                                    value="{{ old('title', $search_title) }}" />
                            </div>

                            <div class="widget">
                                <label for="" class="form-label">Category *</label>
                                <select name="category" class="form-control select2">
                                    <option value="">Category</option>
                                    @foreach ($job_categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $search_category == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <label for="" class="form-label">Location *</label>
                                <select name="location" class="form-control select2">
                                    <option value="">Location</option>
                                    @foreach ($job_locations as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $search_location == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <label for="" class="form-label">Job Type *</label>
                                <select name="type" class="form-control select2">
                                    <option value="">Job Type</option>
                                    @foreach ($job_types as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $search_type == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <label for="" class="form-label">Experience *</label>
                                <select name="experience" class="form-control select2">
                                    <option value="">Experience</option>
                                    @foreach ($job_experiences as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $search_experience == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <label for="" class="form-label">Gender *</label>
                                <select name="gender" class="form-control select2">
                                    <option value="">Gender</option>
                                    @foreach ($job_genders as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $search_gender == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <label for="" class="form-label">Salary Range *</label>
                                <select name="salary_range" class="form-control select2">
                                    <option value="">Salary Range</option>
                                    @foreach ($job_salary_ranges as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $search_salary_range == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="filter-button">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                            </div>
                        </form>

                        @if ($advertisement->job_listing_ad_status == 'Show')
                            <div class="advertisement">
                                @if ($advertisement->job_listing_ad_url != null && $advertisement->job_listing_ad_url != '')
                                    <a href="{{ $advertisement->job_listing_ad_url }}" target="_blank">
                                        <img src="{{ asset("uploads/$advertisement->job_listing_ad") }}"
                                            alt="job-listing-advertisement" />
                                    </a>
                                @else
                                    <img src="{{ asset("uploads/$advertisement->job_listing_ad") }}"
                                        alt="job-listing-advertisement" />
                                @endif
                            </div>
                        @endif

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="job">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="search-result-header">
                                        <i class="fas fa-search"></i> Search Result for Job Listing
                                    </div>
                                </div>

                                @if (!$jobs->count())
                                    <p class="text-danger">No Jobs Found</p>
                                @endif
                                @foreach ($jobs as $item) 

                                    @php 
                                        $order_data = $item->rCompany->rOrder;
                                        $order_data = $order_data->where('currently_active',1)->first();
                                        if(date('Y-m-d') > $order_data->expire_date){
                                            continue; 
                                        }   
                                    @endphp
                                
                                    <div class="col-md-12">
                                        <div class="item d-flex justify-content-start">
                                            <div class="logo">
                                                @if ($item->rCompany->logo == null || $item->rCompany->logo == '')
                                                    <img src="{{ asset('uploads/company_default_logo.png') }}"
                                                        alt="" class="logo" name="company-logo" />
                                                @else
                                                    <img src="{{ asset('uploads/' . $item->rCompany->logo) }}"
                                                        alt="" class="logo" name="company-logo" />
                                                @endif
                                            </div>
                                            <div class="text">
                                                <h3><a href="{{ route('job_detail', $item->id) }}">{{ $item->title }},
                                                        {{ $item->rCompany->company_name }}</a></h3>
                                                <div class="detail-1 d-flex justify-content-start">
                                                    <div class="category">{{ $item->rJobCategory->name }}</div>
                                                    <div class="location">{{ $item->rJobLocation->name }}</div>
                                                </div>
                                                <div class="detail-2 d-flex justify-content-start">
                                                    <div class="date">{{ $item->created_at->diffForHumans() }}</div>
                                                    <div class="budget">{{ $item->rJobSalaryRange->name }}</div>
                                                    {!! date('Y-m-d') > $item->deadline ? "<div class='expired'>Expired </div>" : null !!}
                                                </div>
                                                <div class="special d-flex justify-content-start">
                                                    <div class="type">{{ $item->rJobType->name }}</div>
                                                    {!! $item->is_featured == '1' ? "<div class='featured'>Featured</div>" : null !!}
                                                    {!! $item->is_urgent == '1' ? "<div class='urgent'>Urgent</div>" : null !!}
                                                </div>
                                                @if (Auth::guard('candidate')->check())
                                                    @php
                                                        $count = \App\Models\CandidateBookmark::where('candidate_id', Auth::guard('candidate')->user()->id)
                                                            ->where('job_id', $item->id)
                                                            ->count();
                                                        if ($count) {
                                                            $bookmark_status = 'active';
                                                        } else {
                                                            $bookmark_status = '';
                                                        }
                                                    @endphp
                                                    <div class="bookmark">
                                                        <a href="{{ route('candidate_bookmark_add', $item->id) }}">
                                                            <i class="fas fa-bookmark {{ $bookmark_status }}"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    {{ $jobs->appends($_GET)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
