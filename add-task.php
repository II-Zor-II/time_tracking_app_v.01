<?php 

include_once dirname(__FILE__)."/".'header.php';
include_once dirname(__FILE__)."/".'db/db.php';
include_once dirname(__FILE__)."/".'objects/task.php';
include_once dirname(__FILE__)."/".'objects/category.php';

	$database = new Database();
	$db = $database->getConnection();


?>

<form action='add-task.php' method='post'>
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Select Category</td>
			<td>
				<select name="task-category">
					<option value="" disabled selected>Select Category</option>
					<?php 
					$category = new Category($db);					
					$stmt = $category->readCategory();
					$total_category = $category->countAll();
					if($total_category>0){
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);
						echo "<option value='{$category_id}'>{$category_name}</option>";
						}		
					}
					?>
				</select>	
            </td>
        </tr> 
        <tr>
            <td>Task Name</td>
            <td>
            	<textarea name='task-name' class='form-control' value=""></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
               <button class="btn btn-danger" id="Cancel">Cancel</button>
                <button type="submit" class="btn btn-primary" name="submit">Add</button>
            </td>
        </tr>
    </table>
</form>

<?php 
if(isset($_POST['submit'])){	
	if(!empty($_POST['task-category'])&&!empty($_POST['task-name'])){
		$task = new Task($db);
		$task->add_task($_POST['task-category'],$_POST['task-name']);
	}else{
		echo '<script language="javascript">';
		echo 'alert("Please Fill out the Form")';
		echo '</script>';
	}
}



include_once 'footer.php';
?>