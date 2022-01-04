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
    return view('auth.login');
});

Route::group(['prefix' => 'senangpay'], function(){
    Route::get('/', 'App\Http\Controllers\SenangpayController@index')->name('senangpay');
    Route::get('/return', 'App\Http\Controllers\SenangpayController@return')->name('senangpay.return');
    Route::get('/return-recurring', 'App\Http\Controllers\SenangpayController@returnRecurring')->name('senangpay.recurring.return');
    Route::get('/event/paid/{id}/{order_id}', 'App\Http\Controllers\SenangpayController@senangpayRegisterEvent')->name('senangpay.event.paid');
    Route::get('/donation/paid/{donation}/{order_id}', 'App\Http\Controllers\SenangpayController@senangpayDonation')->name('senangpay.donation.paid');
    Route::post('/update', 'App\Http\Controllers\SenangpayController@updateSenangpay')->name('senangpay.update.paid');
    Route::post('/update-recurring', 'App\Http\Controllers\SenangpayController@updateRecurringSenangpay')->name('senangpay.update.recurring.paid');
    Route::get('/subscription/paid/{order_id}', 'App\Http\Controllers\SenangpayController@senangpaySubscription')->name('senangpay.subscription.paid');
    Route::get('/registration/paid', 'App\Http\Controllers\SenangpayController@senangpayRegistration')->name('senangpay.registration.paid');
});

Route::group(['prefix' => 'main'], function(){
    Route::get('/', 'App\Http\Controllers\MainController@index')->name('main');
    Route::get('/seven', 'App\Http\Controllers\MainController@getApiSevenDaySales')->name('main.seven');
    
});

Route::group(['prefix' => 'event'], function(){
    Route::get('/list', 'App\Http\Controllers\EventController@index')->name('event.list');
    Route::get('/data', 'App\Http\Controllers\EventController@apiGetIndexDt')->name('event.dt');
    Route::post('/store', 'App\Http\Controllers\EventController@apiPostStoreEvent')->name('event.store');
    Route::get('/add/{id}', 'App\Http\Controllers\EventController@eventEdit')->name('event.edit');
    Route::get('/detail/{id}', 'App\Http\Controllers\EventController@eventDetail')->name('event.detail');
    Route::post('/update', 'App\Http\Controllers\EventController@apiPutUpdateEvent')->name('event.update');
    Route::put('/store/pic', 'App\Http\Controllers\EventController@apiPostStoreEventBanner')->name('event.store.banner');
    Route::delete('{id}', 'App\Http\Controllers\EventController@apiDeleteEvent')->name('event.destroy');
});

Route::group(['prefix' => 'tadarus'], function(){
    Route::get('/', 'App\Http\Controllers\TadarusController@index')->name('tadarus.index');
    Route::get('/data', 'App\Http\Controllers\TadarusController@apiGetIndexDt')->name('tadarus.dt');
    Route::post('/add', 'App\Http\Controllers\TadarusController@apiPostStoreTadarus')->name('tadarus.add');
    Route::get('/edit/{id}', 'App\Http\Controllers\TadarusController@tadarusEdit')->name('tadarus.edit');
    Route::get('/detail/{id}', 'App\Http\Controllers\TadarusController@tadarusDetail')->name('tadarus.detail');
    Route::put('/update', 'App\Http\Controllers\TadarusController@apiPutUpdateTadarus')->name('tadarus.update');
    Route::delete('{id}', 'App\Http\Controllers\TadarusController@apiDeleteTadarus')->name('tadarus.destroy');
});

Route::group(['prefix' => 'customer'], function(){
    Route::get('/list', 'App\Http\Controllers\CustomerController@index')->name('customer.list');
    Route::get('/add', 'App\Http\Controllers\CustomerController@add')->name('customer.add');
    Route::get('/edit/{id}', 'App\Http\Controllers\CustomerController@edit')->name('customer.edit');    
    Route::get('/info/{id}', 'App\Http\Controllers\CustomerController@info')->name('customer.info');
    Route::put('/update', 'App\Http\Controllers\CustomerController@apiPutUpdateUser')->name('customer.update');
    Route::post('/store', 'App\Http\Controllers\CustomerController@apiPostStoreUser')->name('customer.store');
    Route::delete('{id}', 'App\Http\Controllers\CustomerController@apiDeleteCustomer')->name('customer.destroy');
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('/list', 'App\Http\Controllers\AdminController@index')->name('admin.list');
    Route::get('/add', 'App\Http\Controllers\AdminController@add')->name('admin.add');
    Route::get('/edit/{id}', 'App\Http\Controllers\AdminController@edit')->name('admin.edit');
    Route::get('/info/{id}', 'App\Http\Controllers\AdminController@info')->name('admin.info');
    Route::put('/update', 'App\Http\Controllers\AdminController@apiPutUpdateUser')->name('admin.update');
    Route::post('/store', 'App\Http\Controllers\AdminController@apiPostStoreUser')->name('admin.store');
});

