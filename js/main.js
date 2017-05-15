
$(document).ready(function(){
	//hides certain selection boxes
	$('#mem-options').hide();
	//--------------------------
	$('#logout-btn').click(function(){
		window.location.href="/tmq/index.php";
	});
	//
	$("#add-member-btn").click(function(){
		window.location.href="/tmq/add-member.php";
	});
	$("#add-team-btn").click(function(){
		window.location.href="/tmq/add-team.php";
	});
	$("#add-category-btn").click(function(){
		window.location.href="/tmq/add-category.php";
	});
	$("#add-task-btn").click(function(){
		window.location.href="/tmq/add-task.php";
	});
	$("#add-timeframe-btn").click(function(){
		window.location.href="/tmq/add-timeframe.php";
	});
	$('.admin-mem-tfBtn').click(function(){
		window.location.href="/tmq/member-timeframe.php?user_id="+$(this).attr("value")+"&username="+$(this).attr("name");
	});
	$('.admin-mem-worklog').click(function(){
		console.log("test");
		window.location.href="/tmq/member-work-log.php?user_id="+$(this).attr("value")+"&username="+$(this).attr("name");
	});
	//
	$("#Cancel").click(function(){
		event.preventDefault();
		window.location.href="/tmq/admin-dashboard.php";
	});
	// Create a new password on page load
	$("#memPwG-btn").click(function(){
		event.preventDefault();
		var generatedPw = randString();
		$("#password-input").attr("placeholder",generatedPw);
		$("#password-input").val(generatedPw);
	});
	
	$("#password-input").ready(function(){
		var generatedPw = randString();
		$("#password-input").attr("placeholder",generatedPw);
		$("#password-input").val(generatedPw);
	});
	
	//
	$("#timeFrame-team-selector").change(function(){
		$('#tf-teamMembers').find('option').remove();
		$.ajax({
			url: "team-member-list.php?team_name="+event.target.value, 	
			success: function(result){
				$('#mem-options').show();
				$("#tf-teamMembers").append('<option value="" disabled selected>Select a member</option>');
				var x = JSON.parse(result);
				for(i=0;i<Object.keys(x).length;i++){
					$("#tf-teamMembers").append('<option value="'+x[i].user_id+'">'+x[i].username+'</option>');
				}
    		}
		});	
		
	});
	
	//add-timeframe functions with AJAX
	$("#tf-task-categ").change(function(){
		
		$('#tf-task-selection').find('option').remove();
		console.log("AJAX response");
		$.ajax({
			url: "category_task_list.php?category_id="+event.target.value, 	
			success: function(result){
        		console.log(result);
				//$("#tf-task-selection")
				var x = JSON.parse(result);
				$("#tf-task-selection").append('<option value="" disabled selected>Select a Category</option>');
				for(i=0;i<Object.keys(x).length;i++){
					$("#tf-task-selection").append('<option value="'+x[i].task_id+'">'+x[i].task_name+'</option>');
				}
    		}
		});	
	});
	//
	
	$("#convertToExcel").click(function(e){
		 e.preventDefault();
		console.log("test");
		//getting data from our table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('memberWorkLog');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');

		var a = document.createElement('a');
		a.href = data_type + ', ' + table_html;
		a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
		a.click();
	});

});


function randString(){

  var possible = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  var dataSet = possible.split(','); 
  var text = '';
  for(var i=0; i < 6; i++) {
	text += possible.charAt(Math.floor(Math.random() * possible.length));
  }
  return text;
}


/*
<button class="btn btn-primary" id="add-member-btn">Add Member</button>
		<button class="btn btn-primary" id="add-team-btn">Add Team</button>
		<button class="btn btn-primary" id="add-category-btn">Add Category</button>
		<button class="btn btn-primary" id="add-task-btn">Add Task</button>
		<button class="btn btn-success" id="add-timeframe-btn">Timeframe</button>
*/