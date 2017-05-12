<?php 

include_once 'header.php';
include_once 'db/db.php';
include_once 'objects/team.php';
if(!empty($_POST)){
	$database = new Database();
	$db = $database->getConnection();
}
session_start();

if (isset($_POST['team-name'])) { 
 $_SESSION['team-name'] = $_POST['team-name'];
 } 
if (isset($_POST['team-desc'])) { 
 $_SESSION['team-desc'] = $_POST['team-desc'];
 } 
?>

<form action='' method='post'>
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='team-name' class='form-control' value="<?php if(!empty($_SESSION['team-name'])){echo $_SESSION['team-name']; }?>"/></td>
        </tr> 
        <tr>
            <td>Description</td>
            <td><textarea name='team-desc' class='form-control' value="
            	
            <?php if(!empty($_SESSION['team-desc'])){echo $_SESSION['team-desc']; }?>"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
               <button class="btn btn-danger" id="Cancel">Cancel</button>
                <button type="submit" class="btn btn-primary" name="submit">Add Team</button>
            </td>
        </tr>
    </table>
</form>

<?php 
if(isset($_POST['submit'])){	
	if(!empty($_POST['team-name'])&&!empty($_POST['team-desc'])){
		$team = new Team($db);
		$team->createTeam($_POST['team-name'],$_POST['team-desc']);
	}else{
		echo '<script language="javascript">';
		echo 'alert("Please Fill out the Form")';
		echo '</script>';
	}
}



include_once 'footer.php';
?>