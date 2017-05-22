var reg = {
	regUser:/^[\u4e00-\u9fa5]{2,4}$/,
	regPhone:/^1[34578]\d{9}$/
}
/*验证*/
/*投诉人姓名*/
function checkName(){
	if($("#name").val()==''){
		$("#name").siblings('em').css({'display':'inline-block'}).html('姓名不能为空!');
		return false;
	}else if(!reg.regUser.test($("#name").val())){
		$("#name").siblings('em').css({'display':"inline-block"}).html('中文，4-20位字符');
		return false;
	}else{
		$("#name").siblings('em').css("display",'none');
		return true;
	}
}
//投诉对象
function checkObj(){
	if($('#num').val()==''){
		$('#num').siblings('em').css({'display':'inline-block'}).html('不能为空!')
		return false;
	}else{
		$('#num').siblings('em').css("display",'none');
		return true;
	}
}
/*投诉人电话*/
function checkPhone(){
	if($("#phone1").val()==''){
		$("#phone1").siblings('em').css({'display':'inline-block'}).html('号码不能为空!');
		return false;
	}else if(!reg.regPhone.test($("#phone1").val())){
		$("#phone1").siblings('em').css({'display':"inline-block"}).html('格式不正确！');
		return false;
	}else{
		$("#phone1").siblings('em').css("display",'none');
		return true;
	}
}
//投诉内容
function checkContent(){
	if($('#add').val()==''){$('#add').siblings('em').css({'display':'inline-block'}).html('不能为空!')
		return false;
	}else{
		$('#add').siblings('em').css("display",'none');
		return true;
	}
}
//鉴定报告编码
function checkReportNum(){
	if($('#num').val()==''){
		$('#num').siblings('em').css({'display':'inline-block'}).html('不能为空!');
		return false;
	}else{
		var reportNum = $('#num').val();
		$.ajax({
			url: "/user/queryappraisereportbyreportnumandapplicant",
			dataType: 'json',
			type: 'post',
			headers: {
				'X-CSRF-TOKEN':  $('meta[name="_token"]').attr('content'),
			},
			data: {
				reportNum: reportNum,
			},
			success: function (data) {
				if(data.status){
					$("#fwname").val(data.msg.house_name);
					$("#qy").val(data.msg.district);
					$("#jddw").val(data.msg.appraise_unit);
					$("#jddwPhone").val(data.msg.phone);

				}else{
					$('#num').siblings('em').css({'display':'inline-block'}).html('鉴定编号错误!')
					$('#num').focus();
				}
			}
		});
		$('#num').siblings('em').css("display",'none');
		return true;
	}
}
//鉴定理由
function checkReason(){
	if($('#add').val()==''){
		$('#add').siblings('em').css({'display':'inline-block'}).html('不能为空!')
		return false;
	}else{
		$('#add').siblings('em').css("display",'none');
		return true;
	}
}
$(function(){
	/*加载公共的hotline*/
//	$("#commot-hot").load('public/assets/html/commot-top.html #hotline')
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
