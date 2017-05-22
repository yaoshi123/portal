<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>房屋鉴定申请</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/jdsq.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/jdsq.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        //对查询信息进行翻页
        function page(data){
            if(data=='next'){
                if($("#totalitems").html()>$('#page').val()){
                    queryHouseApplicationInfo(parseInt($('#start').html())+1,2);
                }
            }
            else if(data=='before'){
                if($('#start').html()>1){
                    queryHouseApplicationInfo(parseInt($('#start').html())-3,2);
                }
            }
            else if(!isNaN(data)){
                if(eval(data)<=eval($('#totalitems').html())&&eval(data)>0){
                    queryHouseApplicationInfo(2*(data-1));
                }else if($('#totalitems').html()==0){
                    queryHouseApplicationInfo(2*(data-1));
                }
                else{
                    alert("您输入的数字有误，请重试");
                    $("#choosePage").val("").focus();//清空输入框内容，获得焦点
                }
            }
            else{
                alert("请输入正确数字");
                $("#choosePage").val("").focus();//清空输入框内容，获得焦点
            }
        }
        //地址信息过长的时候，加<br/>换行
        function stringSplit(data){
            var num = Math.ceil(data.length/10);
            var html='';
            for(var i = 0;i<num*10;i=i+10){
                html += data.substr(i,10)+"<br/>";
            }
            return html;
        }
        //提交鉴定申请信息
        function submit(){
            if( checkApplicantName()&&checkApplicantTelNumber()&&checkIdcardNumber()&&
                checkHouseCertificate()&&checkHouseAddress()&&checkCommunicationAddress()&&
                    checkReason()&&checkAppraiseUnit()&&checkConstruction()
                    ){
               $.ajax({
                    url:"/user/houseapplicantsubmit",
                    dataType:'json',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data:{
                        applicant : $("#name").val(),
                        phone : $("#phone1").val(),
                        idcard : $("#num").val(),
                        certificateNum : $("#add").val(),
                        appraiseUnit : $('#jddw option:selected') .text(),
                        address : $("#fwdz").val(),
                        postalAddress : $("#txdz").val(),
                        appraiseReason : $("#jdly").val(),
                        remark : $("#bz").val(),
                        district : $('#qjj option:selected') .text()
                    },
                    success:function(data){
                        if(data){
                            $("input").val('');
                            $("#jddw").val('');
                            success();
                            page(1);
                        }
                    }
                });
            }
        }
        //查询鉴定申请信息
        function queryHouseApplicationInfo(start){
            $.ajax({
                type: 'post',
                url:"/user/houseapplicantinfo",
                data: { start :start,
                        length:2
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                success: function(data){
                    if(data.msg.array.length!=0){
                        //显示第几页
                        $("#choosePage").val((start/2)+1);
                        $("#page").val((start/2)+1);
                        //显示总条数
                        $("#totalitems").html(Math.ceil(data.msg.length/2));
                        //显示记录
                        $("#sequence").empty().append('  <p class="appraisal-con-tit1">序号</p>');
                        $("#applicantNameRow").empty().append('  <p class="appraisal-con-tit1">申请人姓名</p>');
                        $("#idcardnumRow").empty().append('   <p class="appraisal-con-tit1">身份证号</p>');
                        $("#applicantTelNumRow").empty().append('   <p class="appraisal-con-tit1">申请人电话</p>');
                        $("#houseIdRow").empty().append('   <p class="appraisal-con-tit1">产权证编号</p>');
                        $("#identityUnitRow").empty().append('   <p class="appraisal-con-tit1">鉴定单位</p>');
                        $("#houseAddressRow").empty().append('   <p class="appraisal-con-tit1">房屋地址</p>');
                        $("#statusRow").empty().append('   <p class="appraisal-con-tit1">状态</p>');
                        $("#operateRow").empty().append('   <p class="appraisal-con-tit1">操作</p>');
                        for(var i = 0;i<data.msg.array.length;i++){
                            var verifyInfo,checkState,stateCode = data.msg.array[i].bpm_status;
                            if(stateCode==0){verifyInfo='请发送审核'}
                            else if(stateCode==1){verifyInfo='正在审核'}
                            else if(stateCode==2){verifyInfo='审核通过'}
                            else{verifyInfo='审核未通过'}
                            checkState=stateCode==0?"<a href='javascript:;' onclick='editItem("+i+");'>编辑</a>&emsp;&emsp;<a href='javascript:;' onclick='deleteItem("+i+");'>删除</a>&emsp;&emsp;<a href='javascript:;' onclick='transmit("+i+")'>发送</a>" :
                                                    "<a href='javascript:;' onclick='editItem("+i+");' style='display: none'>编辑</a><a href='javascript:;' onclick='showInfo("+i+");'>查看</a>" ;
                            $("#sequence").append("<p id='start'>"+(i+1+start)+"</p>");
                            $("#applicantNameRow").append("<p>"+data.msg.array[i].applicant+"</p>");
                            $("#idcardnumRow").append("<p>"+data.msg.array[i].idcard+"</p>");
                            $("#applicantTelNumRow").append("<p>"+data.msg.array[i].phone+"</p>");
                            $("#houseIdRow").append("<p>"+data.msg.array[i].certificate_num+"</p>");
                            $("#identityUnitRow").append("<p>"+data.msg.array[i].appraise_unit+"</p>");
                            $("#houseAddressRow").append("<p>"+stringSplit(data.msg.array[i].address)+"</p>");
                            $("#statusRow").append("<p>"+verifyInfo+"</p>");
                            $("#statusRow").append("<p hidden>"+data.msg.array[i].remark+"</p>");
                            $("#operateRow").append( "<p>" +
                                    checkState+
                                    "</p>");
                            $("#operateRow").append( "<p hidden>"+data.msg.array[i].id+"</p>");
                        };
                    }else{
                        //显示第几页
                        $("#choosePage").val((start/2)+1);
                        //显示总条数
                        $("#totalitems").html(Math.ceil(data.msg.length/2));
                        //显示记录
                        $("#sequence").empty().append('  <p class="appraisal-con-tit1">序号</p>');
                        $("#applicantNameRow").empty().append('  <p class="appraisal-con-tit1">申请人姓名</p>');
                        $("#idcardnumRow").empty().append('   <p class="appraisal-con-tit1">身份证号</p>');
                        $("#applicantTelNumRow").empty().append('   <p class="appraisal-con-tit1">申请人电话</p>');
                        $("#houseIdRow").empty().append('   <p class="appraisal-con-tit1">产权证编号</p>');
                        $("#identityUnitRow").empty().append('   <p class="appraisal-con-tit1">鉴定单位</p>');
                        $("#houseAddressRow").empty().append('   <p class="appraisal-con-tit1">房屋地址</p>');
                        $("#statusRow").empty().append('   <p class="appraisal-con-tit1">状态</p>');
                        $("#operateRow").empty().append('   <p class="appraisal-con-tit1">操作</p>');
                    }
                },
                error: function(xhr, type){
                    alert("获取失败");
                }
            });
        }
        //删除信息鉴定申请
        function deleteItem(data){
            if(confirm('确认删除？')){
                var id = $("#operateRow > p:eq("+(data+1)*2+")").html();
                $.ajax({
                    type: 'post',
                    url:"/user/deletehouseapplicant",
                    data: { id :id},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    success: function(data){
                        if(data.status=='success'){
                            alert('删除成功');
                            if($("#operateRow>p").length==3){
                                page($('#page').val()-1==0?1:$('#page').val()-1);
                            }else{
                                page($('#page').val());
                            }
                        }
                    }
                });
            }
        }
        //显示需要编辑的信息
        function editItem(data){
            $(window).scrollTop(0);
            var id = $("#operateRow > p:eq("+(data+1)*2+")").html();
            $('#submit').css({'display':'none'});
            $('#edit').css({'display':'block'});
            $("#entrustedInfo").css({'display':'none'});
            //将所有输入框设置为只读
            $('input').attr({'readonly':false})
            $('select').attr({'disabled':false})
            $.ajax({
                type: 'post',
                url:"/user/selecthouseapplicantinfobyid",
                data: { appId :id},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                success: function(data){
                    if(data.status){
                        $("#name ").val(data.msg.application.applicant);
                        $("#phone1 ").val(data.msg.application.phone);
                        $("#num").val(data.msg.application.idcard);
                        $("#add ").val(data.msg.application.certificate_num);
                        $("#jddw ").val(data.msg.application.appraise_unit);
                        $("#fwdz").val(data.msg.application.address);
                        $("#txdz").val(data.msg.application.postal_address);
                        $("#jdly").val(data.msg.application.appraise_reason);
                        $("#bz").val(data.msg.application.remark);
                        $("#qjj").val(data.msg.application.district);
                        $("#modifyIdentityId").val(data.msg.application.id);
                    }
                }
            });
//            $('#submit').css({'display':"none"});
//            $('#edit').css({'display':"block"});
        }
        //将需要编辑的信息保存
        function store(){
            if( checkApplicantName()&&checkApplicantTelNumber()&&checkIdcardNumber()&&
                    checkHouseCertificate()&&checkHouseAddress()&&
                    checkCommunicationAddress()&&checkReason()&&checkAppraiseUnit()) {
                $.ajax({
                    url: "/user/updatehouseappraiseinfobyid",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        applicant: $("#name").val(),
                        phone: $("#phone1").val(),
                        idcard: $("#num").val(),
                        certificateNum: $("#add").val(),
                        appraiseUnit: $('#jddw option:selected').text(),
                        address: $("#fwdz").val(),
                        postalAddress: $("#txdz").val(),
                        appraiseReason: $("#jdly").val(),
                        remark: $("#bz").val(),
                        identityId: $("#modifyIdentityId").val(),
                        district: $('#qjj option:selected').text()
                    },
                    success: function (data) {
                        if (data.status) {
                            $('input').val('');
                            page('1');
                            success();
                        } else {
                            failed();
                        }

                    }
                });
            };
        }
        //提交信息，提交后重新查询信息状态
        function transmit(data){
            if(confirm('确认发送？')){
                $.ajax({
                    url:"/user/houseentrust",
                    dataType:'json',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data:{
                        appId:$("#operateRow > p:eq("+(data+1)*2+")").html(),
                        remark:$("#statusRow > p:eq("+(data+1)*2+")").html(),
                        bpmStatus:'1',
                        appraiseUnit:$("#identityUnitRow > p:eq("+(data+1)+")").html(),
                    },
                    success:function(data){
                        if(data.status){
                            page($("#page").val());
                            success();
                        }else{
                            failed();
                        }
                    }
                });
            }
        }
        //显示提交后的信息
        function showInfo(data){
            //滚动条跳转到最上
            $(window).scrollTop(0);
            //正下方显示信息修改
            $("#entrustedInfo").css({'display':'inline-block'});
            $("#submit").css({'display':'none'});
            $("#edit").css({'display':'none'});
            var id = $("#operateRow > p:eq("+(data+1)*2+")").html();
            $.ajax({
                type: 'post',
                url:"/user/selecthouseapplicantinfobyid",
                data: { appId :id},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                success: function(data){
                    if(data.status){
                        //将所有输入框设置为只读
                        $('input').attr({'readonly':true})
                        //把所有input标签设置为只读
                        $('.appraisal-form-cont input').attr({'disabled':false});
                        $('select').attr({'disabled':true})
                        //向输入框中输入信息
                        $("#name ").val(data.msg.application.applicant);
                        $("#phone1 ").val(data.msg.application.phone);
                        $("#num").val(data.msg.application.idcard);
                        $("#add ").val(data.msg.application.certificate_num);
                        $("#jddw ").val(data.msg.application.appraise_unit);
                        $("#fwdz").val(data.msg.application.address);
                        $("#txdz").val(data.msg.application.postal_address);
                        $("#jdly").val(data.msg.application.appraise_reason);
                        $("#bz").val(data.msg.application.remark);
                        $("#qjj").val(data.msg.application.district);
                        $("#modifyIdentityId").val(data.msg.application.id);
                        //显示鉴定委托表格中的备注信息
                        if(data.msg.entrust.remark!=null){
                            $('#reason').css({'display':'block'});
                            $("#beau").val( data.msg.entrust.remark==''?'无':data.msg.entrust.remark);
                            };
                        //把所有input标签设置为只读
                        //$('.appraisal-form-cont input').attr({'disabled':true});
                    }
                }
            });
        }
        //使相关的input不能输入特殊字符
        function deleteSpecialChar(obj){
            obj.value = obj.value.replace("~","").replace("@","").replace("#","").
                        replace("$","").replace("%","").replace("!","").replace('！','').replace('￥','').
                        replace("^","").replace("&","").replace("*","");
        }
        //加载完毕查询第一页信息
        queryHouseApplicationInfo(0);
    </script>
