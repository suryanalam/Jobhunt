@extends('admin.layout.app')

@section('heading', 'Edit Post')

@section('button')
<div>
    <a href="{{ route('admin_post') }}" class="btn btn-primary">View All</a>
</div>
@endsection


@section('main-content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_post_update',$post_single->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="form-label">Existing Background
                            <div>
                                <img src="{{ asset('uploads/' . $post_single->photo) }}"
                                    alt="" class="w_150">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Change Background</label>
                            <input type="file" class="form-control mt_10"
                                name="photo">
                        </div>
                        <div class="form-group mb-3">
                            <label>Heading *</label>
                            <input type="text" class="form-control" name="heading" value="{{ old('heading',$post_single->heading) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Slug *</label>
                            <input type="text" class="form-control" name="slug" value="{{ $post_single->slug }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Short Description *</label>
                            <textarea name="short_description" class="form-control h_100" cols="30" rows="10"> {{ $post_single->short_description }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Description *</label>
                            <textarea name="description" class="form-control editor" cols="30" rows="10">{{ $post_single->description }}</textarea>
                        </div>
                        <h4 class="seo_section">SEO Section</h4>
                        <div class="form-group mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title',$post_single->title) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"> {{ old('meta_description',$post_single->meta_description) }}</textarea>
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
