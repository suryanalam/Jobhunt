<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        
        <div class="sidebar-brand">
            <a href="{{ route('admin_home') }}">Admin Panel</a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_home') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/home') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('admin_home') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-title="Dashboard">
                    <i class="fas fa-hand-point-right"></i> 
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item dropdown {{ 
                    Request::is('admin/home-page') || Request::is('admin/faq-page') ||
                    Request::is('admin/blog-page') || Request::is('admin/term-page') ||
                    Request::is('admin/privacy-page') || Request::is('admin/contact-page') ||
                    Request::is('admin/job-category-page') || Request::is('admin/pricing-page') ||
                    Request::is('admin/other-page') ? 'active' : '' 
                }}"
             >
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Page Settings</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/home-page') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('admin_home_page') }}">
                            <i class="fas fa-angle-right"></i>Home
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/faq-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_faq_page') }}">
                            <i class="fas fa-angle-right"></i>FAQ
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/blog-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_blog_page') }}">
                            <i class="fas fa-angle-right"></i>Blog
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/term-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_term_page') }}">
                            <i class="fas fa-angle-right"></i>Terms of Use 
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/privacy-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_privacy_page') }}">
                            <i class="fas fa-angle-right"></i>Privacy Policy
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/contact-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_contact_page') }}">
                            <i class="fas fa-angle-right"></i>Contact
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/job-category-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_category_page') }}">
                            <i class="fas fa-angle-right"></i>Job Categories
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/pricing-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_pricing_page') }}">
                            <i class="fas fa-angle-right"></i>Pricing
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/other-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_other_page') }}">
                            <i class="fas fa-angle-right"></i>Other
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown {{ 
                    Request::is('admin/job-category/*') || Request::is('admin/job-location/*') ||
                    Request::is('admin/job-type/*') || Request::is('admin/job-experience/*') ||
                    Request::is('admin/job-gender/*') || Request::is('admin/job-salary-range/*')
                    ? 'active' : '' }}"
             >
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i>
                    <span>Job Section</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/job-category/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_category') }}"><i class="fas fa-angle-right"></i>
                            Job Category
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/job-location/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_location') }}"><i class="fas fa-angle-right"></i>
                            Job Location
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/job-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_type') }}"><i class="fas fa-angle-right"></i>
                            Job Types
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/job-experience/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_experience') }}"><i class="fas fa-angle-right"></i>
                            Job Experience
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/job-gender/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_gender') }}"><i class="fas fa-angle-right"></i>
                            Job Gender
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/job-salary-range/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_job_salary_range') }}"><i class="fas fa-angle-right"></i>
                            Job Salary Range
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ 
                Request::is('admin/company-location/*') || Request::is('admin/company-industry/*') ||
                Request::is('admin/company-size/*') ? 'active' : '' }}"
                >
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i>
                    <span>Company Section</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/company-location/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_company_location') }}"><i class="fas fa-angle-right"></i>
                            Company Location
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/company-industry/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_company_industry') }}"><i class="fas fa-angle-right"></i>
                            Company Industry
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/company-size/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_company_size') }}"><i class="fas fa-angle-right"></i>
                            Company Size
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/why-choose/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_why_choose_item') }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-title="Why Choose Items"><i class="fas fa-hand-point-right"></i>
                    <span>Why Choose Items</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/testimonial/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_testimonial') }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-title="Testimonials"><i class="fas fa-hand-point-right"></i>
                    <span>Testimonials</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/post/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_post') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-title="Posts"><i class="fas fa-hand-point-right"></i>
                    <span>Posts</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/faq/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_faq') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-title="FAQs"><i class="fas fa-hand-point-right"></i>
                    <span>FAQ</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/package/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_package') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-title="Packages"><i class="fas fa-hand-point-right"></i>
                    <span>Packages</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
