/*验证*/
var reg = {
	regUser:/^[\u4e00-\u9fa5]{2,4}$/,
	regPhone:/^1[34578]\d{9}$/,
	reguNum:/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/,
	regNum:/^[\d]{11}$/,
	regNum1:/^[0-9]*$/,/*纯数字*/
	regStr:/^[A-Za-z]+$/,/*验证由26个英文字母组成的字符串*/
}
function checkApplicantName(){
	if($("#name").val()==''){
		$("#name").siblings('em').css({'display':'inline-block'}).html('姓名不能为空!');
		return false;
	}else if(!reg.regUser.test($("#name").val())){
		$("#name").siblings('em').css({'display':"inline-block"}).html('中文，2-4位字符');
		return false;
	}else{
		$("#name").siblings('em').css("display",'none');
	}
	return true;
}
function checkApplicantTelNumber(){
	if($("#phone1").val()==''){
		$("#phone1").siblings('em').css({'display':'inline-block'}).html('号码不能为空!');
		return false;
	}else if(!reg.regPhone.test($("#phone1").val())){
		$("#phone1").siblings('em').css({'display':"inline-block"}).html('格式不正确！');
		return false;
	}else{
		$("#phone1").siblings('em').css("display",'none');
	}
	return true;
}
function checkIdcardNumber(){
	if($("#num").val()==''){
		$("#num").siblings('em').css({'display':'inline-block'}).html('不能为空!');
		return false;
	}else if(!reg.reguNum.test($("#num").val())){
		$("#num").siblings('em').css({'display':"inline-block"}).html('格式不正确！');
		return false;
	}else{
		$("#num").siblings('em').css("display",'none');
	}
	return true;
}
//房产证编号
function checkHouseCertificate(){
	if($("#add").val()==''){
		$("#add").siblings('em').css({'display':'inline-block'}).html('不能为空!');
		return false;
	}else if(reg.regNum1.test($("#add").val())){
		$("#add").siblings('em').css({'display':"inline-block"}).html('不能全是数字！');
		return false;
	}else{
		$("#add").siblings('em').css("display",'none');
	}
	return true;
}
//房屋地址
function checkHouseAddress(){
	if($("#fwdz").val()==''){
		$("#fwdz").siblings('em').css({'display':'inline-block'}).html('不能为空!')
		return false;
	}else if(reg.regStr.test($("#fwdz").val())){
		$("#fwdz").siblings('em').css({'display':"inline-block"}).html('不能全是英文字母！')
		return false;
	}else if(reg.regNum1.test($("#fwdz").val())){
		$("#fwdz").siblings('em').css({'display':"inline-block"}).html('不能全是数字！');
		return false;
	}else{
		$("#fwdz").siblings('em').css("display",'none');
		return true;
	}
}
/*通讯地址*/
function checkCommunicationAddress(){
	if($("#txdz").val()==''){
		$("#txdz").siblings('em').css({'display':'inline-block'}).html('不能为空!')
		return false;
	}else if(reg.regStr.test($("#txdz").val())){
		$("#txdz").siblings('em').css({'display':"inline-block"}).html('不能全是英文字母！')
		return false;
	}else if(reg.regNum1.test($("#txdz").val())){
		$("#txdz").siblings('em').css({'display':"inline-block"}).html('不能全是数字！');
		return false;
	}else{
		$("#txdz").siblings('em').css("display",'none');
		return true;
	}
}
function checkReason(){
	if($("#jdly").val()==''){
		$("#jdly").siblings('em').css({'display':'inline-block'}).html('不能为空!')
		return false;
	}else if(reg.regStr.test($("#jdly").val())){
		$("#jdly").siblings('em').css({'display':"inline-block"}).html('不能全是英文字母！')
		return false;
	}else if(reg.regNum1.test($("#jdly").val())){
		$("#jdly").siblings('em').css({'display':"inline-block"}).html('不能全是数字！');
		return false;
	}else{
		$("#jdly").siblings('em').css("display",'none');
		return true;
	}
}
function checkAppraiseUnit(){
	if($("#jddw").val()=='请选择鉴定单位'){
		$("#jddw").siblings('em').css({'display':'inline-block'}).html('请选择鉴定单位!');
		return false;
	}else{
		$("#jddw").siblings('em').css("display",'none');
		return true;
	}
}
function checkConstruction(){
	if($("#qjj").val()=='请选择区建局'){
		$("#qjj").siblings('em').css({'display':'inline-block'}).html('请选择区建局!');
		return false;
	}else{
		$("#qjj").siblings('em').css("display",'none');
		return true;
	}
}
$(function(){
	/*加载公共的hotline*/
//	$("#commot-hot").load('/public/assets/html/commot-top.html #hotline')
	/*加载公共的logo*/
	$("#commot-logo").load('/public/assets/html/commot-top.html #logo')
	/*加载公共的nav*/
	$("#commot-nav").load('/public/assets/html/commot-top.html #usernav')
	/*加载公共友情链接*/
	$("#friendlyLink-s").load('/public/assets/html/commot-bott.html #friendlyLink')
	/*加载公共底部*/
	$("#oblong-s").load('/public/assets/html/commot-bott.html #oblong')
	$("#foorer-s").load('/public/assets/html/commot-bott.html #foorer')
	/*鼠标移上li p显示 nav-cont 是load加载过来的，采用时间委托*/
	$('body').on('mouseenter','.nav-cont li',function(){
//		console.log($('.nav-cont li').length)
		$('.nav-cont li').eq($(this).index()).find("p").stop(true,true).slideDown()
		$('.appraisal').css({'z-index':-5})
		$('.nav-cont li').eq($(this).index()).find("p").width($(this).width())

	})
	$('body').on('mouseleave','.nav-cont li',function(){
//		console.log($('.nav-cont li').length)
		$('.nav-cont li').eq($(this).index()).find("p").stop(true,true).slideUp()
		$('.appraisal').css({'z-index':9})

	})

})
function success(){
	$('.successfully').fadeIn(1000,function(){
		$(this).fadeOut(2000,function(){
			$(this).css({"display":"none"});
		})
	});
	/*$("input").val('');
	$('#submit').css({'display':'block'});
	$('#edit').css({'display':'none'});*/
}
function failed(){
	$("#modifyResult").html('未改变内容，请重试！');
	$('.successfully').fadeIn(2000,function(){
		$('.successfully').fadeOut(2000)
	});

}