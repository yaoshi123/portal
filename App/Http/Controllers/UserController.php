<?php

namespace App\Http\Controllers;
use App\Http\Models\Appraise_Dispute;
use App\Http\Models\Appraise_Report;
use App\Http\Models\Depart;
use App\Http\Models\House_Complaint;
use App\Http\Models\Appraise_Entrust;
use App\Http\Models\House_Safety_Identity_Report;
use App\Http\Models\Identity_Unit_Info;
use App\Http\Models\User_Info;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('checkuser');
    }
    //从鉴定报告列表跳转到鉴定详细信息页面
    function getAppraisereport(){
        return view('user.appraiseReport')->with('reportNum', $_GET['reportNum']);
    }
    //跳转房屋鉴定申请
    function getHouseapplicant(){
        return view('user.houseApplicant');
    }
    //鉴定详细信息页面根据鉴定报告编号查询鉴定报告详细信息
    function postQueryappraisereportbyreportnum(){
        $report = new House_Safety_Identity_Report();
        $flag = $report->queryAppraiseReportByReportNum(Input::all());
        if($flag){
            return response()->json(array('status'=>true,'msg'=>$flag['0']));
        }else{
            return response()->json(array('status'=>false,'msg'=>null));
        }
    }
    //根据鉴定reportNum和applicant查询鉴定报告
    function postQueryappraisereportbyreportnumandapplicant(){
        $report = new House_Safety_Identity_Report();
        $flag = $report->queryAppraiseReportByReportNumAndApplicant(Input::all());
        if($flag){
            return response()->json(array('status'=>true,'msg'=>$flag['0']));
        }else{
            return response()->json(array('status'=>false,'msg'=>null));
        }
    }
    //根据鉴定纠纷中鉴定报告id获取鉴定报告详细信息
    function postQueryappraisedisputebyreportnum(){
        $dispute = new Appraise_Dispute();
        $rows = $dispute->queryAppraiseDisputeByReportNum(Input::all());
        if($rows){
            return response()->json(array('status'=>true,'msg'=>$rows[0]));
        }else{
            return response()->json(array('status'=>false,'msg'=>null));
        }
    }
    //根据鉴定报告id获取鉴定报告信息,显示
    function postQueryshowappraisereportbyreportnum(){
        $identityReports = new House_Safety_Identity_Report();
        $row = $identityReports->queryShowAppraiseReportByReportNum(Input::all());
        if($row){
            return response()->json($row['0']);
        }
    }
    //跳转用户鉴定报告列表
    function getReportinfos(){
        return view('user.reportInfos');
    }
    //鉴定报告列表跳转到鉴定纠纷页面
    function getAppraisedispute(){
        return view('user.appraiseDispute');
    }
    //鉴定纠纷页面提交信息
    function postAppraisedisputesubmit(){
        $dispute = new Appraise_Dispute();
        $flag = $dispute->appraiseDisputeSubmit(Input::all());
        if($flag){
            return response()->json(array('status'=>true,'msg'=>$flag));
        }else{
            return response()->json(array('status'=>false,'msg'=>null));
        }
    }
    //根据用户名查询鉴定纠纷列表
    function postQueryappraisedisputebyapplicant(){
        $dispute = new Appraise_Dispute();
    }
    //根据登录名查询用户的纠纷信息
    function postQuerydisputeinfos(){
        $dispute = new Appraise_Dispute();
        $data = $dispute->queryApprarseDisputeByApplicant(Input::all());
        if($data){
            return response()->json(array('status'=>true,'msg'=>$data));
        }else{
            return response()->json(array('status'=>false,'msg'=>null));
        }
    }
    //根据report_num修改鉴定纠纷
    function postUpdateappraisedisputebyreportnum(){
        $dispute = new Appraise_Dispute();
        $flag = $dispute->updateAppraiseDisputeByReportNum(Input::all());
        if($flag){
            return response()->json(array('status'=>true));
        }else{
            return response()->json(array('status'=>false));
        }
    }
    //根据report_num删除鉴定报告纠纷
    function postDeleteappraisedisputebyreportnum(){
        $dispute = new Appraise_Dispute();
        $flag = $dispute->deleteAppraiseDisputeByReportNum(Input::all());
        if($flag){
            return response()->json(array('status'=>true));
        }else{
            return response()->json(array('status'=>false));
        }
    }
    //根据report_num修改鉴定纠纷状态
    function postUpdatedisputestatusbyreportnum(){
        $dispute = new Appraise_Dispute();
        if($dispute->updateDisputeStatusByReportNum(Input::all())){
            return response()->json(array('status'=>true));
        }else{
            return response()->json(array('status'=>false));
        }
    }
    //定义提交房屋鉴定申请方法
    public function postHouseapplicantsubmit(){
        $houseAppraiseApplication = new Appraise_Report();
        return response()->json($houseAppraiseApplication->applicationSubmit(Input::all()));
    }
    //获取已经提交的房屋鉴定申请信息
    function postHouseapplicantinfo()
    {
        //查询分页结果
        $houseInfo = new Appraise_Report();
        $houseInfoMessages = $houseInfo->queryRecords($_POST['start'],$_POST['length'],Session::get('user')->user_name);
        if($houseInfoMessages){
            return response()->json(array(
                'status' =>'success',
                'msg' => $houseInfoMessages,
            ));
        }
        return response()->json(array(
            'status' =>'failed',
            'msg' => null,
        ));
    }
    //删除房屋鉴定申请信息
    function postDeletehouseapplicant(){
        $houseIdentity = new Appraise_Report();
        if($houseIdentity->deleteHouseAppraiseApplicant($_POST['id'])){
            return response()->json(array(
                'status' =>'success',
                'msg' => '删除成功',
            ));
        };
    }
    //获取指定id的房屋申请信息
    function postSelecthouseapplicantinfobyid(){
        //根据appid查询鉴定申请的信息
        $houseIdentity = new Appraise_Report();
        $data = $houseIdentity->queryHouseApplicantInfoById(Input::all());
        //根据appid查询鉴定委托的信息
        $appraiseEntrust = new Appraise_Entrust();
        $rows2 = $appraiseEntrust->queryEntrustByAppId(Input::all());
        if($rows2){
            return response()->json(array('status'=>true,'msg'=>array('entrust'=>$rows2[0],'application'=>$data[0])));
        }else if($data){
            return response()->json([
                'status' =>true,
                'msg' => array('application'=>$data[0])
            ]);
        }else{
            return response()->json([
                'status' =>false,
                'msg' => '获取信息失败',
            ]);
        }
    }
    //根据传入的id修改申请信息
    function postUpdatehouseappraiseinfobyid(){
        $houseIdentity = new Appraise_Report();
        if($houseIdentity->updateHouseAppraiseInfoById(Input::all())){
            return response()->json(array(
                'status' =>true,
            ));
        }else{
            return response()->json(array(
                'status' =>false,
            ));
        };
    }
    //根据id进行委托状态修改
    function postHouseentrust(){
        $houseEntrust = new Appraise_Entrust();
        if($houseEntrust->entrustSubmit(Input::all())){
            return response()->json(array(
                'status' =>true,
            ));
        }else{
            return response()->json(array(
                'status' =>false,
            ));
        };
    }
    //跳转到房屋投诉页面
    function getHousecomplaint(){
        return view('user.houseComplaint');
    }
    //提交房屋投诉信息
    function postHousecomplaintsubmit(){
        $houseComplaint = new House_Complaint();
        if($houseComplaint->submit(Input::all())){
            return response()->json(array('status'=>true,'msg'=>'SUCCESS'));
            //return back()->with('msg','添加成功');
        };
        return response()->json(array('status'=>false,'msg'=>'FAILED'));
    }
    //获取已经提交的房屋投诉信息
    function postHousecomplaintinfo()
    {
        //查询分页结果
        $houseComplaint = new House_Complaint();
        $houseComplaintMessages = $houseComplaint->queryComplaintInfos(Input::all());
        if($houseComplaintMessages){
            return response()->json(array(
                'status' =>true,
                'msg' => $houseComplaintMessages,
            ));
        }
        return response()->json(array(
            'status' =>false,
            'msg' => null,
        ));
    }
    //查询区建局信息
    function postQuerydepartinfos(){
        $departs = new Depart();
        $quJianJu = $departs->queryDepartInfosByParentDepartId();
        if($quJianJu){
            return response()->json(array(
                'status' =>true,
                'msg' => $quJianJu,
            ));
        }
        return response()->json(array(
            'status' =>false,
            'msg' => '获取区建局信息失败',
        ));
    }
    //查询鉴定单位的公司信息
    function postQueryappraiseunits(){
        $identityUnitInfo = new Identity_Unit_Info();
        $rows = $identityUnitInfo->queryAppraiseUnitInfos(Input::all());
        if($rows){
            return response()->json(array('status'=>true,'msg'=>$rows));
        }else{
            return response()->json(array('status'=>false,'msg'=>'获取鉴定单位信息失败！'));
        }

    }
    //跳转到个人信息页面
    function getUserinfo(){
        return view('user.userInfo');
    }
    //查询个人基本信息
    function postQueryuserinfos(){
        $userInfo = new User_Info();
        $rows = $userInfo->queryUserInfoById( Session::get('user')->user_id);
        if($rows!=null){
            return response(['status'=>true,'msg'=>$rows[0]]);
        }else{
            return response(['status'=>false,'msg'=>'获取个人信息失败']);
        }
    }
    //修改个人信息用户名
    function postUpdateusername(){
        $userInfo = new User_Info();
        $flag = $userInfo->updateUserNameById(Input::all(),Session::get('user')->user_id);
        if($flag){
            return response()->json(['status'=>true,'msg'=>'修改用户名成功']);
        }
        return response()->json(['status'=>false,'msg'=>'修改用户名失败']);
    }
    //修改个人信息用户身份证号
    function postUpdateuseridcard(){
        $userInfo = new User_Info();
        $flag = $userInfo->updateUserIdcardById(Input::all(),Session::get('user')->user_id);
        if($flag){
            return response()->json(['status'=>true,'msg'=>'修改身份证号成功']);
        }
        return response()->json(['status'=>false,'msg'=>'修改身份证号失败']);
    }
    //修改个人信息联系地址
    function postUpdateusercontactaddress(){
        $userInfo = new User_Info();
        $flag=$userInfo->updateUserContactAddress(Input::all(),Session::get('user')->user_id);
        if($flag){
            return response()->json(['status'=>true,'msg'=>'修改联系地址成功']);
        }
        return response()->json(['status'=>false,'msg'=>'修改联系地址失败']);
    }
}