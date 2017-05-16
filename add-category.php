<?php 

include_once dirname(__FILE__)."/".'header.php';
include_once dirname(__FILE__)."/".'db/db.php';
include_once dirname(__FILE__)."/".'objects/category.php';
if(!empty($_POST)){
	$database = new Database();
	$db = $database->getConnection();
}

?>
<h1>Add Category</h1>
<hr>
<form action='add-category.php' method='post'>
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td><input type='text' name='task-category' class='form-control'/></td>
        </tr> 
        <tr>
            <td>
               <button class="btn btn-danger" id="Cancel">Cancel</button>
                <button type="submit" class="btn btn-primary" name="submit">Add</button>
            </td>
        </tr>
    </table>
</form>

<?php 
if(isset($_POST['submit'])){	
	if(!empty($_POST['task-category'])){
		$team = new Category($db);
		$team->createCategory($_POST['task-category']);
	}else{
		echo '<script language="javascript">';
		echo 'alert("Please Fill out the Form")';
		echo '</script>';
	}
}

include_once 'footer.php';
?>