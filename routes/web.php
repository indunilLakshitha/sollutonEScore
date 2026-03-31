<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DepositedListController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\OrderHistoryController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\SalesReportController;
use App\Http\Controllers\Admin\SettingControlelr;
use App\Http\Controllers\Admin\TeamViewController;
use App\Http\Controllers\AdminPasswordManagerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CoursePaymentController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexPageController;
use App\Http\Controllers\MyTeamController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesChartController;
use App\Http\Controllers\SpecialRequestController;
use App\Http\Controllers\Test\TestController;
use App\Http\Controllers\TreeViewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Models\CourseLecturer;
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
Route::get('/', function () {
    return redirect('/workscore');
});

Route::prefix('workscore')->group(function () {
    Route::middleware(['auth:web', 'noindex', 'is_blocked'])->get('/', function () {
        return view('dashboard');
    });

    /*
    | Custom forgot password (SMS OTP) — Fortify still serves GET /forgot-password (password.request).
    | These routes power auth/forgot-password.blade.php and the OTP flow.
    */
    Route::middleware(['guest'])->group(function () {
        Route::post('/forgot-password/notify', [ForgotPasswordController::class, 'notify'])->name('forgotPassword.notify');
        Route::get('/forgot-password/verify/{ref_id}', [ForgotPasswordController::class, 'verifyView'])->name('forgotPassword.verifyView');
        Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verify'])->name('forgotPassword.verify');
        Route::get('/forgot-password/change/{ref_id}', [ForgotPasswordController::class, 'changeView'])->name('forgotPassword.changeView');
        Route::post('/forgot-password/change', [ForgotPasswordController::class, 'change'])->name('forgotPassword.change');
    });

    Route::middleware(['auth:web', 'noindex', 'is_blocked'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit.custom');

        Route::middleware(['is_admin'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('/members', function () {
                return view('Admin.Member.index');
            })->name('member.index');

            Route::get('/members/create', function () {
                return view('Admin.Member.create');
            })->name('member.create');

            Route::get('/members/{id}/edit', function ($id) {
                return view('Admin.Member.edit', compact('id'));
            })->name('member.edit');

            Route::get('/task-categories', function () {
                return view('Admin.TaskCategory.index');
            })->name('task-category.index');

            Route::get('/task-categories/create', function () {
                return view('Admin.TaskCategory.create');
            })->name('task-category.create');

            Route::get('/task-categories/{id}/edit', function ($id) {
                return view('Admin.TaskCategory.edit', compact('id'));
            })->name('task-category.edit');

            Route::get('/tasks', function () {
                return view('Admin.Task.index');
            })->name('task.index');

            Route::get('/tasks/create', function () {
                return view('Admin.Task.create');
            })->name('task.create');

            Route::get('/tasks/{id}/edit', function ($id) {
                return view('Admin.Task.edit', compact('id'));
            })->name('task.edit');

            Route::get('/company-sales', function () {
                return view('Admin.CompanySales.index');
            })->name('company-sales.index');

            Route::get('/settings', function () {
                return view('Admin.Settings.index');
            })->name('settings.index');

            Route::get('/member-performance', function () {
                return view('Admin.Performance.index');
            })->name('member-performance.index');

            Route::get('/member-performance/{id}/tasks', function ($id) {
                return view('Admin.Performance.tasks', compact('id'));
            })->name('member-performance.tasks');
        });

        Route::get('/my-tasks', function () {
            return view('Task.my-tasks');
        })->name('task.my-tasks');

        Route::get('/my-tasks/{id}', function ($id) {
            return view('Task.task-details', compact('id'));
        })->name('task.details');

        Route::get('/monthly-summary', function () {
            return view('Task.monthly-summary');
        })->name('task.monthly-summary');

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
});
