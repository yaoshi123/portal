<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="_token" content="{{ csrf_token() }}"/>
	<title>长沙市房屋安全及装饰装修网</title>
	<script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/public/assets/libs/jquery.cookie.js" type="text/javascript" charset="utf-8"></script>
	<script src="/public/assets/js/index.js" type="text/javascript" charset="utf-8"></script>
	<script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
	<script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/assets/css/index.css"/>
</head>
<body>
<!------------------------hotline------------------------------>
<!--<div id="commot-hot"></div>-->
<div id="hotline">
	<div class="hotline">
		<p class="phone">咨询热线：0731-88888888 </p>
		@if(session('user'))
			<p class="login">
				<a id = 'login'  class="login-btn">
					{{'欢迎您：'.session('user')->user_name}}
				</a>
				<a href="javascript:;" class="register-btn" id="quit">退出</a>
			</p>
		@elseif(session('unit'))
			<p class="login">
				<a id = 'login'  class="login-btn">
					{{'欢迎您：'.session('unit')->identity_unit_name}}
				</a>
				<a href="javascript:;" class="register-btn" id="quit">退出</a>
			</p>
		@else
			<p class="login">
				<a  href="/index/login" class="login-btn" id = 'login'>
					登录
				</a>
				<a href="/index/register" class="register-btn">注册</a>
			</p>
		@endif
	</div>
</div>
<!------------------------logo------------------------------>
<div id="commot-logo"></div>
<!------------------------nav------------------------------>
<div id="commot-nav" >
	<div id="nav">
		<div class="nav">
			<ul class="nav-cont">
				<li class="nav-list">
					<a href="#">首页</a>
				</li>
				<li class="nav-list">
					<a href="#"	>装修公司</a>
				</li>
				<li class="nav-list">
					<a href="#"	>建材</a>
				</li>
				<li class="nav-list">
					<a href="#"	>案例展示</a>
				</li>
				<li class="nav-list">
					<a href="#"	>装修知识</a>
				</li>
				<li class="nav-list">
					<a href="#"	>装修安全</a>
				</li>
				<li class="nav-list">
					<a href="#"	>曝光台</a>
				</li>
				@if(session('user'))
					<li class="nav-list" >
						<a href="#"	>我&nbsp;&nbsp;&nbsp;的</a>
						<p >
							<a href="/user/houseapplicant" >我的鉴定申请</a>
							<a href="/user/reportinfos">我的鉴定报告</a>
							<a href="/user/appraisedispute">我的鉴定纠纷</a>
							<a href="/user/housecomplaint">我的投诉信息</a>
							<a href="/user/userinfo">个人信息</a>
						</p>
					</li>
				@elseif(session('unit'))
					<li class="nav-list" >
						<a href="#"	>我&nbsp;&nbsp;&nbsp;的</a>
						<p >
							<a href="/unit/appraisereport">鉴定报告录入</a>
							<a href="/unit/reportinfos">我的鉴定报告</a>
							<a href="/unit/entrustinfos">我的鉴定委托</a>
						</p>
					</li>
				@endif
			</ul>
		</div>
	</div>
</div>
<!------------------------置顶------------------------------>
<div id="nav" class="dl-nav" style="margin:auto;position: fixed;top: 0;right: 0;left: 0;display: none;z-index: 999;background: #fff;">
	<div class="nav">
		<ul class="nav-cont">
			<li class="nav-list">
				<a href="#">首页</a>
			</li>
			<li class="nav-list">
				<a href="#"	>装修公司</a>
			</li>
			<li class="nav-list">
				<a href="#"	>建材</a>
			</li>
			<li class="nav-list">
				<a href="#"	>案例展示</a>
			</li>
			<li class="nav-list">
				<a href="#"	>装修知识</a>
			</li>
			<li class="nav-list">
				<a href="#"	>装修安全</a>
			</li>
			<li class="nav-list">
				<a href="#"	>曝光台</a>
			</li>
		</ul>
	</div>
