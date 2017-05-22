<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>我的委托</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/jdsq.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/scfj.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/scfj.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        function show(){
            console.log($('input[name=sure-s]'))
            $('.successfully').fadeIn(1000,function(){
                $('.successfully').fadeOut(1000)
            })
        }
        //查询鉴定委托信息列表
        function queryEntrustInfos(pageNum){
            $.ajax({
                url:"/unit/queryentrustinfos",
                dataType:'json',
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data:{
                    pageNum:pageNum,
                },
                success:function(data){
                    $('#page').val(pageNum);
                    $('#choosePage').val(pageNum);
                    if (!data.status) {
                        alert('您没有提交鉴定报告');
                    } else {
                        $("#entrustTotalPages").html(Math.ceil(data.msg.length / 10));
                        $("#entrustSequence").empty().append('<p class="appraisal-con-tit1" >序号</p>');
                        $("#entrustAppliant").empty().append('<p class="appraisal-con-tit1">申请人</p>');
                        $("#entrustTime").empty().append('<p class="appraisal-con-tit1">提交时间</p>');
                        $("#entrustStatus").empty().append('<p class="appraisal-con-tit1">状态</p>');
                        $("#entrustInfo").empty().append('<p class="appraisal-con-tit1">委托信息</p>');
                        $("#entrustOperation").empty().append('<p class="appraisal-con-tit1">操作</p>');
                        $("#entrustRemark").empty().append(' <p class="appraisal-con-tit1">备注</p>');
                        for (var i = 0; i < 10; i++) {
                            if (data.msg.array[i] != null) {
                                var entrustInfo, verifyInfo,remark;
                                if (data.msg.array[i].bpm_status == 1) {
                                    entrustInfo = '待审核';
                                    verifyInfo = '<p><a href="javascript:;" onclick="updateEntrustStatusById(' + i + ',2)">同意</a> <a href="javascript:;" onclick="updateEntrustStatusById(' + i + ',3)">不同意</a></p>'
                                    remark = '<input/>';
                                }
                                else if (data.msg.array[i].bpm_status == 2) {
                                    entrustInfo = '审核通过';
                                    verifyInfo = '<p><a href="javascript:;" onclick="showHandleDetails(' + i + ')">查看处理详情</a></p>';
                                    remark = '<a>已提交</a>';
                                }
                                else if (data.msg.array[i].bpm_status == 3) {
                                    entrustInfo = '审核未通过';
                                    verifyInfo = '<p><a href="javascript:;" onclick="showHandleDetails(' + i + ')">查看处理详情</a></p>';
                                    remark = '<a>已提交</a>';
                                }
                                $("#entrustSequence").append('<p>' + (i + 1 + (parseInt(pageNum) - 1) * 10) + '</p>');
                                $("#entrustAppliant").append('<p>' + data.msg.array[i].applicant + '</p>');
                                $("#entrustTime").append('<p>' + data.msg.array[i].update_date + '</p>');
                                $("#entrustStatus").append('<p>' + entrustInfo + '</p>');
                                $("#entrustInfo").append('<p><a href="javascript:;" onclick="showEntrustDetails(' + i + ')">查看</a></p>');
                                $("#entrustOperation").append(verifyInfo);
                                $("#entrustRemark").append('<p>'+remark+'</p>');
                                $("#entrustRemark").append('<p style="display: none">' + data.msg.array[i].id + '</p>');
                            } else {
                                $("#entrustSequence").append('<p></p>');
                                $("#entrustAppliant").append('<p></p>');
                                $("#entrustTime").append('<p></p>');
                                $("#entrustInfo").append('<p></p>');
                                $("#entrustOperation").append('<p></p>');
                                $("#entrustRemark").append('<p></p>');
                            }

                        }
                    }
                }
            });
        }
        //修改委托状态
        function updateEntrustStatusById(data,state){
            var entrustId = $("#entrustRemark p:eq("+(data+1)*2+")").html();
            var remark = $("#entrustRemark p:eq("+((data+1)*2-1)+") input").val();
            $.ajax({
                url: "/unit/updateentruststatusbyid",
                dataType: 'json',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                data: {
                    appId: entrustId,
                    bpmStatus:state,
                    remark:remark
                },
                success: function (data) {
                    if(data){
                        entrustPage($("#page").val())
                    }
                }
            });
        }
         //查看处理详情
        function showHandleDetails(data){
            var appId = $("#entrustRemark p:eq("+(data+1)*2+")").html();
			var str = '';
            $.ajax({
                url: "/unit/queryappraiseentrustbyid",
                dataType: 'json',
                type: 'post',
            	headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
               },
               data: {
                    appId: appId,
                },
                success: function (data) {
                    if(data.status){

                    	str += ('<div style="" class="showhouseapplicant">'+
									'<p  class="closehouseapplicant">×</p>'+
									'<p>申请人姓名：'+data.msg.application.applicant+'</p>'+
									'<p>申请人电话：'+data.msg.application.phone+'</p>'+
									'<p>身份证号码：'+data.msg.application.idcard+'</p>'+
									'<p>房产证编号：'+data.msg.application.certificate_num+'</p>'+
									'<p>房屋地址：'+data.msg.application.address+'</p>'+
									'<p>通讯地址：'+data.msg.application.address+'</p>'+
									'<p>鉴定理由：'+data.msg.application.appraise_reason+'</p>'+
									'<p>备  注：'+data.msg.application.remark+'</p>'+
									'<p>区建局：'+data.msg.application.district+'</p>'+
                                    '<p>鉴定单位备注信息：'+data.msg.entrust.remark+'</p>'+

								'</div>')
                    $(".appraisal-con").append(str)
                    $('body').css({'background':"#8c8686"})
					$('.showhouseapplicant').css({'display':"block"})
					$(' body').on('click','.closehouseapplicant',function(){
						$('body').css({'background':""})
						$('.showhouseapplicant').css({'display':"none"})
					})
                    }else{
                    	alert(data.msg)
                    }
                }
               
            })
			
        }
        //查看委托详情
        function showEntrustDetails(data){
            var appId = $("#entrustRemark p:eq("+(data+1)*2+")").html();
            var str = '';
            $.ajax({
                url: "/unit/queryappraiseentrustbyid",
                dataType: 'json',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                data: {
                    appId: appId,
                },
                success: function (data) {
                    if(data.status){

                        str += ('<div style="" class="showhouseapplicant">'+
                        '<p  class="closehouseapplicant">×</p>'+
                        '<p>申请人姓名：'+data.msg.application.applicant+'</p>'+
                        '<p>申请人电话：'+data.msg.application.phone+'</p>'+
                        '<p>身份证号码：'+data.msg.application.idcard+'</p>'+
                        '<p>房产证编号：'+data.msg.application.certificate_num+'</p>'+
                        '<p>房屋地址：'+data.msg.application.address+'</p>'+
                        '<p>通讯地址：'+data.msg.application.address+'</p>'+
                        '<p>鉴定理由：'+data.msg.application.appraise_reason+'</p>'+
                        '<p>备  注：'+data.msg.application.remark+'</p>'+
                        '<p>区建局：'+data.msg.application.district+'</p>'+
                        '</div>')
                        //entrustPage($("#page").val())


                        $(".appraisal-con").append(str)
                        $('body').css({'background':"#8c8686"})
                        $('.showhouseapplicant').css({'display':"block"})
                        $(' body').on('click','.closehouseapplicant',function(){

                            $('body').css({'background':""})
                            $('.showhouseapplicant').css({'display':"none"})


                        })
                    }else{
                        alert(data.msg)
                    }
                }

            })

        }
        //翻页
        function entrustPage(pageNum){
            if(pageNum=='next'){
                if($('#entrustTotalPages').html()>$('#page').val()){
                    queryEntrustInfos(parseInt($('#page').val())+1);
                }
            }
            else if(pageNum=='before'){
                if($('#page').val()>1){
                    queryEntrustInfos(parseInt($('#page').val())-1);
                }
            }
            else if(!isNaN(pageNum)){
                if(eval(pageNum)<=eval($('#entrustTotalPages').html())&&eval(pageNum)>0){
                    queryEntrustInfos(pageNum);
                }else if($('#entrustTotalPages').html()==0){
                    queryEntrustInfos(2*(pageNum-1));
                }
                else{
                    alert("您输入的数字有误，请重试");
                    $("#choosePage").val("").focus();//清空输入框内容，获得焦点
                }
            }
            else{
                alert("请输入正确数字");
                $("#choosePage").val("").focus();//清空输入框内容，获得焦点
            }
        }
        queryEntrustInfos('1');
    </script>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/showhouseapplicant.css"/>
