/*验证*/
/*单击下一步验证不能为空*/
var reg = {
	regPhone:/^1[34578]\d{9}$/,
	regEmail:/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/
};
function checkPassword(){
	var passlength =  $('#newPassword').val().length
	var pass = $('#newPassword').val()
	/*新密码为空时*/
	if($('#newPassword').val()==''){
		$('#newPassword').siblings('em').css({'display':'block'}).html('请填写新密码！');
		return false;
	}else if(passlength<6||passlength>20){
		$('#newPassword').siblings('em').css({'display':'block'}).html('密码长度必须是6-20位之间！');
		return false;
	}
	else if(!(/\d+/.test(pass)&&/[a-zA-Z_]+/.test(pass)&&/\W+/.test(pass))){
		$('#newPassword').siblings('em').css({'display':'block'}).html('由字母和数字，特殊字符组成！');
		return false;
	}else{
		$('#newPassword').siblings('em').css({'display':'none'})
		return true;
	}

}
function confirmPassword(){
	/*确认新密码为空时*/
	if($('#confirmPassword').val()==''){
		$('#confirmPassword').parent('span').width('534')
		$('#confirmPassword').siblings('em').css({
			'display':'block',
			'background-image':'none',
			'color':'red',
			'width':'160px'
		}).html('请确认新密码！');
		return false;
	}else if($('#confirmPassword').val()!=$('#newPassword').val()){
		$('#confirmPassword').parent('span').width('534')
		$('#confirmPassword').siblings('em').css({
			'display':'block',
			'background-image':'none',
			'color':'red',
			'width':'160px'
		}).html('两次输入不一致！');
		return false;
	}else{
		$('#confirmPassword').siblings('em').css({
			'display':'block',
			'background-image':'url(/public/assets/img/reg_icons.png)',
			'color':'#fff',
			'background-position':'-80px 10px',
			'background-repeat':'no-repeat',
			'width':'48px',
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
	
	/*鼠标移上li p显示 nav-cont 是load加载过来的，采用事件委托*/
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
	/*input select 获取焦点边框颜色消失*/
	$('.signIn-tab1 input').focus(function(){
		$(this).css('outline','none')
	})
	//定义新密码失去焦点
	$('#newPassword').blur(function (){
		checkPassword()
	})
	//定义确认新密码失去焦点
	$('#confirmPassword').blur(function (){
		confirmPassword()
	})
})