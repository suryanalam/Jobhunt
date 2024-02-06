@extends('front.layout.app')

{{-- @section('seo-title',"$faq_page_item->title")
@section('seo-meta-description',"$faq_page_item->meta_description") --}}

@section('main_content')

    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dashboard</h2>
                    {{-- <h2>{{ $faq_page_item->heading }}</h2> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="card">
                        @include('company.sidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <h3>Hello, {{ Auth::guard('company')->user()->person_name }} 
                        ({{ Auth::guard('company')->user()->company_name }})
                    </h3>
                    <p>See all the statistics at a glance:</p>

                    <div class="row box-items">
                        <div class="col-md-4">
                            <div class="box1">
                                <h4>{{ $open_jobs_count }}</h4>
                                <p>Open Jobs</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box2">
                                <h4>{{ $featured_jobs_count }}</h4>
                                <p>Featured Jobs</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box3">
                                <h4>NA</h4>
                                <p>Pending Jobs</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-5">Recent Jobs</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Job Title</th>
                                    <th>Category</th>
                                    <th>Location</th>
                                    <th>Featured</th>
                                    <th>Urgent</th>
                                </tr>
                                @if ($recent_jobs == null)
                                    <tr><td>No Jobs available</td></tr>
                                @else
                                    @foreach ($recent_jobs as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->rJobCategory->name }}</td>
                                            <td>{{ $item->rJobLocation->name }}</td>
                                            <td>
                                                @if ($item->is_featured)
                                                    <span class="badge bg-success">YES</span>
                                                @else
                                                    <span class="badge bg-danger">NO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->is_urgent)
                                                    <span class="badge bg-success">YES</span>
                                                @else
                                                    <span class="badge bg-danger">NO</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
