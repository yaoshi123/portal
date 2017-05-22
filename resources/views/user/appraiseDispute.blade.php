<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>纠纷</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/jdsq.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/ts.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/jf.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/ts.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        var reportNum = window.sessionStorage.getItem('reportNum');
        function disputeSubmit(){
            if(checkName()&&checkPhone()&&checkContent()&&checkReportNum()){
                $.ajax({
                    url: "/user/appraisedisputesubmit",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        applicant: $("#name").val(),
                        reportNum: $("#num").val(),
                        houseName: $("#fwname").val(),
                        district: $("#qy").val(),
                        appraiseUnit: $("#jddw").val(),
                        reason: $("#add").val(),
                        applicantTel: $("#phone1").val(),
                        appraiseTel: $("#jddwPhone").val(),
                        remark: $("#bz").val()
                    },
                    success: function (data) {
                        if(data.status){
                            $('input').val('');
                            $('textarea').val('');
                            $('#complain-finish').fadeIn(1000,function(){
                                $(this).fadeOut(1000)
                            })
                            page('1');
                        }else{
                            alert('您已提交该鉴定报告的鉴定纠纷，请耐心等待结果')
                        }
                    }
                });
            }
        }
        function queryDisputeInfos(pageNum){
            $.ajax({
                url:"/user/querydisputeinfos",
                dataType:'json',
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data:{
                    pageNum:pageNum,
                },
                success:function(data){
                    //显示第几页
                    $('#page').val(pageNum);
                    $('#choosePage').val(pageNum);
                    if(data.status){
                        var totalPages = Math.ceil(data.msg.length/10);
                        var operaction ;
                        $("#totalPages").html(totalPages==0?'1':totalPages);
                        $("#sequence").empty().append('<p class="appraisal-con-tit1" >序号</p>');
                        $("#reportCode").empty().append('<p class="appraisal-con-tit1">报告编号</p>');
                        $("#appraiseUnit").empty().append('<p class="appraisal-con-tit1">投诉单位</p>');
                        $("#submitDate").empty().append('<p class="appraisal-con-tit1">提交时间</p>');
                        $("#detail").empty().append('<p class="appraisal-con-tit1">操作</p>');
                        for(var i=0;i<10;i++){
                            if(data.msg.array[i]!=null){
                                if(data.msg.array[i].bpm_status=='0'){
                                    operaction = '<p><a class="skipTop" href="javascript:" onclick="editItem('+i+')">编辑</a> ' +
                                            '        <a href="javascript:" onclick="deleteItem('+i+')">删除</a> ' +
                                            '        <a href="javascript:" onclick="transmit('+i+')">提交</a></p>';
                                }
                                else if(data.msg.array[i].bpm_status=='1'){
                                    operaction = '<p><a href="javascript:" onclick="showItem('+i+')">查看</a> ';
                                }
                                $("#sequence").append('<p>'+(i+1+(parseInt(pageNum)-1)*10)+'</p>');
                                $("#reportCode").append('<p>'+data.msg.array[i].report_num+'</p>');
                                $("#appraiseUnit").append('<p>'+data.msg.array[i].appraise_unit+'</p>');
                                $("#submitDate").append('<p>'+data.msg.array[i].update_date+'</p>');
                                $("#detail").append(operaction);
                            }else{
                                $("#sequence").append('<p></p>');
                                $("#reportCode").append('<p></p>');
                                $("#appraiseUnit").append('<p></p>');
                                $("#submitDate").append('<p></p>');
                                $("#detail").append('<p></p>');
                            }

                        }
                    }else{
                        alert('您没有提交鉴定报告');
                    }
                }
            });
        }
        function page(data){
            if(data=='next'){
                if($('#totalPages').html()>$('#page').val()){
                    queryDisputeInfos(parseInt($('#page').val())+1);
                }
            }
            else if(data=='before'){
                if($('#page').val()>1){
                    queryDisputeInfos(parseInt($('#page').val())-1);
                }
            }
            else if(!isNaN(data)){
                if(eval(data)<=eval($('#totalPages').html())&&eval(data)>0){
                    queryDisputeInfos(data);
                }else if($('#totalPages').html()==0){
                    queryDisputeInfos(2*(data-1));
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
        function editItem(data){
            //滚动条跳转到最上
            $(window).scrollTop(0);
            //隐藏‘提交’按钮
            $('#submit').css({'display':'none'});
            //隐藏‘纠纷信息’按钮
            $('#showItem').css({'display':'none'});
            //显示“编辑”按钮
            $('#edit').css({'display':'inline-block'});

            var reportNum = $("#reportCode > p:eq("+(data+1)+")").html();
            $.ajax({
                url: "/user/queryappraisedisputebyreportnum",
                dataType: 'json',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN':  $('meta[name="_token"]').attr('content'),
                },
                data: {
                    reportNum: reportNum,
                },
                success: function (data) {
                    if(data.status){
                        $('input , textarea').attr({'disabled':false});
                        $("#name").val(data.msg.create_name);
                        $("#phone1").val(data.msg.applicant_tel);
                        $("#num").val(data.msg.report_num);
                        $("#fwname").val(data.msg.house_name);
                        $("#qy").val(data.msg.district);
                        $("#jddw").val(data.msg.appraise_unit);
                        $("#jddwPhone").val(data.msg.appraise_tel);
                        $("#add").val(data.msg.reason);
                        $("#bz").val(data.msg.remark);
                    }
                }
            });
        }
        function deleteItem(data){
            var reportNum = $("#reportCode > p:eq("+(data+1)+")").html();
            if(confirm('确认删除鉴定纠纷？')){
                $.ajax({
                    url: "/user/deleteappraisedisputebyreportnum",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        reportNum: reportNum,
                    },
                    success: function (data) {
                        if(data.status){
                            page($('#page').val());
                        }
                    }
                });
            }
        }
        function editSubmit(){
            $.ajax({
                url: "{{url('user/updateappraisedisputebyreportnum')}}",
                dataType: 'json',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data: {
                    applicant: $("#name").val(),
                    reportNum: $("#num").val(),
                    houseName: $("#fwname").val(),
                    district: $("#qy").val(),
                    appraiseUnit: $("#jddw").val(),
                    reason: $("#add").val(),
                    applicantTel: $("#phone1").val(),
                    appraiseTel: $("#jddwPhone").val(),
                    remark: $("#bz").val()
                },
                success: function (data) {
                    if(data.status){
                        $('input').val('');
                        $('textarea').val('');
                        $('#complain-finish').fadeIn(1000,function(){
                            $(this).fadeOut(1000)
                        })
                        page('1');
                    }else{
                        $('input').val('');
                        $('textarea').val('');
                        alert('保存失败')
                    }
                }
            });
        }
        function transmit(data){
            var reportNum = $("#reportCode > p:eq("+(data+1)+")").html();
            if(confirm('确认提交')){
                $.ajax({
                    url: "/user/updatedisputestatusbyreportnum",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        reportNum: reportNum,
                        bpmStatus:'1'

                    },
                    success: function (data) {
                        if(data.status){
                            page($('#page').val())
                        }
                    }
                });
            }
        }
        function showItem(data){
            //滚动条跳转到最上
            $(window).scrollTop(0);
            //隐藏提交的按钮
            $('#submit').css({'display':'none'});
            //隐藏编辑的按钮
            $('#edit').css({'display':'none'});
            //显示‘纠纷信息按钮’
            $('#showItem').css({'display':'inline-block'});
            //获取相关信息
            var reportNum = $("#reportCode > p:eq("+(data+1)+")").html();
            $.ajax({
                url: "/user/queryappraisedisputebyreportnum",
                dataType: 'json',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN':  $('meta[name="_token"]').attr('content'),
                },
                data: {
                    reportNum: reportNum,
                },
                success: function (data) {
                    if(data.status){
                        $('input , textarea').attr({'disabled':true});
                        $("#name").val(data.msg.create_name);
                        $("#phone1").val(data.msg.applicant_tel);
                        $("#num").val(data.msg.report_num);
                        $("#fwname").val(data.msg.house_name);
                        $("#qy").val(data.msg.district);
                        $("#jddw").val(data.msg.appraise_unit);
                        $("#jddwPhone").val(data.msg.appraise_tel);
                        $("#add").val(data.msg.reason);
                        $("#bz").val(data.msg.remark);
                    }
                }
            });
        }
        $(function(){
            if(reportNum!=null){
                $.ajax({
                    url: "/user/queryappraisereportbyreportnum",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        reportNum: reportNum,
                    },
                    success: function (data) {
                        window.sessionStorage.removeItem('reportNum');
                        if(data.status){
                            $("#num").val(data.msg.report_num);
                            $("#fwname").val(data.msg.house_name);
                            $("#qy").val(data.msg.district);
                            $("#jddw").val(data.msg.appraise_unit);
                            $("#jddwPhone").val(data.msg.phone);
                        }else{
                            $('#num').siblings('em').css({'display':'inline-block'}).html('鉴定编号错误!')
                            $('#num').focus();
                        }
                    }
                });
            }
        });
        queryDisputeInfos(1);
    </script>
