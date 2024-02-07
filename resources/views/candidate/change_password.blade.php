@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Change Password</h2>
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
                    <form action="{{ route('candidate_change_password_update') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="">Password*</label>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="">Confirm Password *</label>
                                <div class="form-group">
                                    <input type="password" name="confirm_password" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Update" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