Route::group(['prefix' => 'setting'], function(){
    Route::get('/add', 'App\Http\Controllers\SettingController@addUser')->name('setting.user.add');
    Route::post('/create', 'App\Http\Controllers\SettingController@apiPostStoreUser')->name('setting.user.create');
    Route::put('/update/{id}', 'App\Http\Controllers\SettingController@apiPutUpdateUser')->name('setting.user.update');
    Route::get('/password', 'App\Http\Controllers\SettingController@changePassword')->name('setting.password');
    Route::put('/change-password/{id}', 'App\Http\Controllers\SettingController@putApiUpdatePassword')->name('setting.password.update');
    Route::get('/third-party', 'App\Http\Controllers\SettingController@thirdPartyInteragation')->name('setting.thirdparty');
});

Route::group(['prefix' => 'report'], function(){
    Route::get('/payment', 'App\Http\Controllers\ReportController@payment')->name('report.payment');
    Route::get('/event', 'App\Http\Controllers\ReportController@event')->name('report.event');
    Route::get('/event/registered/{id}', 'App\Http\Controllers\ReportController@eventRegisteredList')->name('report.registered');
    Route::get('/donation/weekly', 'App\Http\Controllers\ReportController@getApiWeeklyDonation')->name('donation.report.weekly');
    Route::get('/register/weekly', 'App\Http\Controllers\ReportController@getApiWeeklyRegister')->name('register.report.weekly');
});

Route::group(['prefix' => 'donation'], function(){
    Route::get('/', 'App\Http\Controllers\DonationController@index')->name('donation.index');
});

Route::group(['prefix' => 'subscription'], function(){
    Route::get('/', 'App\Http\Controllers\SubscriptionController@index')->name('subscription.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'member'], function(){
    Route::get('/main', 'App\Http\Controllers\MemberMainController@index')->name('member.main');

    Route::group(['prefix' => 'event'], function(){
        Route::get('/list', 'App\Http\Controllers\EventController@index_member')->name('member.event.list');
        Route::post('/add', 'App\Http\Controllers\EventController@apiPostStoreEvent')->name('member.event.add');
        Route::post('/register/add', 'App\Http\Controllers\EventController@apiRegisterEvent')->name('member.register.add');
        Route::get('/detail/{id}', 'App\Http\Controllers\EventController@memberEventDetail')->name('member.event.detail');
        Route::post('/register/paid', 'App\Http\Controllers\EventController@apiRegisterPaidEvent')->name('member.register.paid');
    });

    Route::group(['prefix' => 'tadarus'], function(){
        Route::get('/', 'App\Http\Controllers\TadarusController@index_member')->name('member.tadarus.index');
    });

    Route::group(['prefix' => 'donation'], function(){
        Route::get('/', 'App\Http\Controllers\DonationController@memberIndex')->name('member.donation');
        Route::post('/add', 'App\Http\Controllers\DonationController@apiPostStoreDonation')->name('member.donation.add');
    });

    Route::group(['prefix' => 'subscription'], function(){
        Route::get('/', 'App\Http\Controllers\SubscriptionController@memberIndex')->name('member.subscription');
        Route::post('/add', 'App\Http\Controllers\SubscriptionController@apiPostStoreSubscription')->name('member.subscription.add');
        Route::post('/register/add', 'App\Http\Controllers\EventController@apiRegisterEvent')->name('member.register.add');
    });

    Route::group(['prefix' => 'setting'], function(){
        Route::get('/profile', 'App\Http\Controllers\MemberSettingController@editProfile')->name('member.setting.profile');
        Route::get('/change_password', 'App\Http\Controllers\MemberSettingController@changePassword')->name('member.setting.change_password');
        Route::put('/profile/update/{id}', 'App\Http\Controllers\MemberSettingController@putApiUpdateProfile')->name('member.setting.profile.update');
        Route::put('/password/update/{id}', 'App\Http\Controllers\MemberSettingController@putApiUpdatePassword')->name('member.setting.password.update');
    });
});
