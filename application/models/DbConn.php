<?php

class Application_Model_DbConn
{
	public function conn(){
		
		
		$connParams = array("host" => "localhost",
							"username" => "root",
							"password" => "root",
							"dbname" => "orders_management");
		$db = new Zend_Db_Adapter_Pdo_Mysql($connParams);

		return $db;
			
	}

}

