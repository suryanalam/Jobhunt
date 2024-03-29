<?php

use Illuminate\Support\Facades\Route;

/* Front */
use App\Http\Controllers\Front\SignupController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\Front\ForgetPasswordController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\JobCategoryController;
use App\Http\Controllers\Front\JobListingController;
use App\Http\Controllers\Front\CompanyListingController;
use App\Http\Controllers\Front\PricingController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\TermsController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\SubscriberController;

/* Company */
use App\Http\Controllers\Company\CompanyController;

/* Candidate */
use App\Http\Controllers\Candidate\CandidateController;

/* Admin */
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;

use App\Http\Controllers\Admin\AdminHomePageController;
use App\Http\Controllers\Admin\AdminJobListingPageController;
use App\Http\Controllers\Admin\AdminCompanyListingPageController;
use App\Http\Controllers\Admin\AdminPricingPageController;
use App\Http\Controllers\Admin\AdminFaqPageController;
use App\Http\Controllers\Admin\AdminBlogPageController;
use App\Http\Controllers\Admin\AdminContactPageController;
use App\Http\Controllers\Admin\AdminTermPageController;
use App\Http\Controllers\Admin\AdminPrivacyPageController;
use App\Http\Controllers\Admin\AdminAuthPageController;
use App\Http\Controllers\Admin\AdminJobCategoryPageController;

use App\Http\Controllers\Admin\AdminJobCategoryController;
use App\Http\Controllers\Admin\AdminJobLocationController;
use App\Http\Controllers\Admin\AdminJobTypeController;
use App\Http\Controllers\Admin\AdminJobExperienceController;
use App\Http\Controllers\Admin\AdminJobGenderController;
use App\Http\Controllers\Admin\AdminJobSalaryRangeController;

use App\Http\Controllers\Admin\AdminCompanyLocationController;
use App\Http\Controllers\Admin\AdminCompanyIndustryController;
use App\Http\Controllers\Admin\AdminCompanySizeController;

use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminWhyChooseController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminAdvertisementController;
use App\Http\Controllers\Admin\AdminSettingController;

/* Front */
Route::get('signup',[SignupController::class, 'index'])->name('signup');
Route::get('login',[LoginController::class, 'index'])->name('login');

Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('job-listing',[JobListingController::class, 'index'])->name('job_listing');
Route::get('job/{id}',[JobListingController::class, 'detail'])->name('job_detail');
Route::get('job-categories',[JobCategoryController::class, 'index'])->name('job_categories');
Route::post('job/enquery',[JobListingController::class, 'job_enquery'])->name('job_enquery');

Route::get('company-listing',[CompanyListingController::class, 'index'])->name('company_listing');
Route::get('company-detail/{id}',[CompanyListingController::class, 'detail'])->name('company_detail');
Route::post('company/enquery',[CompanyListingController::class, 'company_enquery'])->name('company_enquery');

Route::get('pricing',[PricingController::class, 'index'])->name('pricing');
Route::get('faq',[FaqController::class, 'index'])->name('faq');
Route::get('blog',[BlogController::class, 'index'])->name('blog');
Route::get('post/{slug}',[BlogController::class, 'detail'])->name('post');
Route::get('contact',[ContactController::class, 'index'])->name('contact');
Route::post('contact/submit',[ContactController::class, 'submit'])->name('contact_submit');
Route::get('terms-of-use',[TermsController::class, 'index'])->name('terms');
Route::get('privacy-policy',[PrivacyController::class, 'index'])->name('privacy');
Route::post('subscriber/add',[SubscriberController::class, 'store'])->name('subscriber_add');
Route::get('subscriber/verify/{token}/{email}',[SubscriberController::class, 'verify'])->name('subscriber_verify');

/* Company */
Route::post('company/signup',[SignupController::class, 'company_signup'])->name('company_signup');
Route::get('company/signup-verify/{token}/{email}',[SignupController::class, 'company_signup_verify'])->name('company_signup_verify');
Route::post('company/login',[LoginController::class, 'company_login'])->name('company_login');

