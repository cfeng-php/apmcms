<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use View;
use Route;

class BaseController extends Controller {


    protected  $repository;

    public function __construct()
    {
        // $this->middleware('auth.admin');

        //绑定当前路由名 菜单可以显示active
		View::composer('layouts.partials.sidebar', function($view) {
		    $route_name = Route::currentRouteName();
		    $menu_config_json = '{
				"dashboard":{
					"pages":["dashboard"]
				},
				"service":{
					"items":{
						"service_list":{"pages":[
							"service.service",
							"service.add",
							"service.show"
						]},
						"metric_list":{"pages":[
							"metric.list",
							"metric.add",
							"metric.show"
						]},
						"installed_list":{"pages":[
							"installed.list",
							"installed.add",
							"installed.edit",
							"installed.show"
						]}
					}
				},
				"doc":{
					"items":{
						"type_list":{"pages":[
							"type.list"
						]},
						"text_list":{"pages":[
							"text.list",
							"text.edit",
							"text.add"
						]}
					}
				},
				"admin":{
					"items":{
						"user_list":{"pages":[
							"admin.list",
							"admin.add",
							"admin.edit"
						]}
					}
				}
			}';
		    $menu_config = json_decode($menu_config_json,true);

		    foreach( $menu_config as $_name => $first ){
		        if( isset( $first['pages'] ) ){
		            $menu[$_name] = in_array( $route_name, $first['pages'] );
		        }else{
		            $menu[$_name] = false;
		            foreach( $first["items"] as $_name2 => $second ){
		                $menu[$_name2] = in_array( $route_name, $second['pages'] );
		                $menu[$_name] = ( $menu[$_name] || $menu[$_name2] );
		            }
		        }
		    }
		    $view->with('menu', $menu);
		    $view->with('route_name', $route_name);
		});
    }
}