</head>
<body>
<!------------------------hotline------------------------------>
<!--<div id="commot-hot"></div>-->
<div id="hotline">
    <div class="hotline">
        <p class="phone">咨询热线：0731-88888888</p>
        @if(session('user'))
            <p class="login">
                <a id = 'login'  class="login-btn">
                    {{'欢迎您：'.session('user')->user_name}}
                <a href="javascript:;" class="register-btn" id="quit">退出</a>
            </p>
        @else
            <p class="login">
                <a id = 'login' href="login" class="login-btn">
                    登录
                </a>
                <a href="register" class="register-btn">注册</a>
            </p>
        @endif
        </p>
    </div>
</div>
<!------------------------logo------------------------------>
<div id="commot-logo"></div>
<!------------------------nav------------------------------>
<div id="commot-nav"></div>
<!------------------------appraisal------------------------------>
<div id="appraisal">
    <div class="appraisal">
        <div class="appraisal-form">
            <div class="appraisal-forms">
                <div class="appraisal-form-tit">
                    <p>填写房屋鉴定申请表单</p>
                </div>
                <div class="appraisal-form-cont">
                    <div>
                        <p class="appraisal-form-contp">
                            <label for="name">申请人姓名：</label>
                            <input type="type" name="" id="name" onblur="checkApplicantName()"/>
                            <em></em>
                        </p>
                        <p class="appraisal-form-contp">
                            <label for="phone1">申请人电话：</label>
                            <input type="type" name="" id="phone1" onblur="checkApplicantTelNumber()" />
                            <em></em>
                        </p>
                        <p class="appraisal-form-contp">
                            <label for="num">身份证号码：</label>
                            <input type="type" name="" id="num" onblur="checkIdcardNumber()"/>
                            <em></em>
                        </p>
                        <p class="appraisal-form-contp">
                            <label for="add">房产证编号：</label>
                            <input type="type" name="" id="add" onblur="checkHouseCertificate()" onkeyup="deleteSpecialChar(this)"/>
                            <em></em>
                        </p>
                        <p class="appraisal-form-contp ">
                            <label for="fwdz">&emsp;房屋地址：</label>
                            <input type="type" id="fwdz" onblur="checkHouseAddress()" onkeyup="deleteSpecialChar(this)"/>
                            <em></em>
                        </p>
                        <p class="appraisal-form-contp ">
                            <label for="txdz">&emsp;通讯地址：</label>
                            <input type="type" name="" id="txdz" onblur="checkCommunicationAddress()" onkeyup="deleteSpecialChar(this);"/>
                            <em></em>
                        </p>
                        <p class="appraisal-form-contp ">
                            <label for="jdly">&emsp;鉴定理由：</label>
                            <input type="type" name="" id="jdly" onkeyup="deleteSpecialChar(this);" onblur="checkReason()"/>
                            <em></em>
                        </p>
                        <p class="appraisal-form-contp ">
                            <label for="bz">&emsp;备&emsp;&emsp;注：</label>
                            <input type="type" name="" id="bz" value="" />

                        </p>
                        <p class="appraisal-form-contp">
                            <label for="jddw">&emsp;鉴定单位：</label>
                            <select name="" id="jddw" onchange="checkAppraiseUnit()">
                                <option value="请选择鉴定单位" >请选择鉴定单位</option>
                                <option value="中电科瑞" >中电科瑞</option>
                                <option value="捷能售电" >捷能售电</option>
                                <option value="长沙房安">长沙房安</option>
                            </select>
                            <em></em>
                        </p>
                        <p class="appraisal-form-contp " id="reason" style="display: none">
                            <label for="beau">&emsp;原&emsp;&emsp;因：</label>
                            <input type="type" name="" id="beau" value="" />
                        </p>
                        <p class="appraisal-form-contp appraisal-form-contp1">
                            <label for="qjj">区建局：&emsp;</label>
                            <select name="" id="qjj" onchange="checkConstruction()">
                            </select>
                            <em></em>
                        </p>
                        <input id="modifyIdentityId" style="display: none;">
                    </div>

                </div>
                <div class="finish">
                    <a href="javascript:;" onclick="submit()" id="submit">填写完毕，确认提交</a>
                    <a href="javascript:;" onclick="store()" id="edit" style="display: none">修改完毕，确认提交</a>
                    <a id="entrustedInfo" style="display: none">您提交的信息</a>
                </div>
            </div>
        </div>
        <!--提交成功-->
        <div class="finish successfully">
            <a href="javascript:;">提交成功</a>
        </div>
        <div class="appraisal-tab">
            <h2>鉴定申请列表</h2>
            <div class="appraisal-con">
                <ul>

                    <li class="appraisal-con-tit" id="sequence">
                    </li>
                    <li class="appraisal-con-tit" id="applicantNameRow">
                    </li>
                    <li class="appraisal-con-tit" id="idcardnumRow">
                    </li>
                    <li class="appraisal-con-tit" id="applicantTelNumRow">
                    </li>
                    <li class="appraisal-con-tit" id="houseIdRow">
                    </li>
                    <li class="appraisal-con-tit" id="identityUnitRow">
                    </li>
                    <li class="appraisal-con-tit" id="houseAddressRow">
                    </li>
                    <li class="appraisal-con-tit" id="statusRow">
                    </li>
                    <li class="appraisal-con-tit" id="operateRow">
                    </li>
                </ul>
            </div>
        </div>
        <div class="paging">
            <p>
                <a href="javascript:;">总页数:<span id="totalitems"></span>页</a>
                <a href="javascript:;" onclick="page('1');">首页</a>
                <a href="javascript:;" onclick="page('before');">上一页</a>
                <a href="javascript:;" onclick="page('next');">下一页</a>
                <a href="javascript:;" onclick="page($('#totalitems').html())">末页</a>
                <a href="javascript:;" style="border: none;">
                    <input type="text" value="1" id="choosePage" style="padding: 0;margin: 0;width: 25px;height: 28px;"/>
                    <input type="text" value="1" id="page" style="display:none"/>
                </a>
                <a href="javascript:;" onclick="page($('#choosePage').val());"> 转到</a>
            </p>
        </div>
        <div class="appraisal-list">
            <h2>鉴定单位列表</h2>
            <div class="appraisal-con">
                <ul>
                    <li class="appraisal-con-tit" id="unitSequence" />
                    <li class="appraisal-con-tit" id="unitName" />
                    <li class="appraisal-con-tit" id="unitTelNum" />
                    <li class="appraisal-con-tit" id="unitAddress" />
                    <li class="appraisal-con-tit" id="unitRand" />
                    <li class="appraisal-con-tit" id="unitCharger" />
                    <li class="appraisal-con-tit" id="unitChargerTelNum" />
                    <li class="appraisal-con-tit" id="unitPersonCondition" />
                    <li class="appraisal-con-tit" id="unitCompanyQualification" />
                </ul>
            </div>
            <!--分页-->
            <div id="paging1" class="paging">
                <p>
                    <a href="javascript:;">总页数:<span id="unitPages"></span>页</a>
                    <a href="javascript:;" onclick="queryAppraiseUnitInfos(1)">首页</a>
                    <a href="javascript:;" onclick="unitSkipPage('before')">上一页</a>
                    <a href="javascript:;" onclick="unitSkipPage('next')">下一页</a>
                    <a href="javascript:;" onclick="unitSkipPage($('#unitPages').html())">末页</a>
                    <a href="javascript:;" style="border: none;">
                        <input type="text" id="chooseUnitPage" style="padding: 0;margin: 0;width: 25px;height: 28px;"/>
                        <input type="text" id="unitPage" style="display:none"/>
                    </a>
                    <a href="javascript:;" onclick="unitSkipPage($('#chooseUnitPage').val())"> 转到</a>
                </p>
            </div>
        </div>
    </div>
