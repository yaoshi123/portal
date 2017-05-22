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
class Appraise_Entrust extends Model{
    //鉴定委托提交
    function entrustSubmit($data){
        DB::beginTransaction();
        try{
            $flag1 =  DB::insert('insert into h_s_appraise_entrust(id,create_name,create_date,bpm_status,app_id) VALUES (?,?,?,?,?)',
                [md5(uniqid().mt_rand(1,10000)),$data['appraiseUnit'],date('Y-m-d H:i:s'),$data['bpmStatus'],$data['appId']]);
            $flag2 = DB::update('update h_s_appraise_application set bpm_status = ?,send_date=? where id = ?',
                                [$data['bpmStatus'],date('Y-m-d H:i:s'),$data['appId']]);
            DB::commit();
            return $flag1&&$flag2;
        } catch (\Exception $e){
            DB::rollback();//事务回滚
           return false;
        }
        return false;
    }
    //根据id修改鉴定委托
    function updateEntrustStatusById($data){
        DB::beginTransaction();
        try{
            $flag1 =  DB::update('update h_s_appraise_entrust set bpm_status= ? ,remark = ? where app_id = ?',
                [$data['bpmStatus'],$data['remark'],$data['appId']]);
            $flag2 = DB::update('update h_s_appraise_application set bpm_status = ? where id = ?',[$data['bpmStatus'],$data['appId']]);
            DB::commit();
            return $flag1&&$flag2;
        } catch (\Exception $e){
            DB::rollback();//事务回滚
            return false;
        }
        return false;
    }
    //根据appid查询鉴定委托信息
    function queryEntrustByAppId($data){
        return DB::select('select remark from h_s_appraise_entrust where app_id = ?',[$data['appId']]);
    }
}