<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer\AuthController;
/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Api" middleware group. Enjoy building your Api!
|
*/


Route::group([
    'middleware' => 'api',
    'prefix' => 'customer'
], function ($router) {
    Route::post('/login', ['uses' =>'Api\Customer\AuthController@login']);
    Route::post('/register', ['uses' =>'Api\Customer\AuthController@register']);
    Route::post('/logout', ['uses' =>'Api\Customer\AuthController@logout']);
    Route::post('/refresh',['uses' =>'Api\Customer\AuthController@refresh'] );

    //parks
    Route::get('/parks', 'Api\Park\ParkController@index');
    Route::get('/park/{id}', 'Api\Park\ParkController@show');

    Route::post('/parks', 'Api\Park\ParkController@store');
    Route::post('/parks/{id}', 'Api\Park\ParkController@update');

    //reservations
    Route::get('reservations', 'Api\Customer\ReservationController@index');
    //rest pass
    Route::post('password/reset', ['uses'=>'Api\Customer\ForgotPasswordtestController@forgotPassword']);

    // get all
        Route::get('all-Email-customer', 'Api\Customer\ReservationController@allEmailCustomer');
        Route::get('all-Mobile-customer', 'Api\Customer\ReservationController@allMobileCustomer');

    //get_all_near =1

        Route::get('all-near-customer', 'Api\Park\ParkController@get_all_near');
        Route::post('update-near/{id}', 'Api\Park\ParkController@update_near_park');
    //get_park_reservation_number

                Route::get('get-reservation-number/{numberpark}', 'Api\Customer\ReservationController@get_reservation_number');

       //get_park_number
       Route::get('get_park_number/{id}', 'Api\Park\ParkController@get_park_number');

                //update_reservation_park

    Route::post('update-reservation-park/{number}', 'Api\Customer\ReservationController@update_reservation_park');

    Route::get('get-resevation-number-near/{id}', 'Api\Park\ParkController@get_resnumber_near');
    //get multi data
    Route::get('multi_get_near_renumber_park_number/{id}', 'Api\Park\ParkController@multi_get_near_renumber_park_number');

//res_status
    Route::post('reservation_status2/{id}', 'Api\Customer\ReservationController@update_status2');

    //update-customer-near
    Route::post('update-near-customer2/{id}', 'Api\Park\ParkController@update_near_customer');
});


Route::group(['middleware' => ['jwt.verify'],'prefix' => 'customer'], function() {


    Route::get('/customer-profile', ['uses' =>'Api\Customer\AuthController@userProfile']);

    Route::get('intervals', 'Api\Interval\IntervalController@index');
    Route::get('reservations_history/{id}', 'Api\Customer\ReservationController@show');
    Route::get('current_busy_reservation/{id}', 'Api\Customer\ReservationController@show_current_busy_reservation');
    Route::get('check_resreservation/{id}', 'Api\Customer\ReservationController@check_res');

    Route::post('reservations/{id}', 'Api\Customer\ReservationController@update');
    Route::post('reservation_status/{id}', 'Api\Customer\ReservationController@update_status');
    Route::post('reservations', 'Api\Customer\ReservationController@store');
    Route::get('customer/{id}', 'Api\Customer\ReservationController@show');
    Route::post('update-profile/{id}', 'Api\Customer\AuthController@update_profile');
    Route::post('update-image/{id}', 'Api\Customer\AuthController@update_image');

    //update-customer-near
        Route::post('update-near-customer/{id}', 'Api\Park\ParkController@update_near_customer');


  //get_status
        Route::get('get-status/{id}', 'Api\Customer\AuthController@get_status');
        Route::post('update_password/{id}', 'Api\Customer\AuthController@update_password');

            // invoices

    Route::get('paid/{id}', 'Api\Invoice\InvoiceController@paid');
    Route::get('unpaid/{id}', 'Api\Invoice\InvoiceController@unpaid');
    Route::post('update-invoice/{id}', 'Api\Invoice\InvoiceController@update_invoice');

  //chat

    Route::get('all-reciver-message/{id}', 'Api\Chat\ChatController@all_reciver_message');
    Route::get('all-send-message/{id}', 'Api\Chat\ChatController@all_send_message');
    Route::post('send-message/{id}', 'Api\Chat\ChatController@send_message');


    //payment
    Route::post('add-to-payment/', 'Api\Invoice\InvoiceController@payment');
        //pdf
      Route::get('invoicePDF/{id}','Api\Invoice\InvoiceController@downloadPDF');


});
