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
			<input type="time" />	
	</div>

	<div class="row time-timer-container">
			<h3><strong>Log</strong></h3>
			<button id="selct-time-btn" class="btn btn-primary">Select by Time</button>
			<button id="selct-timr-btn" class="btn btn-primary">Select by Timer</button>
		<hr>
		<table id="time-form" class="table table-bordered">
		 	<tr>
		 		<td><input type="time" /></td>		 		
		 	</tr>
		 
			 <tr>
                <td>Location</td>
                <td><input type="text" class="form-control"/></td>
            </tr> 
            <tr>
                <td>Collaborated with</td>
                <td><input type="text" class="form-control"/></td>
            </tr> 
            <tr>
                <td>Description</td>
				<td><textarea class="form-control" rows="5"></textarea></td>
            </tr> 
			
		</table>
		<table id="timer-form" style="display:none">
			<tr>
				<td>
					<input id="elapsed-timer" type="text" placeholder="00:00" class="text-center" disabled/>
				</td>
				<td>
					<button id="start-pause-btn" class="btn btn-primary">Start</button>
				</td>
				<td>
					<button id="reset-btn" class="btn btn-danger">Reset</button>
				</td>
				
			</tr>
			
		</table>

	</div>
		<hr>
		<div>
			<button class="btn btn-danger" id="Cancel">Cancel</button>
			<input type="submit" class="btn btn-primary" name="submit" value="Save" />
		</div>
</div>
<?php 
	
include_once 'footer.php';	
?>