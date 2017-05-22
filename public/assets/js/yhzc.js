var reg = {
	regUser:/^[\u4e00-\u9fa5]{2,10}$/,
	reguPwd:/^\w{6,12}$/,
	regPhone:/^1[34578]\d{9}$/
};
function checkUserName(){
	if($("#user").val()==''){
		$("#user").siblings('em').css({'display':'block'}).html('用户名不能为空!');
		return false;
	}else if(!reg.regUser.test($("#user").val())){
		$("#user").siblings('em').css({'display':"block"}).html('使用中文名称,2-10位');
		return false;
	}else{
		$("#user").siblings('em').css("display",'none');
	}
	return true;
	/*
	查询用户名是否重名
	由于查询是否重名需要时间，不能及时返回查询的信息，导致错误
	$.ajax({
		url: "checkusernamerepeat",
		dataType:'json',
		type:'post',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
		},
		data:{
			username:$("#user").val()
		},
		success:function(data){
			if(data){
				$("#user").siblings('em').css({'display':"block"	}).html('用户名重复');
				$("#user").focus();
			}else {
				$("#user").siblings('em').css("display",'none').html('');
			};
			return(!data);
		}
	});*/
}
function checkPassw(){
	if($("#passw").val()==''){
		$("#passw").siblings('em').css({'display':'block'}).html('密码不能为空!');
		return false;
	}else if(!reg.reguPwd.test($("#passw").val())){
		$("#passw").siblings('em').css({'display':"block"}).html('密码,6-12位');
		return false;
	}else{
		$("#passw").siblings('em').css("display",'none');
	}
	if($("#passw1").val()!=''){
		if($("#passw1").val()!=$('#passw').val()) {
			$("#passw1").siblings('em').css({'display': "block"}).html('两次输入不一致');
		}else{
			$("#passw1").siblings('em').css("display",'none');
		}
	}
	return true;

}
function checkPassw1(){
	if($("#passw1").val()==''){
		$("#passw1").siblings('em').css({'display':'block'}).html('密码不能为空!');
		return false;
	}else if($("#passw1").val()!=$('#passw').val()){
		$("#passw1").siblings('em').css({'display':"block"}).html('两次输入不一致');
		return false;
	}else{
		$("#passw1").siblings('em').css("display",'none');
	}
	return true;

}
function checkTelNum(){
	if($("#phone").val()==''){
		$("#phone").siblings('em').css({'display':'block'}).html('手机号不能为空!');
		return false;
	}else if(!reg.regPhone.test($("#phone").val())){
		$("#phone").siblings('em').css({'display':"block"}).html('手机号不正确，请重新填写');
		return false;
	}else{
		$("#phone").siblings('em').css("display",'none');
	}
	return true;
}
function checkTelCode(){
	if($("#yzm").val()==''){
		$("#yzm").siblings('em').css({'display':'block'}).html('验证码不能为空!');
		return false;
	}else{
		$("#yzm").siblings('em').css("display",'none');
	}
	return true;
}
function deleteBlank(obj){
	obj.value = obj.value.replace(".","").replace(" ","");
}
function submit(){
	if(checkUserName()&&checkPassw()&&checkPassw1()&&checkTelNum()&&checkTelCode()){
		$.ajax({
			url:"/index/register",
			dataType:'json',
			type:'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
			},
			data:{
				userName:$("#user").val(),
				password:$("#passw").val()
			},
			success:function(data){
				if(data){
					window.location.href='/';
				}else {
					alert('注册失败');
				}
			}
		});
	}
}
$(function(){
	/*加载公共的hotline*/
//	$("#commot-hot").load('/public/assets/html/commot-top.html #hotline')
	/*加载公共的logo*/
	$("#commot-logo").load('/public/assets/html/commot-top.html #logo')
	/*加载公共的nav*/
	$("#commot-nav").load('/public/assets/html/commot-top.html #nav')
	/*加载公共友情链接*/
	$("#friendlyLink-s").load('/public/assets/html/commot-bott.html #friendlyLink')
	/*加载公共底部*/
	$("#oblong-s").load('/public/assets/html/commot-bott.html #oblong')
	$("#foorer-s").load('/public/assets/html/commot-bott.html #foorer')
});