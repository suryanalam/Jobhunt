@extends('front.layout.app')

@section('seo-title', 'Job Detail')
@section('seo-meta-description', 'Job Detail')

@section('main_content')
    <div class="page-top page-top-job-single" style="background-image: {{ asset('uploads/banner.jpg') }}">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 job job-single">
                    <div class="item d-flex justify-content-start">
                        <div class="logo">
                            @if ($job->rCompany->logo == null || $job->rCompany->logo == '')
                                <img src="{{ asset('uploads/company_default_logo.png') }}" alt="" class="logo"
                                    name="company-logo" />
                            @else
                                <img src="{{ asset('uploads/' . $job->rCompany->logo) }}" alt="" class="logo"
                                    name="company-logo" />
                            @endif
                        </div>
                        <div class="text">
                            <h3>{{ $job->title }}, {{ $job->rCompany->company_name }}</h3>
                            <div class="detail-1 d-flex justify-content-start">
                                <div class="category">{{ $job->rJobCategory->name }}</div>
                                <div class="location">{{ $job->rJobLocation->name }}</div>
                            </div>
                            <div class="detail-2 d-flex justify-content-start">
                                <div class="date">{{ $job->created_at->diffForHumans() }}</div>
                                <div class="budget">{{ $job->rJobSalaryRange->name }}</div>
                                {!! date('Y-m-d') > $job->deadline ? "<div class='expired'>Expired</div>" : null !!}
                            </div>
                            <div class="special d-flex justify-content-start">
                                <div class="type">{{ $job->rJobType->name }}</div>
                                {!! $job->is_featured == '1' ? "<div class='featured'>Featured</div>" : null !!}
                                {!! $job->is_urgent == '1' ? "<div class='urgent'>Urgent</div>" : null !!}
                            </div>

                            @if (Auth::guard('candidate')->check() && date('Y-m-d') <= $job->deadline)
                                <div class="apply">

                                    @php
                                        $applied = \App\Models\CandidateApplication::where('candidate_id', Auth::guard('candidate')->user()->id)
                                            ->where('job_id', $job->id)->first();
                                    @endphp

                                    @if (!$applied)
                                        <a href="{{ route('candidate_job_apply',$job->id) }}" class="btn btn-primary">Apply Now</a>
                                    @else
                                        <p class=" alert alert-success">{{ $applied->status }}</p>
                                    @endif

                                    @php
                                        $bookmarked = \App\Models\CandidateBookmark::where('candidate_id', Auth::guard('candidate')->user()->id)
                                            ->where('job_id', $job->id)->count();
                                    @endphp

                                    @if (!$bookmarked && !$applied)
                                        <a href="{{ route('candidate_bookmark_add', $job->id) }}"
                                            class="btn btn-primary save-job">Bookmark</a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="job-result pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Description
                        </h2>
                        <p>
                            {!! $job->description !!}
                        </p>
                    </div>
                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Job Responsibilities
                        </h2>
                        <ul>
                            {!! $job->responsibility !!}
                        </ul>
                    </div>
                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Skills and Abilities
                        </h2>
                        <ul>
                            {!! $job->skill !!}
                        </ul>
                    </div>

                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Educational Qualification
                        </h2>
                        <ul>
                            {!! $job->education !!}
                        </ul>
                    </div>

                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Benefits
                        </h2>
                        <ul>
                            {!! $job->benefit !!}
                        </ul>
                    </div>

                    <div class="left-item">
                        <div class="apply">
                            <a href="apply.html" class="btn btn-primary">Apply Now</a>
                        </div>
                    </div>

                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Related Jobs
                        </h2>
                        <div class="job related-job pt-0 pb-0">
                            <div class="container">
                                <div class="row">
                                    @if (!$similar_jobs->count())
                                        <p class="text-danger">Not Found</p>
                                    @endif
                                    @foreach ($similar_jobs as $item)
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="right-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Job Summary
                        </h2>
                        <div class="summary">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            <b>Published On:</b>
                                        </td>
                                        <td> {{ date('M d, Y', strtotime($job->created_at)) }} </td>
                                    </tr>
                                    <tr>
                                        <td><b>Deadline:</b></td>
                                        <td>{{ date('M d, Y', strtotime($job->deadline)) }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Vacancy:</b></td>
                                        <td>{{ $job->vacancy }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Category:</b></td>
                                        <td>{{ $job->rJobCategory->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Location:</b></td>
                                        <td>{{ $job->rJobLocation->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Salary Range:</b>
                                        </td>
                                        <td>{{ $job->rJobSalaryRange->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Experience:</b>
                                        </td>
                                        <td>{{ $job->rJobExperience->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Type:</b></td>
                                        <td>{{ $job->rJobType->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Gender:</b></td>
                                        <td>{{ $job->rJobGender->name }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="right-item">
                        <h2><i class="fas fa-file-invoice"></i>Enquery Form</h2>
                        <div class="enquery-form">
                            <form action="{{ route('job_enquery') }}" method="POST">
                                @csrf
                                <input type="hidden" name="job_title" value="{{ $job->title }}">
                                <input type="hidden" name="company_email" value="{{ $job->rCompany->email }}">
                                <div class="mb-3">
                                    <input type="text" name="visitor_name" class="form-control" placeholder="Full Name"
                                        value="{{ old('visitor_name') }}" />
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="visitor_email" class="form-control"
                                        placeholder="Email Address" value="{{ old('visitor_email') }}" />
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="visitor_phone" class="form-control"
                                        placeholder="Phone Number" value="{{ old('visitor_phone') }}" />
                                </div>
                                <div class="mb-3">
                                    <textarea name="visitor_message" class="form-control h-150" rows="3" placeholder="Message">
                                        {{ old('visitor_message') }}
                                    </textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if ($job->rCompany->map_code != null && $job->rCompany->map_code != '')
                        <div class="right-item">
                            <h2><i class="fas fa-file-invoice"></i>Location Map</h2>
                            <div class="location-map">{!! $job->rCompany->map_code !!} </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
