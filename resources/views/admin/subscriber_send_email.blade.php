@extends('admin.layout.app')

@section('heading', 'Send Email')

@section('button')
    <div>
        <a href="{{ route('admin_subscriber_view') }}" class="btn btn-primary">View All</a>
    </div>
@endsection


@section('main-content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_subscriber_send_email_submit') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Subject*</label>
                                <input type="text" class="form-control" name="subject">
                            </div>
                            <div class="form-group mb-3">
                                <label>Message*</label>
                                <textarea name="message" class="form-control editor" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
