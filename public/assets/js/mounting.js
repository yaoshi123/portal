$(window).scroll(function(){
				//获取滚动条距离窗口顶端的距离
//				console.log($(window).scrollTop()) 
				var _scrolltop = $(window).scrollTop();
				//获取id= box的div距离窗口顶端的距离
//				console.log($('#commot-nav').offset().top) 
				var _top = $('#commot-nav').offset().top
				if( _scrolltop >= 160){
//					$('#box').offset().top = _scrolltop + _top ;
					$('.dl-nav').slideDown(500)
				}else{
					$('.dl-nav').slideUp(500);
				}
			})