<?php 

include_once 'header.php';


?>

<form action='add-team.php' method='post'>
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='team-name' class='form-control' /></td>
        </tr> 
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
               <button class="btn btn-danger" id="Cancel">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Team</button>
            </td>
        </tr>
 
    </table>
</form>

<?php 

include_once 'footer.php';

?>