@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Edit Job</h2>
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
                    <form action="{{ route('company_job_update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $job->id }}">
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Title *</label>
                            <input type="text" class="form-control" name="title"
                                value="{{ old('title', $job->title) }}" />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description *</label>
                            <textarea name="description" class="form-control editor" cols="30" rows="10">{!! old('description', $job->description) !!}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Job Responsibilities</label>
                                <textarea name="responsibility" class="form-control editor" cols="30" rows="10">{!! old('responsibility', $job->responsibility) !!}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Skills</label>
                                <textarea name="skill" class="form-control editor" cols="30" rows="10">{!! old('skill', $job->skill) !!}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Educational Qualification</label>
                                <textarea name="education" class="form-control editor" cols="30" rows="10">{!! old('education', $job->education) !!}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Benifits</label>
                                <textarea name="benefit" class="form-control editor" cols="30" rows="10">{!! old('benefit', $job->benefit) !!}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Deadline *</label>
                                <input type="text" name="deadline" class="form-control datepicker"
                                    value="{{ $job->deadline ? $job->deadline : date('Y-m-d') }}" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Vacancy *</label>
                                <input type="number" class="form-control" name="vacancy"
                                    value="{{ $job->vacancy ? $job->vacancy : old('vacancy', 1) }}" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Category *</label>
                                <select name="job_category_id" class="form-control select2">
                                    @foreach ($job_categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $job->job_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Location *</label>
                                <select name="job_location_id" class="form-control select2">
                                    @foreach ($job_locations as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $job->job_location_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Job Type *</label>
                                <select name="job_type_id" class="form-control select2">
                                    @foreach ($job_types as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $job->job_type_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Experience *</label>
                                <select name="job_experience_id" class="form-control select2">
                                    @foreach ($job_experiences as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $job->job_experience_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Gender *</label>
                                <select name="job_gender_id" class="form-control select2">
                                    @foreach ($job_genders as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $job->job_gender_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Salary Range *</label>
                                <select name="job_salary_range_id" class="form-control select2">
                                    @foreach ($job_salary_ranges as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $job->job_salary_range_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Is Featured</label>
                                <select name="is_featured" class="form-control select2">
                                    <option value="1" {{ $job->is_featured == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $job->is_featured == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Is Urgent</label>
                                <select name="is_urgent" class="form-control select2">
                                    <option value="1" {{ $job->is_urgent == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $job->is_urgent == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="" class="form-label">Location Map</label>
                                <textarea name="map_code" class="form-control h-150" cols="30" rows="10">{!! old('map_code', $job->map_code) !!}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="submit" class="btn btn-primary" value="Submit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