</div>
<!------------------------carousel------------------------------>
<div id="carousel">
	<div class="carousel">
		<div class="carousel-left">
			<!--轮播图-->
			<div class="box">
				<div class="screen">
					<ul>
						<li><img src="{{asset('public/assets/img/7.jpg')}}"></li>
						<li><img src="{{asset('public/assets/img/8.jpg')}}"></li>
						<li><img src="{{asset('public/assets/img/9.jpg')}}"></li>
						<li><img src="{{asset('public/assets/img/10.jpg')}}"></li>
					</ul>
				</div>
				<ol>
					<li class="current"></li>
					<li></li>
					<li></li>
					<li></li>
				</ol>
				<div class="pre">&lt;</div>
				<div class="next">&gt;</div>
			</div>
			<!---->
			<div class="ledge-list">
				<div class="knowledge">
					<p>装修“知识”</p>
				</div>
				<div class="safety">
					<p>装修“安全”</p>
				</div>
				<div class="hand">
					<p>装修“攻略”</p>
				</div>
			</div>
		</div>
		<div class="carousel-right">
			<div class="ido">
				<!--鉴定申请按钮-->
				<a href="/user/houseapplicant" ></a>
				<!--鉴定报告上传-->
				{{--<a href="{{url('index/uploadrepord')}}" class="upload">鉴定报告上传</a>--}}
				<a href="/unit/appraisereport" class="upload"></a>
				<!--我要投诉-->
				<a href="/user/housecomplaint" class="complaint"></a>
			</div>
			<!--新闻列表-->
			<div class="new-list">
				<p class="new-title">
					<b>鉴定单位信息</b>
					<a href="/index/appraiseunits">更多 >></a>
				</p>
				<ul id="appraiseInfos" />
			</div>
		</div>
	</div>
</div>
<!------------------------advert------------------------------>
<div id="advert">
	<div class="advert">
		<a href="#"><img src="{{asset('public/assets/img/advert-pic1.png')}}" alt="" /></a>
		<a href="#" class="advert-pic2"><img src="{{asset('public/assets/img/advert-pic2.png')}}" alt="" /></a>
		<a href="#"><img src="{{asset('public/assets/img/advert-pic3.png')}}" alt="" /></a>
	</div>


</div>
<!------------------------caseShow------------------------------>
<div id="caseShow">
	<div class="caseShow-box">
		<div class="caseShow">
			<div class="caseShow-tit">案例展示</div>
			<div>
				<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
				<p>三方欧式风格</p>
			</div>
			<div>
				<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
				<p>三方欧式风格</p>
			</div>
			<div>
				<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
				<p>三方欧式风格</p>
			</div>
			<div>
				<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
				<p>三方欧式风格</p>
			</div>
		</div>
	</div>

</div>
<!------------------------pressionDrawing------------------------------>
<div id="pressionDrawing">
	<div class="pressionDrawing">
		<p class="pressionDrawing-tit">装修效果图</p>
		<div class="pressionDrawing-dis">
			<div>
				<p class="pressionDrawing-dis-tit">空间</p>
				<p>
					<a href="#">客厅</a>
					<a href="#">卧室</a>
					<a href="#">卫生间</a>
					<a href="#">厨房</a>
					<a href="#">电视墙</a>
					<a href="#">榻榻米</a>
				</p>
			</div>
			<div>
				<p class="pressionDrawing-dis-tit">户型</p>
				<p>
					<a href="#">一居室</a>
					<a href="#">二居室</a>
					<a href="#">三居室</a>
					<a href="#">复式</a>
					<a href="#">别墅</a>
					<a href="#">小户型</a>
					<a href="#">样板房</a>
				</p>
			</div>
			<div>
				<p class="pressionDrawing-dis-tit">风格</p>
				<p>
					<a href="#">简约</a>
					<a href="#">现代</a>
					<a href="#">中式</a>
					<a href="#">欧式</a>
					<a href="#">美式</a>
					<a href="#">田园</a>
					<a href="#">新古典</a><br/>
					<a href="#">东南亚</a>
					<a href="#">地中海</a>
					<a href="#">混搭</a>

				</p>
			</div>
		</div>

		<!--图片列表-->
		<div class="pressionDrawing-piclist">
			<div class="pressionDrawing-piclist1">
				<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
				<p>三方欧式风格</p>
			</div>
			<div class="pressionDrawing-piclist2">
				<div class="pressionDrawing-piclist1 pressionDrawing-piclist2-top">
					<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
					<p>三方欧式风格</p>
				</div>
				<div class="pressionDrawing-piclist1 pressionDrawing-piclist2-top pressionDrawing-piclist2-bott">
					<div class="pressionDrawing-piclist1 pressionDrawing-piclist2-b1">
						<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
						<p>三方欧式风格</p>
					</div>
					<div class="pressionDrawing-piclist1 pressionDrawing-piclist2-b1" style="margin-left: 10px;">
						<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
						<p>三方欧式风格</p>
					</div>
				</div>
			</div>
			<div class="pressionDrawing-piclist3 pressionDrawing-piclist1">
				<img src="{{asset('public/assets/img/9.jpg')}}"/>
				<p>三方欧式风格</p>
			</div>
		</div>
	</div>

