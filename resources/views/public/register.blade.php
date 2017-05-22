<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>用户注册</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/yhzc.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/yhzc.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<!------------------------hotline------------------------------>
<!--<div id="commot-hot"></div>-->
<div id="hotline">
    <div class="hotline">
        <p class="phone">咨询热线：0731-88888888</p>
        <p class="login">
            <a href="/index/login" class="login-btn">登录</a>
            <a href="/index/register"  class="register-btn">注册</a>
        </p>
    </div>
</div>
<!------------------------logo------------------------------>
<div id="commot-logo"></div>
<!------------------------nav------------------------------>
<div id="commot-nav"></div>
<!--registration-->
<div id="registration">
    <div class="registration">
        <h2>用户注册</h2>
        <div class="registration-cent">
            <div class="registration-c-left">
                <p >
							<span >
							</span>
                </p>
                <!--表单-->
                <form action="{{url('index/register')}}" method="post" class="registration-form">
                    <div>
                        <dl>
                            <dt><span>*</span><label for="user">用户名: </label></dt>
                            <dd><input type="text"  id="user"  name="username" onblur="checkUserName();" onkeyup="deleteBlank(this);"/><em></em></dd>
                        </dl>
                    </div>
                    <div>
                        <dl>
                            <dt><span>*</span><label for="passw">请设置密码: </label></dt>
                            <dd><input type="password"  id="passw"  onblur="checkPassw()" onkeyup="deleteBlank(this);"/><em></em></dd>
                        </dl>
                    </div>
                    <div>
                        <dl>
                            <dt><span>*</span><label for="passw1">请确认密码: </label></dt>
                            <dd><input type="password"  id="passw1"  name="password" onblur="checkPassw1();" onkeyup="deleteBlank(this);"/><em></em></dd>
                        </dl>
                    </div>
                    <div>
                        <dl>
                            <dt><span>*</span><label for="phone">手机号码: </label></dt>
                            <dd><input type="tel"  id="phone"  name="telnumber" onblur="checkTelNum();" onkeyup="deleteBlank(this);"/><em></em></dd>
                        </dl>
                    </div>
                    <div>
                        <dl style="width: 626px;">
                            <dt><span>*</span><label for="yzm">手机验证码: </label></dt>
                            <dd style="width: 529px"><input style="float: left" type="text"  id="yzm"  onblur="checkTelCode()" onkeyup="deleteBlank(this);"/><a  style="float: left" href="javascript:;">获取手机验证码</a><em  style="float: left"></em></dd>
                        </dl>
                    </div>
                    <!--同意条款，并注册-->
                    <div>
                        <a href="javascript:;" onclick="submit();">同意条款，并注册</a>
                    </div>
                    <input name="__method" type="hidden" value="POST">
                    {{csrf_field()}}
                </form>
                <!--注册条款-->
                <div class="clause">
                    <div class="clause-cen">
                        <h2>注册条款</h2>
                        <div>
                            <p>1.长沙房屋安全及装饰装修网服务条款</p>
                            <p>长沙房屋安全及装饰装修网立足于商务，为客户提供全方位的服务。长沙房屋安全及装饰装修网的各项电子服务的所有权和运作权归长沙朗文网络有限公司.长沙房屋安全及装饰装修网提供的服务将按照其发布的章程、服务条款和操作规则严格执行。会员若完全同意所有服务条款，并完成注册程序，即可成为长沙家居网的正式会员。
                            </p>
                            <p>2.服务条件  基于长沙房屋安全及装饰装修网提供的网络服务的商业性和实效性：</p>
                            <p>(1)用户对其发布的信息负责，应提供详尽、真实、准确的企业资料，不得发布不真实的，有歧义的信息绝对禁止发布误导性的、恶意的消息。
                            </p>
                            <p>(2)随时更新注册资料，已符合及时、详尽、准确的要求。</p>
                            <p>(3)长沙房屋安全及装饰装修网向会员提供的会员帐号及密码只供会员使用。如果会员将帐号或密码丢失或被盗，应及时重新登记并重新设置密码。会员造成的帐号失密，应自行承担责任。
                            </p>
                            <p>3.</p>
                            <p>4.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="registration-c-right">
                <p>已有帐号，立即登录</p>
                <p>
                    <a href="/index/login">登录</a>
                </p>
                <p>您还可以用其他方式直接登录：</p>
                <p>
                    <a href="javascript:;" class="dl-qq">QQ登录</a>
                    <a href="javascript:;" class="dl-weix">微信登录</a>
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


