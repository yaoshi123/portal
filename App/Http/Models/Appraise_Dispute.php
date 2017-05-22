<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2017/4/9
 * Time: 10:28
 */
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
//引入DB类
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class Appraise_Dispute extends Model{
    //鉴定纠纷表单提交
    function appraiseDisputeSubmit($data){
        $flag = DB::select('select * from h_s_report_dispute where report_num = ?',[$data['reportNum']]);
        if($flag==null){
            return DB::insert('insert into h_s_report_dispute(id,create_name,create_date,update_date,bpm_status,
                                                            report_num,house_name,district,appraise_unit,reason,
                                                            applicant_tel,appraise_tel,remark,applicant)
                                              values(?,?,?,?,?,?,?,?,?,?,?,?,?,?) ',
                [md5(uniqid().mt_rand(1,10000)),Session::get('user')->user_name,date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'0',
                    $data['reportNum'],$data['houseName'],$data['district'],$data['appraiseUnit'],$data['reason'],
                    $data['applicantTel'],$data['appraiseTel'],$data['remark'],$data['applicant']]);
        }else{
            return false;
        }
    }
    //根据用户名查询鉴定纠纷列表
    function queryApprarseDisputeByApplicant($data){
        $rows = DB::select('select * from h_s_report_dispute where create_name = ? ORDER BY update_date DESC ',[Session::get('user')->user_name]);
        return array('array'=>array_slice($rows,($data['pageNum']-1)*10,'10'),'length'=>count($rows));
    }
    //根据report_num修改鉴定纠纷
    function updateAppraiseDisputeByReportNum($data){
        return DB::update('update h_s_report_dispute set applicant=?,update_date=?,house_name=?,district=?,appraise_unit=?,
                                                           reason=?,applicant_tel=?,appraise_tel=?,remark=? where report_num=?',
                                                          [$data['applicant'],date('Y-m-d H:i:s'),$data['houseName'],$data['district'],$data['appraiseUnit'],
                                                          $data['reason'],$data['applicantTel'],$data['appraiseTel'],$data['remark'],$data['reportNum']]);
    }
    //根据report_num查询鉴定纠纷详细信息
    function queryAppraiseDisputeByReportNum($data){
        return DB::select('select * from h_s_report_dispute where report_num = ?',[$data['reportNum']]);
    }
    //根据report_num删除鉴定纠纷
    function deleteAppraiseDisputeByReportNum($data){
        return DB::delete('delete from h_s_report_dispute where report_num = ? ',[$data['reportNum']]);
    }
    //根据report_num修改鉴定纠纷状态
    function updateDisputeStatusByReportNum($data){
        return DB::update('update h_s_report_dispute set bpm_status = ?,send_date=? where report_num = ?',[$data['bpmStatus'],date('Y-m-d H:i:s'),$data['reportNum']]);
    }
}