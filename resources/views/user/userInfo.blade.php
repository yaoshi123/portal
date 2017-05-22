<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>个人信息</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/grxx.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/grxx2.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/grxx2.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/cropbox.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
    
	    var reg = {
			regEmail:/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/
		};
    	/*邮箱不能为空*/
		function bindEmail(){
			if($('#old-email').val()==''){
				$('.successfully').html("请填写邮箱！")
				.css({'background':'#000'})
				.fadeIn(1000,function(){
					$('.successfully').fadeOut(1000);
				})
				return false;
			}else if(!reg.regEmail.test($('#old-email').val())){
				$('.successfully').html("新邮箱格式好像错了！")
				.css({'background':'#000'})
				.fadeIn(1000,function(){
					$('.successfully').fadeOut(1000);
				})
				return false;
			}else{
				
				return true;
			}
		}
		/*新邮箱的验证码不能为空*/
		function bindEmailCode(){
			if($('#old-email-in').val()==''){
				$('.successfully').html("请填写验证码！")
				.css({'background':'#000'})
				.fadeIn(1000,function(){
					$('.successfully').fadeOut(1000);
				})
				return false;
			}else{
				$('#nx-newEmail').parents("form").siblings("form").css({'display':'none'});
				$('.profile').find("#registration").css({'text-align':'center',"height":"90px",'line-height':'90px','font-size':'20px'}).html("邮箱绑定成功")
				return true;
			}
		}
        function queryUserInfos(){
            $.ajax({
                url: "/user/queryuserinfos",
                dataType: 'json',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                success: function (data) {
                    if(data.status){
                        $('#user').val(data.msg.user_name)
                        $('#passw1').val(data.msg.idcard_num)
                        $('#yzm').val(data.msg.contact_address)
                        $('#old-email').val(data.msg.email)
                        //如果邮箱未注册，则变为绑定邮箱
                        if(data.msg.email==''){
                        	//alert('111')
                        	$('a:contains(修改绑定邮箱)').html('绑定邮箱')
                        	$('label:contains(原邮箱)').html('邮箱地址&emsp;: ')
                        	$('#nx-newEmail').html("确定").click(function(){
								if(bindEmail()&&bindEmailCode()){

								} 
                        	})
                        }
                    }else{
                        alert(data.msg);
                    }
                }
            });
        }
        
        queryUserInfos()
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

