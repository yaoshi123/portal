$(function(){
	/*加载公共的hotline*/
//	$("#commot-hot").load('html/commot-top.html #hotline')
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
		$('.worker-div').css({'z-index':-5})
		$('.nav-cont li').eq($(this).index()).find("p").width($(this).width())
	})
	$('body').on('mouseleave','.nav-cont li',function(){
//		console.log($('.nav-cont li').length)
		$('.nav-cont li').eq($(this).index()).find("p").stop(true,true).slideUp()
		$('.worker-div').css({'z-index':111})
	})
	
	/*选项卡*/
	$('#worker ul li').click(function(){
		/*console.log($(this).children('a').end().find('a').length);*/
		/*改变背景*/
		$(this).css({"background": "#0da388"}).siblings().css({"background": "#f5f5f5"})
		/*改变a的颜色*/
		$(this).children('a').css({"color": "#fff"}).end().siblings().children('a').css({"color": "#000"})
		/*切换div*/
		$('.worker .worker-div').eq($(this).index()).addClass('profile').siblings().removeClass('profile');
		
	})
	/*显示登陆的用户名*/
	$('#user').val(window.localStorage.getItem('name'))
	$("#user").attr("disabled","disabled")
	/*显示身份证*/
	$('#passw1').val(window.localStorage.getItem('sfz'))
	$("#passw1").attr("disabled","disabled")
	/*显示地址*/
	$('#yzm').val(window.localStorage.getItem('txdz'))
	$("#yzm").attr("disabled","disabled")
