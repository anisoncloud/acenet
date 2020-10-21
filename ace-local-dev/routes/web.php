<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */

use Gloudemans\Shoppingcart\Facades\Cart;

Route::view('/', 'front-end.index')->name('index');
Route::view('/about', 'front-end.about')->name('about');
Route::view('/contact', 'front-end.contact.contact')->name('contacts');
Route::view('/coverage', 'front-end.coverage')->name('coverage');
Route::get('/contact/{slug}', 'ContactFormController@create')->name('contact');
Route::post('/contact', 'ContactFormController@store')->name('contact.store');
//Route::view('/cart', 'front-end.cart')->name('cart.index');
//Route::get('/cart', 'CartController@index')->name('cart.index');
/* Route::get('/cart', function () {
    return redirect('/');
}); */
Route::get('/checkout-preview', function () {
    return redirect('/');
});
Route::post('/cart', 'CartController@tonewpage');
Route::view('/cart', 'front-end.checkout');
//Route::get('/cart', 'CartController@tonewpage');
//Route::get('/cart', 'CartController@index');
//Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');

Route::get('/empty', function () {
    Cart::destroy();
});

//Route::view('/checkout', 'front-end.checkout');
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::post('/checkout-preview', 'CheckoutController@preview')->name('checkout.preview');

Route::view('/select-customer', 'front-end.select-customer');

Route::post('/select-customer', 'CartController@store')->name('cart.store');

//oute::view('/thankyou', 'front-end.thankyou')->name('thankyou');
Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::view('/admin/index', 'backend.index');
//Route::view('/admin/order/index', 'backend.order.index');
Route::get('admin/order', 'AdminControllers\AdminOrderController@index')->name('adminorder.index');

//OTP
Route::get('/sendOTP', 'CheckoutController@sendOTP')->name('otp.otpsend');
//Route::post('/checkOTP', 'OtpController@checkOTP')->name('otp.otpcheck');


Route::post('/customer/shipping/info/save', [
    'uses'  =>  'CheckoutController@saveShippingInfo',
    'as'    =>  '/save-shipping-info'
]);

Route::get('/customer/checkout/cancel_url',[
    'uses'=>'CheckoutController@cancelMessage',
    'as'=>'/cancel-url'
]);

Route::get('/customer/checkout/fail_url',[
    'uses'=>'CheckoutController@failMessage',
    'as'=>'/fail-url'
]);

Route::get('/customer/checkout/success_url',[
    'uses'=>'CheckoutController@onlinePaymentResponse',
    'as'=>'/success-url'
]);


Route::get('/customer/checkout/success_notice', function () {
    return view('front.checkout.success-message');
});