<!--内容区域-->
<div id="worker">
    <div class="worker">
        <!--<img src="img/jddw-ban.png"/>-->
        <div class="groom">
            <div class="checkup" >
                <!--<h2>鉴定单位</h2>-->
                <ul >
                    <li><a href="javascript:;">基本信息</a></li>
                    <li><a href="javascript:;">修改绑定手机</a></li>
                    <li><a href="javascript:;">修改绑定邮箱</a></li>
                </ul>
            </div>
        </div>

        <div class="worker-div profile">
            <h2>信息</h2>
            <div id="registration">
                <div class="registration">
                    <div class="registration-cent">
                        <div class="registration-c-left">
                            <p>

                            </p>
                            <!--表单-->
                            <form action="#" method="post" class="registration-form">
                                <div>
                                    <dl>
                                        <dt><span>*</span><label for="user">用户名&emsp;:</label></dt>
                                        <dd><input type="text"  id="user"/><em class="hidden">修改</em></dd>
                                    </dl>
                                </div>

                                <div>
                                    <dl>
                                        <dt><span>*</span><label for="passw1">身份证&emsp;: </label></dt>
                                        <dd><input type="text"  id="passw1"/><em class="hidden">修改</em></dd>
                                    </dl>
                                </div>

                                <div>
                                    <dl>
                                        <dt><span>*</span><label for="yzm">联系地址: </label></dt>
                                        <dd><input type="text"  id="yzm"  /><em class="hidden">修改</em></dd>
                                    </dl>
                                </div>
                                <!--同意条款，并注册-->
                                <div>
                                    <a href="javascript:;" id="conserve" class="agree">保存设置</a>
                                </div>
                            </form>
                        </div>
                        <div class="registration-c-right">
                            <p><img src="/public/assets/img/10.jpg" class="image-display"/></p>
                            <p class="avatar">
                                <a href="javascript:;" id="OpenImg">修改头像</a>
                            </p>
                            <!--编辑图片-->

                            <div class="container">
                                <div class="imageBox">
                                    <div class="thumbBox"></div>
                                    <div class="spinner" style="display: none">Loading...</div>
                                </div>
                                <div class="action">
                                    <!-- <input type="file" id="file" style=" width: 200px">-->
                                    <div class="new-contentarea tc"> <a href="javascript:void(0)" class="upload-img">
                                            <label for="upload-file">上传图像</label>
                                        </a>
                                        <input type="file" class="" name="upload-file" id="upload-file" />
                                    </div>
                                    <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
                                    <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
                                    <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
                                </div>
                                <div class="cropped"></div>
                            </div>
                            <!---->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="worker-div ">
            <h2>信息</h2>
            <div id="registration">
                <!--表单-->
                <form action="#" method="post" class="registration-form ">
                    <div>

                    </div>
                    <div class="old-phone-box">
                        <dl>
                            <dt><span>*</span><label for="old-phone">&emsp;原手机&emsp;: </label></dt>
                            <dd><input type="text"  id="old-phone"  /></dd>
                            <dd id="old-phone-code">发送验证码</dd>
                        </dl>
                    </div>

                    <div class="old-phone-box">
                        <dl>
                            <dt><span>*</span><label for="old-phone-in">&emsp;验证码&emsp;: </label></dt>
                            <dd><input type="text"  id="old-phone-in"  /><em></em></dd>
                        </dl>
                    </div>

                    <!--同意条款，并注册-->
                    <div class="Phone-save">
                        <a href="javascript:;" id="nx-newPhone" class="agree ps ">下一步</a>
                    </div>
                </form>

                <form action="#" method="post" class="registration-form phoneForm" >
                    <div>

                    </div>
                    <div class="old-phone-box">
                        <dl>
                            <dt><span>*</span><label for="new-phone">新验证手机&emsp;: </label></dt>
                            <dd><input type="text"  id="new-phone"  /></dd>
                            <dd id="new-phone-Ncode">发送验证码</dd>
                        </dl>
                    </div>

                    <div class="old-phone-box">
                        <dl>
                            <dt><span>*</span><label for="new-phone-in">&emsp;&emsp;验证码&emsp;: </label></dt>
                            <dd><input type="text"  id="new-phone-in"  /><em></em></dd>
                        </dl>
                    </div>

                    <!--同意条款，并注册-->
                    <div class="Phone-save Phone-save-s ">
                        <a href="javascript:;" id="ps" class="agree ps">上一步</a>
                        <a href="javascript:;" id="cell-Newphone" class="agree ps ">确认</a>
                    </div>
                </form>

            </div>
        </div>

        <!--更改邮箱-->
        <div class="worker-div ">
            <h2>信息</h2>
            <div id="registration">
                <!--表单-->
                <form action="#" method="post" class="registration-form ">
                    <div>

                    </div>
                    <div class="old-phone-box old-email-box">
                        <dl>
                            <dt><span>*</span><label for="old-email">&emsp;原邮箱&emsp;: </label></dt>
                            <dd><input type="text"  id="old-email"  /></dd>
                            <dd id="old-email-code">发送验证码</dd>
                        </dl>
                    </div>

                    <div class="old-phone-box old-email-box">
                        <dl>
                            <dt><span>*</span><label for="old-email-in">&emsp;验证码&emsp;: </label></dt>
                            <dd><input type="text"  id="old-email-in"  /><em></em></dd>
                        </dl>
                    </div>

                    <!--同意条款，并注册-->
                    <div class="Phone-save">
                        <!--<a href="javascript:;" class="agree ps">上一步</a>-->
                        <a href="javascript:;" id="nx-newEmail" class="agree ps ">下一步</a>
                    </div>
                </form>
                <form action="#" method="post" class="registration-form phoneForm" >
                    <div>
                    </div>
                    <div class="old-phone-box">
                        <dl>
                            <dt><span>*</span><label for="new-email">新验证邮箱&emsp;: </label></dt>
                            <dd><input type="text"  id="new-email"  /></dd>
                            <dd id="new-email-Ncode">发送验证码</dd>
                        </dl>
                    </div>

                    <div class="old-phone-box">
                        <dl>
                            <dt><span>*</span><label for="new-email-in">&emsp;&emsp;验证码&emsp;: </label></dt>
                            <dd><input type="text"  id="new-email-in"  /><em></em></dd>
                        </dl>
                    </div>

                    <!--同意条款，并注册-->
                    <div class="Phone-save Phone-save-s ">
                        <a href="javascript:;" id="ps" class="agree ps">上一步</a>
                        <a href="javascript:;" id="cell-Newemail" class="agree ps ">确认</a>
                    </div>
                </form>

            </div>
        </div>


    </div>


    <!--修改成功-->
    <a href="javascript:;" class="successfully">
        修改成功
    </a>
</div>

<!------------------------friendlyLink------------------------------>
<div id="friendlyLink-s" style="clear: both;margin-top: 56px;"></div>

<!------------------------oblong------------------------------>
<div id="oblong-s"></div>
<!------------------------foorer------------------------------>
<div id="foorer-s"></div>
</body>
</html>
