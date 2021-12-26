<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\FeatureAttributeController;
use App\Http\Controllers\Backend\PublicationController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Backend\ContactController;
use Illuminate\Support\Facades\Artisan;

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
    Route::get('/password-change', [AdminController::class, 'passwordChange'])->name('password.change');
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
/* publications  route start */
    Route::resource('publications', PublicationController::class);
/* author  route start */
    Route::resource('authors', AuthorController::class);
/* book route start */
    Route::resource('books', BookController::class); 
    Route::post('/book/status/update/', [BookController::class, 'updateStatus'])->name('books.status.update');
    Route::get('get/{book}/pdf/', [BookController::class, 'getPdf'])->name('book.get.pdf');
    


// Slider start
Route::get('/slider', [SliderController::class, 'index'])->name('sliders');
Route::post('/slider/store', [SliderController::class, 'store'])->name('sliders.store');
Route::post('/slider/edit', [SliderController::class, 'edit'])->name('sliders.edit');
Route::post('/slider/update', [SliderController::class, 'update'])->name('sliders.update');
Route::post('/slider/delete', [SliderController::class, 'destroy'])->name('sliders.delete');
// Slider end


// Social Media start
Route::get('/social', [SocialMediaController::class, 'index'])->name('socials');
Route::post('/social/store', [SocialMediaController::class, 'store'])->name('socials.store');
Route::post('/social/edit', [SocialMediaController::class, 'edit'])->name('socials.edit');
Route::post('/social/update', [SocialMediaController::class, 'update'])->name('socials.update');
Route::post('/social/delete', [SocialMediaController::class, 'destroy'])->name('socials.delete');
// Social Media end

// Contact start
Route::get('/contact', [ContactController::class, 'index'])->name('contacts');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contacts.store');
Route::post('/contact/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::post('/contact/update', [ContactController::class, 'update'])->name('contacts.update');
Route::post('/contact/delete', [ContactController::class, 'destroy'])->name('contacts.delete');
// Contact end

});
//* password reset start */
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forgot.password');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
//* password reset end */


Route::get('/clear-cache', function() {
    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    return "Finished";
});