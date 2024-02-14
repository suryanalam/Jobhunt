@extends('admin.layout.app')

@section('heading', 'Advertisement')

@section('main-content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_advertisement_update', $advertisement->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <h4>Job Advertisement</h4>

                            <div class="form-group mb-3">
                                <label class="form-label">Existing Ad Banner</label>
                                <div>
                                    @if ($advertisement->job_listing_ad == null || $advertisement->job_listing_ad == '')
                                        <p class="text-danger">No job advertisement</p>
                                    @else
                                        <img src="{{ asset('uploads/' . $advertisement->job_listing_ad) }}" alt=""
                                            class="w_150">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Change Ad Banner</label>
                                <input type="file" class="form-control mt_10" name="job_listing_ad">
                            </div>

                            <div class="form-group mb-3">
                                <label>Ad URL *</label>
                                <input type="text" class="form-control" name="job_listing_ad_url"
                                    value="{{ $advertisement->job_listing_ad_url }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Ad Status *</label>
                                <select name="job_listing_ad_status" class="form-control select2">
                                    <option value="Show" @if ($advertisement->job_listing_ad_status == 'Show') selected @endif>Show
                                    </option>
                                    <option value="Hide" @if ($advertisement->job_listing_ad_status == 'Hide') selected @endif>Hide
                                    </option>
                                </select>
                            </div>


                            <h4>Company Advertisement</h4>

                            <div class="form-group mb-3">
                                <label class="form-label">Existing Ad Banner</label>
                                <div>
                                    @if ($advertisement->company_listing_ad == null || $advertisement->company_listing_ad == '')
                                        <p class="text-danger">No company advertisement</p>
                                    @else
                                        <img src="{{ asset('uploads/' . $advertisement->company_listing_ad) }}"
                                            alt="" class="w_150">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Change Ad Banner</label>
                                <input type="file" class="form-control mt_10" name="company_listing_ad">
                            </div>

                            <div class="form-group mb-3">
                                <label>Ad URL *</label>
                                <input type="text" class="form-control" name="company_listing_ad_url"
                                    value="{{ $advertisement->company_listing_ad_url }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Ad Status *</label>
                                <select name="company_listing_ad_status" class="form-control select2">
                                    <option value="Show" @if ($advertisement->company_listing_ad_status == 'Show') selected @endif>Show
                                    </option>
                                    <option value="Hide" @if ($advertisement->company_listing_ad_status == 'Hide') selected @endif>Hide
                                    </option>
                                </select>
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
