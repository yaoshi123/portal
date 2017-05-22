<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2017/5/16
 * Time: 14:55
 */

namespace App\Http\Models;


use Illuminate\Support\Facades\DB;

class Type
{
    //查询结构类别信息
    function queryStructures($id){
        return DB::select('select typecode,typename from t_s_type WHERE typegroupid = ?',[$id]);
    }
    //查询健康等级信息
    function queryDangerLevel($id){
        return DB::select('select typecode,typename from t_s_type WHERE typegroupid = ?',[$id]);
    }
    //查查房屋类型信息
    function queryHouseType($id){
        return DB::select('select typecode,typename from t_s_type WHERE typegroupid = ?',[$id]);
    }
    //查询房屋平面形式
    function queryHousePlaneForm($id){
        return DB::select('select typecode,typename from t_s_type WHERE typegroupid = ?',[$id]);
    }
}