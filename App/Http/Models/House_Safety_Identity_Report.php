<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2017/3/30
 * Time: 9:35
 */

namespace App\Http\Models;

//引入DB类
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class House_Safety_Identity_Report
{
    //鉴定报告修改状态
    function changeIdentityReportSubmit($data){
        return DB::insert('insert into h_s_appraise_report(id,create_name,create_by,create_date,update_name,update_by,update_date,
                                                              sys_org_code,sys_company_code,bpm_status,report_num,applicant,address,
                                                              appraise_purpose,appraise_condition,appraise_unit,inspector,destroyed_reason,
                                                              conclusion_handle,district_appraise_staff,city_appraise_staff,city_appraise_leader,
                                                              house_name,build_end_year,owner_ship,phone,build_area,certificate_num,use_unit,use_property,
                                                              structure,plane_form,layer_number,house_use,house_basic_facts,street,district,property,
                                                              use_yesr,danger_level,remark,send_date,record_date,receiver_in,receiver_to,file_route,
                                                              unit_id
                                                              ) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [md5(time() . rand(0,1000)),"",date("Y-m-d H:i:s"),"","","","",
            "","","",$data['reportId'],
                $data['owner'],$data['telNumber'],$data['buildUser'],
                $data['structType'],$data['useProperty'],$data['planeForm'],$data['houseFloors'],$data['housePurpose'],$data['houseArea'],$data['houseCertificate'],$data['identtiyPurpose'],$data['identityCondition'],
                $data['identityUnit'],$data['destroyedReason'],$data['conclusionHandle'],$data['quAppraiser'],$data['shiAppraiser'],$data['shiCharger'],'',Session::get('unit')->identity_unit_id]);
    }
    //鉴定报告提交
    function appraiseReportSubmit($data){
        return DB::insert('insert into h_s_appraise_report(id,create_name,create_date,update_name,update_date,report_num,
                                                            applicant,address,appraise_purpose,appraise_condition,appraise_unit,inspector,
                                                            destroyed_reason,conclusion_handle,district_appraise_staff,city_appraise_staff,city_appraise_leader,house_name,
                                                            build_end_year,owner_ship,phone,build_area,certificate_num,use_unit,
                                                            use_property,structure,plane_form,layer_number,house_use,house_basic_facts,
                                                            street,district,property,use_yesr,danger_level,remark,
                                                            unit_id,bpm_status) values ( ?,?,?,?,?,?,?,?,?,?,
                                                                              ?,?,?,?,?,?,?,?,?,?,
                                                                              ?,?,?,?,?,?,?,?,?,?,
                                                                              ?,?,?,?,?,?,?,?)',
                                                        [md5(uniqid().mt_rand(1,10000)),Session::get('unit')->identity_unit_name,date('Y-m-d H:i:s'),'',date('Y-m-d H:i:s'),$data['reportNum'],
                                                            $data['applicant'],$data['address'],$data['appraisePurpose'],$data['appraiseCondition'],$data['appraiseUnit'],$data['inspector'],
                                                            $data['destroyedReason'],$data['conclusionHandle'],$data['districtAppraiseStaff'],$data['cityAppraiseStaff'],$data['cityAppraiseLeader'],$data['houseName'],
                                                            $data['buildEndYear'],$data['ownerShip'],$data['phone'],$data['buildArea'],$data['certificateNum'],$data['useUnit'],
                                                            $data['useProperty'],$data['structure'],$data['planeForm'],$data['layerNumber'],$data['houseUse'],$data['houseBasicFacts'],
                                                            $data['street'],$data['district'],$data['property'],$data['useYear'],$data['dangerLevel'],$data['remark'],
                                                            Session::get('unit')->identity_unit_id,'0']);
    }
    //查询鉴定报告信息
    function queryAppraiseReports($data){
        $rows = DB::select('select * from h_s_appraise_report where unit_id = ? ORDER BY update_date DESC ',[Session::get('unit')->identity_unit_id]);
        return array('array'=>array_slice($rows,($data['pageNum']-1)*10,'10'),'length'=>count($rows));
    }
    //保存附件路径
    function saveFileRoute($route,$reportId){
        DB::update('update h_s_appraise_report set file_route = ? where report_num = ?',[$route,$reportId]);
    }
    //根据鉴定报告编号显示查询的信息
    function queryShowAppraiseReportByReportNum($data){
        $rows =  DB::select('select * from h_s_appraise_report where report_num = ? ',[$data['reportNum']]);
        //查询鉴定的数据字典
        //健康等级
        $typeGroup = DB::select ('select * from t_s_typegroup where typegroupcode = ?',['danger_level']);
        $row = DB::select('select * from t_s_type where typegroupid = ? and typecode = ?',[$typeGroup['0']->ID,$rows['0']->danger_level]);
        $rows['0']->danger_level= $row['0']->typename;
        //结构类型
        $typeGroup = DB::select ('select * from t_s_typegroup where typegroupcode = ?',['structure']);
        $row = DB::select('select * from t_s_type where typegroupid = ? and typecode = ?',[$typeGroup['0']->ID,$rows['0']->structure]);
        $rows['0']->structure= $row['0']->typename;
        //平面形式
        $typeGroup = DB::select ('select * from t_s_typegroup where typegroupcode = ?',['plane_form']);
        $row = DB::select('select * from t_s_type where typegroupid = ? and typecode = ?',[$typeGroup['0']->ID,$rows['0']->plane_form]);
        $rows['0']->plane_form= $row['0']->typename;
        return $rows;
    }
    //根据鉴定报告编号编辑鉴定信息
    function queryAppraiseReportByReportNum($data){
        $rows =  DB::select('select * from h_s_appraise_report where report_num = ? ',[$data['reportNum']]);
        return $rows;
    }
    //根据申请人和鉴定报告的编号查询鉴定信息
    function queryAppraiseReportByReportNumAndApplicant($data){
        return DB::select('select * from h_s_appraise_report where report_num = ? and applicant = ? ',[$data['reportNum'],session('user')->user_name]);
    }
    //更新鉴定报告
    function updateAppraiseReportById($data){
        return DB::update('update h_s_appraise_report set update_name=?,update_date=?,
                                                            applicant=?,address=?,appraise_purpose=?,appraise_condition=?,appraise_unit=?,inspector=?,
                                                            destroyed_reason=?,conclusion_handle=?,district_appraise_staff=?,city_appraise_staff=?,city_appraise_leader=?,house_name=?,
                                                            build_end_year=?,owner_ship=?,phone=?,build_area=?,certificate_num=?,use_unit=?,
                                                            use_property=?,structure=?,plane_form=?,layer_number=?,house_use=?,house_basic_facts=?,
                                                            street=?,district=?,property=?,use_yesr=?,danger_level=?,remark=?,
                                                            unit_id=?
                                                            where report_num = ?',
                                                        [Session::get('unit')->identity_unit_name,date('Y-m-d H:i:s'),
                                                         $data['applicant'],$data['address'],$data['appraisePurpose'],$data['appraiseCondition'],$data['appraiseUnit'],$data['inspector'],
                                                         $data['destroyedReason'],$data['conclusionHandle'],$data['districtAppraiseStaff'],$data['cityAppraiseStaff'],$data['cityAppraiseLeader'],$data['houseName'],
                                                         $data['buildEndYear'],$data['ownerShip'],$data['phone'],$data['buildArea'],$data['certificateNum'],$data['useUnit'],
                                                         $data['useProperty'],$data['structure'],$data['planeForm'],$data['layerNumber'],$data['houseUse'],$data['houseBasicFacts'],
                                                         $data['street'],$data['district'],$data['property'],$data['useYear'],$data['dangerLevel'],$data['remark'],
                                                         Session::get('unit')->identity_unit_id,
                                                         $data['reportNum']]);

    }
    //根据id修改鉴定报告状态
    function updateAppraiseReportStatusById($data){
        return  DB::update('update h_s_appraise_report set bpm_status = ?,send_date= ? where id = ?',[$data['bpmStatus'],date('Y-m-d H:i:s'),$data['id']]);
    }
    //删除鉴定报告通过id
    function deleteAppraiseReportById($data){
        return DB::delete('delete from h_s_appraise_report where id = ?',[$data['id']]);
    }
    //根据申请人查询鉴定报告id
    function queryAppraiseReportsByAppliant($data){
        $rows = DB::select('select * from h_s_appraise_report where applicant = ? and bpm_status != 0 ORDER BY send_date DESC ',[session('user')->user_name]);
        return array('array'=>array_slice($rows,($data['pageNum']-1)*10,'10'),'length'=>count($rows));
    }
    //根据鉴定报告查查鉴定报告附件路径
    function queryFileRouteByReportNum($data){
        return DB::select('select * from h_s_appraise_report where report_num = ?',[$data['reportId']]);
    }
}