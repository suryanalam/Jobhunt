<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\SignupController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\Front\ForgetPasswordController;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\JobCategoryController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\TermsController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\PricingController;

/* Company */
use App\Http\Controllers\Company\CompanyController;

/* Candidate */
use App\Http\Controllers\Candidate\CandidateController;

/* Admin */

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;

use App\Http\Controllers\Admin\AdminHomePageController;
use App\Http\Controllers\Admin\AdminFaqPageController;
use App\Http\Controllers\Admin\AdminBlogPageController;
use App\Http\Controllers\Admin\AdminTermPageController;
use App\Http\Controllers\Admin\AdminPrivacyPageController;
use App\Http\Controllers\Admin\AdminContactPageController;
use App\Http\Controllers\Admin\AdminJobCategoryPageController;
use App\Http\Controllers\Admin\AdminPricingPageController;
use App\Http\Controllers\Admin\AdminOtherPageController;

use App\Http\Controllers\Admin\AdminJobCategoryController;
use App\Http\Controllers\Admin\AdminWhyChooseController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminPackageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('signup',[SignupController::class, 'index'])->name('signup');
Route::get('login',[LoginController::class, 'index'])->name('login');

Route::get('job-categories',[JobCategoryController::class, 'categories'])->name('job_categories');
Route::get('blog',[BlogController::class, 'index'])->name('blog');
Route::get('post/{slug}',[BlogController::class, 'detail'])->name('post');
Route::get('faq',[FaqController::class, 'index'])->name('faq');
Route::get('pricing',[PricingController::class, 'index'])->name('pricing');
Route::get('terms-of-use',[TermsController::class, 'index'])->name('terms');
Route::get('privacy-policy',[PrivacyController::class, 'index'])->name('privacy');
Route::get('contact',[ContactController::class, 'index'])->name('contact');
Route::post('contact/submit',[ContactController::class, 'submit'])->name('contact_submit');

/* Company */

Route::post('company/signup',[SignupController::class, 'company_signup'])->name('company_signup');
Route::get('company/signup-verify/{token}/{email}',[SignupController::class, 'company_signup_verify'])->name('company_signup_verify');
Route::post('company/login',[LoginController::class, 'company_login'])->name('company_login');

Route::get('company/forget-password',[ForgetPasswordController::class, 'company_forget_password'])->name('company_forget_password');
Route::post('company/forget-password-submit',[ForgetPasswordController::class, 'company_forget_password_submit'])->name('company_forget_password_submit');
Route::get('/company/reset-password/{token}/{email}',[ForgetPasswordController::class, 'company_reset_password'])->name('company_reset_password');
Route::post('/company/reset-password-submit',[ForgetPasswordController::class, 'company_reset_password_submit'])->name('company_reset_password_submit');

Route::middleware(['company:company'])->group(function () {
    Route::get('company/logout',[LoginController::class, 'company_logout'])->name('company_logout');
    Route::get('company/dashboard',[CompanyController::class,'dashboard'])->name('company_dashboard');
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
    Route::get('candidate/logout',[LoginController::class, 'candidate_logout'])->name('candidate_logout');
    Route::get('candidate/dashboard',[CandidateController::class,'dashboard'])->name('candidate_dashboard');
});

/* Admin */

// Authentication Routes
Route::get('/admin/login',[AdminLoginController::class, 'index'])->name('admin_login');
Route::post('/admin/login-submit',[AdminLoginController::class, 'login_submit'])->name('admin_login_submit');

Route::get('/admin/forget-password',[AdminLoginController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit',[AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/admin/reset-password/{token}/{email}',[AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit',[AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

// Admin portal routes
Route::middleware(['admin:admin'])->group(function () {
    Route::get('/admin/logout',[AdminLoginController::class, 'logout'])->name('admin_logout');

    Route::get('/admin/home',[AdminHomeController::class, 'index'])->name('admin_home');

    Route::get('/admin/edit-profile',[AdminProfileController::class, 'index'])->name('admin_profile');
    Route::post('/admin/edit-profile-submit',[AdminProfileController::class, 'profile_submit'])->name('admin_profile_submit');

    Route::get('/admin/home-page',[AdminHomePageController::class, 'index'])->name('admin_home_page');
    Route::post('/admin/home-page/update',[AdminHomePageController::class, 'update'])->name('admin_home_page_update');

    Route::get('/admin/faq-page',[AdminFaqPageController::class, 'index'])->name('admin_faq_page');
    Route::post('/admin/faq-page/update',[AdminFaqPageController::class, 'update'])->name('admin_faq_page_update');

    Route::get('/admin/blog-page',[AdminBlogPageController::class, 'index'])->name('admin_blog_page');
    Route::post('/admin/blog-page/update',[AdminBlogPageController::class, 'update'])->name('admin_blog_page_update');

    Route::get('/admin/term-page',[AdminTermPageController::class, 'index'])->name('admin_term_page');
    Route::post('/admin/term-page/update',[AdminTermPageController::class, 'update'])->name('admin_term_page_update');

    Route::get('/admin/privacy-page',[AdminPrivacyPageController::class, 'index'])->name('admin_privacy_page');
    Route::post('/admin/privacy-page/update',[AdminPrivacyPageController::class, 'update'])->name('admin_privacy_page_update');

    Route::get('/admin/contact-page',[AdminContactPageController::class, 'index'])->name('admin_contact_page');
    Route::post('/admin/contact-page/update',[AdminContactPageController::class, 'update'])->name('admin_contact_page_update');

    Route::get('/admin/job-category-page',[AdminJobCategoryPageController::class, 'index'])->name('admin_job_category_page');
    Route::post('/admin/job-category-page/update',[AdminJobCategoryPageController::class, 'update'])->name('admin_job_category_page_update');

    Route::get('/admin/pricing-page',[AdminPricingPageController::class, 'index'])->name('admin_pricing_page');
    Route::post('/admin/pricing-page/update',[AdminPricingPageController::class, 'update'])->name('admin_pricing_page_update');

    Route::get('/admin/other-page',[AdminOtherPageController::class, 'index'])->name('admin_other_page');
    Route::post('/admin/other-page/update',[AdminOtherPageController::class, 'update'])->name('admin_other_page_update');

    Route::get('/admin/job-category/view',[AdminJobCategoryController::class, 'index'])->name('admin_job_category');
    Route::get('/admin/job-category/create',[AdminJobCategoryController::class, 'create'])->name('admin_job_category_create');
    Route::post('/admin/job-category/store',[AdminJobCategoryController::class, 'store'])->name('admin_job_category_store');
    Route::get('/admin/job-category/edit/{id}',[AdminJobCategoryController::class, 'edit'])->name('admin_job_category_edit');
    Route::post('/admin/job-category/update/{id}',[AdminJobCategoryController::class, 'update'])->name('admin_job_category_update');
    Route::get('/admin/job-category/delete/{id}',[AdminJobCategoryController::class, 'delete'])->name('admin_job_category_delete');

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

});