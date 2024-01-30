@extends('front.layout.app')

@section('seo-title',"$term->title")
@section('seo-meta-description',"$term->meta_description")

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $term->heading }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $term->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
