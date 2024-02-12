@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Apply for: "{{ $job->title }}"</h2>
                    <div class="button">
                        <a href="{{ route('job_detail', $job->id) }}" class="btn btn-primary btn-sm">
                            See Job Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="job-apply">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="apply-form">
                        <form action="{{ route('candidate_job_apply_submit') }}" method="post">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                            <div class="mb-3">
                                <label for="" class="mb-1">Cover Letter *</label>
                                <textarea class="form-control" rows="3" name="cover_letter"></textarea>
                                <div class="clearfix"></div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Confirm Apply
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
