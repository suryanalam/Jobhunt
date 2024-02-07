@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add New Award</h2>
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
                    <a href="{{ route('candidate_resume') }}" class="btn btn-primary btn-sm mb-2">
                        View Resumes
                    </a>
                    <form action="{{ route('candidate_resume_update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $resume->id }}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name *</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $resume->name) }}" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Existing File *</label>
                                <div class="form-group">
                                    <a href="{{ asset("uploads/$resume->file") }}" target="_blank">{{ $resume->file }}</a>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">File *</label>
                                <div class="form-group">
                                    <input type="file" name="file" class="form-control" value="{{ old('file') }}" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Update" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
