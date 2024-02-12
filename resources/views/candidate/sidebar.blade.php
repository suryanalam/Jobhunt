<ul class="list-group list-group-flush">
    <li class="list-group-item {{ Request::is('candidate/dashboard') ? 'active' : '' }}">
        <a href="{{ route('candidate_dashboard') }}">Dashboard</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/applied-jobs') ? 'active' : '' }}">
        <a href="{{ route('candidate_applied_jobs') }}">Applied Jobs</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/bookmarked-jobs') ? 'active' : '' }}">
        <a href="{{ route('candidate_bookmarked_jobs') }}">Bookmarked Jobs</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/education') ? 'active' : '' }}">
        <a href="{{ route('candidate_education') }}">Education</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/skill') ? 'active' : '' }}">
        <a href="{{ route('candidate_skill') }}">Skills</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/experience') ? 'active' : '' }}">
        <a href="{{ route('candidate_experience') }}">Work Experience</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/award') ? 'active' : '' }}">
        <a href="{{ route('candidate_award') }}">Awards</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/profile/edit') ? 'active' : '' }}">
        <a href="{{ route('candidate_profile_edit') }}">Edit Profile</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/change-password') ? 'active' : '' }}">
        <a href="{{ route('candidate_change_password') }}">Change Password</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/resume') ? 'active' : '' }}">
        <a href="{{ route('candidate_resume') }}">Resume Upload</a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('candidate_logout') }}">Logout</a>
    </li>
</ul>