Route::get('company/forget-password',[ForgetPasswordController::class, 'company_forget_password'])->name('company_forget_password');
Route::post('company/forget-password-submit',[ForgetPasswordController::class, 'company_forget_password_submit'])->name('company_forget_password_submit');
Route::get('company/reset-password/{token}/{email}',[ForgetPasswordController::class, 'company_reset_password'])->name('company_reset_password');
Route::post('company/reset-password-submit',[ForgetPasswordController::class, 'company_reset_password_submit'])->name('company_reset_password_submit');

Route::middleware(['company:company'])->group(function () {

    Route::get('company/dashboard',[CompanyController::class,'dashboard'])->name('company_dashboard');
    Route::get('company/make-payment',[CompanyController::class,'make_payment'])->name('company_make_payment');
    Route::get('company/orders',[CompanyController::class,'orders'])->name('company_orders');

    Route::get('company/job',[CompanyController::class,'job'])->name('company_job');
    Route::get('company/job/create',[CompanyController::class,'job_create'])->name('company_job_create');
    Route::post('company/job/store',[CompanyController::class,'job_store'])->name('company_job_store');
    Route::get('company/job/edit/{id}',[CompanyController::class,'job_edit'])->name('company_job_edit');
    Route::post('company/job/update',[CompanyController::class,'job_update'])->name('company_job_update');
    Route::get('company/job/delete/{id}',[CompanyController::class,'job_delete'])->name('company_job_delete');

    Route::get('company/photos',[CompanyController::class,'photos'])->name('company_photos');
    Route::post('company/photos/submit',[CompanyController::class,'photo_submit'])->name('company_photo_submit');
    Route::get('company/photos/delete/{id}',[CompanyController::class,'photo_delete'])->name('company_photo_delete');

    Route::get('company/videos',[CompanyController::class,'videos'])->name('company_videos');
    Route::post('company/videos/submit',[CompanyController::class,'video_submit'])->name('company_video_submit');
    Route::get('company/videos/delete/{id}',[CompanyController::class,'video_delete'])->name('company_video_delete');
  
    Route::get('company/candidate-application',[CompanyController::class,'candidate_application'])->name('company_candidate_application');
    Route::get('company/job-applicants/{id}',[CompanyController::class,'job_applicants'])->name('company_job_applicants');
    Route::get('company/applicant-details/{id}',[CompanyController::class,'applicant_details'])->name('company_applicant_details');
    Route::post('company/applicant-status/update',[CompanyController::class,'applicant_status_update'])->name('applicant_status_update');

    Route::get('company/profile/edit',[CompanyController::class,'profile_edit'])->name('company_profile_edit');
    Route::post('company/profile/update',[CompanyController::class,'profile_update'])->name('company_profile_update');

    Route::get('company/change-password',[CompanyController::class,'change_password'])->name('company_change_password');
    Route::post('company/change-password/update',[CompanyController::class,'change_password_update'])->name('company_change_password_update');

    Route::get('company/logout',[LoginController::class, 'company_logout'])->name('company_logout');

    /* PayPal */
    Route::post('company/paypal/payment', [CompanyController::class, 'paypal'])->name('company_paypal');
    Route::get('company/paypal/success', [CompanyController::class, 'paypal_success'])->name('company_paypal_success');
    Route::get('company/paypal/cancel', [CompanyController::class, 'paypal_cancel'])->name('company_paypal_cancel');

    /* Stripe */
    Route::post('company/stripe/payment', [CompanyController::class, 'stripe'])->name('company_stripe');
    Route::get('company/stripe/success', [CompanyController::class, 'stripe_success'])->name('company_stripe_success');
    Route::get('company/stripe/cancel', [CompanyController::class, 'stripe_cancel'])->name('company_stripe_cancel');
});

/* Candidate */

Route::post('candidate/signup',[SignupController::class, 'candidate_signup'])->name('candidate_signup');
Route::get('candidate/signup-verify/{token}/{email}',[SignupController::class, 'candidate_signup_verify'])->name('candidate_signup_verify');
Route::post('candidate/login',[LoginController::class, 'candidate_login'])->name('candidate_login');

