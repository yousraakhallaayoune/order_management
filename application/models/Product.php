<?php

class Application_Model_Product
{
	public function getAllProducts(){

		try {
			

			$db = new Application_Model_DbConn();
			$conn = $db->conn();

			$statement = "SELECT productId, productName FROM product";

			$result = $conn->fetchAll($statement);
			
			return $result;


    	} catch (Exception $e) {
			echo $e; 
		}
	}

	public function getPriceProduct($productId){

		try {
			

			$db = new Application_Model_DbConn();
			$conn = $db->conn();

			$statement = "SELECT productPrice FROM product WHERE productId ='".$productId."'";

			$result = $conn->fetchAll($statement)[0]["productPrice"];

			$price = (float)$result;
			return $price;


    	} catch (Exception $e) {
			echo $e; 
		}
	}

}

