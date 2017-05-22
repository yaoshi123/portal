<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>登录</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/dl.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/dl.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        var userLoginNum = '{{session('userLoginNum')}}';
        var unitLoginNum = '{{session('unitLoginNum')}}';
        function checkUserCode(){
            if($('#userCode').val()==''){
                $('#userCode').siblings('em').css({'display':'block'}).html('验证码不能为空!');
                return false;
            }else{
                $('#userCode').siblings('em').css({'display':"none"});
                return true;
            }
        }
        function checkUnitCode(){
            if($('#unitCode').val()==''){
                $('#unitCode').siblings('em').css({'display':'block'}).html('验证码不能为空!');
                return false;
            }else{
                $('#unitCode').siblings('em').css({'display':"none"});
                return true;
            }
        }
        function userLogin(){
            var checkCode =true;
            if(checkUserName()&&checkUserPassword()){
                if($("#userCodeShow").css('display')!='none'){
                    checkCode = checkUserCode();
                }
            }
            if(checkUserName()&&checkUserPassword()&&checkCode) {
                $.ajax({
                    url: "{{url('index/userlogin')}}",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        username: $("#user").val(),
                        password: $("#passw").val(),
                        userCode:$("#userCode").val()
                    },
                    success: function (data) {
                        if (data.status) {
                            window.location.href = '/';
                        } else {
                            if(parseInt(data.userLoginNum)>1){
                                getUserCode();
                                $('#userCodeShow').css({'display':'inline-block'}).siblings('.showRequired').css({'display':'inline-block'});
                               
                            }
                            $('#userCode').val('');
                            $('#userCode').focus();
                            alert(data.msg);
                            if(data.msg=='输入的验证码错误'){
                                getUserCode();
                            }
                            if(data.msg == '用户名或密码错误'){
                            	//alert($("#passw").length)
                            	$("#passw").siblings('em').css({
									'display':'block',
									'background-image':'url("/public/assets/img/reg_icons.png")',
									'color':'#fff',
									'background-position':'-80px -15px',
									'background-repeat':'no-repeat',
									'width':'32px',
									'height':'32px'
								}).html('');
								$("#user").siblings('em').css({
									'display':'block',
									'background-image':'url("/public/assets/img/reg_icons.png")',
									'color':'#fff',
									'background-position':'-80px -15px',
									'background-repeat':'no-repeat',
									'width':'32px',
									'height':'32px'
								}).html('')
                            }
                            
                            
                        }
                    }
                });
            }
        }
        function identityUnitLogin(){
            var checkCode =true;
            if(checkUnitName()&&checkUnitPassword()){
                if($("#unitCodeShow").css('display')!='none'){
                    checkCode = checkUnitCode();
                }
            }
            if(checkUnitName()&&checkUnitPassword()&&checkCode){
                $.ajax({
                    url:"{{url('index/identityunitlogin')}}",
                    dataType:'json',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data:{
                        identityName:$("#unitname").val(),
                        password:$("#unitpassw").val(),
                        unitCode:$("#unitCode").val()
                    },
                    success:function(data){
                        if (data.status) {
                            window.location.href = '/';
                        } else {
                            if(parseInt(data.unitLoginNum)>1){
                                getUnitCode();
                                $('#unitCodeShow').css({'display':'inline-block'}).siblings('.showRequired').css({'display':'inline-block'});
								
                            }
                            $('#unitCode').val('');
                            $('#unitCode').focus();
                            alert(data.msg);
                            if(data.msg == '输入的验证码错误'){
                                getUnitCode();
                            }
                            if(data.msg == '用户名或密码错误'){
                            	//alert($("#passw").length)
                            	$("#unitname").siblings('em').css({
									'display':'block',
									'background-image':'url("/public/assets/img/reg_icons.png")',
									'color':'#fff',
									'background-position':'-80px -15px',
									'background-repeat':'no-repeat',
									'width':'32px',
									'height':'32px'
								}).html('');
								$("#unitpassw").siblings('em').css({
									'display':'block',
									'background-image':'url("/public/assets/img/reg_icons.png")',
									'color':'#fff',
									'background-position':'-80px -15px',
									'background-repeat':'no-repeat',
									'width':'32px',
									'height':'32px'
								}).html('')
                            }
                        }
                    }
                });
            }

        }
        function getUserCode(){
            $('#imgCode').attr('src',"/index/code?random="+Math.random());
        }
        function getUnitCode(){
            $('#imgUnitCode').attr('src',"{{url('/index/code')}}");
        }
    </script>
