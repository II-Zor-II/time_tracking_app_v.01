<?php
include_once 'header.php';

?>

<button class="btn">Register</button>
<form class="" method="post" action="log-in.php">
	<div class="form-group">
		<div class="col-sm-6">
			<label for="username" class="col-sm-2 control-label">Username</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="" /> </div>
		<div class="col-sm-6">
			<label for="password" class="col-sm-2 control-label">Password</label>
			<input type="text" class="form-control" id="password" name="password" placeholder="" /> </div>
		<input type="submit" name="submit" class="btn btn-primary">
	</div>
	
</form>
<?php 	
	
include_once 'footer.php';	
?>