<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API RoutesT
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('api')->domain(env('APP_URL'))->group(function() {
    Route::prefix('/v2')->group(function(){
        Route::group(['middleware' => ['auth:api']], function(){
            // Customer
            Route::prefix('/membership')->group(function(){
                Route::post('/check', 'Api\V2\MembershipController@check');
                Route::post('/activation', 'Api\V2\MembershipController@activation');
                Route::post('/request-for-claim', 'Api\V2\MembershipController@requestForClaim');
                Route::get('/my-plan', 'Api\V2\MembershipController@myPlan');
                Route::get('/my-claim', 'Api\V2\MembershipController@myClaim');
                Route::get('/current', 'Api\V2\MembershipController@current');
                Route::get('/store', 'Api\V2\MembershipController@getStore'); 

            });
            Route::prefix('/user')->group(function(){
                Route::get('/detail', 'Api\V2\UserController@detail');
                Route::post('/edit', 'Api\V2\UserController@edit');
                route::get('/notification', 'Api\V2\NotificationController@getNotification');
                route::post('/notification', 'Api\V2\NotificationController@updateNotification'); 

            });

            // Partner
            Route::prefix('/voucher')->group(function(){
                Route::post('/create', 'Api\V2\PartnerController@create');
                Route::post('/sold', 'Api\V2\PartnerController@sold');
            });

            // Check App Version
            Route::get('/app-version', 'Api\V2\AppVersionController@detail');
        });
        Route::post('/login/partner', 'Api\V2\AuthController@loginForPartner');
        Route::post('/login/customer', 'Api\V2\AuthController@loginForCustomer');
        Route::post('/register', 'Api\V2\AuthController@register');
        Route::prefix('/password')->group(function(){
            Route::post('/email', 'Api\V2\AuthController@passwordEmail');
            // Route::post('/reset', 'Api\V2\AuthController@passwordReset');
        });
    });
});
