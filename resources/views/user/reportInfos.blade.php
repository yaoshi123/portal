<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>鉴定单位上传信息</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/common.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/jdsq.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/scfj.css')}}"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/userscfj.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        function queryIdentityInfos(pageNum){
            $.ajax({
                url:"{{url('index/queryappraisereportsbyappliant')}}",
                dataType:'json',
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data:{
                    pageNum:pageNum,
                },
                success:function(data) {
                   $('#choosePage').val(pageNum);
                   $('#page').val(pageNum);
                    if (data.status) {
                        $("#totalPages").html(Math.ceil(data.msg.length / 10));
                        $("#sequence").empty().append('<p class="appraisal-con-tit1" >序号</p>');
                        $("#reportCode").empty().append('<p class="appraisal-con-tit1">报告编号</p>');
                        $("#houseName").empty().append('<p class="appraisal-con-tit1">房屋名称</p>');
                        $("#buildTime").empty().append('<p class="appraisal-con-tit1">建造年份</p>');
                        $("#sendDate").empty().append(' <p class="appraisal-con-tit1">提交时间</p>');
                        $("#reportStatus").empty().append(' <p class="appraisal-con-tit1">报告状态</p>');
                        $("#operation").empty().append(' <p class="appraisal-con-tit1">操作</p>');
                        for (var i = 0; i < 10; i++) {
                            if (data.msg.array[i] != null) {
                                var reportStatus, operaction, fileOperaction;
                                if (data.msg.array[i].bpm_status == '1') {
                                    reportStatus = '已提交';
                                }else if(data.msg.array[i].bpm_status == '2'){
                                    reportStatus = '初审未通过';
                                }else if(data.msg.array[i].bpm_status == '3'){
                                    reportStatus = '等待复审';
                                }else if(data.msg.array[i].bpm_status == '4'){
                                    reportStatus = '复审通过';
                                }else if(data.msg.array[i].bpm_status == '5'){
                                    reportStatus = '复审未通过';
                                }
                                $("#sequence").append('<p>' + (i + 1 + (parseInt(pageNum) - 1) * 10) + '</p>');
                                $("#reportCode").append('<p>' + data.msg.array[i].report_num + '</p>');
                                $("#houseName").append('<p>' + data.msg.array[i].house_name + '</p>');
                                $("#buildTime").append('<p>' + data.msg.array[i].build_end_year.substr(0, 10) + '</p>');
                                $("#sendDate").append('<p>' + data.msg.array[i].send_date + '</p>');
                                $("#reportStatus").append('<p>' + reportStatus + '</p>');
                                $("#operation").append('<p><a href="javascript:;" onclick="reportDispute('+i+')">提出纠纷</a> ' +
                                                        '<a href="javascript:;" onclick="checkReportInfo('+i+')">查看</a></p>');
                            } else {
                                $("#sequence").append('<p></p>');
                                $("#reportCode").append('<p></p>');
                                $("#houseName").append('<p></p>');
                                $("#buildTime").append('<p></p>');
                                $("#reportStatus").append('<p></p>');
                                $("#reportOperation").append('<p></p>');
                                $("#operation").append('<p></p>');
                            }
                        }
                    }
                }
            });
        }
        function page(data){
            if(data=='next'){
                if($('#totalPages').html()>$('#page').val()){
                    queryIdentityInfos(parseInt($('#page').val())+1);
                }
            }
            else if(data=='before'){
                if($('#page').val()>1){
                    queryIdentityInfos(parseInt($('#page').val())-1);
                }
            }
            else if(!isNaN(data)){
                if(eval(data)<=eval($('#totalPages').html())&&eval(data)>0){
                    queryIdentityInfos(data);
                }else if($('#totalPages').html()==0){
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
        function checkReportInfo(data){
            var reportNum = $("#reportCode p:eq("+(data + 1)+")").html();
            window.location.href='/user/appraisereport?reportNum='+reportNum;
        }
        function reportDispute(data){
            var reportNum = $("#reportCode p:eq("+(data + 1)+")").html();
            window.sessionStorage.setItem('reportNum',reportNum);
            window.location.href='/user/appraisedispute';
        }
        queryIdentityInfos(1);
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
            <a href="javascript:;" class="register-btn" id="quit">退出</a>
        </p>
    </div>
</div>
<!------------------------logo------------------------------>
<div id="commot-logo">
</div>
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
<!------------------------appraisal------------------------------>
<div id="appraisal">
    {{session('msg')}}
    <div class="appraisal">
        <div class="appraisal-tab">
            <!--提交成功-->
            <div class="finish successfully">
                <a href="javascript:;">上传成功</a>
            </div>
            <h2>我的报告</h2>
            <div class="appraisal-con">
                <ul>
                    <li class="appraisal-con-tit" id="sequence"/>
                    <li class="appraisal-con-tit" id="reportCode"/>
                    <li class="appraisal-con-tit" id="houseName"/>
                    <li class="appraisal-con-tit" id="buildTime"/>
                    <li class="appraisal-con-tit" id="sendDate"/>
                    <li class="appraisal-con-tit" id="reportStatus"/>
                    <li class="appraisal-con-tit" id="operation"/>
                </ul>
            </div>
        </div>
        <!--分页-->
        <div class="paging">
            <p>
                <a href="javascript:;">共<span id="totalPages"></span>页</a>
                <a href="javascript:;" onclick="page(1)">首页</a>
                <a href="javascript:;" onclick="page('before')">上一页</a>
                <a href="javascript:;" onclick="page('next')">下一页</a>
                <a href="javascript:;" onclick="page($('#totalPages').html())">末页</a>
                <a href="javascript:;" style="border: none;">
                    <input type="text" value="1" id="choosePage" style="padding: 0;margin: 0;width: 25px;height: 26px;"/>
                    <input type="text" value="1" id="page" style="display: none"/>
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
<!------------------------隐藏的div------------------------------>
<div id="hide-div" >
    <p style="">
        <a href="javascript:;" class="close-hide">关闭</a>
    </p>
    <img id='img'style="margin: 100px auto;" />
</div>
</body>
</html>
