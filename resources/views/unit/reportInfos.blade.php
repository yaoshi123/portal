<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>鉴定单位上传信息</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/jdsq.css"/>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/scfj.css"/>
    <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/mounting.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/scfj.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        //查询鉴定报告信息并显示
        function queryIdentityInfos(pageNum){
            $.ajax({
                url:"/unit/queryappraisereports",
                dataType:'json',
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                data:{
                    pageNum:pageNum,
                },
                success:function(data) {
                    $('#page').val(pageNum);
                    $('#choosePage').val(pageNum);
                    if (data.status) {
                        $("#totalPages").html(Math.ceil(data.msg.length / 10));
                        $("#sequence").empty().append('<p class="appraisal-con-tit1" >序号</p>');
                        $("#reportCode").empty().append('<p class="appraisal-con-tit1">报告编号</p>');
                        $("#houseName").empty().append('<p class="appraisal-con-tit1">房屋名称</p>');
                        $("#buildTime").empty().append('<p class="appraisal-con-tit1">建造年份</p>');
                        $("#reportDownload").empty().append(' <p class="appraisal-con-tit1">鉴定报告</p>');
                        $("#fileStatus").empty().append(' <p class="appraisal-con-tit1">附件状态</p>');
                        $("#reportOperation").empty().append(' <p class="appraisal-con-tit1">附件操作</p>');
                        $("#reportStatus").empty().append(' <p class="appraisal-con-tit1">报告状态</p>');
                        $("#operation").empty().append(' <p class="appraisal-con-tit1">操作</p>');
                        for (var i = 0; i < 10; i++) {
                            if (data.msg.array[i] != null) {
                                var status, showCheck, reportStatus, operaction, fileOperaction,fileDownload;
                                if (data.msg.array[i].file_route == null) {
                                    status = '未上传';
                                    showCheck = ' style="opacity: 0;cursor:default;"'
                                }
                                else {
                                    status = '已上传';
                                    showCheck = "";
                                }
                                if (data.msg.array[i].bpm_status == '0') {
                                    reportStatus = '未提交';
                                    operaction = '<p><a href="javascript:;" class="edit" onclick="edit(' + i + ')">编辑</a> <a href="javascript:;" class="edit" onclick="deleteReport(' + i + ')">删除</a> <a href="javascript:;" class="edit" onclick="transmit(' + i + ')">提交</a></p>';
                                    fileOperaction =  ' style="display: block;"';
                                    fileDownload= ' style="display: none;"';
                                }else if (data.msg.array[i].bpm_status == '1') {
                                    reportStatus = '审核中';
                                    operaction = '<p><a href="javascript:;" onclick="checkReportInfo('+i+')">查看</a></p>';
                                    fileOperaction = ' style="display: none;"';
                                    fileDownload= ' style="display:block;"';
                                }else if(data.msg.array[i].bpm_status == '2'){
                                    reportStatus = '初审未通过';
                                    operaction = '<p><a href="javascript:;" onclick="checkReportInfo('+i+')">查看</a></p>';
                                    fileOperaction = ' style="display: none;"';
                                    fileDownload= ' style="display:block;"';
                                }else if(data.msg.array[i].bpm_status == '3'){
                                    reportStatus = '等待复审';
                                    operaction = '<p><a href="javascript:;" onclick="checkReportInfo('+i+')">查看</a></p>';
                                    fileOperaction = ' style="display: none;"';
                                    fileDownload= ' style="display:block;"';
                                }else if(data.msg.array[i].bpm_status == '4'){
                                    reportStatus = '复审通过';
                                    operaction = '<p><a href="javascript:;" onclick="checkReportInfo('+i+')">查看</a></p>';
                                    fileOperaction = ' style="display: none;"';
                                    fileDownload= ' style="display:block;"';
                                }else if(data.msg.array[i].bpm_status == '5'){
                                    reportStatus = '复审未通过';
                                    operaction = '<p><a href="javascript:;" onclick="checkReportInfo('+i+')">查看</a></p>';
                                    fileOperaction = 'style="display: none;"';
                                    fileDownload= 'style="display:block;"';
                                }
                                $("#sequence").append('<p>' + (i + 1 + (parseInt(pageNum) - 1) * 10) + '</p>');
                                $("#reportCode").append('<p>' + data.msg.array[i].report_num + '</p>');
                                $("#houseName").append('<p>' + data.msg.array[i].house_name + '</p>');
                                $("#buildTime").append('<p>' + data.msg.array[i].build_end_year.substr(0, 10) + '</p>');
                                $("#reportDownload").append('<p><a  onclick = downloadFile(' + i + '); href="javascript:;">下载</a></p>');
                                $("#fileStatus").append('<p>' + status + '</p>');
                                $("#reportOperation").append(
                                    '<form id="form' + i + '" action="/index/upload" method="post" enctype="multipart/form-data" class="uploadForm" '+fileOperaction+' >'+
                                        '{{csrf_field()}}'+
                                        '<input style="margin-right: 2px"  type="text" name="textfield" class="textfield" class="txt" onclick="selectFile('+i+')"/>'+
                                        '<input style="margin-right: 2px" type="button" class="btn" value="浏览..." onclick="selectFile('+i+')"/>'+
                                        '<input onchange = changeValue('+i+',this.value) type="file" name="fileField" class="file" class="fileField" size="28" id="zip'+i+'"/>'+
                                        '<input onclick = imgSubmit(' + i + '); style="margin-right: 2px"  type="button"  class="btn " value="上传" />'+
                                        '<input name="reportId" type="hidden" value="' + data.msg.array[i].report_num + '"/>' +
                                    '</form>'+
                                    '<p '+fileDownload+'><a onclick = downloadZip(' + i + '); href="javascript:;">下载</a></p>'
                                );
                                $("#reportStatus").append('<p>' + reportStatus + '</p>');
                                $("#operation").append(operaction);
                                $("#operation").append('<p hidden="true" id="imgUrl' + i + '">' + data.msg.array[i].file_route + '</p>');
                                $("#operation").append('<p hidden="true" id="reportId' + i + '">' + data.msg.array[i].id + '</p>');
                            } else {
                                $("#sequence").append('<p></p>');
                                $("#reportCode").append('<p></p>');
                                $("#houseName").append('<p></p>');
                                $("#buildTime").append('<p></p>');
                                $("#reportStatus").append('<p></p>');
                                $("#reportOperation").append('<p></p>');
                                $("#operation").append('<p></p>');
                            }
                        }
                    }
                }
            });
        }
        //当<input type='file'>的值改变时，给<input type='text'>复制
        function changeValue(num ,data){
            $('form:eq('+num+') >input[type=text]').val(data);
        }
        //判断附件的状态后上传附件
        function imgSubmit(data){
           if($("#fileStatus p:eq("+(data+1)+")").html()=='已上传'){
                if(confirm('附件已上传，确认覆盖？')){
                    uploadFile(data);
                }
            }else{
                uploadFile(data);
           }
        }
        //上传图片
        function uploadFile(num){
            var data = new FormData($("#form"+num)[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                url: "/unit/uploadimg",
                type: 'POST',
                data:data ,
                dataType: 'JSON',
                cache: false,
                processData: false,
                contentType: false,
                success:function(data){
                    if(data.status){
                        show();
                        page($('#page').val());
                    }else{
                        alert(data.msg);
                    }
                }
            })
        }
        //显示上传的图片
        function downloadZip(data){
            var zipUrl = $("#imgUrl"+data).html()
            window.location.href='/unit/downloadzip?zipUrl='+zipUrl;
        }
        //翻页
        function page(data){
            if(data=='next'){
                if($('#totalPages').html()>$('#page').val()){
                    queryIdentityInfos(parseInt($('#page').val())+1);
                }
            }
            else if(data=='before'){
                if($('#page').val()>1){
                    queryIdentityInfos(parseInt($('#page').val())-1);
                }
            }
            else if(!isNaN(data)){
                if(eval(data)<=eval($('#totalPages').html())&&eval(data)>0){
                    queryIdentityInfos(data);
                }else if($('#totalPages').html()==0){
                    queryHouseApplicationInfo(2*(data-1));
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
        //跳转到鉴定报告上传页面
        function edit(data){
            var reportNum = $("#reportCode p:eq("+(data + 1)+")").html();
            window.location.href = "/unit/appraisereport?reportNum="+reportNum;
        }
        //显示相关信息
        function show(){
            $('.successfully').fadeIn(1000,function() {
                $('.successfully').fadeOut(1000)
            })
        }
        //讲鉴定报告提交
        function transmit(data){
            if(confirm('确认提交报告？')){
                var reportId = $("#operation p:eq("+(data+1)*3+")").html();
                var imgUrl = $("#operation p:eq("+((data+1)*3-1)+")").html();
                if(imgUrl!='null'){
                    $.ajax({
                        url: "/unit/updateappraisereportstatebyid",
                        dataType: 'json',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                        },
                        data: {
                            id: reportId,
                            bpmStatus:'1',
                        },
                        success: function (data) {
                            if(data){
                                queryIdentityInfos($("#page").val());
                            }
                        }
                    })
                }else{
                    alert('请先将鉴定报告附件上传')
                }
            }
        }
        //删除鉴定报告
        function deleteReport(data){
            if(confirm("你确定删除此报告吗？")){
                var reportId = $("#operation p:eq("+(data+1)*3+")").html();
                $.ajax({
                    url: "/unit/deleteappraisereportbyid",
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    },
                    data: {
                        id: reportId,
                    },
                    success: function (data) {
                        if(data){
                            queryIdentityInfos($("#page").val());
                        }
                    }
                })
            }
        }
        //查看鉴定报告信息，跳转页面
        function checkReportInfo(data){
            var reportNum = $("#reportCode p:eq("+(data + 1)+")").html();
            window.location.href = "/unit/appraisereport?reportNum="+reportNum+"&showReport="+true;
        }
        //下载已经有信息的Word文档
        function downloadFile(data){
            var reportNum = $("#reportCode p:eq("+(data + 1)+")").html();
            window.location.href='/unit/downloadword?reportNum='+reportNum;
        }
        function selectFile(num){
            $('#zip'+num).click()}
        queryIdentityInfos(1)
    </script>
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
<div id="commot-logo"></div>
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
    <div class="appraisal" ><!--style="z-index: -5;"-->
        <!--提交成功-->
        <div class="finish successfully" style="z-index: 100;">
            <a href="javascript:;">上传成功</a>
        </div>
        <div class="appraisal-tab">
            <h2>我的报告</h2>
            <div class="appraisal-con">
                <ul>
                    <li class="appraisal-con-tit" id="sequence"/>
                    <li class="appraisal-con-tit" id="reportCode"/>
                    <li class="appraisal-con-tit" id="houseName"/>
                    <li class="appraisal-con-tit" id="buildTime"/>
                    <li class="appraisal-con-tit" id="reportDownload"/>
                    <li class="appraisal-con-tit" id="fileStatus"/>
                    <li class="appraisal-con-tit file-box" style="font-size: 14px;" id="reportOperation">
                        <p class="appraisal-con-tit1">附件操作</p>
                        <form action="" method="post" enctype="multipart/form-data" class="uploadForm">
                            <input type='text' name='textfield' class='textfield' class='txt' />
                            <input type='button' class='btn' value='浏览...' onclick="a()"/>
                            <input type="file" name="fileField" class="file" class="fileField" size="28" id="zip"/>
                            <input type="button"  class="btn" value="上传" />
                        </form>
                        <form action="" method="post" enctype="multipart/form-data" class="uploadForm" >
                            <input type='text' name='textfield' class='textfield' class='txt' />
                            <input type='button' class='btn' value='浏览...' />
                            <input type="file" name="fileField" class="file" class="fileField" size="28" />
                            <input type="button"  class="btn " value="上传" />

                        </form>


                    </li>
                    <li class="appraisal-con-tit" id="reportStatus" />
                    <li class="appraisal-con-tit" id="operation" />
                </ul>
            </div>
        </div>
        <!--分页-->
        <div class="paging">
            <p>
                <a href="javascript:;">共<span id="totalPages"></span>页</a>
                <a href="javascript:;" onclick="page(1)">首页</a>
                <a href="javascript:;" onclick="page('before')">上一页</a>
                <a href="javascript:;" onclick="page('next')">下一页</a>
                <a href="javascript:;" onclick="page($('#totalPages').html())">末页</a>
                {{--<a href="javascript:;"><input id="page" value="111"/></a>--}}
                <a href="javascript:;" style="border: none;">
                    <input type="text" value="1" id="choosePage" style="padding: 0;margin: 0;width: 25px;height: 26px;"/>
                    <input type="text" value="1" id="page" style="display: none"/>
                </a>
                <a href="javascript:;" onclick="page($('#choosePage').val())"> 转到</a>
            </p>
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
</body>
</html>
