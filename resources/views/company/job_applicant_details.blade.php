@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Applicant Details of "{{ $applicant_details->name }}"</h2>
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

                    <h4 class="resume">Basic Profile</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th class="w-200">Photo:</th>
                                <td>

                                    @if ($applicant_details->photo == '' || $applicant_details->photo == null)
                                        <img src="{{ asset('uploads/candidate_default_logo.png') }}" alt="candidate-photo"
                                            class="user-photo" />
                                    @else
                                        <img src="{{ asset("uploads/$applicant_details->photo") }}" alt=""
                                            class="w-100" />
                                    @endif


                                </td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>{{ $applicant_details->name }}</td>
                            </tr>
                            <tr>
                                <th>Designation:</th>
                                <td>{{ $applicant_details->designation }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $applicant_details->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $applicant_details->phone }}</td>
                            </tr>
                            <tr>
                                <th>Country:</th>
                                <td>{{ $applicant_details->country }}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ $applicant_details->address }}</td>
                            </tr>
                            <tr>
                                <th>State:</th>
                                <td>{{ $applicant_details->state }}</td>
                            </tr>
                            <tr>
                                <th>City:</th>
                                <td>{{ $applicant_details->city }}</td>
                            </tr>
                            <tr>
                                <th>Zip Code:</th>
                                <td>{{ $applicant_details->zip_code }}</td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td>{{ $applicant_details->gender }}</td>
                            </tr>
                            <tr>
                                <th>Marital Status:</th>
                                <td>{{ $applicant_details->marital_status }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth:</th>
                                <td>{{ $applicant_details->date_of_birth }}</td>
                            </tr>
                            <tr>
                                <th>Website:</th>
                                <td>{{ $applicant_details->website }}</td>
                            </tr>
                            <tr>
                                <th>Biography:</th>
                                <td>
                                    {!! $applicant_details->biography !!}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <h4 class="resume mt-5">Education</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Education Level</th>
                                    <th>Institute</th>
                                    <th>Degree</th>
                                    <th>Passing Year</th>
                                </tr>
                                @foreach ($applicant_educations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->level }}</td>
                                        <td>{{ $item->institute }}</td>
                                        <td>{{ $item->degree }}</td>
                                        <td>{{ $item->passing_year }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 class="resume mt-5">Skills</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Skill Name</th>
                                    <th>Percentage</th>
                                </tr>
                                @foreach ($applicant_skills as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->percentage }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 class="resume mt-5">Experience</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Company</th>
                                    <th>Designation</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                                @foreach ($applicant_experiences as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->company }}</td>
                                        <td>{{ $item->designation }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 class="resume mt-5">Awards</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                                @foreach ($applicant_awards as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 class="resume mt-5">Resume</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>File</th>
                                </tr>
                                @foreach ($applicant_resumes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ asset("uploads/$item->file") }}" target="_blank">{{ $item->file }}</a>
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
