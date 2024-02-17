<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="item">
                    <h2 class="heading">For Candidates</h2>
                    <ul class="useful-links">
                        <li><a href="{{ route('job_listing') }}">Browser Jobs</a></li>
                        <li><a href="{{ route('candidate_dashboard') }}">Candidate Dashboard</a></li>
                        <li><a href="{{ route('candidate_bookmarked_jobs') }}">Bookmarked Jobs</a></li>
                        <li><a href="{{ route('candidate_applied_jobs') }}">Applied Jobs</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="item">
                    <h2 class="heading">For Companies</h2>
                    <ul class="useful-links">
                        <li><a href="{{ route('company_listing') }}">Browser Companies</a></li>
                        <li><a href="{{ route('company_dashboard') }}">Company Dashboard</a></li>
                        <li><a href="{{ route('company_job_create') }}">Post New Job</a></li>
                        <li><a href="{{ route('company_candidate_application') }}">Candidate Applications</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="item">
                    <h2 class="heading">Contact</h2>
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="right">
                            {{ $global_settings_data->footer_address }}
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="right">{{ $global_settings_data->footer_phone }}</div>
                    </div>
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="right">{{ $global_settings_data->footer_email }}</div>
                    </div>
                    <ul class="social">
                        @if ($global_settings_data->footer_facebook != null)
                            <li>
                                <a href="{{ $global_settings_data->footer_facebook }}"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                        @endif
                        @if ($global_settings_data->footer_instagram != null)
                            <li>
                                <a href="{{ $global_settings_data->footer_instagram }}"><i
                                        class="fab fa-instagram"></i></a>
                            </li>
                        @endif
                        @if ($global_settings_data->footer_twitter != null)
                            <li>
                                <a href="{{ $global_settings_data->footer_twitter }}"><i
                                        class="fab fa-twitter"></i></a>
                            </li>
                        @endif

                        @if ($global_settings_data->footer_linkedin != null)
                            <li>
                                <a href="{{ $global_settings_data->footer_linkedin }}"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="item">
                    <h2 class="heading">Newsletter</h2>
                    <p>To get the latest news from our website, pleasesubscribe us here:</p>
                    <form action="{{ route('subscriber_add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Subscribe Now" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="copyright">
                    {{ $global_settings_data->footer_copyright_text }}
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="right">
                    <ul>
                        <li><a href="{{ route('terms') }}">Terms of Use</a></li>
                        <li>
                            <a href="{{ route('privacy') }}">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
