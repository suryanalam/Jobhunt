@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Bookmarked Jobs</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="card">
                        @include('candidate.sidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Job Title</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($bookmarked_jobs as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->rJob->title }}</td>
                                        <td>
                                            <a href="{{ route('job_detail', $item->rJob->id) }}"
                                                class="btn btn-primary btn-sm text-white">
                                                view Job
                                            </a>
                                            <a href="{{ route('candidate_bookmark_delete', $item->id) }}"
                                                class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');">
                                                delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
