//用户鉴定报告页面引用js
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

	/*查看*/

	$('#appraisal-con-btn').click(function(){
//		console.log($('.hide-div').length)
		$('#hide-div').css({left:0})
	})
	$('.close-hide').click(function(){

		$(this).parents('#hide-div').css({left:-2000})
	})
	/*上传按钮的单击事件*/
	 $('#btn').click(function () {
        //触发file的点击事件
        $('#uploadFile').click();
    });
    /*确认*/
	$('input[name=sure-s]').click(function(){
			/*console.log($('input[name=sure-s]'))*/
			$('.successfully').fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
	})

})