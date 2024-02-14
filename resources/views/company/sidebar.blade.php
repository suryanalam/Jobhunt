<ul class="list-group list-group-flush">
    <li class="list-group-item {{ Request::is('company/dashboard') ? 'active' : '' }}">
        <a href="{{ route('company_dashboard') }}">Dashboard</a>
    </li>
    <li class="list-group-item {{ Request::is('company/make-payment') ? 'active' : '' }}">
        <a href="{{ route('company_make_payment') }}">Make Payment</a>
    </li>
    <li class="list-group-item {{ Request::is('company/orders') ? 'active' : '' }}">
        <a href="{{ route('company_orders') }}">Orders</a>
    </li>
    <li class="list-group-item {{ Request::is('company/job/create') ? 'active' : '' }}">
        <a href="{{ route('company_job_create') }}">Create Job</a>
    </li>
    <li class="list-group-item {{ Request::is('company/job') ? 'active' : '' }}">
        <a href="{{ route('company_job') }}">All Jobs</a>
    </li>
    <li class="list-group-item {{ Request::is('company/photos') ? 'active' : '' }}">
        <a href="{{ route('company_photos') }}">Photos</a>
    </li>
    <li class="list-group-item {{ Request::is('company/videos') ? 'active' : '' }}">
        <a href="{{ route('company_videos') }}">Videos</a>
    </li>
    <li class="list-group-item {{ Request::is('company/candidate-application') ? 'active' : '' }}">
        <a href="{{ route('company_candidate_application') }}">Candidate Applications</a>
    </li>
    <li class="list-group-item {{ Request::is('company/profile/edit') ? 'active' : '' }}">
        <a href="{{ route('company_profile_edit') }}">Edit Profile</a>
    </li>
    <li class="list-group-item {{ Request::is('company/change-password') ? 'active' : '' }}">
        <a href="{{ route('company_change_password') }}">Change Password</a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('company_logout') }}">Logout</a>
    </li>
</ul>