Route::get('candidate/forget-password',[ForgetPasswordController::class, 'candidate_forget_password'])->name('candidate_forget_password');
Route::post('candidate/forget-password-submit',[ForgetPasswordController::class, 'candidate_forget_password_submit'])->name('candidate_forget_password_submit');
Route::get('/candidate/reset-password/{token}/{email}',[ForgetPasswordController::class, 'candidate_reset_password'])->name('candidate_reset_password');
Route::post('/candidate/reset-password-submit',[ForgetPasswordController::class, 'candidate_reset_password_submit'])->name('candidate_reset_password_submit');

Route::middleware(['candidate:candidate'])->group(function () {
    Route::get('candidate/dashboard',[CandidateController::class,'dashboard'])->name('candidate_dashboard');

    Route::get('candidate/education',[CandidateController::class,'education'])->name('candidate_education');
    Route::get('candidate/education/create',[CandidateController::class,'education_create'])->name('candidate_education_create');
    Route::post('candidate/education/store',[CandidateController::class,'education_store'])->name('candidate_education_store');
    Route::get('candidate/education/edit/{id}',[CandidateController::class,'education_edit'])->name('candidate_education_edit');
    Route::post('candidate/education/update',[CandidateController::class,'education_update'])->name('candidate_education_update');
    Route::get('candidate/education/delete/{id}',[CandidateController::class,'education_delete'])->name('candidate_education_delete');

    Route::get('/candidate/skill',[CandidateController::class,'skill'])->name('candidate_skill');
    Route::get('/candidate/skill/create',[CandidateController::class, 'skill_create'])->name('candidate_skill_create');
    Route::post('/candidate/skill/store',[CandidateController::class, 'skill_store'])->name('candidate_skill_store');
    Route::get('/candidate/skill/edit/{id}',[CandidateController::class, 'skill_edit'])->name('candidate_skill_edit');
    Route::post('/candidate/skill/update/{id}',[CandidateController::class, 'skill_update'])->name('candidate_skill_update');
    Route::get('/candidate/skill/delete/{id}',[CandidateController::class, 'skill_delete'])->name('candidate_skill_delete');

    Route::get('/candidate/experience',[CandidateController::class,'experience'])->name('candidate_experience');
    Route::get('/candidate/experience/create',[CandidateController::class, 'experience_create'])->name('candidate_experience_create');
    Route::post('/candidate/experience/store',[CandidateController::class, 'experience_store'])->name('candidate_experience_store');
    Route::get('/candidate/experience/edit/{id}',[CandidateController::class, 'experience_edit'])->name('candidate_experience_edit');
    Route::post('/candidate/experience/update/{id}',[CandidateController::class, 'experience_update'])->name('candidate_experience_update');
    Route::get('/candidate/experience/delete/{id}',[CandidateController::class, 'experience_delete'])->name('candidate_experience_delete');

    Route::get('candidate/award',[CandidateController::class,'award'])->name('candidate_award');
    Route::get('candidate/award/create',[CandidateController::class,'award_create'])->name('candidate_award_create');
    Route::post('candidate/award/store',[CandidateController::class,'award_store'])->name('candidate_award_store');
    Route::get('candidate/award/edit/{id}',[CandidateController::class,'award_edit'])->name('candidate_award_edit');
    Route::post('candidate/award/update',[CandidateController::class,'award_update'])->name('candidate_award_update');
    Route::get('candidate/award/delete/{id}',[CandidateController::class,'award_delete'])->name('candidate_award_delete');

    Route::get('candidate/resume',[CandidateController::class,'resume'])->name('candidate_resume');
    Route::get('candidate/resume/create',[CandidateController::class,'resume_create'])->name('candidate_resume_create');
    Route::post('candidate/resume/store',[CandidateController::class,'resume_store'])->name('candidate_resume_store');
    Route::get('candidate/resume/edit/{id}',[CandidateController::class,'resume_edit'])->name('candidate_resume_edit');
    Route::post('candidate/resume/update',[CandidateController::class,'resume_update'])->name('candidate_resume_update');
    Route::get('candidate/resume/delete/{id}',[CandidateController::class,'resume_delete'])->name('candidate_resume_delete');

    Route::get('candidate/profile/edit',[CandidateController::class,'profile_edit'])->name('candidate_profile_edit');
    Route::post('candidate/profile/update',[CandidateController::class,'profile_update'])->name('candidate_profile_update');

    Route::get('candidate/change-password',[CandidateController::class,'change_password'])->name('candidate_change_password');
    Route::post('candidate/change-password/update',[CandidateController::class,'change_password_update'])->name('candidate_change_password_update');

    Route::get('candidate/bookmarked-jobs',[CandidateController::class,'bookmarked_jobs'])->name('candidate_bookmarked_jobs');
    Route::get('candidate/bookmark-add/{id}',[CandidateController::class,'bookmark_add'])->name('candidate_bookmark_add');
    Route::get('candidate/bookmark-delete/{id}',[CandidateController::class,'bookmark_delete'])->name('candidate_bookmark_delete');

    Route::get('candidate/job-apply/{id}',[CandidateController::class,'job_apply'])->name('candidate_job_apply');
    Route::post('candidate/job-apply-submit',[CandidateController::class,'job_apply_submit'])->name('candidate_job_apply_submit');

    Route::get('candidate/applied-jobs',[CandidateController::class,'applied_jobs'])->name('candidate_applied_jobs');

    Route::get('candidate/logout',[LoginController::class, 'candidate_logout'])->name('candidate_logout');
});

