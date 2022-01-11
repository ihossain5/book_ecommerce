<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\FeatureAttributeController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PublicationController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Frontend\BookController as FrontendBookController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerAddressController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\WriterController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SidebarSearchController;
use App\Http\Controllers\Frontend\SocialLoginController;
use App\Http\Controllers\Frontend\TopicController;
use App\Http\Controllers\Frontend\PublisherController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Models\Order;
use Illuminate\Support\Facades\Artisan;
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

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('admin');
    Route::get('/password-change', [AdminController::class, 'passwordChange'])->name('password.change');
    Route::post('/password-update', [AdminController::class, 'updatePassword'])->name('password.update');
    Route::get('/profile-update', [AdminController::class, 'profile'])->name('user.profile');
    Route::post('/profile-update', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');

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
    Route::post('update-asdasd', [CategoryController::class, 'updateStatus'])->name('category.status.update');
    Route::post('update-category', [CategoryController::class, 'update'])->name('update.category');
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
    Route::get('/book/review/{id}', [BookController::class, 'book_review'])->name('book.review');

// Slider start
    Route::resource('sliders', SliderController::class);
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

// Contact start
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{order}', [OrderController::class, 'downloadInvoice'])->name('order.invoice.download');
    Route::get('/order_manage', [OrderController::class, 'order_info'])->name('order.info');
    Route::post('/order/manage/edit', [OrderController::class, 'order_view'])->name('order.view');
    Route::post('/order/manage/change/status', [OrderController::class, 'order_change_status'])->name('order.change.status');
    Route::post('/order/delete', [OrderController::class, 'destroy'])->name('order.delete');

// Contact end

// Customer Order start
    Route::get('/customer/orders', [CustomerController::class, 'index'])->name('customer.order');
    Route::get('/customer/orders/{id}', [CustomerController::class, 'order_review'])->name('customer.order.review');
// Customer Order  end
// ban start
    Route::post('/user/ban', [CustomerController::class, 'user_ban'])->name('user.ban');
    Route::post('/customer/info', [CustomerController::class, 'customer_info'])->name('customer.info');
// ban end

});

//* password reset start */
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forgot.password');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
//* password reset end */

Route::get('/clear-cache', function () {
    $configCache = Artisan::call('config:cache');
    $clearCache  = Artisan::call('cache:clear');
    return "Finished";
});

// frontend route start
Route::get('/', [HomePageController::class, 'index'])->name('frontend.home');
Route::get('/book/{book}/details', [FrontendBookController::class, 'bookDetails'])->name('frontend.book.details');

// Route::get('/authors', [WriterController::class, 'index'])->name('frontend.authors');

Route::post('/add-to-cart', [CartController::class, 'addTocart'])->name('add.cart');
Route::post('/remove-cart', [CartController::class, 'deleteCart'])->name('remove.cart');
Route::post('/increase-cart', [CartController::class, 'increaseCart'])->name('increase.cart.qty');
Route::post('/decrease-cart', [CartController::class, 'decreaseCart'])->name('decrease.cart.qty');

Route::get('checkout',[CheckoutController::class,'checkOut'])->name('frontend.checkout');

Route::get('/sign-in', [LoginController::class, 'index'])->name('frontend.login');
Route::get('/send-otp', [LoginController::class, 'sendOtp'])->name('frontend.otp.send');

Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('frontend.otp.verification');

Route::post('/send-otp', [LoginController::class, 'otpSend'])->name('send.otp');
Route::post('/otp-verify', [LoginController::class, 'otpVerification'])->name('verify.otp');

Route::post('store-rating', [ReviewController::class, 'store'])->name('store.review');
Route::post('store-whishlist', [WishlistController::class, 'store'])->name('store.whislist')->middleware('auth');

Route::get('/authors', [WriterController::class, 'index'])->name('frontend.authors');
Route::get('/author/details/{id}', [WriterController::class, 'author_details'])->name('frontend.author.details');

Route::get('/topics', [TopicController::class, 'index'])->name('frontend.topics');
Route::get('/topics/name/{id}', [TopicController::class, 'topic_name'])->name('frontend.topics.name');

Route::post('/search/book/details', [SearchController::class, 'book_detials_filter'])->name('book.details.filter');
Route::post('/search/topics', [SearchController::class, 'topic_filter'])->name('topics.filter');

Route::get('/book/list', [FrontendBookController::class, 'index'])->name('frontend.books');

// Viewer profile start
Route::get('/profile', [ProfileController::class, 'index'])->name('customer.profile');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/profile/address/{id}', [ProfileController::class, 'address_details'])->name('profile.address.detail');
Route::post('/profile/add/address', [ProfileController::class, 'add_address'])->name('profile.address.add');
Route::post('/profile/delete/address', [ProfileController::class, 'destroy'])->name('profile.address.delete');
Route::post('/profile/primary/address', [ProfileController::class, 'primary_address'])->name('profile.address.primary');
Route::post('/profile/address/update', [ProfileController::class, 'address_update'])->name('profile.address.update');
Route::post('/profile/my/order', [ProfileController::class, 'my_orders'])->name('profile.my.order');
Route::post('/order/my/order', [ProfileController::class, 'profile_order_view'])->name('my.order.single');

// Viewer profile end

Route::post('/search/books/filter', [SearchController::class, 'book_filter'])->name('book.filter');
Route::post('/photo/update', [ProfileController::class, 'photoUpdate'])->name('profile.photo.update');

// Google login
Route::get('login/google', [SocialLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);

Route::post('/frontend-logout',[LoginController::class,'logout'])->name('frontend.logout');


//search topic sidebar
Route::post('/sidebar/filter/author', [SidebarSearchController::class, 'author_sidebar_filter'])->name('author.sidebar.filter');
Route::post('/sidebar/filter/publisher', [SidebarSearchController::class, 'publisher_sidebar_filter'])->name('publisher.sidebar.filter');
Route::post('/sidebar/filter/category', [SidebarSearchController::class, 'category_sidebar_filter'])->name('category.sidebar.filter');

Route::post('/customer-address',[CustomerAddressController::class,'getAddress'])->name('get.customer.address');

Route::post('/order-place',[CheckoutController::class,'placeOrder'])->name('order.place');

Route::post('/book/filter/autocomplete', [SidebarSearchController::class, 'getBook'])->name('book.filter.autocomplete');
Route::get('/book/search', [SidebarSearchController::class, 'book_search'])->name('book.filter.search');


Route::get('/publishers', [PublisherController::class, 'index'])->name('frontend.publishers');
Route::get('/publisher/name/{id}', [PublisherController::class, 'publisher_info'])->name('frontend.publishers.name');
Route::post('/search/publishers', [PublisherController::class, 'publisher_filter'])->name('publishers.filter');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'paymentSuccess']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END