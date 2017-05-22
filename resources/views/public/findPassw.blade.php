<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>找回密码</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/dl.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/zhmm.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/zhmm.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        function emailCount(){
            var count="59";
            var timer = setInterval(function(){
                $(".btn-fsy").val("重新发送(" + count + ")");
                count--;
                $(".btn-fsy").attr("disabled", true);
                if(count=='0'){
                    clearInterval(timer);
                    $(".btn-fsy").val("发送验证码");
                    $(".btn-fsy").attr("disabled", false);
                }
            },"1000");
        }
        function sendEmail(){
            if(checkEmail()){
                $.ajax({
                    url: "/index/sendmail",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        email:$('#email-1').val(),
                    },
                    success: function (data) {
                        if(data.status){
                            emailCount();
                        }
                        alert(data.msg)
                    }
                });
            }
        }
        function validateCode(){
            if(checkEmail()&&checkCodeE()){
                $.ajax({
                    url: "/index/validateemailcode",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        email:$('#email-1').val(),
                        emailCode:$('#yzm-e').val(),
                    },
                    success: function (data) {
                        if(data.status){
                            window.location.href = '/index/resetpassw';
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
        <h2>找回密码</h2>
        <div class="signIn-form">
            <p>
						<span>
							<a href="javascript:;" class="dl-radio dl-radio1">手机找回</a>
							<a href="javascript:;" class="dl-radio">邮箱找回</a>
						</span>
            </p>
            <div class="signIn-tab1" >
                <p>
							<span>
								<label for="user">验证手机号 ：</label>
								<input type="text" name="" id="user" value="" />
								<input type="button" class="btn-fs" value="发送验证码"  />
								<em></em>
							</span>
                </p>
                <p>
							<span style="margin-left: 324px;">
								<label for="yzm">验证码：</label>
								<input type="text" name="" id="yzm" placeholder="请输入验证码" />
								<em></em>
							</span>
                </p>
                <p>
                    <a href="javascript:;" class="next-step">下一步</a>
                </p>
                <p>
                    *
                </p>
                <p>
                    *
                </p>
            </div>

            <div>
                <p>
							<span>
								<label for="email-1">验证邮箱号 ：</label>
								<input type="text" name="" id="email-1" value="" />
								<input type="button" class="btn-fsy" value="发送验证码"  onclick="sendEmail()"/>
								<em></em>
							</span>
                </p>
                <p>
							<span style="margin-left: 324px;">
								<label for="yzm-e">验证码：</label>
								<input type="text" name="" id="yzm-e" placeholder="请输入验证码" />
								<em></em>
							</span>
                </p>
                <p>
                    <a href="javascript:;" class="next-step next-step1"  onclick="validateCode()">下一步</a>
                </p>
                <p>
                    *
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
