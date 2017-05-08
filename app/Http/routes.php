<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('info', function () {
    echo phpinfo();
    //return view('welcome');
});

Route::get('login','Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

//管理员路由  'prefix' => 'admin',
Route::group(['middleware' => 'auth'],function(){
    Route::any('/',['uses' => 'DashboardController@index', 'as' => 'dashboard']);

    Route::group(['prefix' => 'admin'],function(){
        Route::any('list',['uses' => 'AdminController@index', 'as' => 'admin.list']);
        Route::any('add',['uses' => 'AdminController@add', 'as' => 'admin.add']);
        Route::any('store',['uses' => 'AdminController@store', 'as' => 'admin.store']);
        Route::any('edit/{id}',['uses' => 'AdminController@edit', 'as' => 'admin.edit']);
        Route::any('update/{id}',['uses' => 'AdminController@update', 'as' => 'admin.update']);
        Route::any('active/{id}',['uses' => 'AdminController@active', 'as' => 'admin.active']);
        Route::any('change/{id}',['uses' => 'AdminController@changePwd', 'as' => 'admin.changepwd']);
    });

    Route::group(['prefix' => 'service'],function(){
        Route::any('/',['uses' => 'MetricController@service', 'as' => 'service.service']);
        Route::any('show/{integration}',['uses' => 'MetricController@show', 'as' => 'service.show']);
        Route::any('update/{integration}',['uses' => 'MetricController@update', 'as' => 'service.update']);
        Route::any('del/{integration}',['uses' => 'MetricController@del', 'as' => 'service.del']);
        Route::any('add',['uses' => 'MetricController@add', 'as' => 'service.add']);

        Route::group(['prefix' => 'metric'],function(){
            Route::any('/',['uses' => 'MetricController@metricList', 'as' => 'metric.list']);
            Route::any('show/{metric_name}',['uses' => 'MetricController@metricShow', 'as' => 'metric.show']);
            Route::any('update',['uses' => 'MetricController@metricUpdate', 'as' => 'metric.update']);
            Route::any('del/{metric_name}',['uses' => 'MetricController@metricDel', 'as' => 'metric.del']);
            Route::any('add',['uses' => 'MetricController@metricAdd', 'as' => 'metric.add']);
        });
        Route::group(['prefix' => 'installed'],function(){
            Route::any('/',['uses' => 'MetricController@installedList', 'as' => 'installed.list']);
            Route::any('show/{metric_name}',['uses' => 'MetricController@installedShow', 'as' => 'installed.show']);
            Route::any('edit/{metric_name}',['uses' => 'MetricController@installedEdit', 'as' => 'installed.edit']);
            Route::any('update',['uses' => 'MetricController@installedUpdate', 'as' => 'installed.update']);
            Route::any('del/{metric_name}',['uses' => 'MetricController@installedDel', 'as' => 'installed.del']);
            Route::any('add',['uses' => 'MetricController@installedAdd', 'as' => 'installed.add']);
        });
    });

    Route::group(['prefix' => 'doc'],function(){
        Route::group(['prefix' => 'type'],function(){
            Route::any('/',['uses' => 'DocController@typeList', 'as' => 'type.list']);
            Route::any('edit/{id}',['uses' => 'DocController@typeEdit', 'as' => 'type.edit']);
            Route::any('del/{id}',['uses' => 'DocController@typeDel', 'as' => 'type.del']);
            Route::any('add',['uses' => 'DocController@typeAdd', 'as' => 'type.add']);
        });
        Route::group(['prefix' => 'text'],function(){
            Route::any('/',['uses' => 'DocController@textList', 'as' => 'text.list']);
            Route::any('edit/{id}',['uses' => 'DocController@textEdit', 'as' => 'text.edit']);
            Route::any('del/{id}',['uses' => 'DocController@textDel', 'as' => 'text.del']);
            Route::any('add',['uses' => 'DocController@textAdd', 'as' => 'text.add']);
            Route::any('store',['uses' => 'DocController@textStore', 'as' => 'text.add']);
            Route::any('upload',['uses' => 'DocController@upload','as' => 'text.upload']);
        });
    });


});