</div>
<!------------------------buildingMaterials------------------------------>
<div id="buildingMaterials">
	<div class="pressionDrawing">
		<p class="pressionDrawing-tit">建材家具</p>
		<div class="pressionDrawing-dis">
			<div>
				<p class="pressionDrawing-dis-tit">家装主材</p>
				<p>
					<a href="#">集成吊顶</a>
					<a href="#">淋浴房</a>
					<a href="#">水槽</a>
					<a href="#">面盆</a>
					<a href="#">浴缸</a>
					<a href="#">室柜</a>
					<a href="#">油漆</a>
					<a href="#">壁纸</a>
					<a href="#">木门</a>
					<a href="#">瓷砖</a>
					<a href="#">地板</a>
					<a href="#">马桶</a>
					<a href="#">橱柜</a>
				</p>
			</div>

			<div>
				<p class="pressionDrawing-dis-tit">户型</p>
				<p>
					<a href="#">一居室</a>
					<a href="#">二居室</a>
					<a href="#">三居室</a>
					<a href="#">复式</a>
					<a href="#">别墅</a>
					<a href="#">小户型</a>
					<a href="#">样板房</a>
				</p>
			</div>
		</div>

		<!--图片列表-->
		<div class="pressionDrawing-piclist">
			<div class="pressionDrawing-piclist1">
				<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
				<p>
					<span>欧派木门 实木烤漆室内套装门 美式风格PS-220</span>
					<b style="">￥2280元</b>
				</p>
			</div>
			<div class="pressionDrawing-piclist2">
				<div class="pressionDrawing-piclist1 pressionDrawing-piclist2-top">
					<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
					<p>
						<span>欧派木门 实木烤漆室内套装门 美式风格PS-220</span>
						<b style="">￥2280元</b>
					</p>
				</div>
				<div class="pressionDrawing-piclist1 pressionDrawing-piclist2-top pressionDrawing-piclist2-bott">
					<div class="pressionDrawing-piclist1 pressionDrawing-piclist2-b1">
						<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
						<p>
							<span>中宇卫浴水龙头</span>
							<b style="">￥2280元</b>
						</p>

					</div>
					<div class="pressionDrawing-piclist1 pressionDrawing-piclist2-b1" style="margin-left: 10px;">
						<img src="{{asset('public/assets/img/7.jpg')}}" alt="" />
						<p>
							三方欧式风格
						</p>
					</div>
				</div>
			</div>
			<div class="pressionDrawing-piclist3 pressionDrawing-piclist1">
				<img src="{{asset('public/assets/img/9.jpg')}}"/>
				<p>
					<span>3.9折美的油酊取暖器家用13片</span>
				</p>
			</div>
		</div>
	</div>

