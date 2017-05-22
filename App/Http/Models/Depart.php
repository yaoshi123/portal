<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2017/5/12
 * Time: 15:06
 */

namespace App\Http\Models;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Depart
{
    function __construct(){

    }
    function queryDepartInfosByParentDepartId(){
        return DB::select('select departname from t_s_depart where parentdepartid = ?',[Config::get('constants.DEPARTPARENTID')]);
    }
    function queryDistrictsByParentId(){
        return DB::select('select ID,departname from t_s_depart where parentdepartid = ?',[Config::get('constants.QUYUPARENTID')]);
    }
    function queryStreetsByDistrictName($data){
        $rows = DB::select("select ID from t_s_depart WHERE departname = ?",[$data['districtName']]);
        return DB::select('select ID,departname from t_s_depart where parentdepartid = ?',[$rows[0]->ID]);
    }
}