$(document).ready(function(){
	
	$("#mem-myWorklog").click(function(){
		window.location.href="/tmq/member-personalWorkLog.php?user_id="+$(this).attr("value")+"&username="+$(this).attr("name");
	});
	
});