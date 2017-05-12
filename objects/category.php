
<?php

class Category{
	
	private $category_id;
	private $category_name;

	private $con;
	private $table_category = "category";
	
	public function __construct($db){
		//instantiate variables on create here
		$this->con = $db;
	}

	
	public function readCategory(){
		$query = "SELECT * FROM ".$this->table_category."";
		
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		
		return $stmt;
	}
	
	public function countAll(){
		$query = "SELECT category_id FROM ".$this->table_category."";

		$stmt = $this->con->prepare($query);
		$stmt->execute();

		$num = $stmt->rowCount();
		return $num;
	}
    
	public function createCategory($category_name){
		
		$query = "INSERT INTO ".$this->table_category." SET category_name=?";
		
		$this->category_name = $category_name;
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->category_name);
		if($stmt->execute()){
			echo '<script language="javascript">';
			echo 'alert("Category Created");';
			echo '</script>';
		}else{
			echo '<script language="javascript">';
			echo 'alert("Category Creation Failed")';
			echo '</script>';
		}
	}
	
}


?>