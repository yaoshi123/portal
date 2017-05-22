<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>鉴定报告（填写表单）</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/txbd.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/libs/jquery.jqprint-0.3.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/txbd.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
	<script src="/public/assets/js/beforeunload.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<!------------------------hotline------------------------------>
<!--<div id="commot-hot"></div>-->
<div id="hotline" >
    <div class="hotline">
        <p class="phone">咨询热线：0731-88888888</p>
        <p class="login">
            <a id = 'login'  class="login-btn" >
                {{'欢迎您：'.session('unit')->identity_unit_name}}
            </a>
            <a href="javascript:;" class="register-btn" id="quit">退出</a>
        </p>
    </div>
</div>

<!------------------------logo------------------------------>
<div id="commot-logo"></div>
<!------------------------nav------------------------------>
<div id="commot-nav"></div>
<!------------------------置顶------------------------------>

<div id="nav" class="dl-nav" style="margin:auto;position: fixed;top: 0;right: 0;left: 0;display: none;z-index: 999;background: #fff;">
    <div class="nav">
        <ul class="nav-cont">
            <li class="nav-list">
                <a href="#" >首页</a>
            </li>
            <li class="nav-list">
                <a href="#"	>装修公司</a>
            </li>
            <li class="nav-list">
                <a href="#"	>建材</a>
            </li>
            <li class="nav-list">
                <a href="#"	>案例展示</a>
            </li>
            <li class="nav-list">
                <a href="#"	>装修知识</a>
            </li>
            <li class="nav-list">
                <a href="#"	>装修安全</a>
            </li>
            <li class="nav-list">
                <a href="#"	>曝光台</a>
            </li>
            <li class="nav-list">
                <a href="#"	>热点投诉</a>
            </li>
        </ul>
    </div>