</head>
<body>
<!------------------------hotline------------------------------>
<!--<div id="commot-hot"></div>-->
<div id="hotline">
    <div class="hotline">
        <p class="phone">咨询热线：0731-88888888</p>
        <p class="login">
            <a id = 'login'  class="login-btn">
                {{'欢迎您：'.session('unit')->identity_unit_name}}
            </a>
            <a href="javascript:;" class="register-btn" id="quit">退出</a>
        </p>
    </div>
</div>
<!------------------------logo------------------------------>
<div id="commot-logo">
</div>
<!------------------------nav------------------------------>
<div id="commot-nav"></div>
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
            <li class="nav-list">
                <a href="#"	>热点投诉</a>
            </li>
        </ul>
    </div>
</div>
<!------------------------appraisal------------------------------>
<div id="appraisal">
    {{session('msg')}}
    <div class="appraisal">
        <div class="appraisal-tab">
            <!--提交成功-->
            <div class="finish successfully">
                <a href="javascript:;">上传成功</a>
            </div>
        <div class="appraisal-tab">
            <h2>我的委托</h2>
            <div class="appraisal-con">
                <ul>
                    <li class="appraisal-con-tit" id="entrustSequence"/>
                    <li class="appraisal-con-tit" id="entrustAppliant"/>
                    <li class="appraisal-con-tit" id="entrustTime"/>
                    <li class="appraisal-con-tit" id="entrustStatus"/>
                    <li class="appraisal-con-tit" id="entrustInfo"/>
                    <li class="appraisal-con-tit" id="entrustOperation"/>
                    <li class="appraisal-con-tit" id="entrustRemark"/>
                </ul>
            </div>
			
        </div>
        <!--分页-->
        <div class="paging">
            <p>
                <a href=" ">共:<span id="entrustTotalPages"/></span>页</a >
                <a href="javascript:;" onclick="entrustPage('1')">首页</a >
                <a href="javascript:;" onclick="entrustPage('before')">上一页</a >
                <a href="javascript:;" onclick="entrustPage('next')">下一页</a >
                <a href="javascript:;" onclick="entrustPage($('#entrustTotalPages').html())" >末页</a >
                <a href="javascript:;" style="border: none;">
                    <input type="text" value="1" id="choosePage" style="padding: 0;margin: 0;width: 25px;height: 26px;"/>
                    <input type="text" value="1" id="page" style="display: none"/>
                </a>
                <a href="javascript:;" onclick="entrustPage($('#choosePage').val())"> 转到</a >
            </p >
        </div>
    </div>
</div>
<!------------------------friendlyLink------------------------------>
<div id="friendlyLink-s"></div>

<!------------------------oblong------------------------------>
<div id="oblong-s"></div>
<!------------------------foorer------------------------------>
<div id="foorer-s"></div>
<!------------------------隐藏的div------------------------------>
<div id="hide-div" >
    <p style="">
        <a href="javascript:;" class="close-hide">关闭</a>
    </p>
    <img id='img'style="margin: 100px auto;" />
</div>
</body>
<script>
	
</script>
</html>
