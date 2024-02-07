@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Edit Education</h2>
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
                    <a href="{{ route('candidate_education') }}" class="btn btn-primary btn-sm mb-2">
                        View Educations
                    </a>
                    <form action="{{ route('candidate_education_update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $education->id }}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Education Level *</label>
                                <div class="form-group">
                                    <input type="text" name="level" class="form-control"
                                        value="{{ old('level', $education->level) }}" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Institute *</label>
                                <div class="form-group">
                                    <input type="text" name="institute" class="form-control"
                                        value="{{ old('institute', $education->institute) }}" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Degree *</label>
                                <div class="form-group">
                                    <input type="text" name="degree" class="form-control"
                                        value="{{ old('degree', $education->degree) }}" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Passing Year *</label>
                                <div class="form-group">
                                    <input type="text" name="passing_year" class="form-control"
                                        value="{{ old('passing_year', $education->passing_year) }}" />
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