</div>
<!------------------------malpractice------------------------------>
<div id="malpractice">
    <div class="malpractice">
        <div class="malpractice-c" >
            <h2 >长沙市城市房屋安全鉴定报告</h2>
            <p class="malpractice-p">长房鉴定字第<input type="text" id="reportNum" placeholder="请输入11位数字编码"/>号</p>
            <table
                    width="998"
                    height="998"
                    border="1px"
                    bordercolor="#999"
                    align="center"
                    cellpadding="0"
                    cellspacing="0">
                <tr >
                    <td colspan="2"><label for="jdr">一. 申请鉴定单位（人）：</label></td>
                    <td colspan="4"><input type="text" name="" id="jdr" style="padding-left:10px;width: 673px" /></td>
                </tr>
                <tr>
                    <td colspan="2"><label for="add">二. &nbsp;房 &nbsp;屋 &nbsp;地 &nbsp;址&nbsp;：</label></td>
                    <td colspan="4"><textarea  style="width: 646px;"  id="add"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><label for="about">三. 房 屋 基 本 情 况 ：</label></td>
                    <td colspan="4"><textarea  style="width: 646px;"  id="about"></textarea></td>
                </tr>
                <tr>
                    <td ><label for="qy"> 区&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;域：</label></td>
                    <td colspan="2" width="319" id="showqy">
                        <select name="" id="qy" style="width: 200px;border: none;font-size: 18px;" onchange="queryStreet()">
                        </select>
                        <!--<input id="qy" tyle="width: 200px;border: none;font-size: 18px;"/>-->
                    </td>
                    <td colspan="2" width="179"><label for="jd"> 街&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;道：</label></td>
                    <td id="showjd">
                        <select name="" id="jd" style="width: 200px;border: none;font-size: 18px;">
                            <option value="">请选择街道</option>
                        </select>
                        <!--<input id="jd" tyle="width: 200px;border: none;font-size: 18px;"/>-->
                    </td>
                </tr>
                <tr>
                    <td ><label for="fwname"> 房屋名称：</label></td>
                    <td colspan="2" width="319"><input type="text" id="fwname" /></td>
                    <td colspan="2" width="179"><label for="jznf">建造年份</label></td>
                    <td>
                        <input type="date" id="jznf" />
                    </td>
                </tr>
                <tr>
                    <td><label for="cqdw"> 产权单位：</label> </td>
                    <td colspan="2"><input type="text" id="cqdw" /> </td>
                    <td colspan="2"><label for="lxdh">联系电话</label></td>
                    <td><input type="text"  id="lxdh" /> </td>
                </tr>
                <tr>
                    <td><label for="sydw"> 使用单位：</label> </td>
                    <td colspan="2"><input type="text"  id="sydw" /> </td>
                    <td colspan="2"><label for="jglb">结构类别</label></td>
                    <td id="showjglx">
                        <select name="" id="jglb" style="width: 200px;border: none;font-size: 18px;">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="syxz"> 使用性质：</label></td>
                    <td colspan="2" id="showsyxz">
                        <select name="" id="syxz" style="width: 200px;border: none;font-size: 18px;">
                        </select>
                    </td>
                    <td colspan="2"><label for="pmxs">平面形式</label></td>
                    <td id="showpmxs">
                        <select name="" id="pmxs" style="width: 200px;border: none;font-size: 18px;">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="fwcs"> 房屋层数：</label></td>
                    <td colspan="2"><input type="text"  id="fwcs" />  </td>
                    <td colspan="2"><label for="fwyt"> 房屋用途</label></td>
                    <td><input type="text"  id="fwyt" /> </td>
                </tr>
                <tr>
                    <td><label for="cqmj"> 建筑面积：</label></td>
                    <td colspan="2"><input type="text"  id="cqmj" />   </td>
                    <td colspan="2"><label for="cqbh">产权证号</label></td>
                    <td><input type="text"  id="cqbh" />   </td>
                </tr>
                <tr>
                    <td><label for="synx"> 使用年限：</label></td>
                    <td colspan="2"><input type="text"  id="synx"/>   </td>
                    <td colspan="2"><label for="jkdj">健康等级</label></td>
                    <td id="showjkdn">
                        <select id="jkdj" style="width: 200px;border: none;font-size: 18px;">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="jddw"> 鉴定单位：</label></td>
                    <td colspan="2" id="showjddw">
                        <select name="" id="jddw" style="width: 200px;border: none;font-size: 18px;">
                        </select>
                    </td>
                    <td colspan="2"><label for="jcry">检测人员</label></td>
                    <td><input type="text"  id="jcry" />   </td>
                </tr>
                <tr>
                    <td><label for="wydw"> 物业单位：</label></td>
                    <td colspan="5"><input type="text"  id="wydw" />   </td>
                </tr>
                <tr height="79">
                    <td style="width: 190px;"><label for="jdmd">四、鉴定目的</label></td>
                    <td colspan="5"><input style="width: 700px;" type="text"  id="jdmd"  /></td>
                </tr>
                <tr >
                    <td colspan="6" style="background: #f5f5f5;"><label for="jdsq">五、鉴定情况</label></td>

                </tr>
                <tr height="179">
                    <td colspan="6"><textarea  style="height: 179px;width: 960px;"  id="jdsq"></textarea></td>
                </tr>
            </table>
            <table width="998"
                   height="998"
                   border="1px"
                   bordercolor="#999"
                   align="center"
                   cellpadding="0"
                   cellspacing="0"
                   style="display: none;"
                   class="showTable">
                <tr>
                    <td colspan="6" style="height: 49px;background: #f5f5f5;"><label for="shyy">六、损坏原因分析</label></td>
                </tr>
                <tr>
                    <td colspan="6" height="179"><textarea  style="height: 179px;width: 960px;"  id="shyy"></textarea></td>
                </tr>
                <tr>
                    <td colspan="6" style="height: 49px;background: #f5f5f5;"><label for="jlyj">七、鉴定结论处理意见</label></td>
                </tr>
                <tr>
                    <td colspan="6" height="179"><textarea  style="height: 179px;width: 960px;"  id="jlyj"></textarea></td>
                </tr>
                <tr>
                    <td colspan="6" style="height: 49px;background: #f5f5f5;"><label for="bz">八、备注</label></td>
                </tr>
                <tr>
                    <td colspan="6" height="179"><textarea  style="height: 179px;width: 960px;"  id="bz"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 49px;background: #f5f5f5;"><label for="qjdb">区鉴定办公室人员</label></td>
                    <td colspan="2" style="height: 49px;background: #f5f5f5;"><label for="sjdb">市鉴定办公室人员</label></td>
                    <td colspan="2" style="height: 49px;background: #f5f5f5;"><label for="sjdbr">市鉴定办公室负责人</label></td>
                </tr>
                <tr height="199">
                    <td colspan="2"><textarea style="height: 199px;text-align: center;" id="qjdb" ></textarea></td>
                    <td colspan="2"><textarea style="height: 199px;text-align: center;width: 250px;" id="sjdb"></textarea></td>
                    <td colspan="2"><textarea style="height: 199px;text-align: center;" id="sjdbr"></textarea></td>
                </tr>
                <tr class="tr-p">
                    <td colspan="6" height="122">
                        <p>附注&nbsp; 1、本鉴定报告只做房屋安全损坏程度鉴定的依据，不作房屋产权依据。</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、鉴定结论属于非危险房屋的，在正常使用条件下，本鉴定报告有效时限为一年。</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、鉴定报告经鉴定单位盖章后生效。</p>
                    </td>
                </tr>

            </table>
            <p class="nextPage">
                <a href="javascript:;" class="nextPage-a" id="">下一页</a>
                <a href="javascript:;" class="tijiao" id="">
                    <span class="upPage">上一页</span>
                    <span class="refer" onclick="submitAll('submit')" id="submit" >提交</span>
                    <span class="refer" onclick="updateReportInfoById()" id="update" style="display: none;">修改完成</span>
                    <span class="refer" onclick="javascript:history.go(-1)" id="fanhui" style="display: none;">返回</span>
                </a>
                <a href="javascript:;" class="successfully">信息提交成功</a>
            </p>
        </div>
    </div>
