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

Route::middleware('web')->domain(env('APP_URL'))->group(function() {
    Route::get('/', 'FrontWeb\FrontWebController@index')->name('index_frontweb');
    Route::get('/index', 'FrontWeb\FrontWebController@index')->name('index_frontweb');
    Route::get('/home', 'FrontWeb\FrontWebController@index')->name('home_frontweb');
    Route::get('/activation', 'FrontWeb\FrontWebController@activation')->name('frontweb.activation');
    Route::get('/claim', 'FrontWeb\FrontWebController@claim')->name('frontweb.claim');
    Route::get('/terms&condition', 'FrontWeb\FrontWebController@terms')->name('frontweb.terms');
    Route::get('/privacy-policy', 'FrontWeb\FrontWebController@privacy')->name('frontweb.privacy');
    Route::get('/service-center', 'FrontWeb\FrontWebController@ServiceCenter')->name('frontweb.ServiceCenter');
    Route::get('/privacy-policy/trade-in', 'FrontWeb\FrontWebController@privacyTradeIn')->name('frontweb.privacy.tradein');

    
    Route::get('/code/{code}', 'Other\UniqueLinkController@index')->name('code.index');
    Route::patch('/code/{code}', 'Other\UniqueLinkController@edit')->name('code.edit');

    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
});

