//forms
//$("#timer-form").hide();



$(document).ready(function(){


	let Interval;
	let sec = 0;
	let min = 0;
	let hr  = 0;
	//
	let d = 0; //day
	//
	let pause = 2;
	$("#mem-myWorklog").click(function(){
		window.location.href="/tmq/member-personalWorkLog.php?user_id="+$(this).attr("value")+"&username="+$(this).attr("name");
	});
	
	$("#selct-time-btn").click(function(){
		//$("time-form").hide.$("#timer-form").show();
		$.when($("#timer-form").hide()).then(function(){
			$("#time-form,#timeframe-div").show();
			$("#LogIdentifier").attr("value",1);
			console.log($("#LogIdentifier").val());
		});
		event.preventDefault();
	});	
	$("#selct-timr-btn").click(function(){
		//$("time-form").hide.$("#timer-form").show();
		$.when($("#time-form,#timeframe-div").hide()).then(function(){
			$("#timer-form").show();
			$("#LogIdentifier").attr("value",2);
			console.log($("#LogIdentifier").val());
		});
		event.preventDefault();
	});
	
	$("#memWorkLog-Cancel").click(function(){
		event.preventDefault();
		window.location.href="/tmq/member-dashboard.php?user_id="+event.target.getAttribute("uid")+"&username="+event.target.getAttribute("un");
	});
	
	//timer buttons
	$("#start-pause-btn").click(function(){
		event.preventDefault();
		let date;
		let dateObj = new Date();
		let y = dateObj.getFullYear();
		let m = dateObj.getMonth()+1;
		let d = dateObj.getDate();
		
		let strtTime;
		let stSec = dateObj.getSeconds();
		let stMin = dateObj.getMinutes();
		let stHr = dateObj.getHours();
		date = y+"-"+m+"-"+d;
		strtTime = stHr+":"+stMin+":"+stSec;
		console.log(date + "/" + strtTime);
		// pass start-date
		$.ajax({
			type: "POST",
			url: "start-and-end-api.php?task_id="+$("#mem-prsnlWorkLog-selection").val()+"&start_date="+date+"&start_time="+strtTime,			
			success: function(){
				console.log("success");		
    		}
		});
		//
		if(pause%2!=0){
			$.when($(event.target).html("Start")).then(clearInterval(Interval));	
		}else{
			$.when($(event.target).html("Pause")).then(function(){
				Interval = setInterval(startTimer,1000);
			});	
		}
		pause++;
	});
	$("#reset-btn").click(function(){
		event.preventDefault();
		clearInterval(Interval);
		resetTimer();	
		 $("#elapsed-timer").attr("value","0 : 0 : 0");
	});
	//AJAX
	$("#mem-prsnlWorkLog-selection").change(function(){
		console.log("AJAX response");
		if($("#LogIdentifier").val()==1){
			$.ajax({
			url: "task-timeframe.php?task_id="+event.target.value, 	
			success: function(result){
				var x = JSON.parse(result);
				$("#mem-task-timeframe").attr("value",x.estimated_date+" - "+x.estimated_time);			
    		}
		});		
		}
	});
	
	//TIMER functions
	function startTimer(){
	 sec++;
	 if(sec>60){
		 min++;
		 sec = 0;
	 }	
	 if(min>60){
		 hr++;
		 min = 0
	 }
	 if(hr>24){
		 d++;
		 hr = 0;
	 }
	 $("#elapsed-timer").attr("value",
			hr + " : " + min + " : " + sec				  
								 );
	};
	function resetTimer(){
		sec = 0;
		min = 0;
		hr  = 0;
	}
	
	
});
