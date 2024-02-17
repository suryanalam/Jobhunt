<div class="top">
    <div class="container">
        <div class="row">
            <div class="col-md-6 left-side">
                <ul>
                    @if ($global_settings_data->top_bar_phone  != null)
                        <li class="phone-text">{{  $global_settings_data->top_bar_phone  }}</li>
                    @endif
                    @if ($global_settings_data->top_bar_email  != null)
                        <li class="email-text">{{  $global_settings_data->top_bar_email  }}</li>
                    @endif
                    
                </ul>
            </div>
            <div class="col-md-6 right-side">
                <ul class="right">
                    @if (Auth::guard('company')->check())
                        <li class="menu">
                            <a href="{{ route('company_dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                    @elseif(Auth::guard('candidate')->check())
                        <li class="menu">
                            <a href="{{ route('candidate_dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>                         
                    @else
                        <li class="menu">
                            <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                        </li>
                        <li class="menu">
                            <a href="{{ route('signup') }}"><i class="fas fa-user"></i> Sign Up</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>