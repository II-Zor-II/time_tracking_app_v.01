<?php
include_once 'header.php';

?>

<!--Display Worklog member here-->
<div class="container">
	<h1>NEW WORKLOG</h1>
	<hr>
	<div class="row">
		<div class="col-xs-6">
			<label>Task</label>
			<select name="" id="">
								
			</select>
		</div>
		<div class="col-xs-6">
			<label>Timeframe</label>
			<input disabled/ value="09/22/2015 -> 02:30:00">
		</div>	
	</div>
	<div class="row">
			<label>Clock in</label>
			<input disabled/ type="time"/>	
	</div>
	<div class="row time-timer-container">
		
		
	</div>
		<div>
			<button class="btn btn-danger" id="Cancel">Cancel</button>
			<input type="submit" class="btn btn-primary" name="submit" value="Add" />
		</div>
</div>
<?php 
	
include_once 'footer.php';	
?>