/*单击"修改"移除 disabled 属性*/
	$('.registration-form em').click(function(){
		$(this).siblings("input").attr("disabled",false).focus();
		$('em').css({'display':'none'});
		//保存需要修改的信息，提交的时候判断是否修改，如果没有修改，那么提示，并且不能提交。
		window.sessionStorage.setItem('changeinfo',$(this).siblings("input").val());
	})
	/*验证*/
	/*单击下一步验证不能为空*/
	var reg = {
		regUser:/^[\u4e00-\u9fa5]{2,4}$/,
		regPhone:/^1[34578]\d{9}$/,
		regEmail:/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/,
		regNum1:/^[0-9]*$/,/*纯数字*/
		regStr:/^[A-Za-z]+$/,/*验证由26个英文字母组成的字符串*/
		reguNum:/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/,
	};
	function checkUserName(){
		/*用户名为空*/
		if($('#user').val()==''){
			$('#user').siblings('em').css({'display':'block'}).html('请填写用户名！');
			return false;
		}else if(!reg.regUser.test($('#user').val())){
			$('#user').siblings('em').css({'display':'block'}).html('2-4位中文！');
			return false;
		}else{
			/*$('#user').siblings('em').css({'display':'none'}).siblings('input').attr("disabled",true)*/
			return true;
		}
	}
	function checkIdcard(){
		if($('#passw1').val()==''){
			$('#passw1').siblings('em').css({'display':'block'}).html('请填写身份证号！');
			return false;
		}else if(!reg.reguNum.test($("#passw1").val())){
			$("#passw1").siblings('em').css({'display':"block"}).html('格式不正确！');
			return false;
		}else{
			return true;
		}
	}
	function checkAdd(){
		if($('#yzm').val()==''){
			$('#yzm').siblings('em').css({'display':'block'}).html('请填写地址！');
			return false;
		}else if(reg.regNum1.test($('#yzm').val())){
			$('#yzm').siblings('em').css({'display':'block'}).html('不能全是数字！');
			return false;
		}else if(reg.regStr.test($('#yzm').val())){
			$('#yzm').siblings('em').css({'display':'block'}).html('不能全是字母！');
			return false;
		}else{
			/*$('#yzm').siblings('em').css({'display':'none'}).siblings('input').attr("disabled",true)*/
			return true;
		}
	}
	/*单击"保存"*/
	$('#conserve').click(
		function success(){
			//判断用户名是否已经更改，如果checkUsername是disabled，那么没有更改，否则更改
			var checkUsername = $('#user').attr("disabled")!='disabled'?checkUserName():false;
			//判断身份证号是否已经更改，如果checkIdcard是disabled，那么没有更改，否则更改
			var checkIdcardStatus = $('#passw1').attr("disabled")!='disabled'?checkIdcard():false;
			//判断联系地址是否已经更改，如果checkIdcard是disabled，那么没有更改，否则更改
			var checkAddr = $('#yzm').attr("disabled")!='disabled'?checkAdd():false;
			//如果修改了用户名
			if(checkUsername){
				if(window.sessionStorage.getItem("changeinfo")==$('#user').val()){
					$('.successfully').html('请修改用户名后提交')
						.css({'background':'#000'})
						.fadeIn(1000,function(){
							$('.successfully').fadeOut(1000);

						})
				}else{
					$.ajax({
						url: "/user/updateusername",
						dataType: 'json',
						type: 'post',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
						},
						data: {
							userName:$('#user').val()
						},
						success: function (data) {
							if(data.status){
								$('.successfully').html(data.msg)
									.css({'background':'#000'})
									.fadeIn(1000,function(){
										$('.successfully').fadeOut(1000);

								})
								$("#user").attr("disabled","disabled");
								$('em').css({'display':'block'});
							}else{
								$('.successfully').html(data.msg)
									.css({'background':'#000'})
									.fadeIn(1000,function(){
										$('.successfully').fadeOut(1000);
								})
							}
						}
					});
				}
			}
			//如果修改了身份证号
			if(checkIdcardStatus){
				if(window.sessionStorage.getItem("changeinfo")==$('#passw1').val()){
					$('.successfully').html('请修改身份证号后提交')
						.css({'background':'#000'})
						.fadeIn(1000,function(){
							$('.successfully').fadeOut(1000);

						})
				}else {
					$.ajax({
						url: "/user/updateuseridcard",
						dataType: 'json',
						type: 'post',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
						},
						data: {
							idcardNum: $('#passw1').val()
						},
						success: function (data) {
							if (data.status) {
								$("#passw1").attr("disabled", "disabled");
								$('em').css({'display': 'block'});
								$('.successfully').html(data.msg)
									.css({'background': '#000'})
									.fadeIn(1000, function () {
										$('.successfully').fadeOut(1000);

									})
							} else {
								$('.successfully').html(data.msg)
									.css({'background': '#000'})
									.fadeIn(1000, function () {
										$('.successfully').fadeOut(1000);

									})
							}
						}
					});
				}
			}
			//如果修改了联系地址
			if(checkAddr){
				if(window.sessionStorage.getItem("changeinfo")==$('#yzm').val()){
					$('.successfully').html('请修改联系地址后提交')
						.css({'background':'#000'})
						.fadeIn(1000,function(){
							$('.successfully').fadeOut(1000);

						})
				}else {
					$.ajax({
						url: "/user/updateusercontactaddress",
						dataType: 'json',
						type: 'post',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
						},
						data: {
							contactAddress: $('#yzm').val()
						},
						success: function (data) {
							if (data.status) {
								$("#yzm").attr("disabled", "disabled");
								$('em').css({'display': 'block'});
								$('.successfully').html(data.msg)
									.css({'background': '#000'})
									.fadeIn(1000, function () {
										$('.successfully').fadeOut(1000);
									})
							} else {
								$('.successfully').html(data.msg)
									.css({'background': '#000'})
									.fadeIn(1000, function () {
										$('.successfully').fadeOut(1000);
									})
							}
						}
					});
				}
			}
		}
	)
	/*用户名失去焦点*/
	$('#user').blur(function(){
		checkUserName()
	})
	/*用身份证号失去焦点*/
	$('#passw1').blur(function(){
		checkIdcard();
	})
	/*地址失去焦点*/
	$('#yzm').blur(function(){
		checkAdd()
	})
	/*更换头像*/
	/*container出现*/
	$('#OpenImg').click(function(){
		$('.container').fadeIn(1000)
	})
	var options =
	{
		thumbBox: '.thumbBox',
		spinner: '.spinner',
		imgSrc: '/public/assets/img/avatar.png'
	}
	var cropper = $('.imageBox').cropbox(options);
	$('#upload-file').on('change', function(){
		var reader = new FileReader();
		reader.onload = function(e) {
			options.imgSrc = e.target.result;
			cropper = $('.imageBox').cropbox(options);
		}
		reader.readAsDataURL(this.files[0]);
		this.files = [];
	})
	$('#btnCrop').on('click', function(){
		var img = cropper.getDataURL();
		$('.cropped').html('');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:64px;margin-top:4px;border-radius:64px;box-shadow:0px 0px 12px #7E7E7E;" ><p>64px*64px</p>');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:128px;margin-top:4px;border-radius:128px;box-shadow:0px 0px 12px #7E7E7E;"><p>128px*128px</p>');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>');
	})
	$('#btnZoomIn').on('click', function(){
		cropper.zoomIn();
	})
	$('#btnZoomOut').on('click', function(){
		cropper.zoomOut();
	})
	
	$('.cropped').on('click', function(){
		$('.cropped img').each(function(index){
			$('.container').css({'display':'none'})
			$('.image-display').prop('src', options.imgSrc)
			
		})
	})
	/*显示注册的手机号*/
	$('#old-phone').val(window.localStorage.getItem('phone'))
	/*old-phone-code*/
	$('#old-phone-code').click(function(){
		var count="59";
		var timer = setInterval(function(){

			$("#old-phone-code").html("重新发送(" + count + ")");
			count--;
			$("#old-phone-code").attr("disabled", true);
			if(count=='0'){
				clearInterval(timer);
				$("#old-phone-code").html("发送验证码");
				$("#old-phone-code").attr("disabled", false);
			}
		},"1000");
	})
	/*new-phone-Ncode*/
	$('#new-phone-Ncode').click(function(){
		var count="59";
		var timer = setInterval(function(){

			$("#new-phone-Ncode").html("重新发送(" + count + ")");
			count--;
			$("#new-phone-Ncode").attr("disabled", true);
			if(count=='0'){
				clearInterval(timer);
				$("#new-phone-Ncode").html("发送验证码");
				$("#new-phone-Ncode").attr("disabled", false);
			}
		},"1000");
	})
	/*验证老手机验证码*/
	function checkCode(){
		if($('#old-phone-in').val()==''){
			$('.successfully').html("请填写验证码！")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000);
			})
			return false;
		}else{
			$('#old-phone-in').parents("form").addClass('phoneForm').siblings("form").removeClass('phoneForm')
		}
	}
	/*验证新手机不能为空*/
	function checkNewNum(){
		if($('#new-phone').val()==''){
			$('.successfully').html("请填写新手机号！")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000);
			})
			return false;
		}else if(!reg.regPhone.test($('#new-phone').val())){
			$('.successfully').html("新手机号格式好像错了！")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000);
			})
			return false;
		}else{
			$('.successfully').html("还差一步！").css({'background':'#fff'});
			return true;
		}
	}
	/*验证新手机的验证码*/
	function checkNewNumCode(){
		if($('#new-phone-in').val()==''){
			$('.successfully').html("请填新手机上的验证码！")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000);
			})
			return false;
		}else{
			$('.successfully').html("填写验证码！").css({'background':'#fff'});
			return true;
			
		}
	}
	$('#nx-newPhone').click(function(){
		checkCode()
	})
	$('#ps').click(function(){
		$(this).parents("form").addClass('phoneForm').siblings("form").removeClass('phoneForm')
	})
	/*输入新手机页面*/
	$('#cell-Newphone').click(function(){
		//console.log("111");
		if(checkNewNum() && checkNewNumCode()){
			alert('提交');
		}
	})
	/*老手机验证码失去焦点*/
	$("#old-phone-in").blur(function(){
		checkCode()
	})
	/*新手机号码失去焦点*/
	$("#new-phone").blur(function(){
		checkNewNum()
	})
	/*新手机验证码失去焦点*/
	$("#new-phone-in").blur(function(){
		checkNewNumCode()
	})
	/*显示注册的邮箱*/
	$('#old-email').val(window.localStorage.getItem('email-add'))
	/*老邮箱发送验证码*/
	$('#old-email-code').click(function(){
		var count="59";
		var timer = setInterval(function(){

			$("#old-email-code").html("重新发送(" + count + ")");
			count--;
			$("#old-email-code").attr("disabled", true);
			if(count=='0'){
				clearInterval(timer);
				$("#old-email-code").html("发送验证码");
				$("#old-email-code").attr("disabled", false);
			}
		},"1000");
	});
	/*老邮箱验证码不能为空*/
	function checkEmailCode(){
		if($('#old-email-in').val()==''){
			$('.successfully').html("请填写验证码！")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000);
			})
			return false;
		}else{
			$('#old-email-in').parents("form").addClass('phoneForm').siblings("form").removeClass('phoneForm');
			return true;
		}
	}
	/*单击下一步，验证老邮箱验证码*/
	$('#nx-newEmail').click(function(){
		checkEmailCode()
	})
	/*新邮箱“发送验证码”*/
	$("#new-email-Ncode").click(function(){
		var count="59";
		var timer = setInterval(function(){

			$("#new-email-Ncode").html("重新发送(" + count + ")");
			count--;
			$("#new-email-Ncode").attr("disabled", true);
			if(count=='0'){
				clearInterval(timer);
				$("#new-email-Ncode").html("发送验证码");
				$("#new-email-Ncode").attr("disabled", false);
			}
		},"1000");
	})
	/*新邮箱不能为空，遵守正则的验证*/
	function checkNewEmail(){
		if($('#new-email').val()==''){
			$('.successfully').html("请填写新邮箱号！")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000);
			})
			return false;
		}else if(!reg.regEmail.test($('#new-email').val())){
			$('.successfully').html("新邮箱格式好像错了！")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000);
			})
			return false;
		}else{
			$('.successfully').html("还差一步！").css({'background':'#fff'});
			return true;
		}
	}
	/*新邮箱的验证码不能为空*/
	function checkNewEmailCode(){
		if($('#new-email-in').val()==''){
			$('.successfully').html("请填写验证码！")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000);
			})
			return false;
		}else{
			//$('#new-email-in').parents("form").addClass('phoneForm').siblings("form").removeClass('phoneForm');
			return true;
		}
	}
	/*单击确认，调用函数*/
	$("#cell-Newemail").click(function(){
		if(checkNewEmail()&&checkNewEmailCode()){
			alert('提交')
		} 
	})
	/*新邮箱失去焦点*/
	$("#new-email").blur(function(){
		checkNewEmail()
	})
	/*新邮箱验证码失去焦点*/
	$("#new-email-in").blur(function(){
		checkNewEmailCode()
	})
})


