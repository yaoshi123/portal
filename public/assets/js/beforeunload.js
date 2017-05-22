var flag = false;
$(function (){
	
	$("input,select,textarea").each(function (){
		$(this).on("change",function(){
			flag=true;
		});
	});
})
window.onbeforeunload=function checkLeave(e){
	var evt = e ? e : (window.event ? window.event : null); //此方法为了在firefox中的兼容
	if(!flag)
		window.unbind("onbeforeunload");
	else
		evt.returnValue="页面已更改，确定要离开吗"
}

function submitAll(callback){
	flag = false;
	eval(callback+"()");
}

