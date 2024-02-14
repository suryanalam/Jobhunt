@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Applications for "{{ $job_details->title }}"</h2>
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
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>status</th>
                                    <th>Action</th>
                                    <th>Applicant Details</th>
                                </tr>
                                @foreach ($applicants as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->rCandidate->name }}</td>
                                        <td>{{ $item->rCandidate->email  }}</td>
                                        <td>{{ $item->rCandidate->phone  }}</td>

                                        @php
                                            if($item->status == "Applied"){
                                                $color = "primary";
                                            }elseif($item->status == "Approved"){
                                                $color = "success";
                                            }elseif($item->status == "Rejected"){
                                                $color = "danger";
                                            }
                                        @endphp

                                        <td class="badge bg-{{ $color }} m-2">{{ $item->status }}</td>
                                        <td>
                                            <form action="{{ route('applicant_status_update') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="candidate_id" value="{{  $item->rCandidate->id }}">
                                                <input type="hidden" name="job_id" value="{{ $item->rJob->id }}">
                                                <select name="status" class="select2" onchange="this.form.submit()">
                                                    <option value="">Select</option>
                                                    <option value="Applied">Applied</option>
                                                    <option value="Approved">Approve</option>
                                                    <option value="Rejected">Reject</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('company_applicant_details', $item->rCandidate->id) }}" class="btn btn-primary btn-sm" target="_blank">View Applicant</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
