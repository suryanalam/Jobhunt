@extends('front.layout.app')

@section('seo-title',"$job_category_page_item->title")
@section('seo-meta-description',"$job_category_page_item->meta_description")

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $job_category_page_item->heading }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="job-category">
        <div class="container">
            <div class="row">
                @foreach ($job_categories as $item)
                    <div class="col-md-4">
                        <div class="item">
                            <div class="icon">
                                <i class="{{ $item->icon }}"></i>
                            </div>
                            <h3>{{ $item->name }}</h3>
                            <p>({{ $item->rJob->count() }} Open Positions)</p>
                            <a href="{{ url("job-listing?category=$item->id") }}"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
