
// totalhours, task task task task
$(document).ready(function(){
	
	console.log($("#chartUserId").val());
	$.ajax({
		url: "chart-api.php?user_id="+$("#chartUserId").val(), 	
		success: function(result){
			console.log(result);
			//$("#tf-task-selection")
			let x = JSON.parse(result);
			$("#chart-member-name").html(x[0]+" Chart Report");
			x.shift();
			console.log(x);
			let taskLabels =  x.filter(function(e, i) { // e for element, i for index
			  return (i % 2 === 0);
			});
			let taskTimeSpent = x.filter(function(e,i){
			  return (i % 2 != 0);
			});
			console.log(taskLabels);
			console.log(taskTimeSpent);
			let taskTimeSpentFormatted = taskTimeSpent.map(function(time){
				return TimeToSeconds(time); // return the sum of the timespent into total seconds
			});
			console.log(taskTimeSpentFormatted);
			drawChart(taskLabels,taskTimeSpentFormatted);
		}
	});	
	function TimeToSeconds(timeStr){
		let a = timeStr.split(":");
		let hrs = a[0]*3600;
		let min = a[1]*60;
		let sec = parseInt(a[2]);
		let totalSec = hrs+min+sec;
		return totalSec;
  	}
});

function drawChart(taskLabels,taskTimeSpentFormatted){
	const CHART = $("#memberChart");
	let colors = [];
	for(i=0;i<taskLabels.length;i++){
		let rdc = getRandomColor();
		colors.push(rdc);	
	}
	
	let pieChart = new Chart(CHART, {
		type: 'pie',
		data: {
				labels: taskLabels,
				datasets: [
					{
						data: taskTimeSpentFormatted,
						backgroundColor: colors
					}
				]
			  },
		
	}); 

}
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

/*tot : 16.04.19

12.01.00
04.03.00
00.00.19

*/