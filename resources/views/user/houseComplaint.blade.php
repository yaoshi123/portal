<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="_token" content="{{ csrf_token() }}"/>
  <title>投诉</title>
  <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/common.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/jdsq.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/ts.css')}}"/>
  <script src="/public/assets/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="/public/assets/js/ts.js" type="text/javascript" charset="utf-8"></script>
  <script src="/public/assets/js/common.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
    //提交鉴定纠纷
    function submit(){
      if(checkName()&&checkPhone()&&checkObj()&&checkContent()){
        $.ajax({
          type: 'post',
          url:"/user/housecomplaintsubmit",
          data: {
            complaintName:$("#name").val(),
            telNumber:$("#phone1").val(),
            beComplaintedObj:$("#num").val(),
            complaintContent:$("#add").val(),
          },
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
          },
          success: function(data) {
            if(data.status){
              showMes();
              page(1);
              $("input").val("");
              $("textarea").val("");
            }
          }
        });
      }
    }
    //查询鉴定纠纷信息
    function queryHouseComplaintInfo(start){
      $.ajax({
        type: 'post',
        url:"/user/housecomplaintinfo",
        data: { start :start,
          length:2
        },
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
        },
        success: function(data){
          if(data.status){
            if(data.msg.array.length!=0){
              //显示第几页
              $("#page").val((start/2)+1);
              //显示总条数
              $("#totalitems").html(Math.ceil(data.msg.length/2));
              //显示记录
              $("#sequence").empty().append('   <p class="appraisal-con-tit1">序号</p>');
              $("#complaintName").empty().append('  <p class="appraisal-con-tit1">投诉人姓名</p>');
              $("#telNumber").empty().append('   <p class="appraisal-con-tit1">联系电话</p>');
              $("#beComplaintedObj").empty().append('   <p class="appraisal-con-tit1">投诉对象</p>');
              $("#complaintContent").empty().append('   <p class="appraisal-con-tit1">投诉内容</p>');
              for(var i = 0;i<data.msg.array.length;i++){
                $("#sequence").append("<p id='start'>"+(i+1+start)+"</p>");
                $("#complaintName").append("<p>"+data.msg.array[i].complaint_name+"</p>");
                $("#telNumber").append("<p>"+data.msg.array[i].tel_number+"</p>");
                $("#beComplaintedObj").append("<p>"+data.msg.array[i].be_complainted_obj+"</p>");
                $("#complaintContent").append("<p id='showContent"+i+"' onclick = 'showContent("+i+")'>"+data.msg.array[i].complaint_content+"</p>");
              };
            }
          }
        },
        error: function(xhr, type){
          alert("获取失败");
        }
      });
    }
    /*单击p 显示省略号后的内容*/
    function showContent(i){
    	alert($("#showContent"+i).html());
    }
    //对鉴定纠纷进行查询
    function page(data){
      if(data=='next'){
        queryHouseComplaintInfo(parseInt($('#start').html())+1);
      }
      else if(data=='before'){
        if($('#start').html()>1){
          queryHouseComplaintInfo(parseInt($('#start').html())-3);
        }
      }
      else if(!isNaN(data)){
       if(eval(data)<=eval($('#totalitems').html())&&eval(data)>0){
          queryHouseComplaintInfo(2*(data-1));
        }else{
         alert("您输入的数字有误，请重试");
         $("#choosePage").val("").focus();//清空输入框内容，获得焦点
       }
      }
      else{
        alert("请输入正确数字");
        $("#choosePage").val("").focus();//清空输入框内容，获得焦点
      }
    }
    //显示鉴定纠纷提交后的信息
    function showMes() {
      $('#complain-finish').fadeIn(1000, function () {
        $(this).fadeOut(1000)
      })
    }
    

    queryHouseComplaintInfo(0);
  </script>
</head>
<body>
<!------------------------hotline------------------------------>
<!--<div id="commot-hot"></div>-->
<div id="hotline">
  <div class="hotline">
    <p class="phone">咨询热线：0731-88888888</p>
    @if(session('user'))
      <p class="login">
        <a id = 'login'  class="login-btn">
          {{'欢迎您：'.session('user')->user_name}}
        </a>
        <a href="javascript:;" class="register-btn" id="quit">退出</a>
      </p>
    @else
      <p class="login">
        <a id = 'login' href="login" class="login-btn">
          登录
        </a>
        <a href="register" class="register-btn">注册</a>
      </p>
    @endif
    </p>
  </div>
