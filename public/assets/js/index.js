$(function(){
	/*加载公共的hotline*/
//	$("#commot-hot").load('public/assets/html/commot-top.html #hotline')
	/*加载公共的logo*/
	$("#commot-logo").load('/public/assets/html/commot-top.html #logo')
	/*加载公共的nav*/
	//$("#commot-nav").load('/public/assets/html/commot-top.html #nav')
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

	/*轮播图*/

	 //先在ul里面添加第一张图片
    $(".box ul").append($(".box ul li").eq(0).clone());
    var count = 0;//0-5
    var timer = null;

    var k = 0;//记录小圆点的位置//0-4
    timer= setInterval(autoPlay,4000);
    function autoPlay() {
        count++;
        if(count == 5){
            $(".box ul").css("left",0)
            count = 1;
        }
        $(".box ul").animate({"left":-count*800},1000);
        k++;
        if(k==4){
            k = 0;
        }
        $(".box ol li").eq(k).addClass("current").siblings().removeClass("current")
    }
    $(".box ol li").click(function () {
        $(this).addClass("current").siblings().removeClass("current")
        k= $(this).index();
        count = k;
        $(".box ul").animate({"left":-k*800})
    })
    $(".box").mouseenter(function () {
        clearInterval(timer);
    });
    $(".box").mouseleave(function () {
        timer= setInterval(autoPlay,4000);
    })
    // 控制左右的箭头
    $(".pre").click(function () {
        count--;
        if(count== -1){
            count = 3;
            $(".box ul").css("left",-4*800)
        }
        $(".box ul").stop().animate({"left":-count*800});

        k = count;
        $(".box ol li").eq(k).addClass("current").siblings().removeClass("current");



    })
    $(".next").click(function () {
        count++;
        if(count == 5){
            count = 1;
            $(".box ul").css("left",0)
        }

        $(".box ul").stop().animate({"left":-count*800})

        k = count;
        if(k == 4){
            k=0;
        }

        $(".box ol li").eq(k).addClass("current").siblings().removeClass("current");
    })
    /*案例展示*/
// console.log($('.caseShow div').length)
   $('.caseShow div').mouseenter(function(){
   		$(this).children("p").stop().animate({
   			top:0
   		},500)
   })
    $('.caseShow div').mouseleave(function(){
		$(this).children("p").stop().animate({
				top:144
		},500)
	})
    /**/

   $('.pressionDrawing-piclist1').mouseenter(function(){
   		$(this).children("p").stop().animate({
   			top:0
   		},500)
   })
   if($('.pressionDrawing-piclist1').height()=='362'){
   		$('.pressionDrawing-piclist1').mouseleave(function(){
   			$(this).children("p").stop().animate({
					top:310
			},500)
   		})
   }
    $('.pressionDrawing-piclist2-b1').mouseleave(function(){
    	console.log($(this).height())
    	$(this).children('p').stop().animate({
    		top:124
    	},500)

	})
//		pressionDrawing-piclist2-top
	$('.pressionDrawing-piclist2-top').mouseleave(function(){
    	console.log($(this).height())
    	$(this).children('p').stop().animate({
    		top:124
    	},500)
	})

})
