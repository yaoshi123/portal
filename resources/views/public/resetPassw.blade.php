<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>重置密码</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/dl.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/czmm.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/czmm.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        function changePass(){
            if(checkPassword()&&confirmPassword()){
                $.ajax({
                    url: "/index/changepassw",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        password:$("#confirmPassword").val(),
                    },
                    success: function (data) {
                        if(data.status){
                            window.location.href = 'http://www.changsha.com/index/login';
                        }else{
                            alert(data.msg);
                        }
                    }
                });
            }
        }
    </script>
</head>
<body>
<!------------------------hotline------------------------------>
<!--<div id="commot-hot"></div>-->
<div id="hotline">
    <div class="hotline">
        <p class="phone">咨询热线：0731-88888888</p>
        <p class="login">
            <a href="/index/login" class="login-btn">登录</a>
            <a href="/index/register" class="register-btn">注册</a>
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

<!--signIn-->
<div id="signIn">
    <div class="signIn" >
        <h2>重置密码</h2>
        <div class="signIn-form">
            <p>
            </p>
            <div class="signIn-tab1" >
                <p>
							<span>
								<label for="newPassword">新密码 ：</label>
								<input type="password" name="" id="newPassword" placeholder="请输入新密码码" />
                                <!--<a href="javascript:;" class="yzm-click" onclick="settime(this)">发送验证码</a>-->
								<em></em>
							</span>
                </p>
                <p>
							<span style="margin-left: 304px;width: 420px;">
								<label for="confirmPassword">确认新密码：</label>
								<input type="password" name="" id="confirmPassword" placeholder="请确认新密码" />
								<em></em>
							</span>
                </p>
                <p>
                    <a href="javascript:;" class="next-step" onclick="changePass();">确认修改</a>
                </p>
                <p>
                    *
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
</body>
</html>

