@extends('admin.layout.app')

@section('heading', 'Privacy Policy Page Content')

@section('main-content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_privacy_page_update') }}" method="post" >
                        @csrf
                        <div class="form-group mb-3">
                            <label>Heading *</label>
                            <input type="text" class="form-control" name="heading" value="{{ old('heading',$page_privacy_data->heading) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Content *</label>
                            <textarea name="content" class="form-control editor" cols="30" rows="10"> {{ $page_privacy_data->content }} </textarea>
                        </div>
                        <h4 class="seo_section">SEO Section</h4>
                        <div class="form-group mb-3">
                            <label>Title *</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title',$page_privacy_data->title) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Meta Description *</label>
                            <input type="text" class="form-control" name="meta_description" value="{{ old('meta_description',$page_privacy_data->meta_description) }}">
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