</head>
<body>
<!------------------------hotline------------------------------>
<!--<div id="commot-hot"></div>-->
<div id="hotline">
    <div class="hotline">
        <p class="phone">咨询热线：0731-88888888</p>
        <p class="login">
            <a id = 'login'  class="login-btn">
                {{'欢迎您：'.session('user')->user_name}}
            </a>
            <a href="javascript:;" class="register-btn " id="quit">退出</a>
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
                <a href="#">首页</a>
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

<!--complain-->
<div id="appraisal"  >
    <div class="appraisal complain">
        <div class="appraisal-form complain-form" >
            <div class="appraisal-forms" >
                <div class="appraisal-form-tit">
                    <p>鉴定纠纷</p>
                </div>
                <!--左边的框-->
                <div class="complain-left">
                    <div class="complain-tit">
                        <h2>请如实填写以下信息</h2>
                        <p>基本资料</p>
                    </div>
                    <div class="appraisal-form-cont complain-left-form">
                        <div class="complain-left-formps">
                            <p >
                                <label for="name">&emsp;&emsp;&emsp;&emsp;姓名：</label>
                                <input type="type" id="name" onblur="checkName()"/>
                                <em></em>
                            </p>
                            <p >
                                <label for="phone1">&emsp;&emsp;联系电话：</label>
                                <input type="type" id="phone1"onblur="checkPhone()"/>
                                <em></em>
                            </p>
                            <p >
                                <label for="num">鉴定报告编码：</label>
                                <input type="type" id="num" onblur="checkReportNum()"/>
                                <em></em>
                            </p>
                            <p >
                                <label for="fwname">&emsp;&emsp;房屋名称：</label>
                                <input type="type"  id="fwname" style="width: 500px;" onfocus="javascript:$('#num').focus();"/>
                                <em></em>
                            </p>
                            <p >
                                <label for="qy">&emsp;&emsp;&emsp;&emsp;区域：</label>
                                <input type="type" id="qy" style="width: 500px;" onfocus="javascript:$('#num').focus();"/>
                                <em></em>
                            </p>
                            <p >
                                <label for="jddw">&emsp;&emsp;鉴定单位：</label>
                                <input type="type" id="jddw" style="width: 500px;" onfocus="javascript:$('#num').focus();"/>
                                <em></em>
                            </p>
                            <p>
                                <label for="jddwPhone">鉴定单位电话：</label>
                                <input type="type" id="jddwPhone" style="width: 500px;" onfocus="javascript:$('#num').focus();"/>
                                <em></em>
                            </p>
                            <p >
                                <label for="add" style="float:left;margin-top: 10px;">&emsp;&emsp;鉴定理由：</label>
                                <textarea type="type" id="add" onblur="checkReason()"></textarea>
                                <em></em>
                            </p>
                            <p >
                                <label for="bz" style="float:left;margin-top: 10px;">&emsp;&emsp;&emsp;&emsp;备注：</label>
                                <textarea type="type" name="" id="bz" value="" ></textarea>
                                <em></em>
                            </p>
                        </div>

                    </div>
                    <div class="finish complain-finish">
                        <a href="javascript:;" onclick="disputeSubmit()" id="submit">填写完毕，确认提交</a>
                        <a href="javascript:;" onclick="editSubmit()" style="display: none;" id="edit">修改完毕，确认提交</a>
                        <a href="javascript:;" style="display: none;" id="showItem">纠纷信息</a>
                    </div>
                    <div class="finish complain-finish" id="complain-finish">
                        <a href="javascript:;">提交完成</a>
                    </div>
                </div>


                <!--右边的框-->
                <div class="complain-right" >
                    <h2>投诉注意事项</h2>
                    <p style="margin-top: 20px;">1.投诉者在填写“联系电话”时请真实、准确、无误的填写，方便后台工作人员及时联系您处理相关问题。经后台发布的信息自动的屏蔽了您的联系方式，敬请放心。</p>
                    <p>2.为防止输入错误而导致的数据丢失，请投诉者在填写“投诉内容”时，先将文字信息输入到记事本或word文档上，在复制到表格的“投诉内容”</p>
                    <p>3.咨询电话：0730-88888888，页面下方查看投诉信息列表</p>
                </div>
            </div>
        </div>


        <div class="appraisal-tab">
            <h2>鉴定纠纷列表</h2>
            <div class="appraisal-con">
                <ul>
                    <li class="appraisal-con-tit" id="sequence"></li>
                    <li class="appraisal-con-tit" id="reportCode"></li>
                    <li class="appraisal-con-tit" id="appraiseUnit"></li>
                    <li class="appraisal-con-tit" id="submitDate"></li>
                    <li class="appraisal-con-tit" id="detail"></li>
                </ul>
            </div>
        </div>
        <!--分页-->
        <div class="paging">
            <p>
                <a href="javascript:;">总页数:<span id="totalPages">0</span>页</a>
                <a href="javascript:;" onclick="page('1');">首页</a>
                <a href="javascript:;" onclick="page('before');">上一页</a>
                <a href="javascript:;" onclick="page('next');">下一页</a>
                <a href="javascript:;"  onclick="page($('#totalPages').html());">末页</a>
                <a href="javascript:;" style="border: none;">
                    <input id="choosePage" type="text" value="1"  style="padding: 0;margin: 0;width: 25px;height: 26px;"/>
                    <input id="page" type="text" value="1"  style="display: none"/>
                </a>
                <a href="javascript:;" onclick="page($('#choosePage').val())"> 转到</a>
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
</html>
