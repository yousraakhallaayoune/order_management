<?php

class OrderController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
                // $modelUser = new Application_Model_User();
                // $users = $modelUser->getAllUsers();
        
                // $this->view->users = $users;
        
                // $modelProduct = new Application_Model_Product();
        
                // $products = $modelProduct->getAllProducts();
        
                // $this->view->products = $products;
    }

    public function addOrderAction(){

        
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isPost()){
                                
                    $params = $this->_request->getParams();
                    
        
                    $modelOrder = new Application_Model_Order();
                    
                    
                    
                    $modelOrder->addOrder($params["user"], $params["product"], $params["quantity"]);
                }
                $this->_redirect ( $this->view->url ( array ('action' => 'edit-orders', 'controller' => 'order'), 'default', true ) );
    }

    public function editOrdersAction()
    {
        
        $modelOrder = new Application_Model_Order();
        $orders = $modelOrder->simpleEditOrders();
                
        $modelProduct = new Application_Model_Product();
        $products = $modelProduct->getAllProducts();
        $this->view->products = $products;

        $modelUser = new Application_Model_User();
        $users = $modelUser->getAllUsers();
        $this->view->users = $users;

        if($this->_request->isPost()){
                                
            $params = $this->_request->getParams();
            $orders = $modelOrder->editOrders($params["date"],$params["search"]);
            
        }        
                
                $this->view->orders = $orders;
    }

    public function updateOrdersAction(){
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isPost()){
                                
                    $params = $this->_request->getParams();
                    
                    $modelOrder = new Application_Model_Order();
                    
                    $modelOrder->updateOrder((int)$params["orderId"],(int)$params["user"], (int)$params["product"],(int) $params["quantity"]);
                }
                $this->_redirect ( $this->view->url ( array ('action' => 'edit-orders', 'controller' => 'order'), 'default', true ) );
    }

    public function deleteOrderAction(){

        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isPost()){
                                
                    $params = $this->_request->getParams();
        
                    $modelOrder = new Application_Model_Order();
                   
                    $modelOrder->deleteOrder($params["orderId"]);
        
        
                }
                $this->_redirect ( $this->view->url ( array ('action' => 'edit-orders', 'controller' => 'order'), 'default', true ) );
    }

    // public function searchOrdersAction()
    // {
    //     if($this->_request->isPost()){
                                
    //         $params = $this->_request->getParams();
    //        //var_dump($params);die;
            
    //         $modelOrder = new Application_Model_Order();
    //         $orders = $modelOrder->searchOrders($params["date"],$params["search"]);
    //         $this->view->orders = $orders;
    //     }
    // }


}











