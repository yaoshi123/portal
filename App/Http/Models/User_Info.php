<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
//引入DB类
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class User_Info extends Model
{
    //注册方法
    function register($data){
        DB::insert('insert into user_info(user_name,password) values(?,?)',[$data['userName'],md5($data['password'])]);
        $rows = DB::select('select * from user_info where user_name = ? and password = ?',[$data['userName'],md5($data['password'])]);
        if($rows) {
            Session::put('user', $rows[0]);
            return true;
        }
        return false;
    }
    //登录方法
    function login($data){
        $rows = DB::select('select user_id,contact_address,email,idcard_num,img_route,tel_number,user_name from user_info where user_name = ? and password = ?',[$data['username'],md5($data['password'])]);
        if($rows) {
            Session::put('user', $rows[0]);
            return true;
        }
        return false;
    }
    //验证用户名，密码，验证码的方法
    function check($data){
        //获取用户名、密码以及code验证码
        $username = $data['username'];
        $password = $data['password'];
        $code = $data['code'];
        //判断验证码是否为空
        if(empty($code)) {
            //c1：验证码不能为空
            return back()->with('msg','验证码不能为空');
        }
        $verify = new \Code();
        if(strtoupper($code) != $verify->get()) {
            //c2：验证码不正确
            return back()->with('msg','验证码不正确');
        }
        //使用DB类
        if(empty($username) || empty($password)) {
            //c3：用户名或密码不能为空
            return back()->with('msg','用户名或密码不能为空');
        }
    }
    //验证用户名是否重复
    function checkUserNameRepear($name){
        return DB::select('select * from user_info where user_name = ?',[$name]);
    }
    //查询邮箱是否注册
    function queryEmail($data){
        return DB::select('select * from user_info where email = ?',[$data["email"]]);
    }
    //根据用户id修改用户密码
    function changePasswById($data,$id){
        return DB::update('update user_info set password = ? where user_id = ?',[md5($data['password']),$id]);
    }
    //根据用户id查询用户信息
    function queryUserInfoById($id){
        return DB::select('select user_name,tel_number,email,idcard_num,contact_address,img_route from user_info where user_id = ?',[$id]);
    }
    //根据用户id修改用户信息
    function updateUserNameById($data,$id){
        return DB::update('update user_info set user_name= ?  where user_id = ?',[$data['userName'],$id]);
    }
    //根据用户id修改用户身份证号
    function updateUserIdcardById($data,$id){
        return DB::update('update user_info set idcard_num= ?  where user_id = ?',[$data['idcardNum'],$id]);
    }
    //修改个人联系地址
    function updateUserContactAddress($data,$id){
        return DB::update('update user_info set contact_address= ?  where user_id = ?',[$data['contactAddress'],$id]);
    }
}
