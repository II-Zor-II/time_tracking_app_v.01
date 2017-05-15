//forms
//$("#timer-form").hide();



$(document).ready(function(){

	let startedTimeLog = false;
	let breaksCtr = 0;
	
	let Interval;
	let sec = 0;
	let min = 0;
	let hr  = 0;
	//
	let d = 0; //day
	//
	let pause = 2;
	let date;
	let strtTime;
	$("#mem-myWorklog").click(function(){
		window.location.href="/tmq/member-personalWorkLog.php?user_id="+$(this).attr("value")+"&username="+$(this).attr("name");
	});
	
	$("#selct-time-btn").click(function(){
		$.when($("#timer-form").hide()).then(function(){
			$("#time-form,#timeframe-div").show();
			$("#LogIdentifier").attr("value",1);
			console.log($("#LogIdentifier").val());
			resetTimer();	
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
	$("#save-worklog").hover(function(){		
		setDate();
		$("#time-ended").attr("value",date+" "+strtTime);
		
	});
	$("#mem-myTimeframe").click(function(){
		window.location.href="/tmq/member-timeframe.php?user_id="+$(this).attr("value")+"&username="+$(this).attr("name")+"&member=true";
	});
	$("#mem-myWorklog-ChR").click(function(){
		event.preventDefault();
		window.location.href="/tmq/member-chart.php?user_id="+$("#mem-myWorklog").attr("value")+"&username="+$("#mem-myWorklog").attr("name");
	});
	
	$("#memWorkLog-Cancel,#Cancel-member").click(function(){
		event.preventDefault();
		window.location.href="/tmq/member-dashboard.php?user_id="+event.target.getAttribute("uid")+"&username="+event.target.getAttribute("un");
	});
	
	//timer buttons
	$("#start-pause-btn").click(function(){
		event.preventDefault();
		setDate();
		// pass start-date
		if(!startedTimeLog){
			$.ajax({
				url: "start-and-end-api.php?task_id="+$("#mem-prsnlWorkLog-selection").val()+"&start_date="+date+"&start_time="+strtTime,		
				success: function(){
					console.log("success");	
					startedTimeLog = true;
				}
			});	
		}
		//
		if(pause%2!=0){
			$.when($(event.target).html("Start")).then(function(){
				clearInterval(Interval);
				$("#tot-breaks").attr("value",breaksCtr);
			});	
		}else{
			$.when($(event.target).html("Pause")).then(function(){
				Interval = setInterval(startTimer,1000);
				breaksCtr++;
			});	
		}
		pause++;
	});
	$("#reset-btn").click(function(){
		event.preventDefault();
		resetTimer();
		breaksCtr = 0;
		$("#tot-breaks").attr("value",breaksCtr);
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
			hr + ":" + min + ":" + sec				  
								 );
	};
	function resetTimer(){
		let sec = 0;
		let min = 0;
		let hr  = 0;
		clearInterval(Interval);
		$("#elapsed-timer").attr("value","0 : 0 : 0");
		startedTimeLog = false;
	}
	function setDate(){
		
		let dateObj = new Date();
		let y = dateObj.getFullYear();
		let m = dateObj.getMonth()+1;
		let d = dateObj.getDate();
		let mF;
		let dF;
		
		

		let stSec = dateObj.getSeconds();
		let stMin = dateObj.getMinutes();
		let stHr = dateObj.getHours();
		// F = format
		let stSecF;
		let stMinF;
		let stHrF;

		if(stSec<10){
			stSecF = "0"+stSec;
		}else{
			stSecF = stSec;
		}
		if(stMin<10){
			stMinF = "0"+stMin;
		}else{
			stMinF = stMin;
		}
		if(stHr<10){
			stHrF = "0"+stHr;
		}else{
			stHrF = stHr;
		}
		if(m<10){
			mF = "0"+m;
		}else{
			mF = m;
		}
		if(d<10){
			dF = "0"+d;
		}else{
			dF = d;	
		}
		date = y+"-"+mF+"-"+dF;
		strtTime = stHrF+":"+stMinF+":"+stSecF;
	}
	//
	
});