</div>
<!------------------------friendlyLink------------------------------>
<div id="friendlyLink-s"></div>

<!------------------------oblong------------------------------>
<div id="oblong-s"></div>
<!------------------------foorer------------------------------>
<div id="foorer-s"></div>
<script>
    //判断页面是否包含鉴定单位信息，如果包含，那么显示下拉框显示鉴定单位信息
    function queryAppraiseUnitInfo(){
        if(window.location.href.indexOf('?')!='-1'){
            var datas = window.location.href.split("?")[1].split('&');
            for(var i = 0;i<datas.length;i++){
                if(datas[i].split('=')[0]=='appraiseUnitName'){
                    $("#jddw").val(decodeURI(datas[i].split('=')[1]));
                }
            }
        }
    }
    //动态查询鉴定单位信息添加到select中
    function querySelectAppraiseUnitInfo(){
        $.ajax({
            url: "/index/queryappraiseinfos",
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
            success: function (data) {
                if (data.status) {
                    $("#jddw").empty().append('<option value="请选择鉴定单位" >请选择鉴定单位</option>');
                    for(var i = 0;i<data.msg.length;i++){
                        $("#jddw").append('<option value="'+data.msg[i].identity_unit_name+'" >'+data.msg[i].identity_unit_name+'</option>');
                    }
                    queryAppraiseUnitInfo();
                } else {
                    alert(data.msg)
                }

            }
        });
    }
    //查询区建局信息
    function queryQuJianJu(){
        $.ajax({
            type: 'post',
            url:"/user/querydepartinfos",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
            success: function(data){
                if(data.status){
                    $("#qjj").empty().append("<option value='请选择区建局'>请选择区建局</option>");
                    for(var i = 0; i<data.msg.length;i++){
                        $("#qjj").append("<option value='"+data.msg[i].departname+"'>"+data.msg[i].departname+"</option>")
                    }
                }else{
                    alert('获取区建局信息失败！');
                }
            }
        });
    }
    //查询第几页的鉴定单位
    function queryAppraiseUnitInfos(pageNum){
        $.ajax({
            type: 'post',
            url:"/user/queryappraiseunits",
            dataType: 'json',
            data:{
                'pageNum':pageNum,
                length:10
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
            success: function(data){
                if(data.status){
                    //显示第几页
                    $('#unitPages').html(Math.ceil(data.msg.unitNum/10));
                    //显示用户要跳转的页数
                    $("#chooseUnitPage").val(pageNum);
                    //显示固定的跳转页数
                    $("#unitPage").val(pageNum);
                    //显示相关鉴定单位信息
                    $("#unitSequence").empty().append("<p class='appraisal-con-tit1'>序号</p>");
                    $("#unitName").empty().append("<p class='appraisal-con-tit1'>单位名称</p>");
                    $("#unitTelNum").empty().append("<p class='appraisal-con-tit1'>办公电话</p>");
                    $("#unitAddress").empty().append("<p class='appraisal-con-tit1'>单位地址</p>");
                    $("#unitRand").empty().append("<p class='appraisal-con-tit1'>鉴定资质</p>");
                    $("#unitCharger").empty().append("<p class='appraisal-con-tit1'>负责人</p>");
                    $("#unitChargerTelNum").empty().append("<p class='appraisal-con-tit1'>负责人电话</p>");
                    $("#unitPersonCondition").empty().append("<p class='appraisal-con-tit1'>人员情况</p>");
                    $("#unitCompanyQualification").empty().append("<p class='appraisal-con-tit1'>资质情况</p>");
                    var length = data.msg.array.length;
                    for(var i = 0;i<length;i++){
                        $("#unitSequence").append("<p>"+(+(pageNum-1)*10+i+1)+"</p>");
                        $("#unitName").append("<p>"+data.msg.array[i].identity_unit_name+"</p>");
                        $("#unitTelNum").append("<p>"+data.msg.array[i].tel_number+"</p>");
                        $("#unitAddress").append("<p>"+data.msg.array[i].address+"</p>");
                        $("#unitRand").append("<p>"+data.msg.array[i].rank+"</p>");
                        $("#unitCharger").append("<p>"+data.msg.array[i].charger+"</p>");
                        $("#unitChargerTelNum").append("<p>"+data.msg.array[i].charger_tel_num+"</p>");
                        $("#unitPersonCondition").append("<p>"+data.msg.array[i].person_condition+"</p>");
                        $("#unitCompanyQualification").append("<p>"+data.msg.array[i].company_qualification+"</p>");
                    }
                    if(length<10){
                        for(var i =length;i<10;i++){
                            $("#unitSequence").append("<p></p>");
                            $("#unitName").append("<p></p>");
                            $("#unitTelNum").append("<p></p>");
                            $("#unitAddress").append("<p></p>");
                            $("#unitRand").append("<p></p>");
                            $("#unitCharger").append("<p></p>");
                            $("#unitChargerTelNum").append("<p></p>");
                            $("#unitPersonCondition").append("<p></p>");
                            $("#unitCompanyQualification").append("<p></p>");
                        }
                    }
                }else{
                    alert(data.msg);
                }
            }
        });
    }
    //跳转页面
    function unitSkipPage(data){
        if(data=='next'){
            if($("#unitPages").html()>$('#unitPage').val()){
                queryAppraiseUnitInfos(parseInt($('#unitPage').val())+1);
            }
        }
        else if(data=='before'){
            if($('#unitPage').val()>1){
                queryAppraiseUnitInfos($('#unitPage').val()-1);
            }
        }
        else if(!isNaN(data)){
            if(eval(data)<=eval($('#unitPages').html())&&eval(data)>0){
                queryAppraiseUnitInfos(data);
            }else if($('#totalitems').html()==0){
                queryAppraiseUnitInfos(data);
            }
            else{
                alert("您输入的数字有误，请重试");
                $("#chooseUnitPage").val("").focus();//清空输入框内容，获得焦点
            }
        }
        else{
            alert("请输入正确数字");
            $("#chooseUnitPage").val("").focus();//清空输入框内容，获得焦点
        }
    }
    queryAppraiseUnitInfos(1);
    querySelectAppraiseUnitInfo();
    queryQuJianJu();
</script>
</body>
</html>
