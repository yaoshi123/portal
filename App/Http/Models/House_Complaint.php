<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2017/3/23
 * Time: 9:50
 */

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
//引入DB类
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class House_Complaint extends Model{
    public function submit($data){
        return DB::insert('insert into complaint_info(complaint_name,tel_number,be_complainted_obj,
                                                  complaint_content,user_id,id,complaint_time) VALUES(?,?,?,?,?,?,?) ',
                                                 [$data["complaintName"],$data["telNumber"],$data["beComplaintedObj"],
                                                 $data["complaintContent"],Session::get('user')->user_id,md5(uniqid().mt_rand(1,10000)),date('Y-m-d H:i:s')]);
    }
    public function searchRecords($start,$length,$id){
        $data = DB::table("housecomplaintinfo")->where(['user_id'=>$id])->orderBy('complaint_time','desc')->get(); //一个条件
        return array('array'=>array_slice($data,$start,$length),'length'=>count($data));
    }
    function queryComplaintInfos($data){
        $rows = DB::select('select * from complaint_info where user_id = ? ORDER BY complaint_time DESC ',[Session::get('user')->user_id]);
        if(!empty($rows)){
            return array('array'=>array_slice($rows,$data['start'],$data['length']),'length'=>count($rows));
        }else{
            return null;
        }
    }
}