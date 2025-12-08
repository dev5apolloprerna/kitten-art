<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\EBookController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TrialClassController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\StudentInquiryController;
use App\Http\Controllers\Admin\StudentAttendanceController;
use App\Http\Controllers\Admin\StudentRenewPlanController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\BannerController;


use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\StudentLoginController;
use App\Http\Controllers\Front\FrontStudentController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::fallback(function () {
     return view('errors.404');
});

Route::get('/login', function () {
    return redirect()->route('login');
});


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::get('/edit', [HomeController::class, 'EditProfile'])->name('EditProfile');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

Route::prefix('admin')->name('banner.')->middleware('auth')->group(function () {
    Route::any('banner', [BannerController::class,'index'])->name('index');
    Route::get('banner/create', [BannerController::class, 'create'])->name('create');
    Route::post('banner/store', [BannerController::class, 'store'])->name('store');
    Route::get('banner/edit/{id?}', [BannerController::class, 'edit'])->name('edit');
    Route::post('banner/update/{id?}', [BannerController::class, 'update'])->name('update');
    Route::delete('banner/delete', [BannerController::class, 'delete'])->name('destroy');
});

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

//Category
Route::prefix('admin')->name('category.')->middleware('auth')->group(function () {
    Route::any('category', [CategoryController::class,'index'])->name('index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('store');
    Route::get('category/edit/{id?}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('category/update/{id?}', [CategoryController::class, 'update'])->name('update');
    Route::delete('category/delete', [CategoryController::class, 'delete'])->name('delete');
});

//Plan
Route::prefix('admin')->name('plan.')->middleware('auth')->group(function () {
    Route::any('plan', [PlanController::class,'index'])->name('index');
    Route::get('plan/create', [PlanController::class, 'create'])->name('create');
    Route::post('plan/store', [PlanController::class, 'store'])->name('store');
    Route::get('plan/edit/{id?}', [PlanController::class, 'edit'])->name('edit');
    Route::post('plan/update/{id?}', [PlanController::class, 'update'])->name('update');
    Route::delete('plan/delete', [PlanController::class, 'delete'])->name('delete');
});


//Batch
Route::prefix('admin')->name('batch.')->middleware('auth')->group(function () {
    Route::any('batch', [BatchController::class,'index'])->name('index');
    Route::get('batch/create', [BatchController::class, 'create'])->name('create');
    Route::post('batch/store', [BatchController::class, 'store'])->name('store');
    Route::get('batch/edit/{id?}', [BatchController::class, 'edit'])->name('edit');
    Route::post('batch/update/{id?}', [BatchController::class, 'update'])->name('update');
    Route::delete('batch/delete/{id?}', [BatchController::class, 'destroy'])->name('destroy');
});

//Student
Route::prefix('admin')->name('student.')->middleware('auth')->group(function () {
    Route::any('student', [StudentController::class,'index'])->name('index');
    Route::get('student/create', [StudentController::class, 'create'])->name('create');
    Route::post('student/store', [StudentController::class, 'store'])->name('store');
    Route::get('student/edit/{id?}', [StudentController::class, 'edit'])->name('edit');
    Route::get('student/active-edit/{id?}', [StudentController::class, 'activeEdit'])->name('activeEdit');
    Route::post('student/update/{id?}', [StudentController::class, 'update'])->name('update');
    Route::delete('student/delete', [StudentController::class, 'delete'])->name('delete');
    Route::get('student/view/{id?}', [StudentController::class, 'view'])->name('view');
    Route::post('student/payment-request', [StudentController::class, 'payment_request'])->name('paymentRequest');
    Route::get('student/active-student-view/{id?}', [StudentController::class, 'active_student_view'])->name('active_student_view');


    Route::any('student/register-student', [StudentController::class,'register_student'])->name('register_student');
    Route::any('student/active-student', [StudentController::class,'active_student'])->name('active_student');
    Route::any('student/inactive-student', [StudentController::class,'inactive_student'])->name('inactive_student');
    Route::post('student/update-paid-student', [StudentController::class,'updatepaid_student'])->name('updatepaid_student');

    Route::get('student/get-batch/{category_id}', [StudentController::class, 'getBatch']);
    Route::get('student/get-plan/{category_id}', [StudentController::class, 'getPlan']);
    Route::get('student/get-planAmount/{plan_id}', [StudentController::class, 'getPlanAmount']);


    Route::get('user/changepassword/{id?}', [StudentController::class, 'changepassword'])->name('changepassword');
    Route::post('user/updatepassword/{id?}', [StudentController::class, 'updatepassword'])->name('updatepassword');

});

//Student renew plan
Route::prefix('admin')->name('renewPlan.')->middleware('auth')->group(function () {
   

    Route::any('student-renewplan/renew_plan', [StudentRenewPlanController::class,'renew_plan'])->name('renew_plan');
    Route::post('student-renewplan/create/', [StudentRenewPlanController::class, 'create'])->name('create');

    Route::get('student-renewplan/get-batch/{category_id}', [StudentRenewPlanController::class, 'getBatch']);
    Route::get('student-renewplan/get-plan/{category_id}', [StudentRenewPlanController::class, 'getPlan']);
    Route::post('student-renewplan/updatestatus', [StudentRenewPlanController::class,'updatestatus'])->name('updatestatus');
    Route::get('student-renewplan/edit_renew_student/{id?}', [StudentRenewPlanController::class, 'edit_renew_student'])->name('edit_renew_student');
    Route::post('student-renewplan/update_renew_student/{id?}', [StudentRenewPlanController::class, 'update_renew_student'])->name('update_renew_student');
    Route::post('student-renewplan/student-submit-renew-plan', [StudentRenewPlanController::class, 'admin_submit_renew_plan'])->name('admin_submit_renew_plan');


});


//Student attendance
Route::prefix('admin')->name('attendance.')->middleware('auth')->group(function () {
    Route::any('student-attendance', [StudentAttendanceController::class,'index'])->name('index');
    Route::post('student-attendance/markAttended', [StudentAttendanceController::class, 'markAttended'])->name('markAttended');
    Route::post('student-attendance/markAbsent', [StudentAttendanceController::class, 'markAbsent'])->name('markAbsent');
    Route::post('student-attendance/store', [StudentAttendanceController::class, 'store'])->name('store');
    Route::post('student-attendance/edit', [StudentAttendanceController::class, 'edit'])->name('edit');
    Route::delete('student-attendance/delete', [StudentAttendanceController::class, 'delete'])->name('delete');
    Route::get('student-attendance/view/{id?}', [StudentAttendanceController::class, 'view'])->name('view');
    Route::get('student-attendance/get-batches-by-category', [StudentAttendanceController::class, 'getBatchesByCategory'])->name('get-batches-by-category');


});

//report
Route::prefix('admin')->name('report.')->middleware('auth')->group(function () {
    Route::any('report/upcoming_renew', [ReportController::class,'upcoming_renew'])->name('upcoming_renew');
    Route::any('report/upcoming_view/{id?}', [ReportController::class,'upcoming_view'])->name('upcoming_view');
    Route::any('report/attendance_report', [ReportController::class,'attendance_report'])->name('attendance_report');
    Route::any('report/edit_attendance', [ReportController::class,'editAttendance'])->name('editAttendance');
    Route::any('report/ajax_attendance_report', [ReportController::class,'ajax_attendance_report'])->name('ajax_attendance_report');
    Route::get('report/get-attendance-dates', [ReportController::class, 'getAttendanceDates'])->name('get-attendance-dates');
    Route::any('report/renewal_report', [ReportController::class,'renewal_report'])->name('renewal_report');

});

//Student Inquiry
Route::prefix('admin')->name('studentinquiry.')->middleware('auth')->group(function () {
    Route::any('student-inquiry', [StudentInquiryController::class,'index'])->name('index');
    Route::get('student-inquiry/edit/{id?}', [StudentInquiryController::class, 'edit'])->name('edit');
    Route::post('student-inquiry/update/{id?}', [StudentInquiryController::class, 'update'])->name('update');

    Route::delete('student-inquiry/delete', [StudentInquiryController::class, 'delete'])->name('delete');
    Route::get('student-inquiry/view/{id?}', [StudentInquiryController::class, 'view'])->name('view');
    Route::post('student-inquiry/update-status', [StudentInquiryController::class, 'updatestatus'])->name('updatestatus');


});

//Gallery
Route::prefix('admin')->name('gallery.')->middleware('auth')->group(function () {
    Route::any('gallery', [GalleryController::class,'index'])->name('index');
    Route::get('gallery/create', [GalleryController::class, 'create'])->name('create');
    Route::post('gallery/store', [GalleryController::class, 'store'])->name('store');
    Route::get('gallery/edit/{id?}', [GalleryController::class, 'edit'])->name('edit');
    Route::post('gallery/update/{id?}', [GalleryController::class, 'update'])->name('update');
    Route::delete('gallery/delete', [GalleryController::class, 'delete'])->name('delete');
});

//popup
Route::prefix('admin')->name('popupImage.')->middleware('auth')->group(function () {
    Route::any('popupImage', [GalleryController::class,'image'])->name('image');
    Route::get('popupImage/edit-image/{id?}', [GalleryController::class, 'editImage'])->name('editImage');
    Route::post('popupImage/update-image/{id?}', [GalleryController::class, 'updateImage'])->name('updateImage');
});

//Events
Route::prefix('admin')->name('events.')->middleware('auth')->group(function () {
    Route::any('events', [EventsController::class,'index'])->name('index');
    Route::get('events/create', [EventsController::class, 'create'])->name('create');
    Route::post('events/store', [EventsController::class, 'store'])->name('store');
    Route::get('events/edit/{id?}', [EventsController::class, 'edit'])->name('edit');
    Route::post('events/update/{id?}', [EventsController::class, 'update'])->name('update');
    Route::delete('events/delete', [EventsController::class, 'delete'])->name('delete');
});

//page
Route::prefix('admin')->name('page.')->middleware('auth')->group(function () {
    Route::any('page', [PageController::class,'index'])->name('index');
    Route::get('page/edit/{id?}', [PageController::class, 'edit'])->name('edit');
    Route::post('page/update/{id?}', [PageController::class, 'update'])->name('update');
});

//E-Book
Route::prefix('admin')->name('ebook.')->middleware('auth')->group(function () {
    Route::any('ebook', [EBookController::class,'index'])->name('index');
    Route::get('ebook/create', [EBookController::class, 'create'])->name('create');
    Route::post('ebook/store', [EBookController::class, 'store'])->name('store');
    Route::get('ebook/edit/{id?}', [EBookController::class, 'edit'])->name('edit');
    Route::post('ebook/update/{id?}', [EBookController::class, 'update'])->name('update');
    Route::delete('ebook/delete', [EBookController::class, 'delete'])->name('delete');
});

//testimonial
Route::prefix('admin')->name('testimonial.')->middleware('auth')->group(function () {
    Route::any('testimonial', [TestimonialController::class,'index'])->name('index');
    Route::get('testimonial/create', [TestimonialController::class, 'create'])->name('create');
    Route::post('testimonial/store', [TestimonialController::class, 'store'])->name('store');
    Route::get('testimonial/edit/{id?}', [TestimonialController::class, 'edit'])->name('edit');
    Route::post('testimonial/update/{id?}', [TestimonialController::class, 'update'])->name('update');
    Route::delete('testimonial/delete', [TestimonialController::class, 'delete'])->name('delete');
    Route::post('testimonial/update-status/{id?}', [TestimonialController::class, 'updatestatus'])->name('updatestatus');

});

//trialClass
Route::prefix('admin')->name('trialClass.')->middleware('auth')->group(function () {
    Route::any('trialClass', [TrialClassController::class,'index'])->name('index');
    Route::delete('trialClass/delete', [TrialClassController::class, 'delete'])->name('delete');
    Route::get('trialClass/view/{id?}', [TrialClassController::class, 'view'])->name('view');
    Route::post('trialClass/update-status', [TrialClassController::class, 'updatestatus'])->name('updatestatus');
    Route::post('trialClass/sendmail', [TrialClassController::class, 'sendmail'])->name('sendmail');

});

//service
Route::prefix('admin')->name('service.')->middleware('auth')->group(function () {
    Route::any('service', [ServiceController::class,'index'])->name('index');
    Route::get('service/create', [ServiceController::class, 'create'])->name('create');
    Route::post('service/store', [ServiceController::class, 'store'])->name('store');
    Route::get('service/edit/{id?}', [ServiceController::class, 'edit'])->name('edit');
    Route::post('service/update/{id?}', [ServiceController::class, 'update'])->name('update');
    Route::delete('service/delete', [ServiceController::class, 'delete'])->name('delete');
    Route::get('service/images/{id?}', [ServiceController::class, 'images'])->name('images');
    Route::post('service/uploadimages', [ServiceController::class, 'uploadimages'])->name('uploadimages');
    Route::delete('service/deleteImages', [ServiceController::class, 'deleteImages'])->name('deleteImages');

});

//inquiry
Route::prefix('admin')->name('Inquiry.')->middleware('auth')->group(function () {
        Route::get('Inquiry/index', [InquiryController::class, 'index'])->name('index');
        Route::delete('/Inquiry-delete', [InquiryController::class, 'delete'])->name('delete');
        Route::get('Inquiry/view/{id?}', [InquiryController::class, 'view'])->name('view');
});
/*---------------------------------------------admin route end-----------------------------------------------------*/



/*---------------------------------------------Front route end-----------------------------------------------------*/

Route::get('/', [FrontController::class, 'index'])->name('FrontIndex');
Route::get('/about-us', [FrontController::class, 'about'])->name('FrontAbout');
Route::any('/class', [FrontController::class, 'class'])->name('FrontClass');
Route::get('/class-detail/{id?}', [FrontController::class, 'class_detail'])->name('FrontClassDetail');

Route::get('/contact-us', [FrontController::class, 'contact'])->name('FrontContact');
Route::get('/get-batch/{category_id}', [FrontController::class, 'getBatch']);
Route::get('/get-plan/{category_id}', [FrontController::class, 'getPlan']);
Route::get('/get-plan-amount/{plan_id}', [FrontController::class, 'getPlanAmount']);
Route::post('/contact-store', [FrontController::class, 'contactStore'])->name('contactStore');

Route::get('/photo-gallery', [FrontController::class, 'gallery'])->name('FrontGallery');
Route::get('/trial-class', [FrontController::class, 'trial_class'])->name('FrontTrialClass');

Route::get('/event', [FrontController::class, 'events'])->name('FrontEvents');
Route::get('/event-detail/{id?}', [FrontController::class, 'event_detail'])->name('FrontEventsDetail');
Route::get('/event-calendar', [FrontController::class, 'event_calander'])->name('FrontEventCalander');

Route::get('/student-login', [FrontController::class, 'login'])->name('FrontLogin');
Route::post('/studentlogin', [StudentLoginController::class, 'studentlogin'])->name('FrontStudentLogin');
Route::get('/student-logout', [StudentLoginController::class, 'studentlogout'])->name('FrontStudentLogout');


Route::middleware(['auth:student', 'student.active'])->group(function () {
    Route::get('/student-dashboard', [FrontStudentController::class, 'student_dashboard'])->name('student_dashboard');
    Route::get('/student-active-plan', [FrontStudentController::class, 'student_active_plan'])->name('student_active_plan');
    Route::post('/student-submit-renew-plan', [FrontStudentController::class, 'student_submit_renew_plan'])->name('student_submit_renew_plan');
    Route::any('/student-renew-plan', [FrontStudentController::class, 'student_renew_plan'])->name('student_renew_plan');
    Route::get('/renew-subscription/{id?}', [FrontStudentController::class, 'renew_subscription'])->name('renew-subscription');
    Route::get('/student-profile', [FrontStudentController::class, 'student_profile'])->name('student_profile');
    Route::post('/student-update', [FrontStudentController::class, 'student_update'])->name('student_update');
    Route::get('/student_testimonial', [FrontStudentController::class, 'student_testimonial'])->name('student_testimonial');
    Route::post('/store-feedback', [FrontStudentController::class, 'storeFeedback'])->name('storeFeedback');
});

//Forgot-Password Page
Route::get('Forgot-Password', [StudentLoginController::class, 'forgotpassword'])->name('forgotpassword');
Route::post('forgotpassword', [StudentLoginController::class, 'forgotpasswordsubmit'])->name('forgotpasswordsubmit');

//New-Password Page
Route::get('New-Password/{token?}', [StudentLoginController::class, 'newpassword'])->name('newpassword');
Route::post('New-Password', [StudentLoginController::class, 'newpasswordsubmit'])->name('newpasswordsubmit');

//change password
Route::get('Change-Password', [StudentLoginController::class, 'changepassword'])->name('changepassword');
Route::post('Change-Password', [StudentLoginController::class, 'changepasswordsubmit'])->name('changepasswordsubmit');

Route::any('/Registration', [FrontController::class, 'registration'])->name('FrontRegistration');
Route::post('/student_registration', [FrontController::class, 'student_registration'])->name('student_registration');
Route::post('/trialclass_registration', [FrontController::class, 'trialclass_registration'])->name('trialclass_registration');


Route::get('/services', [FrontController::class, 'services'])->name('FrontService');
Route::get('/services-details/{slug?}', [FrontController::class, 'service_gallery'])->name('FrontServiceImages');
Route::post('/service_registration', [FrontController::class, 'service_registration'])->name('ServiceRegisteration');


Route::get('/blogs', [FrontController::class, 'blogs'])->name('FrontBlogs');
Route::get('/ebooks', [FrontController::class, 'ebooks'])->name('FrontEbooks');
Route::post('/ebook-registration', [FrontController::class, 'ebook_registration'])->name('FrontEbooksRegistration');
Route::get('/blogdetail', [FrontController::class, 'blogdetail'])->name('FrontBlogdetail');

Route::get('/classdetail', [FrontController::class, 'classdetail'])->name('FrontClassdetail');
Route::post('/event_registration', [FrontController::class, 'event_registration'])->name('EventRegisteration');

Route::get('/thankyou', [FrontController::class, 'thankyou1'])->name('FrontThankyou1');
Route::get('/thank_you', [FrontController::class, 'thankyou'])->name('FrontThankyou');
Route::get('/renewal_thank_you', [FrontController::class, 'renewal_thank_you'])->name('FrontrenewalThankyou');
Route::get('refresh_captcha', [FrontController::class,'refreshCaptcha'])->name('refresh_captcha');


Route::get('Privacy-Policy', [FrontController::class, 'privacypolicy'])->name('privacypolicy');
Route::get('Term-&-Condition', [FrontController::class, 'termandcondition'])->name('termandcondition');
Route::get('Supply-List', [FrontController::class, 'supply_list'])->name('supply_list');
Route::get('Payment-Information', [FrontController::class, 'payment_information'])->name('payment_information');

