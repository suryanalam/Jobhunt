@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Edit Profile</h2>
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
                        @include('candidate.sidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <form action="{{ route('candidate_profile_update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Existing Photo</label>
                                <div class="form-group">
                                    @if (Auth::guard('candidate')->user()->photo == '' || Auth::guard('candidate')->user()->photo == null)
                                        <img src="{{ asset('uploads/company_default_logo.png') }}" alt="candidate-photo"
                                            class="user-photo" />
                                    @else
                                        <img src="{{ asset('uploads/' . Auth::guard('candidate')->user()->photo) }}"
                                            alt="candidate-photo" class="user-photo" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Change Photo</label>
                                <div class="form-group">
                                    <input type="file" name="photo" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Name *</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', Auth::guard('candidate')->user()->name) }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Designation</label>
                                <div class="form-group">
                                    <input type="text" name="designation" class="form-control"
                                        value="{{ old('designation', Auth::guard('candidate')->user()->designation) }}" />
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Biography</label>
                                <textarea name="biography" class="form-control editor" cols="30" rows="10">{!! old('biography', Auth::guard('candidate')->user()->biography) !!}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Username *</label>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control"
                                        value="{{ old('username', Auth::guard('candidate')->user()->username) }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email *</label>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control"
                                        value="{{ old('email', Auth::guard('candidate')->user()->email) }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone *</label>
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone', Auth::guard('candidate')->user()->phone) }}" />
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Address</label>
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control"
                                        value="{{ old('address', Auth::guard('candidate')->user()->address) }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Country</label>
                                <div class="form-group">
                                    <input type="text" name="country" class="form-control"
                                        value="{{ old('country', Auth::guard('candidate')->user()->country) }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">State</label>
                                <div class="form-group">
                                    <input type="text" name="state" class="form-control"
                                        value="{{ old('state', Auth::guard('candidate')->user()->state) }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">City</label>
                                <div class="form-group">
                                    <input type="text" name="city" class="form-control"
                                        value="{{ old('city', Auth::guard('candidate')->user()->city) }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Zip Code</label>
                                <div class="form-group">
                                    <input type="text" name="zip_code" class="form-control"
                                        value="{{ old('zip_code', Auth::guard()->user('candidate')->zip_code) }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Gender</label>
                                <div class="form-group">
                                    <select name="gender" class="form-control select2">
                                        <option value="Male"
                                            {{ Auth::guard()->user('candidate')->gender == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female"
                                            {{ Auth::guard()->user('candidate')->gender == 'Female' ? 'selected' : '' }}>
                                            Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Marital Status</label>
                                <div class="form-group">
                                    <select name="marital_status" class="form-control select2">
                                        <option value="Married"
                                            {{ Auth::guard()->user('candidate')->marital_status == 'Married' ? 'selected' : '' }}>
                                            Married</option>
                                        <option value="Unmarried"
                                            {{ Auth::guard()->user('candidate')->marital_status == 'Unmarried' ? 'selected' : '' }}>
                                            Unmarried</option>
                                        <option value="Divorced"
                                            {{ Auth::guard()->user('candidate')->marital_status == 'Divorced' ? 'selected' : '' }}>
                                            Divorced</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Date of Birth</label>
                                <div class="form-group">
                                    <input type="text" name="date_of_birth" class="form-control datepicker"
                                        value="{{ Auth::guard()->user('candidate')->date_of_birth ? Auth::guard()->user('candidate')->date_of_birth : date('Y-m-d') }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Website</label>
                                <div class="form-group">
                                    <input type="text" name="website" class="form-control"
                                        value="{{ old('website', Auth::guard()->user('candidate')->website) }}" />
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
