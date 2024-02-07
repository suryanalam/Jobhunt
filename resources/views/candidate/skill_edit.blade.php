@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Edit Skill</h2>
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
                    <a href="{{ route('candidate_skill') }}" class="btn btn-primary btn-sm mb-2">
                        View Skills
                    </a>
                    <form action="{{ route('candidate_skill_update', $skill->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $skill->id }}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Skill Name *</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $skill->name) }}" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Percentage *</label>
                                <div class="form-group">
                                    <input type="text" name="percentage" class="form-control"
                                        value="{{ old('percentage', $skill->percentage) }}" />
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
