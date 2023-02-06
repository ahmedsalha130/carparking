<?php

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



Route::group(['prefix'=>'admin'],function (){

//    Route::get('email/verify',                      ['as' => 'verification.notice',             'uses' => 'BackendAdmin\Auth\VerificationController@show']);

    Route::get('/login', [\App\Http\Controllers\BackendAdmin\Auth\LoginController::class, 'showLoginForm'])->name('admin.show_login_form');
    Route::post('/login', [\App\Http\Controllers\BackendAdmin\Auth\LoginController::class, 'login'])->name('admin.login');
    Route::get('/register', [\App\Http\Controllers\BackendAdmin\Auth\RegisterController::class, 'showRegistrationForm'])->name('admin.show_register_form');
    Route::post('/register', [\App\Http\Controllers\BackendAdmin\Auth\RegisterController::class, 'register'])->name('admin.register');
    Route::post('logout', [\App\Http\Controllers\BackendAdmin\Auth\LoginController::class, 'logout'])->name('admin.logout');
    Route::get('password/reset', [\App\Http\Controllers\BackendAdmin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [\App\Http\Controllers\BackendAdmin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}', [\App\Http\Controllers\BackendAdmin\Auth\ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [\App\Http\Controllers\BackendAdmin\Auth\ResetPasswordController::class, 'reset'])->name('admin.password.update');
    Route::get('email/verify', [\App\Http\Controllers\BackendAdmin\Auth\VerificationController::class, 'show'])->name('admin.verification.notice');
    Route::get('email/verify', [\App\Http\Controllers\BackendAdmin\Auth\VerificationController::class, 'verify'])->name('admin.verification.verify');
    Route::post('email/resend', [\App\Http\Controllers\BackendAdmin\Auth\VerificationController::class, 'resend'])->name('admin.verification.resend');
    //  end Authentication Routes...
    Route::group(['middleware'=>'auth:web'],function () {

        Route::get('/', [\App\Http\Controllers\BackendAdmin\AdminController::class, 'index'])->name('admin.index_route');
        Route::get('/index', [\App\Http\Controllers\BackendAdmin\AdminController::class, 'index'])->name('admin.index_route');

// permission
        Route::resource('users','BackendAdmin\UsersController');

        Route::resource('roles','BackendAdmin\RoleController');

        Route::post('userremove_image', ['as' => 'user.remove_image', 'uses' => 'BackendAdmin\UsersController@remove_image']);

        Route::post('update_image', ['as' => 'admin.update_image', 'uses' => 'BackendAdmin\AdminProfile\Profile@update_image']);

        //custromer
        Route::post('logout',                           ['as' => 'admin.logout',                'uses' => 'BackendAdmin\Auth\LoginController@logout']);

        Route::resource('/customer_archive', 'BackendAdmin\ArchiveCustomers');
        Route::resource('/customer', 'Frontend\CustomerController');
        Route::get('/ActiveCustomer',  ['as' => 'customer.active',               'uses' => 'Frontend\CustomerController@active_customer']);
        Route::get('/DisActiveCustomer',  ['as' => 'customer.disactive',               'uses' => 'Frontend\CustomerController@disactive_customer']);
        Route::post('customerremove_image', ['as' => 'customer.remove_image', 'uses' => 'Frontend\CustomerController@remove_image']);
        Route::get('Print_customer/{id}', ['as' => 'customer.print_customer', 'uses' => 'Frontend\CustomerController@Print']);

        //parking
        Route::patch('/park/status', ['as' => 'admin.park_status', 'uses' => 'BackendAdmin\ParkController@park_status']);
        Route::resource('/park', 'BackendAdmin\ParkController');
        Route::get('/ActivePark',  ['as' => 'park.active',               'uses' => 'BackendAdmin\ParkController@active_park']);
        Route::get('/DisActivePark',  ['as' => 'park.disactive',               'uses' => 'BackendAdmin\ParkController@disactive_park']);

        //interval
        Route::patch('/interval/status', ['as' => 'admin.interval_status', 'uses' => 'BackendAdmin\IntervalController@interval_status']);

        Route::resource('/interval', 'BackendAdmin\IntervalController');

        //active interval
        Route::get('/ActiveInterval',  ['as' => 'interval.active',               'uses' => 'BackendAdmin\IntervalController@active_interval']);
        Route::get('/DisActiveInterval',  ['as' => 'interval.disactive',               'uses' => 'BackendAdmin\IntervalController@dis_active_interval']);




        //Reservation
        Route::patch('/reservation/status', ['as' => 'admin.reservation_status', 'uses' => 'BackendAdmin\ReservationController@reservation_status']);
        Route::resource('/reservation_archive', 'BackendAdmin\ArchiveReservations');

        Route::resource('/reservation', 'BackendAdmin\ReservationController');

        //cancel
        Route::get('/CancelReservation',  ['as' => 'reservation.cancel',               'uses' => 'BackendAdmin\ArchiveReservations@cancel']);
        //finish
        Route::get('/FinishReservation',  ['as' => 'reservation.finish',               'uses' => 'BackendAdmin\ArchiveReservations@finish']);
        //busy
        Route::get('/BusyReservation',  ['as' => 'reservation.busy',               'uses' => 'BackendAdmin\ReservationController@busy']);

        //Payment Wallet
        Route::patch('/PaymentWallet/status', ['as' => 'admin.wallet_status', 'uses' => 'BackendAdmin\PaymentWalletController@PaymentWallet_status']);
        Route::get('/ActivePaymentWallet',  ['as' => 'PaymentWallet.active',               'uses' => 'BackendAdmin\PaymentWalletController@PaymentWallet_active']);
        Route::get('/DisActivePaymentWallet',  ['as' => 'PaymentWallet.disactive',               'uses' => 'BackendAdmin\PaymentWalletController@PaymentWallet_disactive']);
        Route::resource('/PaymentWallet_Archive', 'BackendAdmin\PaymentWalletArchiveController');

        Route::resource('/PaymentWallet', 'BackendAdmin\PaymentWalletController');

        Route::get('/reservation_ajax/{id}', 'BackendAdmin\InvoiceController@getreservations');
        Route::get('/reservation_number/{id}', 'BackendAdmin\InvoiceController@getpayments');

        //invoices
        Route::get('/PaidInvoice',  ['as' => 'invoice.paid',               'uses' => 'BackendAdmin\InvoiceController@paid']);
        Route::get('/UnpaidInvoice',  ['as' => 'invoice.unpaid',               'uses' => 'BackendAdmin\InvoiceController@unpaid']);
        Route::resource('/Archive_Invoices', 'BackendAdmin\ArchiveInvoiceController');

        Route::patch('/invoice/status', ['as' => 'admin.invoice_status', 'uses' => 'BackendAdmin\InvoiceController@invoice_status']);
        Route::resource('/Invoices', 'BackendAdmin\InvoiceController');
        //Payment
        Route::resource('/Payment', 'BackendAdmin\PaymentController');

        //chat
        Route::resource('/Chat', 'BackendAdmin\ChatController');
        Route::resource('/ArchiveChat', 'BackendAdmin\ArchiveChatController');
        Route::get('/AnsweredChat',  ['as' => 'Chat.answered',               'uses' => 'BackendAdmin\ChatController@answered']);
        Route::get('/NoResponseChat',  ['as' => 'Chat.noresponse',               'uses' => 'BackendAdmin\ChatController@noresponse']);
    //delete_all _chat
        Route::delete('multiplechatsdelete', ['as' => 'multiplechatsdelete', 'uses' => 'BackendAdmin\ChatController@multipleusersdelete']);
//Notify
        Route::get('MarkAsRead_all','BackendAdmin\ChatController@MarkAsRead_all')->name('MarkAsRead_all');
        Route::get('MarkAsRead/{id}','BackendAdmin\ChatController@MarkAsRead')->name('MarkAsRead');

        Route::resource('profile', 'BackendAdmin\AdminProfile\Profile');

        //Export
        Route::get('reservations/export/', ['as' => 'reservation.export', 'uses' => 'BackendAdmin\ReservationController@export']);
        Route::get('customers/export/', ['as' => 'customer.export', 'uses' => 'Frontend\CustomerController@export']);
        Route::get('invoices/export/', ['as' => 'invoice.export', 'uses' => 'BackendAdmin\InvoiceController@export']);
        Route::get('invoicePDF/{id}', ['as' => 'invoice.pdf', 'uses' => 'BackendAdmin\InvoiceController@downloadPDF']);



    });

});
Route::get('customer/login',                            ['as' => 'customer.show_login_form',       'uses' => 'Frontend\Auth\LoginController@showLoginForm']);

Route::group(['prefix'=>'customer'],function (){

//    //    Route::get('email/verify',                      ['as' => 'verification.notice',             'uses' => 'BackendAdmin\Auth\VerificationController@show']);
//    Route::get('/',                                 ['as' => 'customer.index_route',           'uses' => 'Frontend\CustomerAuth@index']);
//    Route::get('/index',                            ['as' => 'customer.index_route',           'uses' => 'Frontend\CustomerAuth@index']);
    Route::get('/login',                            ['as' => 'customer.show_login_form',       'uses' => 'Frontend\Auth\LoginController@showLoginForm']);
    Route::post('/login',                            ['as' => 'customer.login',                 'uses' => 'Frontend\Auth\LoginController@login']);
    Route::post('logout',                           ['as' => 'customer.logout',                'uses' => 'Frontend\Auth\LoginController@logout']);
    Route::get('password/reset',                    ['as' => 'customer.password.request',      'uses' => 'Frontend\Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email',                   ['as' => 'customer.password.email',        'uses' => 'Frontend\Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}',            ['as' => 'customer.password.reset',        'uses' => 'Frontend\Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset',                   ['as' => 'customer.password.update',       'uses' => 'Frontend\Auth\ResetPasswordController@reset']);
    Route::get('register',                          ['as' => 'customer.show_register_form',     'uses' => 'Frontend\Auth\RegisterController@showRegistrationForm']);
    Route::post('register',                         ['as' => 'customer.register',               'uses' => 'Frontend\Auth\RegisterController@register']);
    Route::get('email/verify',                      ['as' => 'verification.notice',             'uses' => 'Frontend\Auth\VerificationController@show']);
    Route::get('/email/verify/{id}/{hash}',         ['as' => 'verification.verify',             'uses' => 'Frontend\Auth\VerificationController@verify']);
    Route::post('email/resend',                     ['as' => 'verification.resend',             'uses' => 'Frontend\Auth\VerificationController@resend']);
    Route::group(['middleware'=>'auth:customer'],function () {

//        Route::get('site_user', ['as' => "customer.index_route", 'uses' => 'Frontend\CustomerAuth@index']);
            Route::get('/',                                 ['as' => 'customer.index_route',           'uses' => 'Frontend\CustomerAuth@index']);
    Route::get('/index',                            ['as' => 'customer.index_route',           'uses' => 'Frontend\CustomerAuth@index']);

//    Route::get('login',['as'=>  "customer.login",'uses'=> 'Frontend\CustomerAuth@login'] );
//    Route::post('check',['as'=>  "check_login",'uses'=> 'Frontend\CustomerAuth@check_login'] );


    });
});
Route::get('/',                            ['as' => 'selectlogin',           'uses' => 'HomeController@index']);
