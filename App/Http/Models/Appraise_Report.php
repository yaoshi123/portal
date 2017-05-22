<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2017/3/20
 * Time: 11:32
 */

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
//引入DB类
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class Appraise_Report extends Model
{
    public function applicationSubmit($data){
        return DB::insert('insert into h_s_appraise_application(create_name,create_date,bpm_status,applicant,phone,
                                                                  idcard,certificate_num,appraise_unit,address,postal_address,
                                                                  appraise_reason,remark,district,id,update_date)
                                                                  values (?,?,?,?,?,
                                                                          ?,?,?,?,?,
                                                                          ?,?,?,?,?)',
                                                                [Session::get('user')->user_name,date('Y-m-d H:i:s'),"0",$data['applicant'],$data['phone'],
                                                                    $data['idcard'],$data['certificateNum'],$data['appraiseUnit'],$data['address'],$data['postalAddress'],
                                                                    $data['appraiseReason'],$data['remark'],$data['district'],md5(uniqid().mt_rand(1,10000)),date('Y-m-d H:i:s')]);
    }
    public function queryRecords($start,$length,$name){
        $data = DB::select('select * from h_s_appraise_application
                            where create_name = ? ORDER BY  update_date DESC
                            ',[$name]);
        return array('array'=>array_slice($data,$start,$length),'length'=>count($data));
    }
    public function deleteHouseAppraiseApplicant($id){
        return DB::delete('delete from h_s_appraise_application where id= ?',[$id]);
    }
    public function queryHouseApplicantInfoById($data){
        //获取用户鉴定申请中的信息
        $row1 =  DB::select('select * from h_s_appraise_application where id= ?',[$data['appId']]);
        return $row1;
    }
    public function updateHouseAppraiseInfoById($data){
        return DB::update('update h_s_appraise_application
                            set update_name= ?,update_date=?,bpm_status=?,applicant=?,phone=?,
                            idcard= ?,certificate_num=?,appraise_unit=?,address=?,postal_address=?,
                            appraise_reason=?,remark=? ,district=? where id= ? '
            ,[Session::get('user')->user_name,date('Y-m-d H:i:s'),"0",$data['applicant'],$data['phone'],
                $data['idcard'],$data['certificateNum'],$data['appraiseUnit'],$data['address'],$data['postalAddress'],
                $data['appraiseReason'],$data['remark'],$data['district'],$data['identityId']]);
    }
    public function houseEntrust($data){
        return DB::update('update h_s_appraise_application set bpm_status= ? WHERE id = ?',['1',$data["modifyIdentityId"]]);
    }
    public function queryEntrustsByName($data){
        $row = DB::select('select * from h_s_appraise_application WHERE appraise_unit = ? AND bpm_status != 0 ORDER BY update_date DESC ',[Session::get('unit')->identity_unit_name]);
        return array('array'=>array_slice($row,($data['pageNum']-1)*10,'10'),'length'=>count($row));
    }
}