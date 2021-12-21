<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\FeatureAttributeController;
use App\Http\Controllers\Backend\PublicationController;
use App\Http\Controllers\ForgotPasswordController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/password-update', [AdminController::class, 'passwordChange'])->name('password.change');
    Route::post('/password-update', [AdminController::class, 'updatePassword'])->name('password.update');
    Route::get('/profile-update', [AdminController::class, 'profile'])->name('user.profile');
    Route::post('/profile-update', [AdminController::class, 'profileUpdate'])->name('profile.update');


//* employee route start */
    Route::get('/admins', [AdminController::class, 'allAdmin'])->name('admin.index');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::post('/admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/show', [AdminController::class, 'show'])->name('admin.show');
    Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/admin/delete', [AdminController::class, 'destroy'])->name('admin.delete');
//* employee route end */

/* category route start */
    Route::resource('category', CategoryController::class);
    Route::post('update-asdasd',[CategoryController::class, 'updateStatus'])->name('category.status.update');
    Route::post('update-category',[CategoryController::class, 'update'])->name('update.category');
/* category route end */

/* feature attribute route start */
    Route::resource('feature-attributes', FeatureAttributeController::class);
/* feature attribute route end */

/* publications  route start */
    Route::resource('publications', PublicationController::class);
/* publications route end */



});
//* password reset start */
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forgot.password');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