/* Admin */

// Authentication Routes
Route::get('/admin/login',[AdminLoginController::class, 'index'])->name('admin_login');
Route::post('/admin/login-submit',[AdminLoginController::class, 'login_submit'])->name('admin_login_submit');

Route::get('/admin/forget-password',[AdminLoginController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit',[AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/admin/reset-password/{token}/{email}',[AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit',[AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::middleware(['admin:admin'])->group(function () {
    Route::get('/admin/logout',[AdminLoginController::class, 'logout'])->name('admin_logout');

    Route::get('/admin/home',[AdminHomeController::class, 'index'])->name('admin_home');

    Route::get('/admin/edit-profile',[AdminProfileController::class, 'index'])->name('admin_profile');
    Route::post('/admin/edit-profile-submit',[AdminProfileController::class, 'profile_submit'])->name('admin_profile_submit');

    Route::get('/admin/home-page',[AdminHomePageController::class, 'index'])->name('admin_home_page');
    Route::post('/admin/home-page/update',[AdminHomePageController::class, 'update'])->name('admin_home_page_update');

    Route::get('/admin/job-listing-page',[AdminJobListingPageController::class, 'index'])->name('admin_job_listing_page');
    Route::post('/admin/job-listing-page/update',[AdminJobListingPageController::class, 'update'])->name('admin_job_listing_page_update');

    Route::get('/admin/company-listing-page',[AdminCompanyListingPageController::class, 'index'])->name('admin_company_listing_page');
    Route::post('/admin/company-listing-page/update',[AdminCompanyListingPageController::class, 'update'])->name('admin_company_listing_page_update');

    Route::get('/admin/pricing-page',[AdminPricingPageController::class, 'index'])->name('admin_pricing_page');
    Route::post('/admin/pricing-page/update',[AdminPricingPageController::class, 'update'])->name('admin_pricing_page_update');

    Route::get('/admin/faq-page',[AdminFaqPageController::class, 'index'])->name('admin_faq_page');
    Route::post('/admin/faq-page/update',[AdminFaqPageController::class, 'update'])->name('admin_faq_page_update');

    Route::get('/admin/blog-page',[AdminBlogPageController::class, 'index'])->name('admin_blog_page');
    Route::post('/admin/blog-page/update',[AdminBlogPageController::class, 'update'])->name('admin_blog_page_update');

    Route::get('/admin/contact-page',[AdminContactPageController::class, 'index'])->name('admin_contact_page');
    Route::post('/admin/contact-page/update',[AdminContactPageController::class, 'update'])->name('admin_contact_page_update');

    Route::get('/admin/term-page',[AdminTermPageController::class, 'index'])->name('admin_term_page');
    Route::post('/admin/term-page/update',[AdminTermPageController::class, 'update'])->name('admin_term_page_update');

    Route::get('/admin/privacy-page',[AdminPrivacyPageController::class, 'index'])->name('admin_privacy_page');
    Route::post('/admin/privacy-page/update',[AdminPrivacyPageController::class, 'update'])->name('admin_privacy_page_update');

    Route::get('/admin/auth-page',[AdminAuthPageController::class, 'index'])->name('admin_auth_page');
    Route::post('/admin/auth-page/update',[AdminAuthPageController::class, 'update'])->name('admin_auth_page_update');

    Route::get('/admin/job-category-page',[AdminJobCategoryPageController::class, 'index'])->name('admin_job_category_page');
    Route::post('/admin/job-category-page/update',[AdminJobCategoryPageController::class, 'update'])->name('admin_job_category_page_update');


    Route::get('/admin/job-category/view',[AdminJobCategoryController::class, 'index'])->name('admin_job_category');
    Route::get('/admin/job-category/create',[AdminJobCategoryController::class, 'create'])->name('admin_job_category_create');
    Route::post('/admin/job-category/store',[AdminJobCategoryController::class, 'store'])->name('admin_job_category_store');
    Route::get('/admin/job-category/edit/{id}',[AdminJobCategoryController::class, 'edit'])->name('admin_job_category_edit');
    Route::post('/admin/job-category/update/{id}',[AdminJobCategoryController::class, 'update'])->name('admin_job_category_update');
    Route::get('/admin/job-category/delete/{id}',[AdminJobCategoryController::class, 'delete'])->name('admin_job_category_delete');

    Route::get('/admin/job-location/view',[AdminJobLocationController::class, 'index'])->name('admin_job_location');
    Route::get('/admin/job-location/create',[AdminJobLocationController::class, 'create'])->name('admin_job_location_create');
    Route::post('/admin/job-location/store',[AdminJobLocationController::class, 'store'])->name('admin_job_location_store');
    Route::get('/admin/job-location/edit/{id}',[AdminJobLocationController::class, 'edit'])->name('admin_job_location_edit');
    Route::post('/admin/job-location/update/{id}',[AdminJobLocationController::class, 'update'])->name('admin_job_location_update');
    Route::get('/admin/job-location/delete/{id}',[AdminJobLocationController::class, 'delete'])->name('admin_job_location_delete');

    Route::get('/admin/job-type/view',[AdminJobTypeController::class, 'index'])->name('admin_job_type');
    Route::get('/admin/job-type/create',[AdminJobTypeController::class, 'create'])->name('admin_job_type_create');
    Route::post('/admin/job-type/store',[AdminJobTypeController::class, 'store'])->name('admin_job_type_store');
    Route::get('/admin/job-type/edit/{id}',[AdminJobTypeController::class, 'edit'])->name('admin_job_type_edit');
    Route::post('/admin/job-type/update/{id}',[AdminJobTypeController::class, 'update'])->name('admin_job_type_update');
    Route::get('/admin/job-type/delete/{id}',[AdminJobTypeController::class, 'delete'])->name('admin_job_type_delete');

    Route::get('/admin/job-experience/view',[AdminJobExperienceController::class, 'index'])->name('admin_job_experience');
    Route::get('/admin/job-experience/create',[AdminJobExperienceController::class, 'create'])->name('admin_job_experience_create');
    Route::post('/admin/job-experience/store',[AdminJobExperienceController::class, 'store'])->name('admin_job_experience_store');
    Route::get('/admin/job-experience/edit/{id}',[AdminJobExperienceController::class, 'edit'])->name('admin_job_experience_edit');
    Route::post('/admin/job-experience/update/{id}',[AdminJobExperienceController::class, 'update'])->name('admin_job_experience_update');
    Route::get('/admin/job-experience/delete/{id}',[AdminJobExperienceController::class, 'delete'])->name('admin_job_experience_delete');

    Route::get('/admin/job-gender/view',[AdminJobGenderController::class, 'index'])->name('admin_job_gender');
    Route::get('/admin/job-gender/create',[AdminJobGenderController::class, 'create'])->name('admin_job_gender_create');
    Route::post('/admin/job-gender/store',[AdminJobGenderController::class, 'store'])->name('admin_job_gender_store');
    Route::get('/admin/job-gender/edit/{id}',[AdminJobGenderController::class, 'edit'])->name('admin_job_gender_edit');
    Route::post('/admin/job-gender/update/{id}',[AdminJobGenderController::class, 'update'])->name('admin_job_gender_update');
    Route::get('/admin/job-gender/delete/{id}',[AdminJobGenderController::class, 'delete'])->name('admin_job_gender_delete');

    Route::get('/admin/job-salary-range/view',[AdminJobSalaryRangeController::class, 'index'])->name('admin_job_salary_range');
    Route::get('/admin/job-salary-range/create',[AdminJobSalaryRangeController::class, 'create'])->name('admin_job_salary_range_create');
    Route::post('/admin/job-salary-range/store',[AdminJobSalaryRangeController::class, 'store'])->name('admin_job_salary_range_store');
    Route::get('/admin/job-salary-range/edit/{id}',[AdminJobSalaryRangeController::class, 'edit'])->name('admin_job_salary_range_edit');
    Route::post('/admin/job-salary-range/update/{id}',[AdminJobSalaryRangeController::class, 'update'])->name('admin_job_salary_range_update');
    Route::get('/admin/job-salary-range/delete/{id}',[AdminJobSalaryRangeController::class, 'delete'])->name('admin_job_salary_range_delete');


    Route::get('/admin/company-location/view',[AdminCompanyLocationController::class, 'index'])->name('admin_company_location');
    Route::get('/admin/company-location/create',[AdminCompanyLocationController::class, 'create'])->name('admin_company_location_create');
    Route::post('/admin/company-location/store',[AdminCompanyLocationController::class, 'store'])->name('admin_company_location_store');
    Route::get('/admin/company-location/edit/{id}',[AdminCompanyLocationController::class, 'edit'])->name('admin_company_location_edit');
    Route::post('/admin/company-location/update/{id}',[AdminCompanyLocationController::class, 'update'])->name('admin_company_location_update');
    Route::get('/admin/company-location/delete/{id}',[AdminCompanyLocationController::class, 'delete'])->name('admin_company_location_delete');

    Route::get('/admin/company-industry/view',[AdminCompanyIndustryController::class, 'index'])->name('admin_company_industry');
    Route::get('/admin/company-industry/create',[AdminCompanyIndustryController::class, 'create'])->name('admin_company_industry_create');
    Route::post('/admin/company-industry/store',[AdminCompanyIndustryController::class, 'store'])->name('admin_company_industry_store');
    Route::get('/admin/company-industry/edit/{id}',[AdminCompanyIndustryController::class, 'edit'])->name('admin_company_industry_edit');
    Route::post('/admin/company-industry/update/{id}',[AdminCompanyIndustryController::class, 'update'])->name('admin_company_industry_update');
    Route::get('/admin/company-industry/delete/{id}',[AdminCompanyIndustryController::class, 'delete'])->name('admin_company_industry_delete');

    Route::get('/admin/company-size/view',[AdminCompanySizeController::class, 'index'])->name('admin_company_size');
    Route::get('/admin/company-size/create',[AdminCompanySizeController::class, 'create'])->name('admin_company_size_create');
    Route::post('/admin/company-size/store',[AdminCompanySizeController::class, 'store'])->name('admin_company_size_store');
    Route::get('/admin/company-size/edit/{id}',[AdminCompanySizeController::class, 'edit'])->name('admin_company_size_edit');
    Route::post('/admin/company-size/update/{id}',[AdminCompanySizeController::class, 'update'])->name('admin_company_size_update');
    Route::get('/admin/company-size/delete/{id}',[AdminCompanySizeController::class, 'delete'])->name('admin_company_size_delete');

    Route::get('/admin/subscriber/view',[AdminSubscriberController::class, 'index'])->name('admin_subscriber_view');
    Route::get('/admin/subscriber/send-email',[AdminSubscriberController::class, 'send_email'])->name('admin_subscriber_send_email');
    Route::post('/admin/subscriber/send-email',[AdminSubscriberController::class, 'send_email_submit'])->name('admin_subscriber_send_email_submit');
    Route::get('/admin/subscriber/delete/{id}',[AdminSubscriberController::class, 'delete'])->name('admin_subscriber_delete');

    Route::get('/admin/why-choose/view',[AdminWhyChooseController::class, 'index'])->name('admin_why_choose_item');
    Route::get('/admin/why-choose/create',[AdminWhyChooseController::class, 'create'])->name('admin_why_choose_item_create');
    Route::post('/admin/why-choose/store',[AdminWhyChooseController::class, 'store'])->name('admin_why_choose_item_store');
    Route::get('/admin/why-choose/edit/{id}',[AdminWhyChooseController::class, 'edit'])->name('admin_why_choose_item_edit');
    Route::post('/admin/why-choose/update/{id}',[AdminWhyChooseController::class, 'update'])->name('admin_why_choose_item_update');
    Route::get('/admin/why-choose/delete/{id}',[AdminWhyChooseController::class, 'delete'])->name('admin_why_choose_item_delete');

    Route::get('/admin/testimonial/view',[AdminTestimonialController::class, 'index'])->name('admin_testimonial');
    Route::get('/admin/testimonial/create',[AdminTestimonialController::class, 'create'])->name('admin_testimonial_create');
    Route::post('/admin/testimonial/store',[AdminTestimonialController::class, 'store'])->name('admin_testimonial_store');
    Route::get('/admin/testimonial/edit/{id}',[AdminTestimonialController::class, 'edit'])->name('admin_testimonial_edit');
    Route::post('/admin/testimonial/update/{id}',[AdminTestimonialController::class, 'update'])->name('admin_testimonial_update');
    Route::get('/admin/testimonial/delete/{id}',[AdminTestimonialController::class, 'delete'])->name('admin_testimonial_delete');

    Route::get('/admin/post/view',[AdminPostController::class, 'index'])->name('admin_post');
    Route::get('/admin/post/create',[AdminPostController::class, 'create'])->name('admin_post_create');
    Route::post('/admin/post/store',[AdminPostController::class, 'store'])->name('admin_post_store');
    Route::get('/admin/post/edit/{id}',[AdminPostController::class, 'edit'])->name('admin_post_edit');
    Route::post('/admin/post/update/{id}',[AdminPostController::class, 'update'])->name('admin_post_update');
    Route::get('/admin/post/delete/{id}',[AdminPostController::class, 'delete'])->name('admin_post_delete');

    Route::get('/admin/faq/view',[AdminFaqController::class, 'index'])->name('admin_faq');
    Route::get('/admin/faq/create',[AdminFaqController::class, 'create'])->name('admin_faq_create');
    Route::post('/admin/faq/store',[AdminFaqController::class, 'store'])->name('admin_faq_store');
    Route::get('/admin/faq/edit/{id}',[AdminFaqController::class, 'edit'])->name('admin_faq_edit');
    Route::post('/admin/faq/update/{id}',[AdminFaqController::class, 'update'])->name('admin_faq_update');
    Route::get('/admin/faq/delete/{id}',[AdminFaqController::class, 'delete'])->name('admin_faq_delete');

    Route::get('/admin/package/view',[AdminPackageController::class, 'index'])->name('admin_package');
    Route::get('/admin/package/create',[AdminPackageController::class, 'create'])->name('admin_package_create');
    Route::post('/admin/package/store',[AdminPackageController::class, 'store'])->name('admin_package_store');
    Route::get('/admin/package/edit/{id}',[AdminPackageController::class, 'edit'])->name('admin_package_edit');
    Route::post('/admin/package/update/{id}',[AdminPackageController::class, 'update'])->name('admin_package_update');
    Route::get('/admin/package/delete/{id}',[AdminPackageController::class, 'delete'])->name('admin_package_delete');

    Route::get('/admin/advertisement',[AdminAdvertisementController::class, 'index'])->name('admin_advertisement');
    Route::post('/admin/advertisement/update',[AdminAdvertisementController::class, 'update'])->name('admin_advertisement_update');

    Route::get('/admin/setting',[AdminSettingController::class, 'index'])->name('admin_setting');
    Route::post('/admin/setting/update',[AdminSettingController::class, 'update'])->name('admin_setting_update');

});