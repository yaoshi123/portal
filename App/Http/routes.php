<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route::get('/', 'IndexController@index');
Route::group(['middleware'=>['web']],function(){
    Route::get('/',function(){return view('index');});
    Route::controller('index','PublicController');
    Route::controller('unit','UnitController');
    Route::controller('user','UserController');
    //跳转首页
    //跳转注册页面
    //Route::get('register',function(){return view('public/register');});
    //跳转登录页面
    //Route::get('login',function(){return view('public/login');});
    //跳转房屋鉴定申请
//    Route::get('houseApplicant',function() {
//        if (empty(session('admin')->user_name)) {
//            return view('public.login');
//        }
//        return view('public.houseApplicant');} );
    //跳转到投诉信息
//    Route::get('houseComplaint',function() {
//        if (empty(session('admin')->user_name)) {
//            return view('public.login');
//        }
//        return view('public.houseComplaint');});
    //退出登录
  //  Route::get('quit','PublicController@quit');
    //获取验证码
    //Route::get('code','publicController@code');
    //用户注册
    //Route::post('register','PublicController@register');
    //登录页面
    //Route::post('login','PublicController@login');
    //提交房屋申请
    //Route::post('houseApplicantSubmit','PublicController@houseApplicantSubmit');
    //获取房屋鉴定申请的信息
    //Route::post('houseApplicantInfo','PublicController@houseApplicantInfo');
    //获取指定id的房屋鉴定申请信息
    //Route::post('selectHouseApplicantInfoById','PublicController@selectHouseApplicantInfoById');
    //修改指定id的房屋鉴定申请信息
    //Route::post('updateHouseApplicantInfoById','PublicController@updateHouseApplicantInfoById');
    //删除房屋鉴定申请信息
    //Route::post('deleteHouseApplicant','PublicController@deleteHouseApplicant');
    //提交房屋投诉
    //Route::post('houseComplaintSubmit','PublicController@houseComplaintSubmit');
    //获取房屋投诉的信息
    //Route::post('houseComplaintInfo','PublicController@houseComplaintInfo');
});
/*Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax'], function(){
    Route::post('houseApplicantInfo', 'AjaxController@houseApplicantInfo');
});*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

