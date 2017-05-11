<?php
include_once 'header.php';

?>

<h3>Add Member</h3>
<hr>
<form class="form-horizontal" action="/add-member.php">
    <div class="form-group">
      <label class="control-label col-sm-2" for="team">Team</label>
      <div class="col-sm-10">
        <select name="team"><option value="">TMQ</option></select> <!--to be php-->
      </div>
	</div>
	<div class="form-group">
      <label class="control-label col-xs-2" for="position">Postion:</label>
      <div class="col-xs-8">          
        <input type="text" class="form-control" id="position" placeholder="ex. Web Designer" name="position">
      </div>		
	</div>
	<div class="form-group">
		<label class="control-label col-xs-2" for="settings">Settings:</label>
		<div class="col-xs-8">
		  	<label class="radio-inline"><input type="radio" name="clock">Clock Only</label>
  			<label class="radio-inline"><input type="radio" name="timer">Timer Only</label>
			<label class="radio-inline"><input type="radio" name="both">Both</label>
		</div>
	</div>
		
	<div class="form-group">
	<label class="control-label col-xs-2" for="mem-username">Username: </label>
     <div class="col-xs-8">          
        <input type="text" class="form-control" id="mem-username" placeholder="username" name="mem-username">
	 </div>
	</div>
	<div class="form-group col-xs-12">
		<label class="control-label col-xs-2" for="mem-password">Password: </label>
		<div class="input-group col-xs-3" name="mem-password">		  
		  <input type="text" class="form-control" placeholder="S7kX1eDu" aria-describedby="sizing-addon1" disabled/>
		  <span class="input-group-addon" id="sizing-addon1"><button>again</button></span>
		</div>
	</div>
	<div>
		<button class="btn btn-danger" id="Cancel">Cancel</button>
		<button type="submit" class="btn btn-primary">Add Member</button>	
	</div>
</form>

<?php 
include_once 'footer.php';	
?>