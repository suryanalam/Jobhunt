@extends('front.layout.app')

{{-- @section('seo-title', "$faq_page_item->title")
@section('seo-meta-description', "$faq_page_item->meta_description") --}}

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Photos</h2>
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
                        @include('company.sidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <h4>Add Photo</h4>
                    <form action="{{ route('company_photo_submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <input type="file" name="photo" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-sm" value="Submit"  />
                            </div>
                        </div>
                    </form>

                    <h4 class="mt-4">Existing Photos</h4>
                    <div class="photo-all">
                        @if ($photos->count() == 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="alert alert-danger">No Photos Found</p>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            @foreach ($photos as $item)
                                <div class="col-md-6 col-lg-3">
                                    <div class="item">
                                        <a href="{{ asset("uploads/$item->photo") }}" class="magnific">
                                            <img src="{{ asset("uploads/$item->photo") }}" alt="" />
                                            <div class="icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="bg"></div>
                                        </a>
                                    </div>
                                    <a href="{{ route('company_photo_delete',$item->id) }}" class="btn btn-danger mb-3" onClick="return confirm('Are you sure?');">Delete</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
