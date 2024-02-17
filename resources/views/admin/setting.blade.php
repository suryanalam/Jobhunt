@extends('admin.layout.app')

@section('heading', 'Settings')

@section('main-content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_setting_update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">Existing Logo</label>
                                <div>
                                    <img src="{{ asset('uploads/' . $settings_data->logo) }}" alt="" class="w_150">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Change Logo</label>
                                <input type="file" class="form-control mt_10" name="logo">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Existing Favicon</label>
                                <div>
                                    <img src="{{ asset('uploads/' . $settings_data->favicon) }}" alt=""
                                        class="w_150">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Change Favicon</label>
                                <input type="file" class="form-control mt_10" name="favicon">
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Top Bar Phone *</label>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="top_bar_phone"
                                            value="{{ $settings_data->top_bar_phone }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Top Bar Email *</label>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="top_bar_email"
                                            value="{{ $settings_data->top_bar_email }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Footer Phone *</label>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="footer_phone"
                                        value="{{ $settings_data->footer_phone }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Footer Email *</label>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="footer_email"
                                        value="{{ $settings_data->footer_email }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Footer Address *</label>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="footer_address"
                                        value="{{ $settings_data->footer_address }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Footer Copyright Text *</label>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="footer_copyright_text"
                                        value="{{ $settings_data->footer_copyright_text }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Facebook</label>
                                    <div class="form-group">
                                        <input type="text" name="footer_facebook" class="form-control"
                                            value="{{ $settings_data->footer_facebook }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Twitter</label>
                                    <div class="form-group">
                                        <input type="text" name="footer_twitter"
                                            class="form-control"value="{{ $settings_data->footer_twitter }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Linkedin</label>
                                    <div class="form-group">
                                        <input type="text" name="footer_linkedin" class="form-control"
                                            value="{{ $settings_data->footer_linkedin }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Instagram</label>
                                    <div class="form-group">
                                        <input type="text" name="footer_instagram" class="form-control"
                                            value="{{ $settings_data->footer_instagram }}" />
                                    </div>
                                </div>
                            </div>





                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