</div>
<!------------------------decorationCompany------------------------------>
<div id="decorationCompany">
	<div class="pressionDrawing decoration-tit" >
		<p class="pressionDrawing-tit">知名装修公司</p>
	</div>
	<div class="decoration-nav">
		<ul>
			<li><a href="#">知名品牌</a></li>
			<li><a href="#">高性价比</a></li>
			<li><a href="#">高口碑值</a></li>
			<li><a href="#">擅长二手房翻新</a></li>
			<li><a href="#" style="border-right: none;">擅长大宅设计</a></li>
		</ul>
	</div>

	<div id="outer-box">
		<div id="outer">
			<div class="decoration-cont" id="inner">
				<div class="decoration-conts" id="con1">
					<div>
						<img src="{{asset('public/assets/img/mrwj.png')}}" alt="" />
						<p>美润万家装饰</p>
						<p>案例：4个</p>
						<p>评论：1192条</p>
						<p>口碑值：750</p>
					</div>
					<div>
						<img src="{{asset('public/assets/img/lyj.png')}}" alt="" />
						<p>美润万家装饰</p>
						<p>案例：4个</p>
						<p>评论：1192条</p>
						<p>口碑值：750</p>
					</div>
					<div>
						<img src="{{asset('public/assets/img/lyj2.png')}}" alt="" />
						<p>美润万家装饰</p>
						<p>案例：4个</p>
						<p>评论：1192条</p>
						<p>口碑值：750</p>
					</div>
					<div>
						<img src="{{asset('public/assets/img/lyj3.png')}}" alt="" />
						<p>美润万家装饰</p>
						<p>案例：4个</p>
						<p>评论：1192条</p>
						<p>口碑值：750</p>
					</div>
					<div>
						<img src="{{asset('public/assets/img/lyj4.png')}}" alt="" />
						<p>美润万家装饰</p>
						<p>案例：4个</p>
						<p>评论：1192条</p>
						<p>口碑值：750</p>
					</div>
				</div>
				<div class="decoration-conts"  id="con2"></div>
			</div>
		</div>
		<div id="fx">
			<a href="javascript:;"><</a>
			<a href="javascript:;">></a>
		</div>
	</div>

</div>
<!------------------------friendlyLink------------------------------>
<div id="friendlyLink-s"></div>

<!------------------------oblong------------------------------>
<div id="oblong-s"></div>
<!------------------------foorer------------------------------>
<div id="foorer-s"></div>
</body>
<script>
	//展示鉴定单位信息
	function queryAppraiseInfos(){
		$.ajax({
			url: "{{url('index/queryappraiseinfos')}}",
			dataType: 'json',
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
			},
			success: function (data) {
				if (data.status) {
					if(data.msg.length>9){
						for(var i = 0;i<9;i++){
							$('#appraiseInfos').append('<li><a href="/index/appraiseunits?unitName='+data.msg[i].identity_unit_name+'" >'+data.msg[i].identity_unit_name+'</a></li>');
						}
					}else{
						for(var i = 0;i<data.msg.length;i++){
							$('#appraiseInfos').append('<li><a href="/index/appraiseunits?unitName='+data.msg[i].identity_unit_name+'" >'+data.msg[i].identity_unit_name+'</a></li>');
						}
					}

				} else {
					alert(data.msg)
				}
			}
		});
	}
	queryAppraiseInfos();
	var outer=document.getElementById('outer');
	var con1=document.getElementById('con1');
	var con2=document.getElementById('con2');
	var fx = document.getElementById('fx');
	var div=con1.getElementsByTagName('div')[0];
	var btns=fx.getElementsByTagName('a');
	var timer1=null,timer2=null,timer3=null,timer4=null;
	var x=0;// 储存当前滚动的方向

	//把内容1的东西 赋值给内容2
	con2.innerHTML=con1.innerHTML;

	function clear(){
		clearInterval(timer1);
		clearTimeout(timer2);
		clearTimeout(timer3);
		clearInterval(timer4);
	}

	function moveleft(){//左滚动函数
		outer.scrollLeft++;
//			console.log(con1.offsetWidth)
//			console.log(outer.scrollLeft)
//			console.log(div.scrollWidth)
		if (outer.scrollLeft>=con1.offsetWidth) {
			outer.scrollLeft=0;
		};
		if (outer.scrollLeft%(div.offsetWidth+138)==0) {
			clear();
			timer2=setTimeout(function (){
				timer1=setInterval(moveleft,10);
			},2000);
		};
	}
	function moveright(){//右滚动函数
		outer.scrollLeft--;
		if (outer.scrollLeft<=0) {
			outer.scrollLeft=con1.offsetWidth;
		};
		if (outer.scrollLeft%(div.offsetWidth+10)==0) {
			clear();
			timer3=setTimeout(function (){
				timer4=setInterval(moveright,10);
			},1000);
		};
	}
	timer1=setInterval(moveleft,10);//进入页面自动走

	btns[0].onclick=function (){
		clear();
		timer1=setInterval(moveleft,10);
		// x=0;
	}
	btns[1].onclick=function (){
		clear();
		timer4=setInterval(moveright,10);
		// x=1;
	}

	outer.onmouseover=function (){
		clear();
	}
	outer.onmouseout=function (){
		if (x==0) {
			timer1=setInterval(moveleft,10);
		} else{
			timer4=setInterval(moveright,10);
		};
	}
</script>
</html>


