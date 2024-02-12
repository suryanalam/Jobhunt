@extends('front.layout.app')

@section('seo-title', 'Job Detail')
@section('seo-meta-description', 'Job Detail')

@section('main_content')
    <div class="page-top page-top-job-single page-top-company-single"
        style="background-image: {{ asset('uploads/banner.jpg') }}">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 job job-single">
                    <div class="item d-flex justify-content-start">
                        <div class="logo">
                            @if ($company->logo == null || $company->logo == '')
                                <img src="{{ asset('uploads/company_default_logo.png') }}" alt="" class="logo"
                                    name="company-logo" />
                            @else
                                <img src="{{ asset('uploads/' . $company->logo) }}" alt="" class="logo"
                                    name="company-logo" />
                            @endif
                        </div>
                        <div class="text">
                            <h3>{{ $company->company_name }}</h3>
                            <div class="detail-1 d-flex justify-content-start">
                                <div class="category">{{ $company->rCompanyIndustry->name }}</div>
                                <div class="location">{{ $company->rCompanyLocation->name }}</div>
                                <div class="email">{{ $company->email }}</div>
                                <div class="phone">{{ $company->phone }}</div>
                            </div>
                            <div class="special">
                                <div class="type">{{ $company->r_job_count }} Open Positions</div>
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="{{ $company->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{ $company->twitter }}"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{ $company->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{ $company->instagram }}"><i class="fab fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                        <h2><i class="fas fa-file-invoice"></i> About Company</h2>
                        {!! $company->description !!}
                    </div>
                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Opening Hours
                        </h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Monday</td>
                                        <td>{{ $company->oh_mon }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tuesday</td>
                                        <td>{{ $company->oh_tue }}</td>
                                    </tr>
                                    <tr>
                                        <td>Wednesday</td>
                                        <td>{{ $company->oh_wed }}</td>
                                    </tr>
                                    <tr>
                                        <td>Thursday</td>
                                        <td>{{ $company->oh_thu }}</td>
                                    </tr>
                                    <tr>
                                        <td>Friday</td>
                                        <td>{{ $company->oh_fri }}</td>
                                    </tr>
                                    <tr>
                                        <td>Saturday</td>
                                        <td>{{ $company->oh_sat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sunday</td>
                                        <td>{{ $company->oh_sun }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Photos
                        </h2>
                        <div class="photo-all">
                            <div class="row">
                                @if (!$company->rCompanyPhoto->count())
                                    <p class="text-danger">No Photos available.</p>
                                @endif
                                @foreach ($company->rCompanyPhoto as $item)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="item">
                                            <a href="{{ asset("uploads/$item->photo") }}" class="magnific">
                                                <img src="{{ asset("uploads/$item->photo") }}" alt="" />
                                                <div class="icon">
                                                    <i class="fas fa-plus"></i>
                                                </div>
                                                <div class="bg"></div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Videos
                        </h2>
                        <div class="video-all">
                            <div class="row">
                                @if (!$company->rCompanyVideo->count())
                                    <p class="text-danger">No Videos available.</p>
                                @endif
                                @foreach ($company->rCompanyVideo as $item)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="item">
                                            <a class="video-button"
                                                href="http://www.youtube.com/watch?v={{ $item->video_id }}">
                                                <img src="http://img.youtube.com/vi/{{ $item->video_id }}/0.jpg"
                                                    alt="" />
                                                <div class="icon">
                                                    <i class="far fa-play-circle"></i>
                                                </div>
                                                <div class="bg"></div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="left-item">
                        <h2><i class="fas fa-file-invoice"></i>Open Positions</h2>
                        <div class="job related-job pt-0 pb-0">
                            <div class="container">
                                <div class="row">
                                    @if (!$company_jobs->count())
                                        <p class="text-danger">No openings found</p>
                                    @endif
                                    @foreach ($company_jobs as $item)
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
                                                                ->where('job_id', $item->id)->count();
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
                            Company Overview
                        </h2>
                        <div class="summary">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><b> Contact Person:</b></td>
                                        <td>{{ $company->person_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b> Industry:</b></td>
                                        <td>{{ $company->rCompanyIndustry->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b></td>
                                        <td>{{ $company->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone:</b></td>
                                        <td>{{ $company->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Address:</b></td>
                                        <td>{{ $company->address }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Country:</b></td>
                                        <td>{{ $company->rCompanyLocation->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Website:</b></td>
                                        <td>{{ $company->website }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Company Size:</b>
                                        </td>
                                        <td>{{ $company->rCompanySize->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Founded On:</b>
                                        </td>
                                        <td>{{ $company->founded_on }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="right-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Location Map
                        </h2>
                        <div class="location-map">
                            {!! $company->map_code !!}
                        </div>
                    </div>
                    <div class="right-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Contact Company
                        </h2>
                        <div class="enquery-form">
                            <form action="{{ route('company_enquery') }}" method="post">
                                @csrf
                                <input type="hidden" name="company_email" value="{{ $company->email }}">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Full Name"
                                        name="visitor_name" value="{{ old('visitor_name') }}" />
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Address"
                                        name="visitor_email" value="{{ old('visitor_email') }}" />
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Phone Number"
                                        name="visitor_phone" value="{{ old('visitor_phone') }}" />
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control h-150" rows="3" placeholder="Message" name="visitor_message">{{ old('visitor_message') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
