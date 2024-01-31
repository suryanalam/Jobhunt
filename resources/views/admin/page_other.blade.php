@extends('admin.layout.app')

@section('heading', 'Other Page Content')

@section('main-content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_other_page_update') }}" method="post" >
                        @csrf
                        <div class="row custom-tab">
                            <div class="col-lg-3 col-md-12">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">

                                    <button class="nav-link active" id="v-pills-1-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-1" type="button" role="tab"
                                        aria-controls="v-pills-1" aria-selected="true">Login</button>

                                    <button class="nav-link" id="v-pills-2-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-2" type="button" role="tab"
                                        aria-controls="v-pills-2" aria-selected="false">Signup</button>

                                    <button class="nav-link" id="v-pills-3-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-3" type="button" role="tab"
                                        aria-controls="v-pills-3" aria-selected="false">Forget Password</button>

                                </div>
                            </div>
                            <div class="col-lg-9 col-md-12">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                        aria-labelledby="v-pills-1-tab" tabindex="0">
                                        {{-- Search section start --}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label>Heading *</label>
                                                    <input type="text" class="form-control" name="login_page_heading" value="{{ $page_other_data->login_page_heading }}">
                                                </div>
                                                <h5 class="seo_section">SEO Section</h5>
                                                <div class="mb-4">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="login_page_title" value="{{ $page_other_data->login_page_title }}">
                                                </div>
                                                <div class="mb-4">
                                                    <label>Meta Description</label>
                                                    <input type="text" class="form-control" name="login_page_meta_description" value="{{ $page_other_data->login_page_meta_description }}">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Search section end --}}
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel"
                                        aria-labelledby="v-pills-2-tab" tabindex="0">
                                        {{-- Featured-Jobs-section-start --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label>Heading *</label>
                                                        <input type="text" class="form-control" name="signup_page_heading" value="{{ $page_other_data->signup_page_heading }}">
                                                    </div>
                                                    <h5 class="seo_section">SEO Section</h5>
                                                    <div class="mb-4">
                                                        <label>Title</label>
                                                        <input type="text" class="form-control" name="signup_page_title" value="{{ $page_other_data->signup_page_title }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label>Meta Description</label>
                                                        <input type="text" class="form-control" name="signup_page_meta_description" value="{{ $page_other_data->signup_page_meta_description }}">
                                                    </div>
                                                </div>
                                            </div>
                                        {{-- Featured-Jobs-section-end --}}
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-3" role="tabpanel"
                                        aria-labelledby="v-pills-3-tab" tabindex="0">
                                        {{-- Why-Choose-section-start --}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label>Heading *</label>
                                                    <input type="text" class="form-control" name="forget_password_page_heading" value="{{ $page_other_data->forget_password_page_heading }}">
                                                </div>
                                                <div class="mb-4">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="forget_password_page_title" value="{{ $page_other_data->forget_password_page_title }}">
                                                </div>
                                                <div class="mb-4">
                                                    <label>Meta Description</label>
                                                    <input type="text" class="form-control" name="forget_password_page_meta_description" value="{{ $page_other_data->forget_password_page_meta_description }}">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Testimonial-section-end --}}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
