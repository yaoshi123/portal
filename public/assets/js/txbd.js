/*验证*/
var reg = {
	regNum:/^[\d]{11}$/,/*编号*/
	regUser:/^[\u4e00-\u9fa5]{2,4}$/,/*一.申请鉴定单位（人）：*/
	regPhone:/^1[34578]\d{9}$/
};
/*提交验证*/
function checkContent(){
	/*编号*/
	if($('#reportNum').val()==''){
		$('.successfully').html("编号栏不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
		$('#reportNum').focus();
		return false;
		/*申请鉴定单位（人）*/
	}else if(!reg.regNum.test($('#reportNum').val())){
		$('.successfully').html("请输入11位数字编号")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
		$('#reportNum').focus();
		return false;
	}else if($('#jdr').val()==''){
		/*调到第一页*/
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("申请鉴定单位（人）栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
		$('#jdr').focus();
		return false;
		//用户名格式验证
	}else if(!reg.regUser.test($('#jdr').val())){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("请输入2-4位中文名")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
		$('#jdr').focus();
		return false;
		/*房屋地址*/
	}else if($('#add').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("房屋地址栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
		/*获得焦点*/
		$('#add').focus();
		return false;
		/*房 屋 基 本 情 况*/
	}else if($('#about').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("房 屋 基 本 情 况栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
		$('#about').focus();
		return false;
		/*区域*/
	}else if($('#qy option:selected').text()=='请选择区'){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("请选择区")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		return false;
		/*请选择街道*/
	}else if($('#jd option:selected').text()=='请选择街道'){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'});
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'});
		$('.successfully').html("请选择街道")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		return false;
		/*房屋名称*/
	}else if($('#fwname').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("房屋名称栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#fwname').focus();
		return false;
		/*建造年份*/
	}else if($('#jznf').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("建造年份栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#jznf').focus();
		return false;
		/*产权单位*/
	}else if($('#cqdw').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("产权单位栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#cqdw').focus();
		return false;
		/*联系电话*/
	}else if($('#lxdh').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'});
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'});
		$('.successfully').html("联系电话栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#lxdh').focus();
		return false;
		/*使用单位*/
	}else if(!reg.regPhone.test($('#lxdh').val())){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'});
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'});
		$('.successfully').html("手机号格式错误，请输入正确的联系方式")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
		$('#lxdh').focus();
		return false;
	}else if($('#sydw').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("使用单位栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#sydw').focus();
		return false;
		/*结构类别*/
	}else if($('#jglb option:selected').text()=='请选择'){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("请选择结构类别")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
		return false;
		/*使用性质*/
	}else if($('#syxz option:selected').text()=='请选择'){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("请选择使用性质")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			})
		return false;
		/*平面形式*/
	}else if($('#pmxs option:selected').text()=='请选择'){
	$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
	$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
	$('.successfully').html("平面形式栏,不能为空")
		.css({'background':'#000'})
		.fadeIn(1000,function(){
			$('.successfully').fadeOut(1000)
		})
		return false;
		/*房屋层数*/
	}else if($('#fwcs').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("房屋层数栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#fwcs').focus();
		return false;
		/*房屋用途*/
	}else if($('#fwyt option:selected').text()=='请选择'){
	$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
	$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
	$('.successfully').html("平面形式栏,不能为空")
		.css({'background':'#000'})
		.fadeIn(1000,function(){
			$('.successfully').fadeOut(1000)
		})
		return false;
		/*建筑面积*/
	}else if($('#cqmj').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("建筑面积栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#cqmj').focus();
		return false;
		/*产权证号*/
	}else if($('#cqbh').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("产权证号栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#cqbh').focus();
		return false;
		/*使用年限*/
	}else if($('#synx').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("使用年限栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#synx').focus();
		return false;
		/*健康等级*/
	}else if($('#jkdj').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("健康等级栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#jkdj').focus();
		return false;
		/*鉴定单位*/
	}else if($('#jddw option:selected').text()=='请选择鉴定单位'){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("请选择鉴定单位")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		return false;
		/*检测人员*/
	}else if($('#jcry').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("检测人员栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#jcry').focus();
		return false;
		/*物业单位*/
	}else if($('#wydw').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("物业单位栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#wydw').focus();
		return false;
		/*鉴定目的*/
	}else if($('#jdmd').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("鉴定目的栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#jdmd').focus();
		return false;
		/*鉴定情况*/
	}else if($('#jdsq').val()==''){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
		$('.successfully').html("鉴定情况栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#jdsq').focus();
		return false;
		/*损坏原因分析*/
	}else if($('#shyy').val()==''){

		$('.successfully').html("损坏原因分析栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#shyy').focus();
		return false;
		/*鉴定结论处理意见*/
	}else if($('#jlyj').val()==''){
		$('.successfully').html("鉴定结论处理意见栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#jlyj').focus();
		return false;
		/*鉴定单位*/
	}else if($('#jlyj').val()==''){
		$('.successfully').html("鉴定结论处理意见栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#jlyj').focus();
		return false;
		/*备注*/
	}else if($('#bz').val()==''){
		$('.successfully').html("备注栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#bz').focus();
		return false;
		/*区鉴定办公室人员*/
	}else if($('#qjdb').val()==''){
		$('.successfully').html("区鉴定办公室人员栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#qjdb').focus();
		return false;
		/*市鉴定办公室人员*/
	}else if($('#sjdb').val()==''){
		$('.successfully').html("市鉴定办公室人员栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#sjdb').focus();
		return false;
		/*市鉴定办公室负责人*/
	}else if($('#sjdbr').val()==''){
		$('.successfully').html("市鉴定办公室负责人栏,不能为空")
			.css({'background':'#000'})
			.fadeIn(1000,function(){
				$('.successfully').fadeOut(1000)
			});
		$('#sjdbr').focus();
		return false;
	}else{
		/*$('.successfully').html("信息提交成功").css({'background':'#0081cc'})
		$('.successfully').fadeIn(1000,function(){
			$('.successfully').fadeOut(1000)
		});*/
		return true;
	}
}
$(function(){
	/*加载公共的hotline*/
//	$("#commot-hot").load('html/commot-top.html #hotline')
	/*加载公共的logo*/
	$("#commot-logo").load('/public/assets/html/commot-top.html #logo')
	/*加载umit的nav*/
	$("#commot-nav").load('/public/assets/html/commot-top.html #unitnav')
	/*加载user的nav*/
	$("#user-nav").load('/public/assets/html/commot-top.html #usernav')
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
	/*宽度等于父元素的宽度*/
	/*$('td input').width($("td").width())*/
	/*$('td input[type=text]').each(function(){
		$(this).width($(this).parent().width())
	})*/
	$('#add').width($("#add").parent().width())
	$('#about').width($("#about").parent().width())

	$('#wydw').width($("#wydw").parent().width())
	$('#jdmd').width($("#jdmd").parent().width())

	$('td input').focus(function(){
		$(this).css('outline','none')
	})

	$('td textarea').focus(function(){
		$(this).css('outline','none')
	})
	$('td select').focus(function(){
		$(this).css('outline','none')
	})
	$('.malpractice-p input').focus(function(){
		$(this).css('outline','none')
	})
	/*.malpractice-p input*/

	$('.nextPage-a').click(function(){
//		alert($('.showTable').siblings('table').length)
		$('.showTable').css({display:'table'}).siblings('table').css({display:'none'})
		$(this).css({display:'none'}).siblings('.tijiao').css({display:'block'})

	})
	/*上一页*/
	$('.upPage').click(function(){
		$('.showTable').css({display:'none'}).siblings('table').css({display:'table'})
		$('.tijiao').css({display:'none'}).siblings('.nextPage-a').css({display:'block'})
	})

})