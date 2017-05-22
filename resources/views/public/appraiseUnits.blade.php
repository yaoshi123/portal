<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>鉴定单位</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/jddw2.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/libs/jquery.cookie.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/jddw.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        //展示鉴定单位信息
        function queryAppraiseInfos(){
            $.ajax({
                url: "{{url('index/queryappraiseinfos')}}",
                dataType: 'json',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                success: function (data) {
                    if (data.status) {
                        for(var i = 0;i<data.msg.length;i++){
                            $('#appraiseInfos').append(
                                '<li onclick="queryAppraiseIntroductionInfos('+i+')">'
                                    +'<a href="javascript:;">'+data.msg[i].identity_unit_name+'</a>' +
                                     '<a href="javascript:;" style="display: none">'+data.msg[i].identity_unit_id+'</a>' +
                                '</li>')
                        }
                    } else {
                        alert(data.msg)
                    }
                    confirmUnitInfo()
                }
            });
        }
        //展示鉴定单位简介
        function queryAppraiseIntroductionInfos(num){
            var identityUnitId = $('#appraiseInfos >li:eq('+num+')>a:eq(1)').html();
           $.ajax({
                url: "/index/queryappraiseinfobyunitid",
                dataType: 'json',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
               data:{
                   identityUnitId:identityUnitId
               },
                success: function (data) {
                    if (data.status) {
                       $('#appraiseUnitName').html(data.msg.identity_unit_name);
                       $('#appraiseUnitIntroduction').html(data.msg.introduction);
                    } else {
                        alert(data.msg)
                    }
                }
            });
        }
        //跳转到我要鉴定页面
        function skipView(){
            window.location.href='/user/houseapplicant?appraiseUnitName='+$('#appraiseUnitName').html();
        }
        //确定路径中是否含有鉴定单位信息，如果有显示鉴定单位的介绍
        function confirmUnitInfo(){
            var identityUnitName = '';
            if(window.location.href.indexOf('?')!='-1'){
                var datas = window.location.href.split("?")[1].split('&');
                for(var i = 0;i<datas.length;i++){
                    if(datas[i].split('=')[0]=='unitName'){
                        identityUnitName = decodeURI(datas[i].split('=')[1])
                    }
                }
            }
            if(identityUnitName!=''){
                $.ajax({
                    url: "/index/queryappraiseinfobyunitname",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data:{
                        identityUnitName:identityUnitName
                    },
                    success: function (data) {
                        if (data.status) {
                            $('#appraiseUnitName').html(data.msg.identity_unit_name);
                            $('#appraiseUnitIntroduction').html(data.msg.introduction);
                        } else {
                            alert(data.msg)
                        }
                    }
                });
            }else{
                queryAppraiseIntroductionInfos(0)
            }
        }
        queryAppraiseInfos();
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
                </a>
                <a href="javascript:;" class="register-btn" id="quit">退出</a>
            </p>
        @elseif(session('unit'))
            <p class="login">
                <a id = 'login'  class="login-btn">
                    {{'欢迎您：'.session('unit')->identity_unit_name}}
                </a>
                <a href="javascript:;" class="register-btn" id="quit">退出</a>
            </p>
        @else
            <p class="login">
                <a  href="/index/login" class="login-btn" id = 'login'>
                    登录
                </a>
                <a href="/index/register" class="register-btn">注册</a>
            </p>
        @endif
    </div>
</div>
<!------------------------logo------------------------------>
<div id="commot-logo"></div>
<!------------------------nav------------------------------>
<div id="commot-nav">
    <div id="nav">
        <div class="nav">
            <ul class="nav-cont">
                <li class="nav-list">
                    <a href="/">首页</a>
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
                @if(session('user'))
                    <li class="nav-list" >
                        <a href="#"	>我&nbsp;&nbsp;&nbsp;的</a>
                        <p >
                            <a href="/user/houseapplicant" >我的鉴定申请</a>
                            <a href="/user/reportinfos">我的鉴定报告</a>
                            <a href="/user/appraisedispute">我的鉴定纠纷</a>
                            <a href="/user/housecomplaint">我的投诉信息</a>
                            <a href="/user/userinfo">个人信息</a>
                        </p>
                    </li>
                @elseif(session('unit'))
                    <li class="nav-list" >
                        <a href="#"	>我&nbsp;&nbsp;&nbsp;的</a>
                        <p >
                            <a href="/unit/appraisereport">鉴定报告录入</a>
                            <a href="/unit/reportinfos">我的鉴定报告</a>
                            <a href="/unit/entrustinfos">我的鉴定委托</a>
                        </p>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
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
            @if(session('user'))
                <li class="nav-list" >
                    <a href="#"	>我&nbsp;&nbsp;&nbsp;的</a>
                    <p >
                        <a href="/user/houseapplicant" >我的鉴定申请</a>
                        <a href="/user/reportinfos">我的鉴定报告</a>
                        <a href="/user/appraisedispute">我的鉴定纠纷</a>
                        <a href="/user/housecomplaint">我的投诉信息</a>
                    </p>
                </li>
            @elseif(session('unit'))
                <li class="nav-list" >
                    <a href="#"	>我&nbsp;&nbsp;&nbsp;的</a>
                    <p >
                        <a href="/unit/appraisereport">鉴定报告录入</a>
                        <a href="/unit/reportinfos">我的鉴定报告</a>
                        <a href="/unit/entrustinfos">我的鉴定委托</a>
                    </p>
                </li>
            @endif
        </ul>
    </div>
</div>

<!--内容区域-->
<div id="worker">
    <div class="worker">
        <img src="/public/assets/img/jddw-ban.png"/>
        <div class="groom">
            <div class="checkup">
                <h2>鉴定单位</h2>
                <ul id="appraiseInfos" />
            </div>
        </div>
        <div class="worker-div profile">
            <h2 id="appraiseUnitName"></h2>
            <p id="appraiseUnitIntroduction"></p>
            <a href="javascript:;" class="worker-div-a" onclick="skipView()">我要鉴定</a>
        </div>
    </div>
</div>
<!------------------------friendlyLink------------------------------>
<div id="friendlyLink-s" style="clear: both;margin-top: 56px;"></div>

<!------------------------oblong------------------------------>
<div id="oblong-s"></div>
<!------------------------foorer------------------------------>
<div id="foorer-s"></div>
</body>
</html>