Route::middleware('web')->domain('dashboard.'.env('APP_URL'))->group(function() {
    Route::get('/', 'BackWeb\DashboardController@index')->name('index_backweb');
    Route::get('/index', 'BackWeb\DashboardController@index')->name('index_backweb');
    Route::get('/home', 'BackWeb\DashboardController@index')->name('home_backweb');
    // All 
    Route::group(['middleware' => ['auth', 'checkRole:1,2,3,4,5']], function() {
        Route::prefix('/profile')->group(function(){
            Route::get('/', 'BackWeb\ProfileController@index')->name('profile.index');
            Route::patch('/edit', 'BackWeb\ProfileController@edit')->name('profile.edit');
            Route::patch('/change-password', 'BackWeb\ProfileController@change_password')->name('profile.change-password');
        });
    });

    // Super Admin, Admin, Viewer 
    Route::group(['middleware' => ['auth', 'checkRole:1,2,3']], function() {
        Route::prefix('/process')->name('process.')->group(function(){
            Route::prefix('/not-completed')->group(function(){
                Route::get('/', 'BackWeb\Process\NotCompletedController@index')->name('not-completed.index');
            });
            Route::prefix('/all-process')->group(function(){
                Route::get('/', 'BackWeb\Process\AllProcessController@index')->name('all-process.index');
            });
            Route::prefix('/queue')->group(function(){
                Route::get('/', 'BackWeb\Process\QueueController@index')->name('queue.index');
                Route::post('/', 'BackWeb\Process\QueueController@index')->name('queue.index');
                Route::get('/detail/{id}', 'BackWeb\Process\QueueController@detail')->name('queue.detail');
                Route::patch('/action/{id}', 'BackWeb\Process\QueueController@action')->name('queue.action');
            });
            Route::prefix('/rejected')->group(function(){
                Route::get('/', 'BackWeb\Process\RejectedController@index')->name('rejected.index');
                Route::post('/', 'BackWeb\Process\RejectedController@index')->name('rejected.index');
                Route::get('/detail/{id}', 'BackWeb\Process\RejectedController@detail')->name('rejected.detail');
            });
            Route::prefix('/expired')->group(function(){
                Route::get('/', 'BackWeb\Process\ExpiredController@index')->name('expired.index');
                Route::post('/', 'BackWeb\Process\ExpiredController@index')->name('expired.index'); 
                Route::get('/detail/{id}', 'BackWeb\Process\ExpiredController@detail')->name('expired.detail');
            });
            Route::prefix('/approved')->group(function(){
                Route::get('/', 'BackWeb\Process\ApprovedController@index')->name('approved.index');
                Route::post('/', 'BackWeb\Process\ApprovedController@index')->name('approved.index');
                Route::get('/detail/{id}', 'BackWeb\Process\ApprovedController@detail')->name('approved.detail');
            });
            Route::prefix('/request-for-claim')->group(function(){
                Route::get('/', 'BackWeb\Process\RequestForClaimController@index')->name('request-for-claim.index');
                Route::post('/', 'BackWeb\Process\RequestForClaimController@index')->name('request-for-claim.index');
                Route::get('/detail/{id}', 'BackWeb\Process\RequestForClaimController@detail')->name('request-for-claim.detail');
                Route::patch('/action/{id}', 'BackWeb\Process\RequestForClaimController@action')->name('request-for-claim.action');
            });
            Route::prefix('/claimed')->group(function(){
                Route::get('/', 'BackWeb\Process\ClaimedController@index')->name('claimed.index');
                Route::post('/', 'BackWeb\Process\ClaimedController@index')->name('claimed.index');
                Route::get('/detail/{id}', 'BackWeb\Process\ClaimedController@detail')->name('claimed.detail');
                Route::patch('/detail/{id}', 'BackWeb\Process\ClaimedController@edit')->name('claimed.edit'); 
            });
            Route::prefix('/rejected-claim')->group(function(){
                Route::get('/', 'BackWeb\Process\RejectedClaimController@index')->name('rejected-claim.index');
                Route::post('/', 'BackWeb\Process\RejectedClaimController@index')->name('rejected-claim.index');
                Route::get('/detail/{id}', 'BackWeb\Process\RejectedClaimController@detail')->name('rejected-claim.detail');
            });
        });
    });

    // Partner 
    Route::group(['middleware' => ['auth', 'checkRole:4']], function() {
        Route::prefix('/partner')->name('partner.')->group(function(){
            Route::prefix('/list-voucher')->group(function(){
                Route::get('/', 'BackWeb\Partner\ListVoucherController@index')->name('list-voucher.index');
                Route::get('/export/{id}/{status}', 'BackWeb\Partner\ListVoucherController@export')->name('list-voucher.export');
                Route::patch('/sold/{id}', 'BackWeb\Partner\ListVoucherController@sold')->name('list-voucher.sold');
            });
        });
    });


    // Super Admin & Admin 
    Route::group(['middleware' => ['auth', 'checkRole:1,2']], function() {
        Route::prefix('/partner')->name('partner.')->group(function(){
            Route::prefix('/register-new-partner')->group(function(){
                Route::get('/', 'BackWeb\Partner\RegisterNewPartnerController@index')->name('register-new-partner.index');
                Route::get('/detail/{id}', 'BackWeb\Partner\RegisterNewPartnerController@detail')->name('register-new-partner.detail');
                Route::post('/create', 'BackWeb\Partner\RegisterNewPartnerController@create')->name('register-new-partner.create');
                Route::get('/export/{id}/{status}', 'BackWeb\Partner\RegisterNewPartnerController@export')->name('register-new-partner.export');
                Route::get('/edit/{id}', 'BackWeb\Partner\RegisterNewPartnerController@view')->name('register-new-partner.view');
                Route::patch('/edit/{id}', 'BackWeb\Partner\RegisterNewPartnerController@edit')->name('register-new-partner.edit');
                Route::patch('/sold/{id}', 'BackWeb\Partner\RegisterNewPartnerController@sold')->name('register-new-partner.sold');
                Route::delete('/delete/{id}', 'BackWeb\Partner\RegisterNewPartnerController@delete')->name('register-new-partner.delete');
            });
        });
    });

    // Super Admin 
    Route::group(['middleware' => ['auth', 'checkRole:1,2']], function() {
        Route::prefix('/process')->name('process.')->group(function(){
            Route::prefix('/queue')->group(function(){
                Route::patch('/action/{id}', 'BackWeb\Process\QueueController@action')->name('queue.action');
            });
            Route::prefix('/approved')->group(function(){
                Route::patch('/action/{id}', 'BackWeb\Process\ApprovedController@action')->name('approved.action');
            });
        });
        Route::prefix('/partner')->name('partner.')->group(function(){
            Route::prefix('/register-new-partner')->group(function(){
                Route::patch('/sold/{id}', 'BackWeb\Partner\RegisterNewPartnerController@sold')->name('register-new-partner.sold');
            });
            Route::prefix('/generate-voucher')->group(function(){
                Route::get('/', 'BackWeb\Partner\GenerateVoucherController@index')->name('generate-voucher.index');
                Route::post('/create', 'BackWeb\Partner\GenerateVoucherController@create')->name('generate-voucher.create');
                Route::get('/export/{id}/{inserted_at}', 'BackWeb\Partner\GenerateVoucherController@export')->name('generate-voucher.export');
            });
        });
        Route::prefix('/setting')->name('setting.')->group(function(){
            Route::prefix('/user-management')->group(function(){
                Route::get('/', 'BackWeb\Setting\UserManagementController@index')->name('user-management.index');
                Route::post('/create', 'BackWeb\Setting\UserManagementController@create')->name('user-management.create');
                Route::get('/edit/{id}', 'BackWeb\Setting\UserManagementController@view')->name('user-management.view');
                Route::patch('/edit/{id}', 'BackWeb\Setting\UserManagementController@edit')->name('user-management.edit');
                Route::delete('/delete/{id}', 'BackWeb\Setting\UserManagementController@delete')->name('user-management.delete');
            });
            // Route::prefix('/notification')->group(function(){
            //     Route::get('/', 'BackWeb\Setting\NotificationController@index')->name('notification.index');
            // });
            Route::prefix('/store-management')->group(function(){
                Route::get('/', 'BackWeb\Setting\StoreManagementController@index')->name('store-management.index');
                Route::post('/create', 'BackWeb\Setting\StoreManagementController@create')->name('store-management.create');
                Route::get('/edit/{id}', 'BackWeb\Setting\StoreManagementController@view')->name('store-management.view');
                Route::patch('/edit/{id}', 'BackWeb\Setting\StoreManagementController@edit')->name('store-management.edit');
                Route::delete('/delete/{id}', 'BackWeb\Setting\StoreManagementController@delete')->name('store-management.delete');
            });
            Route::prefix('/app-version')->group(function(){
                Route::get('/', 'BackWeb\Setting\AppVersionController@index')->name('app-version.index');
                Route::patch('/edit', 'BackWeb\Setting\AppVersionController@edit')->name('app-version.edit');
            });
        });
    });

    Auth::routes(['register' => false]);
    // Auth::routes();
});
URL::forceScheme('https');


