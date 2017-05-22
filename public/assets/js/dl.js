function checkUserName(){
	if($('#user').val()==''){
		$('#user').siblings('em').css({'display':'block'}).html('用户名不能为空!');
		return false;
	}else{
		$('#user').siblings('em').css({'display':"none"});
		return true;
	}
}
function checkUserPassword(){
	if($('#passw').val()==''){
		$('#passw').siblings('em').css({'display':'block'}).html('密码不能为空!');
		return false;
	}else{
		$('#passw').siblings('em').css("display",'none');
		return true;
	}
}
function checkUnitName(){
	if($('#unitname').val()==''){
		$('#unitname').siblings('em').css({'display':'block'}).html('单位名不能为空!');
		return false;
	}else{
		$('#unitname').siblings('em').css({'display':"none"});
		return true;
	}
}
function checkUnitPassword(){
	if($('#unitpassw').val()==''){
		$('#unitpassw').siblings('em').css({'display':'block'}).html('密码不能为空!');
		return false;
	}else{
		$('#unitpassw').siblings('em').css("display",'none');
		return true;
	}
}
$(function(){
	//根据用户登录次数，判断是否显示验证码
	if(parseInt(userLoginNum)>1){
		getUserCode();
		$('#userCodeShow').css({'display':'inline-block'});
	}
	//根据鉴定单位登录次数，判断是否显示验证码
	if(parseInt(unitLoginNum)>1){
		getUnitCode();
		$('#unitCodeShow').css({'display':'inline-block'});
	}
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
		$('.nav-cont li').eq($(this).index()).find("p").slideDown()
		$('.signIn-form').css({'z-index':-5})
	})
	$('body').on('mouseleave','.nav-cont li',function(){
//		console.log($('.nav-cont li').length)
		$('.nav-cont li').eq($(this).index()).find("p").slideUp()
		$('.signIn-form').css({'z-index':9})

	})

	/*用户切换改变背景*/
	$('.dl-radio').click(function(){
		$(this).addClass('dl-radio1').siblings().removeClass('dl-radio1')
		$('.signIn-form div').eq($(this).index()).addClass('signIn-tab1').siblings().removeClass()
	})
	/*input select 获取焦点边框颜色消失*/
	$('.signIn-tab1 input').focus(function(){
		$(this).css('outline','none')
	})

})