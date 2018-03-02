<?php

class Application_Model_User
{
	public function getAllUsers(){

		try {
			

			$db = new Application_Model_DbConn();
			$conn = $db->conn();

			$statement = "SELECT userId, userName FROM user";

			$result = $conn->fetchAll($statement);
			
			return $result;


    	} catch (Exception $e) {
			echo $e; 
		}
	}

}