</div>

<!------------------------friendlyLink------------------------------>
<div id="friendlyLink-s"></div>

<!------------------------oblong------------------------------>
<div id="oblong-s"></div>
<!------------------------foorer------------------------------>
<div id="foorer-s"></div>
</body>
<script type="text/javascript" charset="utf-8">
    var reportNum, showReport;
    if(window.location.href.indexOf('?')!='-1'){
        var datas = window.location.href.split("?")[1].split('&');
        for(var i = 0;i<datas.length;i++){
            if(datas[i].split('=')[0]=='reportNum'){
                reportNum = decodeURI(datas[i].split('=')[1])
            }else if(datas[i].split('=')[0]=='showReport'){
                showReport = decodeURI(datas[i].split('=')[1])
            }
        }
    }
    //动态查询数据库区域信息
    function queryDistricts(){
        $.ajax({
            url: "/unit/querydistrictsinfos",
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
            success:function(data) {
                if(data.status){
                   $("#qy").empty().append(' <option value="">请选择区</option> ');
                    for(var i = 0 ;i<data.msg.length;i++){
                        $("#qy").append('<option value="'+data.msg[i].departname+'">'+data.msg[i].departname+'</option> ');
                    }
                }else{
                    alert(data.msg)
                }

            }
        });
    }
    //执行动态查询区域信息
    queryDistricts();
    //二级菜单查询，区域选框改变时
    function queryStreet(){
        if($('#qy option:selected') .val()==''){
            $("#jd").empty().append("<option value=''>请选择街道</option>");
            alert('请选择区域');
        }else{
            $.ajax({
                url:"/unit/querystreetbydistrictname",
                dataType:'json',
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data:{
                    districtName:$('#qy option:selected') .val()
                },
                success:function(data){
                    if(data.status){
                    	
                        $("#jd").empty().append("<option value=''>请选择街道</option>");
                        for(var i = 0;i<data.msg.length;i++){
                            $("#jd").append("<option value="+data.msg[i].departname+">"+data.msg[i].departname+"</option>");

                        }
                    }else{
                        alert(data.msg);
                    }
                }
            });
        }
    }
    //动态查询数据库结构类别信息
    function queryStructureInfos(){
        $.ajax({
            url: "/unit/querystructureinfos",
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
            success:function(data) {
                if(data.status){
                    $("#jglb").empty().append(' <option value="">请选择结构类别</option> ');
                    for(var i = 0 ;i<data.msg.length;i++){
                        $("#jglb").append('<option value="'+data.msg[i].typecode+'">'+data.msg[i].typename+'</option> ');
                    }
                }else{
                    alert(data.msg)
                }

            }
        });
    }
    //执行动态查询结构类别信息
    queryStructureInfos();
    //动态查询数据库获取健康等级信息
    function queryDangerLevelInfos(){
        $.ajax({
            url: "/unit/querydangerlevelinfos",
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
            success:function(data) {
                if(data.status){
                    $("#jkdj").empty().append(' <option value="">请选择健康等级</option> ');
                    for(var i = 0 ;i<data.msg.length;i++){
                        $("#jkdj").append('<option value="'+data.msg[i].typecode+'">'+data.msg[i].typename+'</option> ');
                    }
                }else{
                    alert(data.msg)
                }

            }
        });
    }
    //执行动态查询数据库获取健康等级信息
    queryDangerLevelInfos();
    //动态查询数据库，获取使用性质信息信息
    function queryHouseTypeInfos(){
        $.ajax({
            url: "/unit/queryhousetypeinfos",
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
            success:function(data) {
                if(data.status){
                    $("#syxz").empty().append(' <option value="">请选择</option> ');
                    for(var i = 0 ;i<data.msg.length;i++){
                        $("#syxz").append('<option value="'+data.msg[i].typecode+'">'+data.msg[i].typename+'</option> ');
                    }
                }else{
                    alert(data.msg)
                }

            }
        });
    }
    //动态查询数据库，获取使用性质信息
    queryHouseTypeInfos();
    //动态查询鉴定单位信息
    function queryAppraiseUnits(){
        $.ajax({
            url: "/unit/queryappraiseunits",
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
            success:function(data) {
                if(data.status){
                    $("#jddw").empty().append(' <option value="">请选择鉴定单位</option> ');
                    for(var i = 0 ;i<data.msg.length;i++){
                        $("#jddw").append('<option value="'+data.msg[i].identity_unit_name+'">'+data.msg[i].identity_unit_name+'</option> ');
                    }
                }else{
                    alert(data.msg)
                }

            }
        });
    }
    //执行查询鉴定单位
    queryAppraiseUnits();
    //查询房屋平面形式信息并显示
    function queryHousePlaneForm(){
        $.ajax({
            url: "/unit/queryhouseplaneform",
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
            success:function(data) {
                if(data.status){
                    $("#pmxs").empty().append(' <option value="">请选择平面形式</option> ');
                    for(var i = 0 ;i<data.msg.length;i++){
                        $("#pmxs").append('<option value="'+data.msg[i].typecode+'">'+data.msg[i].typename+'</option> ');
                    }
                }else{
                    alert(data.msg)
                }
            }
        });
    }
    //执行查询房屋平面形式信息并显示
    queryHousePlaneForm();
    //提交鉴定报告信息
    function submit(){
        if(checkContent()){
            $.ajax({
                url:"/unit/appraisereportsubmit",
                dataType:'json',
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data:{
                    reportNum:$("#reportNum").val(),
                    applicant:$("#jdr").val(),
                    address:$("#add").val(),
                    appraisePurpose:$("#jdmd").val(),
                    appraiseCondition:$("#jdsq").val(),
                    appraiseUnit:$('#jddw option:selected') .text(),
                    inspector:$("#jcry").val(),
                    destroyedReason:$("#shyy").val(),
                    conclusionHandle:$("#jlyj").val(),
                    districtAppraiseStaff:$("#qjdb").val(),
                    cityAppraiseStaff:$("#sjdb").val(),
                    cityAppraiseLeader:$("#sjdbr").val(),
                    houseName:$("#fwname").val(),
                    buildEndYear:$("#jznf").val(),
                    ownerShip:$("#cqdw").val(),
                    phone:$("#lxdh").val(),
                    buildArea:$("#cqmj").val(),
                    certificateNum:$("#cqbh").val(),
                    useUnit:$("#sydw").val(),
                    useProperty:$("#syxz").val(),
                    structure:$("#jglb").val(),
                    planeForm:$("#pmxs").val(),
                    layerNumber:$("#fwcs").val(),
                    houseUse:$("#fwyt").val(),
                    houseBasicFacts:$("#about").val(),
                    street:$('#jd option:selected') .text(),
                    district:$('#qy option:selected') .text(),
                    property:$("#wydw").val(),
                    useYear:$("#synx").val(),
                    dangerLevel:$("#jkdj").val(),
                    remark:$("#bz").val(),
                },
                success:function(data){
                    if(data.status){
                        alert('保存成功');
                        window.location.href="/unit/reportinfos";
                    }else {
                        alert('保存失败');
                    }
                }
            });
        }
    }
    //更新鉴定报告
    function updateReportInfoById(){
        if(checkContent()) {
            $.ajax({
                url: "/unit/updateappraisereportbyid",
                dataType: 'json',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data: {
                    reportNum: $("#reportNum").val(),
                    applicant: $("#jdr").val(),
                    address: $("#add").val(),
                    appraisePurpose: $("#jdmd").val(),
                    appraiseCondition: $("#jdsq").val(),
                    appraiseUnit: $('#jddw option:selected').val(),
                    inspector: $("#jcry").val(),
                    destroyedReason: $("#shyy").val(),
                    conclusionHandle: $("#jlyj").val(),
                    districtAppraiseStaff: $("#qjdb").val(),
                    cityAppraiseStaff: $("#sjdb").val(),
                    cityAppraiseLeader: $("#sjdbr").val(),
                    houseName: $("#fwname").val(),
                    buildEndYear: $("#jznf").val(),
                    ownerShip: $("#cqdw").val(),
                    phone: $("#lxdh").val(),
                    buildArea: $("#cqmj").val(),
                    certificateNum: $("#cqbh").val(),
                    useUnit: $("#sydw").val(),
                    useProperty: $("#syxz").val(),
                    structure: $('#jglb option:selected').val(),
                    planeForm: $('#pmxs option:selected').val(),
                    layerNumber: $("#fwcs").val(),
                    houseUse: $("#fwyt").val(),
                    houseBasicFacts: $("#about").val(),
                    street: $('#jd option:selected').val(),
                    district: $('#qy option:selected').val(),
                    property: $("#wydw").val(),
                    useYear: $("#synx").val(),
                    dangerLevel: $('#jkdj option:selected').val(),
                    remark: $("#bz").val(),
                },
                success: function (data) {
                    window.sessionStorage.removeItem('reportNum');
                    if (data) {
                        alert('修改成功');
                        window.location.href = "/unit/reportinfos";
                    } else {
                        alert('修改失败');
                    }
                }
            });
        }
    }
    $( function(){
        if(reportNum){
            //将报告id赋值到页面中并设置页面中的input标签为只读
            $("#reportNum").val(reportNum).attr({'readonly':true});
            $.ajax({
                url:"/unit/queryappraisereportbyreportnum",
                dataType:'json',
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data:{
                    reportNum:reportNum,
                },
                success:function(data){
                    if(data){
                        $("#jdr").val(data.applicant);
                        $("#add").val(data.address);
                        $("#jdmd").val(data.appraise_purpose);
                        $("#jdsq").val(data.appraise_condition);
                        $("#jddw").val(data.appraise_unit);
                        $("#jcry").val(data.inspector);
                        $("#shyy").val(data.destroyed_reason);
                        $("#jlyj").val(data.conclusion_handle);
                        $("#qjdb").val(data.district_appraise_staff);
                        $("#sjdb").val(data.city_appraise_staff);
                        $("#sjdbr").val(data.city_appraise_leader);
                        $("#fwname").val(data.house_name);
                        $("#jznf").val(data.build_end_year.substr(0,10));
                        $("#cqdw").val(data.owner_ship);
                        $("#lxdh").val(data.phone);
                        $("#cqmj").val(data.build_area);
                        $("#cqbh").val(data.certificate_num);
                        $("#sydw").val(data.use_unit);
                        $("#syxz").val(data.use_property);
                        $("#jglb").val(data.structure);
                        $("#pmxs").val(data.plane_form);
                        $("#fwcs").val(data.layer_number);
                        $("#fwyt").val(data.house_use);
                        $("#about").val(data.house_basic_facts);
                        $("#qy").val(data.district);
                        $("#jd").empty().append('<option value="'+data.street+'">'+data.street+'</option> ');
                        $("#wydw").val(data.property);
                        $("#synx").val(data.use_yesr);
                        $("#jkdj").val(data.danger_level);
                        $("#bz").val(data.remark);
                        //判断是否是显示信息
                        if(showReport=='true'){
                            $('input').attr({'readonly':true});
                            $('select').attr({'disabled':true})
                            $('textarea').attr({'readonly':true});
                            $("#reportNum").val(reportNum);
                            $("#submit").css({"display":'none'})
                            $("#update").css({"display":'none'})
                            $("#fanhui").css({"display":'inline-block',"margin-left": '40px'})
                        //是否是编辑信息
                        }else{
                            $("#submit").css({"display":'none'});
                            $("#fanhui").css({"display":'none'});
                            $("#update").css({"display":'inline-block',"margin-left": '40px'});
                        }
                    }
                }
            });
        }
        if(reportNum&&showReport){
            //将报告id赋值到页面中并设置页面中的input标签为只读
            $("#reportNum").val(reportNum).attr({'readonly':true});
            $.ajax({
                url:"/unit/queryshowappraisereportbyreportnum",
                dataType:'json',
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data:{
                    reportNum:reportNum,
                },
                success:function(data){
                    if(data){
                        $("#jdr").val(data.applicant);
                        $("#add").val(data.address);
                        $("#jdmd").val(data.appraise_purpose);
                        $("#jdsq").val(data.appraise_condition);
                        $("#showjddw").empty().html("<input type='text' value="+data.appraise_unit+">");
                        $("#jcry").val(data.inspector);
                        $("#shyy").val(data.destroyed_reason);
                        $("#jlyj").val(data.conclusion_handle);
                        $("#qjdb").val(data.district_appraise_staff);
                        $("#sjdb").val(data.city_appraise_staff);
                        $("#sjdbr").val(data.city_appraise_leader);
                        $("#fwname").val(data.house_name);
                        $("#jznf").val(data.build_end_year.substr(0,10));
                        $("#cqdw").val(data.owner_ship);
                        $("#lxdh").val(data.phone);
                        $("#cqmj").val(data.build_area);
                        $("#cqbh").val(data.certificate_num);
                        $("#sydw").val(data.use_unit);
                        $("#showsyxz").empty().html("<input type='text' value="+data.use_property+">");
                        $("#showjglx").empty().html("<input type='text' value="+data.structure+">");
                        $("#showpmxs").empty().html("<input type='text' value="+data.plane_form+">");
                        $("#fwcs").val(data.layer_number);
                        $("#fwyt").val(data.house_use);
                        $("#about").val(data.house_basic_facts);
                        $("#showjd").empty().html("<input type='text' value="+data.street+">");
                        $("#showqy").empty().html("<input type='text' value="+data.district+">");
                        $("#wydw").val(data.property);
                        $("#synx").val(data.use_yesr);
                        $("#showjkdn").empty().html("<input type='text' value="+data.danger_level+">");
                        $("#bz").val(data.remark);
                        if(showReport=='true'){
                            $('input').attr({'readonly':true});
                            $('select').attr({'disabled':true})
                            $('textarea').attr({'readonly':true});
                            $("#reportNum").val(reportNum);
                            $("#submit").css({"display":'none'})
                            $("#update").css({"display":'none'})
                            $("#fanhui").css({"display":'inline-block',"margin-left": '40px'})
                        }else{
                            $("#submit").css({"display":'none'});
                            $("#fanhui").css({"display":'none'});
                            $("#update").css({"display":'inline-block',"margin-left": '40px'});
                        }
                    }
                }
            });
        }
    })
</script>
</html>
