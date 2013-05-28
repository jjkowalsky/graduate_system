<?php
//include("include.php");

class User {
	private $id;

	public function __construct($i) {
		$this->id = $i;
	}

	 //return user id
  public function getID() {
    return $this->id;
  }

	public function get_user() {
    $get_user = "SELECT * FROM USERS WHERE userID='{$this->getID()}'";
    return mysql_query($get_user);
  }

	//check if user id exists in selected table
	public function checkUserId($user_id,$table_name)
	{
		//$next_query="SELECT * FROM USERS";
		if($table_name=="CHAIR") { 
			$next_query="SELECT * FROM ".$table_name." WHERE chairID=".$user_id."";
		}
		elseif($table_name=="FACULTY") { 
			$next_query="SELECT * FROM ".$table_name." WHERE facultyID=".$user_id."";
		}
		elseif($table_name=="GRAD_SECT") { 
			$next_query="SELECT * FROM ".$table_name." WHERE gsID=".$user_id."";
		}
		elseif($table_name=="ALUMNI") { 
			$next_query="SELECT * FROM ".$table_name." WHERE facultyID=".$user_id."";
		}
		elseif($table_name=="STUDENT") { 
			$next_query="SELECT * FROM ".$table_name." WHERE userID=".$user_id."";
		}
		elseif($table_name=="ADVISOR") { 
			$next_query="SELECT * FROM ".$table_name." WHERE advisorID=".$user_id."";
		}
		elseif($table_name=="SYS_ADMIN") { 
			$next_query="SELECT * FROM ".$table_name." WHERE adminID=".$user_id."";
		}
		elseif($table_name=="APPLICANT") { 
			$next_query="SELECT * FROM ".$table_name." WHERE applicantID=".$user_id."";
		}
		else {
			echo "Not a recognized user table";
		}
		
		$result= mysql_query($next_query);
		if (empty($result)) {
			echo "No result*******************";
			$next_query="SELECT * FROM USERS";
			$result= mysql_query($next_query);
		}
	return $result;
	}//end check user by id
}//end user class

	function checkUserId($user_id,$table_name)
	{
		//$next_query="SELECT * FROM USERS";
		if($table_name=="CHAIR") { 
			$next_query="SELECT * FROM ".$table_name." WHERE chairID=".$user_id."";
		}
		elseif($table_name=="FACULTY") { 
			$next_query="SELECT * FROM ".$table_name." WHERE facultyID=".$user_id."";
		}
		elseif($table_name=="GRAD_SECT") { 
			$next_query="SELECT * FROM ".$table_name." WHERE gsID=".$user_id."";
		}
		elseif($table_name=="ALUMNI") { 
			$next_query="SELECT * FROM ".$table_name." WHERE facultyID=".$user_id."";
		}
		elseif($table_name=="STUDENT") { 
			$next_query="SELECT * FROM ".$table_name." WHERE userID=".$user_id."";
		}
		elseif($table_name=="ADVISOR") { 
			$next_query="SELECT * FROM ".$table_name." WHERE advisorID=".$user_id."";
		}
		elseif($table_name=="SYS_ADMIN") { 
			$next_query="SELECT * FROM ".$table_name." WHERE adminID=".$user_id."";
		}
		elseif($table_name=="APPLICANT") { 
			$next_query="SELECT * FROM ".$table_name." WHERE applicantID=".$user_id."";
		}
		else {
			echo "Not a recognized user table";
		}
		
		$result= mysql_query($next_query);
		if (empty($result)) {
			echo "No result*******************";
			$next_query="SELECT * FROM USERS";
			$result= mysql_query($next_query);
		}
	return $result;
	}//end check user by id

?>


