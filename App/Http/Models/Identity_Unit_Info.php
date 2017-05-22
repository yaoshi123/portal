<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2017/3/30
 * Time: 11:05
 */

namespace App\Http\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Identity_Unit_Info
{
    //鉴定单位登录消息
    function login( $data){
        $row = DB::select('select * from identity_unit_info where identity_unit_name = ? and password = ?',[$data['identityName'],md5($data['password'])]);
        if($row) {
            Session::put('unit', $row[0]);
            return true;
        }
        return false;
    }
    //查询鉴定单位信息展示在首页
    function queryAppraiseInfos(){
        $rows = DB::select('select identity_unit_id,identity_unit_name,introduction from identity_unit_info ');
        if($rows) {
            return $rows;
        }
        return false;
    }
    //根据鉴定单位id查询鉴定单位信息,显示在鉴定单位列表
    function queryAppraiseInfoByUnitId($data){
        $rows = DB::select('select identity_unit_id,identity_unit_name,introduction from identity_unit_info where identity_unit_id = ?',[$data['identityUnitId']]);
        if($rows) {
            return $rows[0];
        }
        return false;
    }
    //根据鉴定单位名查询鉴定单位信息,显示在鉴定单位列表
    function queryAppraiseInfoByUnitName($data){
        $rows = DB::select('select identity_unit_id,identity_unit_name,introduction from identity_unit_info where identity_unit_name = ?',[$data['identityUnitName']]);
        if($rows) {
            return $rows[0];
        }
        return false;
    }
    //查询所有鉴定单位公司详细信息，显示在鉴定申请页面
    function queryAppraiseUnitInfos($data){
        $start = ($data['pageNum']-1)*10;
        $length = $data['length'];
        $rows =  DB::select('select identity_unit_name,tel_number,address,rank,charger,charger_tel_num,person_condition,company_qualification from identity_unit_info');
        return array('array'=>array_slice($rows,$start,$length),'unitNum'=>count($rows));
    }
}