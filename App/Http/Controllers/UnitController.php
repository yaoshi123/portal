<?php

namespace App\Http\Controllers;
use App\Http\Models\Complaint_Info;
use App\Http\Models\Appraise_Entrust;
use App\Http\Models\Appraise_Report;
use App\Http\Models\Depart;
use App\Http\Models\House_Identity;
use App\Http\Models\House_Safety_Identity_Report;
use App\Http\Models\Identity_Unit_Info;
use App\Http\Models\Type;
use App\libs\PHPWord\TableUtils;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    function __construct(){
        $this->middleware('checkunit');
    }
    //跳转鉴定报告表单页面
    function getAppraisereport(){
        return view('unit.appraiseReport');
    }
    //提交鉴定报告表单
    function postAppraisereportsubmit(){
        $identityReportInfo = new House_Safety_Identity_Report();
        if($identityReportInfo->appraiseReportSubmit(Input::all())){
            return response()->json(array('status'=>true));
        }
            return response()->json(array('status'=>false));
    }
    //根据传入的id修改报告信息
    function postUpdateappraisereportbyid(){
        $identityReport = new House_Safety_Identity_Report();
        //return response()->json(Input::all());
        $flag = $identityReport->updateAppraiseReportById(Input::all());
        if($flag==1){
            return response()->json(array('status'=>true,'msg'=>'SUCCESS'));
        }elseif($flag==0){
            return response()->json(array('status'=>false,'msg'=>'NOCHANGE'));
        }
    }
    //根据鉴定报告id获取鉴定报告信息
    function postQueryappraisereportbyreportnum(){
        $identityReports = new House_Safety_Identity_Report();
        $row = $identityReports->queryAppraiseReportByReportNum(Input::all());
        if($row){
            return response()->json($row['0']);
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
    //跳转测试报告显示界面
    function getReportinfos(){
        return view('unit.reportInfos');
    }
    //根据鉴定单位id获取鉴定报告信息
    function postQueryappraisereports(){
        $identityReports = new House_Safety_Identity_Report();
        $reports = $identityReports->queryAppraiseReports(Input::all());
        if($reports){
            return response()->json(array(
                'status' =>'success',
                'msg' => $reports
            ));
        }else{
            return response()->json(array(
                'status' =>'failed',
                'msg' => null
            ));
        }
    }
    //上传鉴定报告的图片ad
    function postUploadimg(){
        //上传压缩文件不能超过10m
        if($_FILES["fileField"]["size"] > 10*1024*1024){
            return response()->json(array(
                    'status' =>false,
                    'msg' => '文件过大')
            );
        }
        //压缩文件格式为zip，否则报错
        if (($_FILES["fileField"]["type"] == "application/x-zip-compressed")){
            if ($_FILES["fileField"]["error"] > 0){
                return response()->json(array(
                    'status' =>false,
                    'msg' => '发生错误')
                );
            }
            else{
                $report = new House_Safety_Identity_Report();
                $filePaths =$report->queryFileRouteByReportNum(Input::all());
                if($filePaths[0]->file_route){
                    Storage::delete($filePaths[0]->file_route);
                }
                $route = "public/uploads/zips/". md5(time() . rand(0,1000)).'.zip';
                //$saveRoute = base_path().'/public/uploads/'.iconv("UTF-8","GBK",$_FILES["fileField"]["name"]);保存中文到数据库，修改为将路径编码后保存
                $saveRoute = base_path('/storage/app/').$route;
                move_uploaded_file($_FILES["fileField"]["tmp_name"],$saveRoute);

                $report->saveFileRoute($route,$_POST["reportId"]);
                return response()->json(array(
                        'status' =>true,
                        'msg' =>'上传成功'
                    )
                );
            }
        }
        else
        {
            return response()->json(array(
                    'status' =>false,
                    'msg' => '文件类型错误')
            );
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
    //根据鉴定报告id删除鉴定报告
    function postDeleteappraisereportbyid(){
        $report = new House_Safety_Identity_Report();
        //return response()->json(true);
        if($report->deleteAppraiseReportById(Input::all())){
            return response()->json(true);
        }else{
            return response()->json(false);
        };
    }
    //下载Word文档
    function getDownloadword(){
        TableUtils::getTable(Input::all());
        return response()->download(base_path('public/uploads').'/report.docx');
    }
    //下载已上传的zip文档
    function getDownloadzip(){
        try{
            return response()->download(base_path('storage/app/'.Input::all()['zipUrl']));
        }catch (\Exception $e){
            echo '您下载的文件不存在';
        }
    }
    //跳转我的委托页面
    function getEntrustinfos(){
        if(Session::get('unit')){
            return view('unit.entrustInfos');
        }
        return view("index/login");
    }
    //根据鉴定单位的信息查询委托信息
    function postQueryentrustinfos(){
        $appraiseEntrust = new Appraise_Report();
        $row = $appraiseEntrust->queryEntrustsByName(Input::all());
        if($row){
            return response()->json(array('status'=>true,'msg'=>$row));
        }else{
            return response()->json(array('status'=>false,'msg'=>null));
        }
    }
    //鉴定单位受理鉴定委托
    function postAppraiseentrustsubmit(){
        $appraiseEntrust = new Appraise_Entrust();
        if($appraiseEntrust->entrustSubmit(Input::all())){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
    //根据id修改用户鉴定申请状态
    function postUpdateentruststatusbyid(){
        $appraiseEntrust = new Appraise_Entrust();
        if($appraiseEntrust->updateEntrustStatusById(Input::all())){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
    //根据委托id获取委托信息
    function postQueryappraiseentrustbyid(){
        $application = new Appraise_Report();
        $rows = $application->queryHouseApplicantInfoById(Input::all());
        $appraiseEntrust = new Appraise_Entrust();
        $rows2 = $appraiseEntrust->queryEntrustByAppId(Input::all());
        if($rows2){
            return response()->json(array('status'=>true,'msg'=>array('entrust'=>$rows2[0],'application'=>$rows[0])));
        }
        if($rows){
            return response()->json(array('status'=>true,'msg'=>$rows[0]));
        }
        return response()->json(array('status'=>false,'msg'=>'委托id错误'));
    }
    //获取所有区信息
    function postQuerydistrictsinfos(){
        $type = new Depart();
        $rows = $type->queryDistrictsByParentId();
        if($rows){
            return response()->json(['status'=>true,'msg'=>$rows]);
        }else{
            return response()->json(['status'=>false,'msg'=>'获取区域信息失败']);
        }
    }
    //获取所有结构类别信息
    function postQuerystructureinfos(){
        $structureId =  Config::get('constants.JIEGOULEIXINGID');
        $type = new Type();
        $rows = $type->queryStructures($structureId);
        if($rows){
            return response()->json(['status'=>true,'msg'=>$rows]);
        }else{
            return response()->json(['status'=>false,'msg'=>'获取结构类别信息失败']);
        }
    }
    //获取健康等级信息
    function postQuerydangerlevelinfos(){
        $dangerLevelId = Config::get('constants.JIANKANGDENGJIID');
        $type = new Type();
        $rows = $type->queryDangerLevel($dangerLevelId);
        if($rows){
            return response()->json(['status'=>true,'msg'=>$rows]);
        }else{
            return response()->json(['status'=>false,'msg'=>'获取健康等级信息失败']);
        }
    }
    //获取房屋类型信息
    function postQueryhousetypeinfos(){
        $houseTypeId = Config::get('constants.FANGWULEIXINGID');
        $type = new Type();
        $rows = $type->queryHouseType($houseTypeId);
        if($rows){
            return response()->json(['status'=>true,'msg'=>$rows]);
        }else{
            return response()->json(['status'=>false,'msg'=>'获取房屋类别信息失败']);
        }
    }
    //根据区域查询街道信息
    function postQuerystreetbydistrictname(){
        $depart = new Depart();
        $streets = $depart->queryStreetsByDistrictName(Input::all());
        if($streets){
            return response()->json(['status'=>true,'msg'=>$streets]);
        }else{
            return response()->json(['status'=>false,'msg'=>'获取接到信息失败！']);
        }
    }
    //查询鉴定单位信息
    function postQueryappraiseunits(){
        $unit = new Identity_Unit_Info();
        $units = $unit->queryAppraiseInfos();
        if($units){
            return response()->json(['status'=>true,'msg'=>$units]);
        }else{
            return response()->json(['status'=>false,'msg'=>'获取鉴定单位信息错误']);
        }
    }
    //查询房屋平面形式
    function postQueryhouseplaneform(){
        $type = new Type();
        $forms = $type->queryHousePlaneForm(Config::get('constants.PLANEFORMID'));
        if($forms){
            return response()->json(['status'=>true,'msg'=>$forms]);
        }else{
            return response()->json(['status'=>false,'msg'=>'查询房屋平面形式错误']);
        }
    }
}