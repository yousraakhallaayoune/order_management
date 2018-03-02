<?php

class Application_Model_Order
{
	public function addOrder($userId, $productId, $quantity){

		
		try {
			
			$quantity = (int)$quantity;
			$price = $this->discount($productId, $quantity)[0];
			$discount = $this->discount($productId, $quantity)[1];

			$db = new Application_Model_DbConn();
			$conn = $db->conn();

			$statement_order = array("userId" => $userId,"orderDate" => date("Y-m-d h:i:s"));
			$conn->insert('orders', $statement_order);

			$statement = "SELECT orderId FROM orders ORDER BY orderId DESC LIMIT 1 ";

			$sumOrder = (int)$conn->fetchAll($statement)[0]["orderId"];
			

			
			$statement_order_detail = array("orderId" => ($sumOrder), "productId" => $productId ,"quantity" => $quantity,"price" => $price,"discount" =>$discount );

			
			
			$conn->insert('order_detail',$statement_order_detail);
			
			


    	} catch (Exception $e) {
			echo $e; 
		}

	}

	public static function discount($productId, $quantity){
		$price = 0;
		$discount = 0;

		$modelProduct = new Application_Model_Product();
		$productPrice = $modelProduct->getPriceProduct($productId);

		
		if($productId == "3" && $quantity==3){
			$discount = .8;
			$price = ($productPrice * $quantity)* $discount;

		} else{
			$discount = 0;
			$price = $productPrice * $quantity;
			
		}

		return [$price, $discount];

	}

	public function simpleEditOrders(){

		$db = new Application_Model_DbConn();
		$conn = $db->conn();

		$statement = "SELECT  user.userName,  orders.orderDate, order_detail.quantity, order_detail.price , product.productName, product.productPrice, orders.orderId
					FROM orders
					INNER JOIN user ON  user.userId = orders.userId
					INNER JOIN order_detail ON order_detail.orderId = orders.orderId
					INNER JOIN product ON order_detail.productId = product.productId";

		$orders = $conn->fetchAll($statement);
		
		return $orders;

	}

	public function updateOrder($orderId, $userId, $productId, $quantity){

		$db = new Application_Model_DbConn();
		$conn = $db->conn();

		

		$price = $this->discount($productId, $quantity)[0];
		$discount = $this->discount($productId, $quantity)[1];

		


		$condition = "orderId = '".$orderId."'";
		$update_order = array(
			"userId" => $userId, 
			);
		$conn->update('orders',$update_order, $condition);

		$update_detail = array(
			 
			"productId" => $productId,
			"quantity" => $quantity,
			"price" => $price,
			"discount" => $discount
			);
		$conn->update('order_detail',$update_detail, $condition);

	}

	public function deleteOrder($orderId){
		$db = new Application_Model_DbConn();
		$conn = $db->conn();

		$condition = "orderId = '".$orderId."'";

		$orders = $conn->delete('orders',$condition );

		$orders = $conn->delete('order_detail',$condition );


	}
	public function editOrders($date,$search ){

		$db = new Application_Model_DbConn();
		$conn = $db->conn();

		$statement = "SELECT user.userName,  orders.orderDate, order_detail.quantity, order_detail.price , product.productName, product.productPrice, orders.orderId  FROM orders 
					INNER JOIN user ON  user.userId = orders.userId
					INNER JOIN order_detail ON order_detail.orderId = orders.orderId
					INNER JOIN product ON order_detail.productId = product.productId";

		if(strlen($date)>0 && strlen($search)>0):
			$condition = $statement." WHERE user.userName LIKE '%".$search."%' OR product.productName LIKE '%".$search."%' AND orders.orderDate between date_sub(now(),INTERVAL 1 WEEK) and now() ";

			$orders = $conn->fetchAll($condition);
			
		elseif(strlen($date)>0):			
			switch($date){
				case 'all':
					$orders = $conn->fetchAll($statement);
				break;
				case 'week':
					
				$condition = $statement." WHERE orders.orderDate between date_sub(now(),INTERVAL 1 WEEK) and now();
							";
				
					$orders = $conn->fetchAll($condition);
				break;
				case 'today':
					$condition = $statement." WHERE DATE(orders.orderDate) = CURDATE()";
				
					$orders = $conn->fetchAll($condition);

				break;
			}
		elseif(strlen($search)>0):
			$condition = $statement." WHERE user.userName LIKE '%".$search."%' OR product.productName LIKE '%".$search."%'";
				
					$orders = $conn->fetchAll($condition);

		else:
			$orders = $this->simpleEditOrders();
		endif;	
		
		
		return $orders;
	}

}