</div>
<!------------------------logo------------------------------>
<div id="commot-logo"></div>
<!------------------------nav------------------------------>
<div id="commot-nav"></div>
<!--complain-->
<div id="appraisal">
  <div class="appraisal complain">
    <div class="appraisal-form complain-form">
      <div class="appraisal-forms">
        <div class="appraisal-form-tit">
          <p>填写投诉表单</p>
        </div>
        <!--左边的框-->
        <div class="complain-left">
          <div class="complain-tit">
            <h2>请如实填写以下信息</h2>
            <p>基本资料</p>
          </div>
          <form action="{{url('index/housecomplaintsubmit')}}" method="post">
            <div class="appraisal-form-cont complain-left-form">
              <div class="complain-left-formps">
                <p >
                  <label for="name">投诉人姓名：</label>
                  <input type="type" name="complaintName" id="name" onblur="checkName()"/>
                  <em></em>
                </p>
                <p >
                  <label for="phone1">&emsp;联系电话：</label>
                  <input type="type" name="telNumber" id="phone1" onblur="checkPhone()" />
                  <em></em>
                </p>
                <p >
                  <label for="num">&emsp;投诉对象：</label>
                  <input type="type" name="beComplaintedObj" id="num" onblur="checkObj()" />
                  <em></em>
                </p>
                <p >
                  <label for="add" style="float:left;margin-top: 10px;">&emsp;投诉内容：</label>
                  <textarea type="type" name="complaintContent" id="add" onblur="checkContent()"></textarea>
                  <em></em>
                </p>
              </div>
            </div>
            <div class="finish complain-finish">
            <a href="javascript:;" onclick="submit();">填写完毕，确认提交</a>
            {{csrf_field()}}
            </div>
          <div class="finish complain-finish" id="complain-finish">
            <a href="javascript:;">提交完成</a>
          </div>
          </form>
        </div>

        <!--右边的框-->
        <div class="complain-right" >
          <h2>投诉注意事项</h2>
          <p style="margin-top: 20px;">
            1.投诉者在填写“联系电话”时请真实、准确、无误的填写，方便后台工作人员及时联系您处理相关问题。经后台发布的信息自动的屏蔽了您的联系方式，敬请放心。</p>
          <p>2.为防止输入错误而导致的数据丢失，请投诉者在填写“投诉内容”时，先将文字信息输入到记事本或word文档上，在复制到表格的“投诉内容”</p>
          <p>3.咨询电话：0730-88888888，页面下方查看投诉信息列表</p>
        </div>
      </div>
    </div>

    <div class="appraisal-tab">
      <h2>投诉信息列表</h2>
      <div class="appraisal-con">
        <ul>
          <li class="appraisal-con-tit" id="sequence"></li>
          <li class="appraisal-con-tit" id="complaintName"></li>
          <li class="appraisal-con-tit" id="telNumber"></li>
          <li class="appraisal-con-tit" id="beComplaintedObj"></li>
          <li class="appraisal-con-tit" id="complaintContent"></li>
        </ul>
      </div>
    <!--分页-->
    <div class="paging">
      <p>
        <a href="javascript:;">总页数:<span id="totalitems">1</span>页</a>
        <a href="javascript:;" onclick="page('1');">首页</a>
        <a href="javascript:;" onclick="page('before');">上一页</a>
        <a href="javascript:;" onclick="page('next');">下一页</a>
        <a href="javascript:;" onclick="page($('#totalitems').html())">末页</a>
        <a href="javascript:;" style="border: none;">
          <input type="text" value="1"  id="choosePage" style="display: none"/>
          <input type="text" value="1"  id="page" style="padding: 0;margin: 0;width: 25px;height: 28px;"/>
        </a>
        <a href="javascript:;" onclick="page($('#choosePage').val());"> 转到</a>
      </p>
    </div>
    <div class="appraisal-list">
      <h2>装饰行业投诉信息</h2>
      <div class="appraisal-con">
        <ul>
          <li class="appraisal-con-tit">
            <p class="appraisal-con-tit1">序号</p>
            <p>1</p>
            <p>2</p>
            <p>3</p>
            <p>4</p>
            <p>5</p>
            <p>6</p>
            <p>7</p>
            <p>8</p>
            <p>9</p>
            <p>10</p>
          </li>
          <li class="appraisal-con-tit">
            <p class="appraisal-con-tit1">投诉标题</p>
            <p>艾仕壁纸</p>
            <p>艾仕壁纸</p>
            <p>艾仕壁纸</p>
            <p>艾仕壁纸</p>
            <p>艾仕壁纸</p>
            <p>艾仕壁纸</p>
            <p>艾仕壁纸</p>
            <p>艾仕壁纸</p>
            <p>艾仕壁纸</p>
            <p>艾仕壁纸</p>
          </li>
          <li class="appraisal-con-tit">
            <p class="appraisal-con-tit1">投诉对象</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
            <p>岳阳太阳桥大市场艾仕壁纸</p>
          </li>
          <li class="appraisal-con-tit">
            <p class="appraisal-con-tit1">时间</p>
            <p>2017年3月22日</p>
            <p>2017年3月22日</p>
            <p>2017年3月22日</p>
            <p>2017年3月22日</p>
            <p>2017年3月22日</p>
            <p>2017年3月22日</p>
            <p>2017年3月22日</p>
            <p>2017年3月22日</p>
            <p>2017年3月22日</p>
            <p>2017年3月22日</p>
          </li>
          <li class="appraisal-con-tit">
            <p class="appraisal-con-tit1">详情</p>
            <p><a href="javascript:;">查看</a></p>
            <p><a href="javascript:;">查看</a></p>
            <p><a href="javascript:;">查看</a></p>
            <p><a href="javascript:;">查看</a></p>
            <p><a href="javascript:;">查看</a></p>
            <p><a href="javascript:;">查看</a></p>
            <p><a href="javascript:;">查看</a></p>
            <p><a href="javascript:;">查看</a></p>
            <p><a href="javascript:;">查看</a></p>
            <p><a href="javascript:;">查看</a></p>
          </li>

        </ul>
      </div>
    </div>
      <!--分页-->
      <div id="paging1" class="paging ">
        <p>
          <a href="javascript:;">总数:<span>20</span>条</a>
          <a href="javascript:;">首页</a>
          <a href="javascript:;">上一页</a>
          <a href="javascript:;">下一页</a>
          <a href="javascript:;">末页</a>
          <a href="javascript:;" style="border: none;">
            <input type="text" value="1"  style="padding: 0;margin: 0;width: 25px;height: 28px;"/>
          </a>
          <a href="javascript:;"> 转到</a>
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
</body>

</html>
