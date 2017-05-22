<?php

namespace App\Http\Controllers;
use App\Http\Models\Complaint_Info;
use App\Http\Models\Appraise_Report;
use App\Http\Models\House_Safety_Identity_Report;
use App\Http\Models\Identity_Unit_Info;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Models\User_Info;
use App\libs\utils\CodeUtils;
class PublicController extends Controller
{
    //定义注册方法
    public function postRegister(){
        $userInfo = new User_Info();
        if($userInfo->register(Input::all())){
            return response()->json(array('status'=>true));
        }
        return response()->json(array('status'=>false));
    }
    //验证用户名是否重复
    public function postCheckusernamerepeat(){
        $userinfo = new User_Info();
        if($userinfo->checkUserNameRepear(Input::all()['username'])){
            return response()->json(true);
        };
        return response()->json(false);
    }
    //定义普通用户login方法
    public function postUserlogin(){
        Session::put('unit', null);
        Session::put('user', null);
        Session::put('userLoginNum',Session::get('userLoginNum')==null?1:Session::get('userLoginNum')+1);
        $userLoginNum=Session::get('userLoginNum');
        if($userLoginNum>2){
            if(Input::all()['userCode']==''){
                return response()->json(array('status'=>false,'msg'=>'请输入验证码'));
            }else if(strtolower(Input::all()['userCode'])!=strtolower($_SESSION['code'])){
                return response()->json(array('status'=>false,'msg'=>'输入的验证码错误'));
            }
        }
        $userinfo = new User_Info();
        if($userinfo->login($input = Input::all())){
            return response()->json(array('status'=>true,'msg'=>'登录成功'));
        }

        return response()->json(array('status'=>false,'msg'=>'用户名或密码错误','userLoginNum'=>$userLoginNum));
    }
    //定义鉴定单位的login方法
    public function postIdentityunitlogin(){
        Session::put('unit', null);
        Session::put('user', null);
        Session::put('unitLoginNum',Session::get('unitLoginNum')==null?1:Session::get('unitLoginNum')+1);
        $unitLoginNum=Session::get('unitLoginNum');
        if($unitLoginNum>2){
            if(Input::all()['unitCode']==''){
                return response()->json(array('status'=>false,'msg'=>'请输入验证码'));
            }else if(strtolower(Input::all()['unitCode'])!=strtolower($_SESSION['code'])){
                return response()->json(array('status'=>false,'msg'=>'输入的验证码错误'));
            }
        }
        $identityunitinfo = new Identity_Unit_Info();
        if($identityunitinfo->login($input = Input::all())){
            return response()->json(array('status'=>true,'msg'=>'登录成功'));
        }

        return response()->json(array('status'=>false,'msg'=>'用户名或密码错误','unitLoginNum'=>$unitLoginNum));
    }
    //退出登录
    public function getQuit(){
        Session::put('unit', null);
        Session::put('user', null);
        return redirect('index');
    }
    //修改指定id的房屋申请信息
    function postUpdatehouseapplicantinfobyid(){
        $houseIdentity = new Appraise_Report();

        //return response()->json(array(Input::all()));
       if($houseIdentity->updateHouseApplicantInfoById(Input::all())){
           return response()->json(array(
               'status' =>'success',
           ));
       }else{
           return response()->json(array(
               'status' =>'failed',
           ));
       };
    }
    //跳转首页
    function getIndex(){
        return view('index');
    }
    //跳转注册页面
    function getRegister(){
        return view('public/register');
    }
    //跳转登录页面
    function getLogin(){
        return view("public/login");
        //return view("test");
    }
    //查询已经提交的鉴定报告
    function postQueryidentityreports(){
        $identityReports = new House_Safety_Identity_Report();
        $reports = $identityReports->queryIdentityReports(Input::all());
        if($reports){
            return response()->json(array(
                'status' =>'success',
                'msg' => $reports
            ));
        }else{
            return response()->json(array(
                'status' =>'success',
                'msg' => null
            ));
        }
    }
    //根据鉴定报告id查询鉴定信息
    function postQueryidentityreportbyid(){
        $identityReports = new House_Safety_Identity_Report();
        $row = $identityReports->queryIdentityReportById($_POST['reportId']);
        return response()->json($row);
    }
    //根据传入的id修改报告信息
    function postUpdateidentityreportbyid(){
        $identityReport = new House_Safety_Identity_Report();
        $flag = $identityReport->updateIdentityReportById(Input::all());
        if($flag==1){
            return response()->json(array('status'=>true,'msg'=>'SUCCESS'));
        }elseif($flag==0){
            return response()->json(array('status'=>false,'msg'=>'NOCHANGE'));
        }
    }
    //根据鉴定报告id修改报告状态
    function postUpdateappraisereportstatebyid(){
        $report = new House_Safety_Identity_Report();
        //return response()->json(true);
        if($report->updateAppraiseReportStatusById(Input::all())){
            return response()->json(true);
        }else{
            return response()->json(false);
        };
    }
    //根据申请人查询鉴定报告
    function postQueryappraisereportsbyappliant(){
        $report = new House_Safety_Identity_Report();
        $reports = $report->queryAppraiseReportsByAppliant(Input::all());
        if($reports){
            return response()->json(array(
                'status' =>true,
                'msg' => $reports
            ));
        }else{
            return response()->json(array(
                'status' =>false,
                'msg' => null
            ));
        }
    }
    //跳转找回密码验证手机号
    function getFindpassw(){
        return view('public.findPassw');
    }
    //跳转鉴定单位信息页面
    function getAppraiseunits(){
        return view("public.appraiseUnits");
    }
    //找回密码发送邮件
    function postSendmail(){
        $user = new User_Info();
        $rows = $user->queryEmail(Input::all());
        if($rows){
            $code = rand(1000,9999);
            Session::put('emailCode',$code);
            $flag = Mail::send('emailMessage',['code'=>$code],function($message){
                $to = Input::all()['email'];
                $message ->to($to)->subject('长沙房安密码找回');
            });
            if($flag){
                return response()->json(array('status'=>true,'msg'=>'发送成功'));
            }else{
                return response()->json(array('status'=>false,'msg'=>'发送失败'));
            }
        }
        return response()->json(array('status'=>false,'msg'=>'您输入的帐号不存在，可进行注册'));
    }
    //发送图形验证码
    function getCode(){
        $codeUtil = new CodeUtils();
        $codeUtil->make();
    }
    //验证发送的邮箱验证码
    function postValidateemailcode(){
        if(Input::all()['emailCode']==Session::get('emailCode')){
            $user = new User_Info();
            $rows = $user->queryEmail(Input::all());
            if($rows){
                Session::put("userInfo",$rows[0]);
                return response()->json(array('status'=>true,'msg'=>'验证成功'));
            }
            return response()->json(array('status'=>false,'msg'=>'您输入的帐号不存在，可进行注册'));
        }
        return response()->json(array('status'=>false,'msg'=>'验证码错误'));
    }
    //跳转重置密码页面
    function getResetpassw(){
        if(Session::get('userInfo')){
            return view('public.resetPassw');
        }
        return view('public.login');
    }
    //确认修改密码
    function postChangepassw(){
        $user = new User_Info();
        if($user->changePasswById(Input::all(),Session::get('userInfo')->user_id)){
            Session::put('userInfo',null);
            return response()->json(array('status'=>true,'msg'=>'密码修改成功'));
        }
        return response()->json(array('status'=>false,'msg'=>'请设置新密码'));
    }
    //获取前一页的refer
    function getTest(){
        return view('test');
    }
    //获取前一页的refer
    function getTest1(){
        echo $_SERVER['HTTP_REFERER'];
    }
    //查询鉴定单位信息
    function postQueryappraiseinfos(){
        $identityUnitInfo = new Identity_Unit_Info();
        $rows = $identityUnitInfo->queryAppraiseInfos();
        if($rows){
            return response()->json(array('status'=>true,'msg'=>$rows));
        }
        return response()->json(array('status'=>false,'msg'=>'获取鉴定单位信息失败！'));
    }
    //查询鉴定单位id查询鉴定单位信息
    function postQueryappraiseinfobyunitid(){
        $identityUnitInfo = new Identity_Unit_Info();
        $row = $identityUnitInfo->queryAppraiseInfoByUnitId(Input::all());
        if($row){
            return response()->json(array('status'=>true,'msg'=>$row));
        }
        return response()->json(array('status'=>false,'msg'=>'获取鉴定单位信息失败！'));
    }
    //查询鉴定单位名字查询鉴定单位信息
    function postQueryappraiseinfobyunitname(){
        $identityUnitInfo = new Identity_Unit_Info();
        $row = $identityUnitInfo->queryAppraiseInfoByUnitName(Input::all());
        if($row){
            return response()->json(array('status'=>true,'msg'=>$row));
        }
        return response()->json(array('status'=>false,'msg'=>'获取鉴定单位信息失败！'));
    }
}
