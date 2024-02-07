@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Reset Password</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                    <div class="login-form">
                        <form action="{{ route('company_reset_password_submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary bg-website">
                                    Submit
                                </button>
                                <a href="{{ route('login') }}" class="primary-color">Back to Login Page</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
