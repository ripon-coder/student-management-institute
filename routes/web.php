<?php
use Vinkla\Hashids\Facades\Hashids;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\userController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\batchController;
use App\Http\Controllers\studentManageController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\StaffsReport;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\TargetedCollectionMonthwiseController;
use App\Http\Controllers\paymentActivitiesController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\overviewController;
use App\Http\Controllers\StudentFeedbackController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\OurteamController;
use App\Http\Controllers\VideoReviewController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\AnnounceController;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;







Auth::routes();


Route::get('/per', function () {
    Artisan::call('backup:run --only-db');
    return $output = Artisan::output();
});



Route::get('/link', function () {
    

    // Storage::disk('dropbox')->put('file.txt', 'Hello laravel ');
    // return "done";
    //Artisan::call('storage:link');
});



Route::get('/optimize', function () {
     Artisan::call('optimize');
     return "Optimize Done";
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/scholarship-form', [HomeController::class, 'scholarshipForm'])->name('scholarshipForm');
Route::post('/scholarship-form', [HomeController::class, 'formstore'])->name('scholarshipFormstore');
Route::get('/congratulations', [HomeController::class, 'congratulations'])->name('congratulations');
Route::get('/error', [HomeController::class, 'error'])->name('error');
Route::get('/student-feedback', [HomeController::class, 'stFeedback'])->name('stFeedback');
Route::get('/review', [HomeController::class, 'review'])->name('review');
Route::get('/our-team', [HomeController::class, 'ourteam'])->name('ourteam');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/courses', [HomeController::class, 'courses'])->name('courses');
Route::get('/blog/{slug}', [HomeController::class, 'blogsinglePage'])->name('blog.single');
Route::post('/email-submit', [HomeController::class, 'emailsubmit']);
Route::get('/contact-us', [HomeController::class, 'contactus'])->name('contactus');
Route::post('/contact-submit', [HomeController::class, 'contactSubmit'])->name('contactSubmit');
Route::get('/about-us', [HomeController::class, 'aboutus'])->name('aboutus');


Route::group(['middleware'=>'auth','prefix' => 'dashboard'],function(){

    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
    
     Route::post('login-by-admin/{id}', [userController::class, 'loginbyadmin'])->name('loginbyadmin')->middleware(['role:Admin']);
    
    Route::resource('target', TargetedCollectionMonthwiseController::class)->middleware(['role:Admin']);;
    Route::resource('expense', ExpenseController::class)->middleware(['role:Admin']);;
    Route::get('/expense-date-search', [ExpenseController::class, 'datewiseSearch'])->name('datewiseSearch')->middleware(['role:Admin']);;
    Route::get('/expense-month-search', [ExpenseController::class, 'monthwiseSearch'])->name('monthwiseSearch')->middleware(['role:Admin']);;
    Route::get('/overview', [overviewController::class, 'overview'])->name('overview');
    Route::get('/month-wise-statement', [overviewController::class, 'monthstatement'])->name('monthstatement');


    // Export

    Route::get('/student-export', [studentManageController::class, 'studentExport'])->name('studentExport')->middleware(['role:Admin']);

    // Export End


    Route::resource('users', userController::class)->middleware(['role:Admin']);
    Route::resource('course', courseController::class)->middleware(['role:Admin']);
    Route::resource('batch', batchController::class)->middleware(['role:Admin']);



    // Batch Section
    
    Route::get('/fully-paid-batch/{id}', [batchController::class, 'fullypaidBatch'])->name('fullypaidbatch');
    Route::get('/due-paid-batch/{id}', [batchController::class, 'duepaidBatch'])->name('duepaidbatch');
    Route::get('/un-paid-batch/{id}', [batchController::class, 'unpaidBatch'])->name('unpaidbatch');
    
    Route::get('/get-student-by-batch/{id}', [batchController::class, 'get_student_by_batch']);
    Route::get('/get-mentor', [batchController::class, 'getMentor']);
    Route::get('/get-course', [batchController::class, 'getCourse']);
    Route::get('/get-batch/{id}', [batchController::class, 'getBatch']);
    Route::post('/update-batch/{id}', [batchController::class, 'updateBatch']);
    Route::get('/fully-paid-export/{id}', [batchController::class, 'fullypaidExport'])->name('fullypaidExport');

    // Profile Section
    Route::resource('profile', profileController::class);



    Route::get('/student-manage-admin', [studentManageController::class, 'studentmanageadmin'])->name('studentmanageadmin')->middleware(['role:Admin']);
    Route::get('/student-manage', [studentManageController::class, 'studentmanage'])->name('studentmanage')->middleware(['role:CRO']);

    Route::get('/student-edit/{id}', [studentManageController::class, 'studentedit'])->name('studentedit');
    Route::get('/student-edit-admin/{id}', [studentManageController::class, 'studenteditadmin'])->name('studenteditadmin')->middleware(['role:Admin']);;

    Route::put('/student-update/{id}', [studentManageController::class, 'studentUpdate'])->name('studenteditupdate');
    Route::delete('/student-delete/{id}', [studentManageController::class, 'studentDelete'])->name('studentdelete');

    Route::get('/student-payment/{id}', [studentManageController::class, 'paymentpage'])->name('payment');
    Route::post('/invoice-create-student/{id}', [studentManageController::class, 'invoicecreate'])->name('invoicecreate');
    Route::post('/create-payment', [studentManageController::class, 'createpayment'])->name('createPayemnt');
    Route::put('/edit-payment/{id}', [studentManageController::class, 'editpayment'])->name('editPayemnt');
    
    Route::post('/create-discount-amount/{id}', [studentManageController::class, 'discountAmountCreate'])->name('discountAmountCreate')->middleware(['role:Admin']);
    Route::delete('/delete-discount-amount/{id}', [studentManageController::class, 'discountAmountDelete'])->name('discountAmountDelete')->middleware(['role:Admin']);


    Route::delete('/delete-payment/{id}', [studentManageController::class, 'deletepayment'])->name('deletepayment');
    Route::get('/invoice-create/{id}', [dashboardController::class, 'invoiceCreate'])->name('invoice');

    Route::get('/invoice-create-image', [dashboardController::class, 'invoiceCreateImg']);
    Route::get('/cro-chart', [dashboardController::class, 'crochart']);
    Route::get('/all-student-chart', [dashboardController::class, 'allstudentchart']);
    Route::get('/log-activity', [dashboardController::class, 'logactivity'])->name('logactivity');


    // Search-System
    Route::get('/student-search', [studentManageController::class, 'studentSearch'])->name('student_search')->middleware(['role:Admin']);;
    Route::get('/student-search-cro', [studentManageController::class, 'studentSearchcro'])->name('student_search_cro');

    // Download Form
    Route::get('/download-form/{id}', [studentManageController::class, 'downloadForm'])->name('downloadForm');
    // Note Add
    Route::post('/note-add/{id}', [studentManageController::class, 'noteadd'])->name('noteadd');



    // fully paid
     Route::get('/today-student-by-cro-fullypaid', [studentManageController::class, 'today_student_by_cro_fullypaid']);

    // Due payment
    Route::get('/today-student-by-cro-duepayment', [studentManageController::class, 'today_student_by_cro_duepayment']);
    // un paid
    Route::get('/today-student-by-cro-unpaid', [studentManageController::class, 'today_student_by_cro_unpaid']);


    Route::get('/staff-report', [StaffsReport::class, 'index'])->name('satffreport')->middleware(['role:Admin']);;
    Route::get('/staff-report-details/{id}', [StaffsReport::class, 'staffReportDetails'])->name('staffRepostDetails')->middleware(['role:Admin']);;
    
    // Backup
    Route::get('/backup', [BackupController::class, 'index'])->name('backup');
    Route::get('/backup/create', [BackupController::class, 'create']);
    Route::get('/backup/download/{file_name}', [BackupController::class, 'download'])->name('backupdownload');
    Route::delete('/backup/delete/{file_name}', [BackupController::class, 'delete'])->name('backupdelete');

    // Payment Activies
    Route::get('/payment-activities', [paymentActivitiesController::class, 'index'])->name('payment.index')->middleware(['role:Admin']);
    Route::get('/payment-activities-date-wise-search', [paymentActivitiesController::class, 'dateSearch'])->name('payment.date')->middleware(['role:Admin']);
    Route::get('/payment-activities-month-wise-search', [paymentActivitiesController::class, 'monthSearch'])->name('payment.month')->middleware(['role:Admin']);
    Route::get('/payment-history', [paymentActivitiesController::class, 'paymentHistoryByCro'])->name('payment.history')->middleware(['role:CRO']);

    // Settings
    
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings-update', [SettingsController::class, 'updatesettings'])->name('settings.update');

    Route::resource('feedback', StudentFeedbackController::class);
    Route::resource('blogs-admin', BlogsController::class);
    Route::resource('video-review', VideoReviewController::class);
    Route::resource('admin-team', OurteamController::class);
    Route::resource('contact-us', ContactUsController::class);
    Route::resource('announce', AnnounceController::class)->middleware(['role:Admin']);


    
    

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

