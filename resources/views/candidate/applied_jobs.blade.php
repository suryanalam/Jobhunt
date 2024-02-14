@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Applied Jobs</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="card">
                        @include('candidate.sidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Job Title</th>
                                    <th>Company Name</th>
                                    <th>Status</th>
                                    <th>Cover Letter</th>
                                    <th class="w-100">View Job</th>
                                </tr>
                     
                                @foreach ($applied_jobs as $item)             
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->rJob->title }}</td>
                                        <td>{{ $item->rJob->rCompany->company_name }}</td>
                                        <td>
                                            @if ($item->status == 'Applied')
                                                @php $color = 'primary'; @endphp
                                            @elseif ($item->status == 'Approved')
                                                @php $color = 'success'; @endphp
                                            @elseif($item->status == 'Rejected')
                                                @php $color = 'danger'; @endphp
                                            @endif
                                            <div class="badge bg-{{ $color }}">{{ $item->status }}</div>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $loop->iteration }}">Cover Letter</a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel{{ $loop->iteration }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel{{ $loop->iteration }}">Cover Letter</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ nl2br($item->cover_letter) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('job_detail', $item->job_id) }}"
                                                class="btn btn-secondary btn-sm text-white">
                                                <i class="fas fa-eye"></i>
                                            </a>
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
