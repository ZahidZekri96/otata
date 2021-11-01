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
    return view('welcome');
});

Route::get('/demo', function () {
    return view('demo');
 });

Route::get('/home', function () {
    return view('home');
});

Route::group(['prefix' => 'main'], function(){
    Route::get('/', 'App\Http\Controllers\MainController@index')->name('main');
});

Route::group(['prefix' => 'event'], function(){
    Route::get('/list', 'App\Http\Controllers\EventController@index')->name('event.list');
    Route::get('/data', 'App\Http\Controllers\EventController@apiGetIndexDt')->name('event.dt');
    Route::post('/add', 'App\Http\Controllers\EventController@apiPostStoreEvent')->name('event.add');
});

Route::group(['prefix' => 'customer'], function(){
    Route::get('/list', 'App\Http\Controllers\CustomerController@index')->name('customer.list');
    Route::get('/add', 'App\Http\Controllers\CustomerController@add')->name('customer.add');
    Route::get('/edit/{id}', 'App\Http\Controllers\CustomerController@edit')->name('customer.edit');    
    Route::get('/info/{id}', 'App\Http\Controllers\CustomerController@info')->name('customer.info');
    Route::put('/update/{id}', 'App\Http\Controllers\CustomerController@apiPutUpdateUser')->name('customer.update');
    Route::post('/store', 'App\Http\Controllers\CustomerController@apiPostStoreUser')->name('customer.store');
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('/list', 'App\Http\Controllers\AdminController@index')->name('admin.list');
    Route::get('/add', 'App\Http\Controllers\AdminController@add')->name('admin.add');
    Route::get('/edit/{id}', 'App\Http\Controllers\AdminController@edit')->name('admin.edit');
    Route::get('/info/{id}', 'App\Http\Controllers\AdminController@info')->name('admin.info');
    Route::put('/update/{id}', 'App\Http\Controllers\AdminController@apiPutUpdateUser')->name('admin.update');
    Route::post('/store', 'App\Http\Controllers\AdminController@apiPostStoreUser')->name('admin.store');
});

Route::group(['prefix' => 'setting'], function(){
    Route::get('/add', 'App\Http\Controllers\SettingController@addUser')->name('setting.user.add');
    Route::put('/update/{id}', 'App\Http\Controllers\SettingController@apiPutUpdateUser')->name('setting.user.update');
    Route::get('/password', 'App\Http\Controllers\SettingController@changePassword')->name('setting.password');
    Route::put('/change-password/{id}', 'App\Http\Controllers\ProfileController@putApiUpdatePassword')->name('setting.password.update');
    Route::get('/third-party', 'App\Http\Controllers\SettingController@thirdPartyInteragation')->name('setting.thirdparty');
});

Route::group(['prefix' => 'report'], function(){
    Route::get('/summary', 'App\Http\Controllers\ReportController@summary')->name('report.summary');
    Route::get('/event', 'App\Http\Controllers\ReportController@event')->name('report.event');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'member'], function(){
    Route::get('/main', 'App\Http\Controllers\MainController@index')->name('main');

    Route::group(['prefix' => 'event'], function(){
        Route::get('/list', 'App\Http\Controllers\EventController@index_member')->name('member.event.list');
        Route::post('/add', 'App\Http\Controllers\EventController@apiPostStoreEvent')->name('member.event.add');
        Route::post('/register/add', 'App\Http\Controllers\EventController@apiRegisterEvent')->name('member.register.add');
    });

    Route::group(['prefix' => 'donation'], function(){
        Route::get('/', 'App\Http\Controllers\DonationController@memberIndex')->name('member.donation');
        Route::post('/add', 'App\Http\Controllers\EventController@apiPostStoreEvent')->name('member.event.add');
        Route::post('/register/add', 'App\Http\Controllers\EventController@apiRegisterEvent')->name('member.register.add');
    });

    Route::group(['prefix' => 'subscription'], function(){
        Route::get('/', 'App\Http\Controllers\SubscriptionController@memberIndex')->name('member.subscription');
        Route::post('/add', 'App\Http\Controllers\EventController@apiPostStoreEvent')->name('member.event.add');
        Route::post('/register/add', 'App\Http\Controllers\EventController@apiRegisterEvent')->name('member.register.add');
    });
});
