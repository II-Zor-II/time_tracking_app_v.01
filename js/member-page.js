//forms
//$("#timer-form").hide();



$(document).ready(function(){
	
	$("#mem-myWorklog").click(function(){
		window.location.href="/tmq/member-personalWorkLog.php?user_id="+$(this).attr("value")+"&username="+$(this).attr("name");
	});
	
	
	$("#myTab a").click(function(e){
    	e.preventDefault();
    	$(this).tab('show');
    });
	
	$("#selct-timr-btn").click(function(){
		//$("time-form").hide.$("#timer-form").show();
		$.when($("#time-form").hide()).then($("#timer-form").show());
	});
	$("#selct-time-btn").click(function(){
		//$("time-form").hide.$("#timer-form").show();
		$.when($("#timer-form").hide()).then($("#time-form").show());
	});
});