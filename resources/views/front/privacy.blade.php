@extends('front.layout.app')

@section('seo-title',"$privacy->title")
@section('seo-meta-description',"$privacy->meta_description")

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $privacy->heading }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $privacy->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
