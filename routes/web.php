<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', 'UserController@displaysform');
Route::post('/signup', 'UserController@register')->name('register-user');
Route::post('/login', 'UserController@login')->name('login-user');

Route::get('/all-media-groups', 'MediaGroupController@displayall');

Route::get('/search', 'SearchController@search');
Route::get('/search-404', 'SearchController@search404')->name('search-404');

Route::get('/media-groups', 'MediaGroupController@display');
Route::get('/create-media-group', function () {
    return view('account.create-media-group');
});
Route::post('/create-media-group', 'MediaGroupController@create')->name('create-mediagroup');

Route::get('/filter-media', 'MediaController@redirect');
Route::post('/filter-media', 'MediaController@filtermedia')->name('filter-media');

Route::get('/upload-media/{groupId}', 'MediaController@uploadmform');
Route::post('/upload-media/{groupId}', 'MediaController@uploadmedia');

Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/checkout', 'CheckoutController@paymentdone')->name('checkout.credit-card');
Route::get('/checkout-success', function () {
    return view('checkout.payment-success');
});

Route::get('/download/{mediafileid}', 'DownloadsController@download');

Route::get('/{mediaslug}-{mediaid}', 'MediaController@display')->where('mediaslug', '.+(?=-)');

Route::get('/account', 'ManageUserController@displaysettings');
Route::post('/account', 'ManageUserController@save')->name('save-profile');
Route::get('/account/change-email', function () {
    return 'Amazon SES is not available';
});
Route::get('/account/delete', 'ManageUserController@deleteform');
Route::post('/account/delete', 'ManageUserController@delete')->name('input-email');

Route::get('/contact', 'ContactController@display');

Route::post('/newsletter-signup', 'NewsletterController@signup')->name('newsletter-signup');

Route::get('/sitemap', 'SiteMapController@generate');

Route::get('/logout', 'ManageUserController@logout');
