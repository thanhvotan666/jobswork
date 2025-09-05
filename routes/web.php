<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('admin')->name('admin.')->middleware(['auth.guard:admin'])->group(function () {
    Route::resource('/', App\Http\Controllers\Admin\DashboardController::class);
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('candidates', App\Http\Controllers\Admin\UserController::class);
    Route::resource('employers', App\Http\Controllers\Admin\EmployerController::class);
    Route::resource('admins', App\Http\Controllers\Admin\AdminController::class);
    Route::resource('jobs', App\Http\Controllers\Admin\JobController::class);
    Route::get('logout', [App\Http\Controllers\Admin\PageController::class, 'logout'])->name('logout');
    Route::get('categories', [App\Http\Controllers\Admin\PageController::class, 'categories'])->name('categories');
    Route::resource('location_select', App\Http\Controllers\Admin\LocationSelectController::class);
    Route::resource('professions', App\Http\Controllers\Admin\ProfessionController::class);
    Route::resource('customer_care', App\Http\Controllers\Admin\CustomerCareController::class);
    Route::resource('payment_info', App\Http\Controllers\Admin\PaymentInfoController::class);
    Route::resource('footer', App\Http\Controllers\Admin\FooterController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('support_candidates', App\Http\Controllers\Admin\SupportCandidateController::class);
    Route::resource('employer_pending', App\Http\Controllers\Admin\EmployerPendingController::class);
    Route::resource('refresh_job', App\Http\Controllers\Admin\RefreshJobController::class);

});


Route::prefix('candidate')->name('candidate.')->middleware(['auth.guard:user'])->group(function () {
    Route::get('/logout_user', [PageController::class, 'logoutUser'])->name('logout_user');
    Route::resource('user', App\Http\Controllers\Candidate\UserController::class);
    Route::resource('saveds', App\Http\Controllers\Candidate\SavedController::class);
    Route::resource('applieds', App\Http\Controllers\Candidate\AppliedController::class);
    
    Route::get('', [App\Http\Controllers\Candidate\PageController::class, 'index'])->name('index');

});
Route::prefix('employer')->name('employer.')->middleware(['auth.guard:employer'])->group(function () {
    Route::resource('/dashboard', App\Http\Controllers\Employer\DashboardController::class);
    Route::resource('/jobs', App\Http\Controllers\Employer\JobController::class);
    Route::resource('/candidates', App\Http\Controllers\Employer\CandidateController::class);
    Route::resource('/orders', App\Http\Controllers\Employer\OrderController::class);
    Route::resource('/jobpoint', App\Http\Controllers\Employer\JobPointController::class);
    Route::resource('/support_candidates', App\Http\Controllers\Employer\SupportCandidateController::class);
    Route::get('contacted_candidate',[App\Http\Controllers\Employer\CandidateController::class,'contactedCandidate'])
        ->name('contacted_candidate');
    Route::get('search',[App\Http\Controllers\Employer\CandidateController::class,'search'])
        ->name('search');
    Route::get('/logout', [App\Http\Controllers\Employer\PageController::class, 'logout'])
        ->name('logout');
    Route::post('show_contact', [App\Http\Controllers\Employer\CandidateController::class, 'showContact'])
        ->name('show_contact');
    Route::post('show_contact_point', [App\Http\Controllers\Employer\CandidateController::class, 'showContactPoint'])
        ->name('show_contact_point');
    Route::post('show_contact_search', [App\Http\Controllers\Employer\CandidateController::class, 'showContactSearch'])
        ->name('show_contact_search');
    Route::post('show_contact_search_point', [App\Http\Controllers\Employer\CandidateController::class, 'showContactSearchPoint'])
        ->name('show_contact_search_point');
    Route::post('show_contact_view', [App\Http\Controllers\Employer\CandidateController::class, 'showContactView'])
        ->name('show_contact_view');
    Route::post('show_contact_view_point', [App\Http\Controllers\Employer\CandidateController::class, 'showContactViewPoint'])
        ->name('show_contact_view_point');
    Route::get('/candidate_statistics',[App\Http\Controllers\Employer\CandidateController::class, 'candidateStatistics'])
        ->name('candidate_statistics');
    Route::get('/download',[App\Http\Controllers\Employer\CandidateController::class, 'download'])
        ->name('download');
    Route::get('/downloadExcel',[App\Http\Controllers\Employer\CandidateController::class, 'downloadExcel'])
        ->name('downloadExcel');
    Route::get('vnpay',[App\Http\Controllers\Employer\PaymentController::class,'vnpay'])
        ->name('vnpay');
    Route::get('vnpay_return',[App\Http\Controllers\Employer\PaymentController::class,'vnpayReturn'])
        ->name('vnpayReturn');
    Route::get('payment_info',[App\Http\Controllers\Employer\PaymentInfoController::class,'index'])
        ->name('payment_info');
    
});

Route::get('admin/login', [App\Http\Controllers\Admin\PageController::class, 'login'])->name('admin.login');
Route::post('admin/check_login', [App\Http\Controllers\Admin\PageController::class, 'checkLogin'])->name('admin.check_login');

Route::post('candidate/check_login', [App\Http\Controllers\Candidate\PageController::class, 'checkLogin'])->name('candidate.check_login');
Route::post('candidate/check_register', [App\Http\Controllers\Candidate\PageController::class, 'checkRegister'])->name('candidate.check_register');

Route::get('employer', [App\Http\Controllers\Employer\PageController::class, 'index'])->name('employer.index');
Route::get('employer/login', [App\Http\Controllers\Employer\PageController::class, 'login'])->name('employer.login');

Route::post('employer/check_login', [App\Http\Controllers\Employer\PageController::class, 'checkLogin'])->name('employer.check_login');
Route::get('employer/register', [App\Http\Controllers\Employer\PageController::class, 'register'])->name('employer.register');
Route::post('employer/check_register', [App\Http\Controllers\Employer\PageController::class, 'checkRegister'])->name('employer.check_register');


Route::get('employers', [PageController::class, 'employers'])->name('employers');
Route::get('employers/{id}', [PageController::class, 'employer'])->name('employer');
Route::get('jobs', [PageController::class, 'jobs'])->name('jobs');
Route::get('jobs/{id}', [PageController::class, 'job'])->name('job');

Route::get('/', [App\Http\Controllers\Candidate\PageController::class, 'index'])->name('index');

Route::get('language/{language}', [App\Http\Controllers\LanguageController::class, 'index'])->name('language');

Route::resource('rv_user', App\Http\Controllers\RegistrationVerificationUserController::class);
Route::resource('rv_employer', App\Http\Controllers\RegistrationVerificationEmployerController::class);
Route::resource('fp_employer', App\Http\Controllers\ForgetPasswordEmployerController::class);
Route::resource('fp_user', App\Http\Controllers\ForgetPasswordUserController::class);
Route::post('get_google_employer', [App\Http\Controllers\GoogleEmployerController::class, 'getGoogleEmployer'])->name('get_google_employer');
Route::post('check_login_google_employer', [App\Http\Controllers\GoogleEmployerController::class, 'checkLoginGoogleEmployer'])->name('check_login_google_employer');

Route::post('/send-sms-otp', [SmsController::class, 'sendSmsOtp'])->name('send-sms-otp');