</head>
<body>
<!------------------------hotline------------------------------>
<!--<div id="commot-hot"></div>-->
<div id="hotline">
    <div class="hotline">
        <p class="phone">咨询热线：0731-88888888</p>
        @if(session('admin'))
            <p class="login">
                <a id = 'login'  class="login-btn">
                    {{'欢迎您：'.session('admin')->user_name}}
                </a>
                <a href="/index/quit" class="register-btn" >退出</a>
            </p>
        @elseif(session('unit'))
            <p class="login">
                <a id = 'login'  class="login-btn">
                    {{'欢迎您：'.session('unit')->identity_unit_name}}
                </a>
                <a href="/index/quit" class="register-btn" >退出</a>
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
        </ul>
    </div>
</div>
<!--signIn-->
<div id="signIn">
    <div class="signIn">
        <h2>用户登录</h2>
        <div class="signIn-form">
            <p>
						<span>
							<a href="javascript:;" class="dl-radio dl-radio1">普通用户</a>
							<a href="javascript:;" class="dl-radio">鉴定单位</a>
						</span>
            </p>
            <div class="signIn-tab1" style="position: relative;">
                <p>
							<span style="margin-left: 380px;">
								<label for="user">用户名 ：</label>
								<input type="text" name="" id="user" onblur="checkUserName()" />
								<em ></em>
							</span>
                </p>
                <p>
							<span style="margin-left: 380px;">
								<label for="passw" style="width: 56px;">&emsp;密码 ：</label>
								<input type="password" name="" id="passw" onblur="checkUserPassword()"/>
								<em ></em>
							</span>
                </p>
                <p id='userCodeShow'style="display: none">
							<span style="margin-left: 380px;">
								<label for="yzm" >验证码：</label>
								<input type="text" onblur="checkUserCode();" id="userCode" placeholder="请输入验证码" />
								<a href="javascript:;" class="yzmk" onclick="getUserCode()">
                                    <img id="imgCode" >
                                </a>
                                <em style="padding-right: 36px;"></em>
							</span>
                </p>

                <p>
							<span style="margin-left: 438px;">
								<a href="/index/findpassw" >忘记密码</a>
								<a href="/index/register" class="free">免费注册</a>
							</span>
                </p>
                <p >
                    <a style="margin-left: 438px;" href="javascript:;" id="login" onclick="userLogin()">登录</a>
                </p>
                <p style="position: absolute;left: 370px;color: red;top: 10px;">*</p>
                <p style="position: absolute;left: 370px;color: red;top: 70px;">*</p>
                <p style="position: absolute;left: 370px;color: red;top: 121px;display: none;" class="showRequired">*</p>
                
            </div>
            <div style="position: relative;">
                <p>
							<span >
								<label for="unitname" style="width: 66px;">单位名称 ：</label>
								<input type="text" name="" id="unitname" onblur="checkUnitName()"/>
								<em></em>
							</span>
                </p>
                <p>
							<span style="margin-left: 379px;">
								<label for="unitpassw">&emsp;密码 ：</label>
								<input type="password" name="" id="unitpassw" onblur="checkUnitPassword()"/>
								<em></em>
							</span>
                </p>
                <p id="unitCodeShow" style="display: none">
							<span style="margin-left: 387px;">
								<label for="yzm">验证码：</label>
								<input type="text" name="" id="unitCode" placeholder="请输入验证码" />
								<a href="javascript:;" class="yzmk" onclick="getUnitCode()">
                                    <img id="imgUnitCode" >
                                </a>
                                <em style="padding-right: 36px;"></em>
							</span>
                </p>
                <p>
							<span style="margin-left: 438px;">
								<a href="/index/findpassw" >忘记密码</a>
								<a href="/index/register" class="free">免费注册</a>
							</span>
                </p>
                <p >
                    <a style="margin-left: 438px;" href="javascript:;" id="login" onclick="identityUnitLogin()">登录</a>
                </p>
                <p style="position: absolute;left: 370px;color: red;top: 10px;">*</p>
                <p style="position: absolute;left: 370px;color: red;top: 70px;">*</p>
                <p style="position: absolute;left: 370px;color: red;top: 121px;display: none;" class="showRequired">*</p>
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
