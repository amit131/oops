<?php
class category{
	
public $dbConnection = null;

public function __construct($conn){
	$this->dbConnection = $conn;
}
	
public function newCat(){
	if(isset($_REQUEST['cat_name'])){
		$sql = "insert into categories values('','$_REQUEST[cat_name]','$_REQUEST[parent]')";
		if($this->dbConnection){
			$result = mysqli_query($this->dbConnection,$sql);
			if($result){
				echo "<span class='success'>Category $_REQUEST[cat_name] has been saved</span>";
				exit(0);
			}else{
				echo "<span class='error'>Category $_REQUEST[cat_name] could not be saved. Please try again..</span>";
				exit(0);
			}
		}
	}
	$data = '';
	$d = array();
	$sql = "select * from categories where parent=0";
	if($this->dbConnection){
		$result = mysqli_query($this->dbConnection,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$data[$row['id']] = $row['name'];
		}
	}
	//print_r($data);
	$f =  Form_API::beginForm('category','post','http://localhost/u_custom/category/newCat/','','ajax');
	$f .= Form_API::input('Category Name','text',array('#name'=>'cat_name'),true,false,'Add New Category','');
	$f .= Form_API::input('Parent','select',array('#name'=>'parent'),true,false,'',array('empty',$data));
	$f .= Form_API::input('','submit',array('#name'=>'submit','#value'=>'Save'),true,false,'','');
	$f .= Form_API::endForm();
	return print $f;
}


public function listCats(){
	return "List of categories has been called";
}


}