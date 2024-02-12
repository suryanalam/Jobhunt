@extends('front.layout.app')

@section('seo-title', "$page_home_data->title")
@section('seo-meta-description', "$page_home_data->meta_description")

@section('main_content')
    <div class="slider" style="background-image: url({{ asset('uploads/' . $page_home_data->background) }})">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="item">
                        <div class="text">
                            <h2>{{ $page_home_data->heading }}</h2>
                            <p>
                                {!! $page_home_data->text !!}
                            </p>
                        </div>
                        <div class="search-section">
                            <form action="{{ route('job_listing') }}" method="get">
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" name="title" class="form-control"
                                                    placeholder="{{ $page_home_data->job_title }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select name="location" class="form-select select2">
                                                    <option value="">
                                                        {{ $page_home_data->job_location }}
                                                    </option>
                                                    @foreach ($all_job_locations as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select name="category" class="form-select select2">
                                                    <option value="">
                                                        {{ $page_home_data->job_category }}
                                                    </option>
                                                    @foreach ($all_job_categories as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                                {{ $page_home_data->search }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($page_home_data->job_category_status == 'Show')
        <div class="job-category">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>{{ $page_home_data->job_category_heading }}</h2>
                            <p>
                                {{ $page_home_data->job_category_subheading }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($job_categories as $item)
                        <div class="col-md-4">
                            <div class="item">
                                <div class="icon">
                                    <i class="{{ $item->icon }}"></i>
                                </div>
                                <h3>{{ $item->name }}</h3>
                                <p>({{ $item->rJob->count() }} Open Positions)</p>
                                <a href="{{ url("job-listing?category=$item->id") }}"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="all">
                            <a href="{{ route('job_categories') }}" class="btn btn-primary">See All Categories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($page_home_data->why_choose_status == 'Show')
        <div class="why-choose"
            style="background-image: url({{ asset('uploads/' . $page_home_data->why_choose_background) }})">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>{{ $page_home_data->why_choose_heading }}</h2>
                            <p>
                                {{ $page_home_data->why_choose_subheading }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($why_choose_items as $item)
                        <div class="col-md-4">
                            <div class="inner">
                                <div class="icon">
                                    <i class="{{ $item->icon }}"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $item->heading }}</h2>
                                    <p>
                                        {!! nl2br($item->text) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if ($page_home_data->featured_jobs_status == 'Show')
        <div class="job">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>{{ $page_home_data->featured_jobs_heading }}</h2>
                            <p>{{ $page_home_data->featured_jobs_subheading }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($featured_jobs as $item)
                        <div class="col-lg-6 col-md-12">
                            <div class="item d-flex justify-content-start">
                                <div class="logo">
                                    @if ($item->rCompany->logo == null || $item->rCompany->logo == '')
                                        <img src="{{ asset('uploads/company_default_logo.png') }}" alt=""
                                            class="logo" name="company-logo" />
                                    @else
                                        <img src="{{ asset('uploads/' . $item->rCompany->logo) }}" alt=""
                                            class="logo" name="company-logo" />
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
                                                ->where('job_id', $item->id)->count(); 
                                            if ($count) {
                                                $bookmark_status = "active";;
                                            }else{
                                                $bookmark_status = "";
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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="all">
                            <a href="{{ route('job_listing') }}" class="btn btn-primary">See All Jobs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($page_home_data->testimonial_status == 'Show')
        <div class="testimonial"
            style="background-image: url({{ asset('uploads/' . $page_home_data->testimonial_background) }})">
            <div class="bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="main-header">{{ $page_home_data->testimonial_heading }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="testimonial-carousel owl-carousel">
                            @foreach ($testimonials as $item)
                                <div class="item">
                                    <div class="photo">
                                        <img src="{{ asset('uploads/' . $item->photo) }}" alt="" />
                                    </div>
                                    <div class="text">
                                        <h4>{{ $item->name }}</h4>
                                        <p>{{ $item->designation }}</p>
                                    </div>
                                    <div class="description">
                                        <p>
                                            {!! nl2br($item->comment) !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($page_home_data->blog_status == 'Show')
        <div class="blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>{{ $page_home_data->blog_heading }}</h2>
                            <p>
                                {{ $page_home_data->blog_subheading }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="item">
                                <div class="photo">
                                    <img src="{{ asset("uploads/$post->photo") }}" alt="" />
                                </div>
                                <div class="text">
                                    <h2>
                                        <a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                                    </h2>
                                    <div class="short-des">
                                        <p>{{ $post->short_description }}</p>
                                    </div>
                                    <div class="button">
                                        <a href="{{ route('post', $post->slug) }}" class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
