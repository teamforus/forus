<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function() {
    Route::group(['prefix' => '/identity'], function() {
        Route::post('/', 'IdentityController@store');

        Route::group(['prefix' => '/proxy'], function() {
            Route::post('/code', 'IdentityController@proxyAuthorizationCode');
            Route::post('/token', 'IdentityController@proxyAuthorizationToken');
            Route::post('/email', 'IdentityController@proxyAuthorizationEmailToken');

            Route::group(['prefix' => '/authorize'], function() {
                Route::get('/email/{source}/{emailToken}', 'IdentityController@proxyAuthorizeEmail');
            });
        });
    });
});

Route::group(['namespace' => 'Api', 'middleware' => ['api.auth']], function() {
    Route::group(['prefix' => '/identity'], function() {
        Route::get('/pin-code/{pinCode}', 'IdentityController@checkPinCode');
        Route::post('/pin-code', 'IdentityController@updatePinCode');

        /**
         * Identity proxies
         */
        Route::group(['prefix' => '/proxy'], function() {
            Route::delete('/', 'IdentityController@proxyDestroy');

            Route::group(['prefix' => '/authorize'], function() {
                Route::post('/code', 'IdentityController@proxyAuthorizeCode');
                Route::post('/token', 'IdentityController@proxyAuthorizeToken');
            });
        });

        /**
         * Record categories
         */
        Route::group(['prefix' => '/record-categories'], function() {
            Route::get('/', 'Identity\RecordCategoryController@index');
            Route::post('/', 'Identity\RecordCategoryController@store');
            Route::put('/sort', 'Identity\RecordCategoryController@sort');
            Route::get('/{recordCategoryId}', 'Identity\RecordCategoryController@show');
            Route::put('/{recordCategoryId}', 'Identity\RecordCategoryController@update');
            Route::delete('/{recordCategoryId}', 'Identity\RecordCategoryController@destroy');
        });

        /**
         * Record
         */
        Route::group(['prefix' => '/records'], function() {
            Route::get('/', 'Identity\RecordController@index');
            Route::post('/', 'Identity\RecordController@store');
            Route::get('/types', 'Identity\RecordController@typeKeys');
            Route::put('/sort', 'Identity\RecordController@sort');
            Route::get('/{recordId}', 'Identity\RecordController@show');
            Route::put('/{recordId}', 'Identity\RecordController@update');
            Route::delete('/{recordId}', 'Identity\RecordController@destroy');
        });
    });

    Route::get('/status', function() {
        return [
            'status' => 'ok'
        ];
    });
});
