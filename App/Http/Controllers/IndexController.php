<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User_Info;
use App\Http\Requests;

class IndexController extends Controller
{
    //
    function index(){
       /*保存数据
       $userInfo = new User_Info();
        $userInfo->user_name = 'asdfa';
        $userInfo->save();
        return view('index');*/
        //显示所有数据
        /*$datas = (new User_Info())->all();
        foreach($datas as $rows){
            echo '用户id'.$rows->user_id.'$nbsp';
        }*/
        //查找指定记录，修改
        if($_REQUEST!=null){
            if($_GET['a']=='login'){
                return view('public.login');
            }

            if($_REQUEST['a']=="register"){
                $userinfo = new User_Info($_REQUEST);
                $userinfo->save();
                echo'成功';
             }
        }
        return view('index');
    }
    static function edit(){
        echo '编辑';
    }
}
