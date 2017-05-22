/*单击下一步验证不能为空*/
var reg = {
	regPhone:/^1[34578]\d{9}$/,
	regEmail:/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/,
	regCode:/^\d{4}$/
};
function checkUserName(){
	/*手机号为空时*/
	if($('#user').val()==''){
		$('#user').siblings('em').css({'display':'block'}).html('请填写手机号！');
		return false;
	}else if(!reg.regPhone.test($('#user').val())){
		$('#user').siblings('em').css({'display':'block'}).html('手机号格式不对！');
		return false;
	}else{
		$('#user').siblings('em').css({'display':'none'})
		return true;
	}
}
function checkCode(){
	/*验证码为空时*/
	if($('#yzm').val()==''){
		$('#yzm').siblings('em').css({'display':'block'}).html('验证码不能为空!');
		return false;
	}else if(!reg.regPhone.test($('#yzm').val())){
		$('#yzm').siblings('em').css({
			'display':'block',
			'background-image':'url("/public/assets/img/reg_icons.png")',
			'color':'#fff',
			'background-position':'-80px -15px',
			'background-repeat':'no-repeat',
			'width':'32px',
			'height':'32px'
		}).html('')
		return false;
	}else{
		$('#yzm').siblings('em').css({
			'display':'block',
			'background-image':'url("/public/assets/img/reg_icons.png")',
			'color':'#fff',
			'background-position':'-80px 10px',
			'background-repeat':'no-repeat',
			'width':'32px',
			'height':'32px'
		}).html('')
		return true;
	}
}
/*单击下一步*/
$('.next-step').click(function success(){
	if(checkUserName()&&checkCode()){
		alert('提交');
	}
	if(checkEmail()&&checkCode()){
		alert('提交');
	}
})
function checkEmail(){
	/*邮箱为空时*/
	if($('#email-1').val()==''){
		$('#email-1').siblings('em').css({'display':'block'}).html('请填写邮箱号！');
		return false;
	}else if(!reg.regEmail.test($('#email-1').val())){
		$('#email-1').siblings('em').css({'display':'block'}).html('邮箱格式不对！');
		return false;
	}else{
		$('#email-1').siblings('em').css({'display':'none'})
		return true;
	}
}
/*验证邮箱验证码*/
function checkCodeE(){
	/*验证码为空时*/
	if($('#yzm-e').val()==''){
		$('#yzm-e').siblings('em').css({'display':'block'}).html('验证码不能为空!');
		return false;
	}else if(!reg.regCode.test($('#yzm-e').val())){
		$('#yzm-e').siblings('em').css({
			'display':'block',
			'background-image':'url("/public/assets/img/reg_icons.png")',
			'color':'#fff',
			'background-position':'-80px -15px',
			'background-repeat':'no-repeat',
			'width':'32px',
			'height':'32px'
		}).html('')
		return false;
	}else{
		$('#yzm-e').siblings('em').css({
			'display':'block',
			'background-image':'url("/public/assets/img/reg_icons.png")',
			'color':'#fff',
			'background-position':'-80px 10px',
			'background-repeat':'no-repeat',
			'width':'32px',
			'height':'32px'
		}).html('')
		return true;
	}
}
$(function(){
	/*加载公共的hotline*/
//	$("#commot-hot").load('html/commot-top.html #hotline')
	/*加载公共的logo*/
	$("#commot-logo").load('/public/assets/html/commot-top.html #logo')
	/*加载公共的nav*/
	$("#commot-nav").load('/public/assets/html/commot-top.html #nav')
	/*加载公共友情链接*/
	$("#friendlyLink-s").load('/public/assets/html/commot-bott.html #friendlyLink')
	/*加载公共底部*/
	$("#oblong-s").load('/public/assets/html/commot-bott.html #oblong')
	$("#foorer-s").load('/public/assets/html/commot-bott.html #foorer')
	
	/*鼠标移上li p显示 nav-cont 是load加载过来的，采用时间委托*/
	$('body').on('mouseenter','.nav-cont li',function(){
//		console.log($('.nav-cont li').length)
		$('.nav-cont li').eq($(this).index()).find("p").stop(true,true).slideDown()
		$('.signIn-form').css({'z-index':-5})
		$('.nav-cont li').eq($(this).index()).find("p").width($(this).width())
		
	})
	$('body').on('mouseleave','.nav-cont li',function(){
//		console.log($('.nav-cont li').length)
		$('.nav-cont li').eq($(this).index()).find("p").stop(true,true).slideUp()
		$('.signIn-form').css({'z-index':9})
		
	})
	/*注册后直接显示用户名密码*/
	$('#user').val(window.localStorage.getItem('name'))
//	$('#passw').val(window.localStorage.getItem('pass'))
	/*输入的值和储存的值比较*/
	/*input select 获取焦点边框颜色消失*/
	$('.signIn-tab1 input').focus(function(){
		$(this).css('outline','none')
	})
	/*切换找回方式*/
	$('.dl-radio').click(function(){
		$(this).addClass('dl-radio1').siblings().removeClass('dl-radio1')
		$('.signIn-form div').eq($(this).index()).addClass('signIn-tab1').siblings().removeClass()
	})
	
	/*验证*/

	//定义手机号失去焦点
	$('#user').blur(function (){
		checkUserName()
	})
	//定义手机验证码失去焦点
	$('#yzm').blur(function (){
		checkCode()
	})
	//定义邮箱失去焦点
	$('#email-1').blur(function (){
		checkEmail()
	})
	//定义邮箱验证码失去焦点
	$('#yzm-e').blur(function (){
		checkCodeE()
	})
	/*发送验证码*/
//	console.log($('.yzm-click').text()) 
	$('.btn-fs').click(function(){
		var count="59";
		var timer = setInterval(function(){
			$(".btn-fs").val("重新发送(" + count + ")");
			count--;
			$(".btn-fs").attr("disabled", true);
			if(count=='0'){
				clearInterval(timer);
				$(".btn-fs").val("发送验证码");
				$(".btn-fs").attr("disabled", false);
			}
		},"1000");
	})
})