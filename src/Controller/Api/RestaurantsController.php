<?php
namespace App\Controller\Api;
    
use App\Controller\AppController;

use Cake\Event\Event; 

use Cake\Routing\Router;

use Cake\Mailer\Email;     
use Cake\Datasource\ConnectionManager;    

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
/**
 * Stores Controller
 *
 * @property \App\Model\Table\StoresTable $Stores
 *
 * @method \App\Model\Entity\Store[] paginate($object = null, array $settings = [])
 */
class RestaurantsController extends AppController
{

      
    public function initialize()
    { 
        parent::initialize();
        $this->loadComponent('Cart');    
    }
    
    public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

      $this->viewBuilder()->setLayout('ajax');

        $this->Auth->allow();   

        $this->authcontent();   
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
	 
	public function adminemail(){ 
		$this->loadModel('Settings');
		$seting = $this->Settings->find('all',['conditions'=>['Settings.key'=>'admin_contact_mail']])->first();
	    return $seting->value;
	}  
	 
    public function index()
    {

       $rest = $this->Restaurants->find('all')->toArray(); 
	   if($rest){
		  $response['status'] = true;
          $response['msg'] = $rest;
	   }else{
		  $response['status'] = false;
          $response['msg'] = 'Data not found!';
	   }
	   $this->set(compact('response')); 
     $this->set('_serialize', ['response']);
    }


    

     


    /************************Add to Cart module********************************/
    
    public function clear() {
    $sesid = $this->request->session()->id();
    $uid = $this->Auth->user('id'); 
      $this->Cart->clear();
      $this->loadModel('Carts');
      $this->Carts->deleteAll(array('Carts.uid'=>$uid,'Carts.sessionid'=>$sesid));
      $this->Flash->error(__('All item(s) removed from your shopping cart'));    
        return $this->redirect('/');
    }
    
      public function addtocart() {
        $this->loadModel('Carts');
        if ($this->request->is('post')) {
             $uid = $this->request->data['user_id'];
             if(!empty($uid)){ 
               $uid = $uid;  
             }else{
                 $uid = 0 ;
             }
            $id = $this->request->data['pid'];  

            $quantity = isset($this->request->data['quantity']) ? $this->request->data['quantity'] : null;

            $productmodId = isset($this->request->data['mods']) ? $this->request->data['mods'] : null;
            $exits = $this->Carts->find('all',array('conditions'=>array('AND'=>array('Carts.product_id'=>$id,'Carts.sessionid'=>$this->request->session()->id()))));
            $exits = $exits->first();   
            
            $cartfind = $this->Carts->find('all',array(
                'conditions'=>array('Carts.uid'=>$uid,'Carts.sessionid'=>$this->request->session()->id())
                )); 
            $cartfind = $cartfind->first();   
            
            if(!empty($exits)){
				 $response['status'] = false;
                 $response['msg'] = 'Product is already added in your cart.';
    
             // $product = true; 
            }else{
            $product = $this->Cart->add($id, $quantity, $productmodId,$uid);  
                if(!empty($product)) {
				  $response['status'] = true;
                  $response['msg'] = $product['name'] . ' is added to your cart successfully.';					
      
                } else {  
				 $response['status'] = false;
                 $response['msg'] = 'Unable to add this product to your shopping cart.';


                } 
            
            }
            

            
        }  
     $this->set(compact('response')); 
     $this->set('_serialize', ['response']);   
       
    }



   public function cart() {    
        $shop = $this->request->session()->read('Shop');
   
        $this->set(compact('shop')); 
    }
    
    public function remove($id = null) {
        $product = $this->Cart->remove($id);
        if(!empty($product)) {
		    $response['status'] = true;
            $response['msg'] = $product['Product']['name'] . ' was removed from your shopping cart';
        }else{
		   $response['status'] = false;
           $response['msg'] = 'Something wrong try again.';	
		} 
     $this->set(compact('response')); 
     $this->set('_serialize', ['response']);
    }
    


      public function displaycart($uid,$sid){
        $this->loadModel('Carts');
        $this->loadModel('Products');
        $this->loadModel('Users');
        $shop = $this->Carts->find('all', array(
       'contain' => array( 
                     'Products',
                ), 
           'conditions' => array(      
               'AND' => array(
                   'Carts.uid' =>$uid,
                   'Carts.sessionid' => $sid  
       ))   
       )); 

        $shop = $shop->all();  
        $shop = $shop->toArray(); 
   
        $quantity = 0;
        $weight = 0;
        $subtotal = 0;
        $total = 0;
        $order_item_count = 0;
        $cartparent=array();
        $cartdata = array();
        $cart_using_dates = array(); 
    
        foreach ($shop as $key => $value) {
            
             if($value['product']['image']){   
             $value['product']['image'] = Router::url('/', true)."images/products/". $value['product']['image'];
             }else{
             $value['product']['image'] = Router::url('/', true)."images/products/no-image.jpg";   
             }
          $cart_using_dates[] =$value;
       
        }

        if (count($shop) > 0) {
            foreach ($shop as $item) {
                $quantity += $item['quantity'];
                $weight += $item['weight'];
                $subtotal += $item['subtotal'];
                $total += $item['subtotal']; 
                
                $order_item_count++;   
            }


            $this->request->session()->write('cart_count',$quantity);      
            $d['order_item_count'] = $order_item_count;
            $d['quantity'] = $quantity;
            $d['weight'] = sprintf('%01.2f', $weight);
            $d['subtotal'] = sprintf('%01.2f', $subtotal);
            $d['total'] = sprintf('%01.2f', $total); 
         
           
             
            $cart['cartInfo']=$d; 
        $cart['cartcount']= $quantity;  
            $cart['products']=$cart_using_dates;
 
        } else {
            $this->request->session()->write('cart_count',0);
            $d['quantity'] = 0;
            $d['weight'] = 0;
            $d['subtotal'] = 0;
            $d['total'] = 0;
            $cart['cartInfo']=$d;
            $cart['cartcount']= 0; 
            $cart['products']= $cart_using_dates;
      
        }  
        
        return $cart;    
      }
 
     public function webdisplaycart() {  
     ini_set('max_execution_time', 300); //300 seconds = 5 minutes   
	 if ($this->request->is('post')) {
		  $sid   = $this->request->data['session_id'];
          $uid = $this->request->data['user_id']; 
          $user_id= $uid?$uid:0;
          $data = $this->displaycart($user_id, $sid); 
       
    
        if (!empty($data)) { 
            $response['status'] = true;
            $response['data'] = $data;

        } else { 
            $response['status'] = false;   
            $response['data'] = "error";
        }       
	  }

	$this->set(compact('response')); 
    $this->set('_serialize', ['response']);	
       
    }




     public function webremoveitems() {
		 
		  if ($this->request->is('post')) { 
			$this->loadModel('Carts'); 
            $sid = $this->request->data['session_id'];
            $uid = $this->request->data['user_id']; 
            $id = $this->request->data['pid'];
			if(empty($id)){
				 $response['status'] = false;
                 $response['msg'] = 'Product Id required';
			}elseif(empty($sid)){
				 $response['status'] = false;
                 $response['msg'] = 'Product Id required';
			}else{
				  $cartItems = $this->Carts->find('all',array('conditions'=>array('AND'=>array('Carts.product_id'=>$id,'Carts.sessionid'=>$sid))));
            $cartItems = $cartItems->first();
                $cart = $this->Carts->get($cartItems['id']);
                $delet = $this->Carts->delete($cart);  
                if($delet){
                 $response['status'] = true;
                 $response['msg'] = 'Deleted';     
                }else{
                 $response['status'] = false;
                 $response['msg'] = 'Try again';    
                }
                $user_id= $uid?$uid:0;
                $data = $this->displaycart($user_id, $sid); 
        if (!empty($data)) { 
              $response['status'] = true;
              $response['data'] = $data; 
          
        } else {    
           $response['status'] = false;
           $response['data'] = 'Data not found'; 
        }   
			}
			
		  }	

        $this->set(compact('response')); 
        $this->set('_serialize', ['response']);
        }
        
        
         public function cartincreaseqty() {    
            $sesid = $this->request->data['session_id'];
            $product_id = $this->request->data['pid']; 
            if($this->request->data['user_id']){
            $uid = $this->request->data['user_id'];
            }else{
                $uid =0;
            }
             $this->loadModel('Products');
             $pro_record = $this->Products->find('all',array('conditions'=>array('Products.id'=>$product_id)));
         $pro_record = $pro_record->first();
            
            $this->loadModel('Carts');  
            $data = $this->Carts->find('all', array('contain'=>['Products'],'conditions' => array('Carts.product_id' => $product_id)));     
            $data = $data->all();
            
         
             foreach ($data as $d) { 

              $cartd = $this->Cart->checkcrt($sesid, $product_id,$uid);
    
              $product_quantity = 0; 
                    foreach ($cartd as $key => $cart_product) {
                        $product_quantity += $cart_product['quantity'];
                    }
            
            //if($product_quantity < $d['product']['quantity']){  
            if($product_quantity < 100000000000){  
             $qty = $d['quantity'] + 1;
                        $weight_total = $d['weight_total'] + $d['weight'];
                        $subtotal = $d['subtotal'] + $d['price'];
                       
             $updated = $this->Carts->updateAll(array('subtotal' => $subtotal, 'quantity' => $qty, 'weight_total' => $weight_total), array('id' => $d['id']));
           
                    }else{
                    $response['status'] = false;
                    $response['msg'] = 'Available Item(s) in Stock : '.$d['product']['quantity'];   
                  }     
    
        }
             $user_id= $uid?$uid:0;   
             $data = $this->displaycart($user_id, $sesid);  
             $response['status'] = true;
             $response['data'] = $data; 
        $this->set(compact('response')); 
        $this->set('_serialize', ['response']);     
     
    }  
    
        public function cartdecreaseqty() { 
         $sesid = $this->request->data['session_id'];
            $product_id = $this->request->data['pid']; 
            if($this->request->data['user_id']){
            $uid = $this->request->data['user_id'];
            }else{
                $uid =0;
            }
        $this->loadModel('Carts');
         $this->loadModel('Products');
        
         $pro_record = $this->Products->find('all',array('conditions'=>array('Products.id'=>$product_id)));
         $pro_record = $pro_record->first();  
         $data = $this->Carts->find('all', array('conditions' => array('Carts.product_id' => $product_id))); 
         $data = $data->all();    

        foreach ($data as $d) {
    
            if($d['quantity']>1){
                $qty = $d['quantity'] - 1;
                $weight_total = $d['weight_total'] + $d['weight'];
                $subtotal = $d['price'] * $qty;
                $updated = $this->Carts->updateAll(array('subtotal' => $subtotal, 'quantity' => $qty, 'weight_total' => $weight_total), array('id' => $d['id'])
                ); 
            }
        
        }
             $user_id= $uid?$uid:0;   
             $data = $this->displaycart($user_id, $sesid);  
             $response['status'] = true; 
             $response['data'] = $data; 
         $this->set(compact('response')); 
        $this->set('_serialize', ['response']);  
    }
    
    
      public function platerate() { 
        $pdata = $this->request->data['pdata'];
        $dataarray = explode("-",$pdata);
        $plate = $dataarray[0];
        $product_id = $dataarray[1];
        $sesid = $this->request->data['session_id'];
        $this->loadModel('Carts');
         $this->loadModel('Products');
         if($this->request->data['user_id']){
            $uid =  $this->request->data['user_id'];
            }else{
                $uid =0;
            }
         $pro_record = $this->Products->find('all',array('conditions'=>array('Products.id'=>$product_id)));
         $pro_record = $pro_record->first();  
         $data = $this->Carts->find('all', array('conditions' => array('Carts.product_id' => $product_id))); 
         $data = $data->all();    

        foreach ($data as $d) {
    
            if($plate == 'full'){
                $qty = $d['quantity'];
                $subtotal = $pro_record['price'] * $qty;
                $price = $pro_record['price'];
                $updated = $this->Carts->updateAll(array('subtotal' => $subtotal, 'quantity' => $qty, 'price' => $price,'plate' => $plate), array('id' => $d['id'])
                ); 
            }else{
                $qty = $d['quantity'];
                $subtotal = $pro_record['price_two'] * $qty;
                $price = $pro_record['price_two'];
                $updated = $this->Carts->updateAll(array('subtotal' => $subtotal,'plate'=>$plate ,'quantity' => $qty, 'price' => $price), array('id' => $d['id'])
                );
            }
        
        }
             $user_id= $uid?$uid:0;   
             $data = $this->displaycart($user_id, $sesid);  
             $response['status'] = true; 
             $response['data'] = $data; 
        $this->set(compact('response')); 
        $this->set('_serialize', ['response']);  
    }

   

     public function payment() {
        $this->loadModel('Orders');
        $this->loadModel('OrderItems');  
        $this->loadModel('Users');
        $this->loadModel('Settings');
        $settings =  $this->Settings->find('all',['conditions'=>['Settings.key'=>'sale_commission']]); 
        $settings = $settings->first();
        $commission = $settings['value'] ;

        $uid      = $this->request->data['user_id'];
        $sesid    = $this->request->data['session_id']; 
        $shipping['name'] = $this->request->data['name'];
		$shipping['email'] = $this->request->data['email'];
		$shipping['phone'] = $this->request->data['phone'];
		$shipping['address'] = $this->request->data['address'];
		$shipping['city'] = $this->request->data['city'];
		$shipping['state'] = $this->request->data['state'];
		$shipping['zip'] = $this->request->data['zip'];
        $user_id = $uid?$uid:0;   
        $cart = $this->displaycart($user_id, $sesid);  

        $user = $this->Users->find('all',['Users.id'=>$user_id]);
        $user = $user->first();
        
        $ordername = $shipping['name']?$shipping['name']:$user['name'];
        $orderemail = $shipping['email']?$shipping['email']:$user['email'];
        $orderphone = $shipping['phone']?$shipping['phone']:$user['phone'];
        $orderaddress = $shipping['address']?$shipping['address']:$user['address'];
        $ordercountry = $user['country'];  
        $ordercity = $shipping['city']?$shipping['city']:$user['city'];
        $orderstate = $shipping['state']?$shipping['state']:$user['state'];  
        $orderzip = $shipping['zip']?$shipping['zip']:$user['zip'];  

        
        $orderdata = array();     
        if($uid){
        if($cart['cartcount'] != 0){ 

        if ($this->request->is('post')) { 
            $orders = $this->Orders->newEntity();       
            $orderdata['uid'] = $uid;
            $orderdata['name'] = $ordername;
            $orderdata['email'] = $orderemail;
            $orderdata['phone'] = $orderphone;
            $orderdata['address'] = $orderaddress;
            $orderdata['country'] = $ordercountry;
            $orderdata['city'] = $ordercity;
            $orderdata['state'] = $orderstate;
            $orderdata['zip'] = $orderzip;  
            $orderdata['order_item_count'] = $cart['cartInfo']['order_item_count'];    
            $orderdata['subtotal'] = $cart['cartInfo']['subtotal'];
            $totalcommission = 0 ;
             foreach($cart['products'] as $orderitem){
               $totalcommission += $orderitem['price']*$commission/100;   
             }
            $orderdata['commission_amount'] = $totalcommission;    
            $orderdata['total'] = $cart['cartInfo']['total'];  
            if($this->request->data['pay_method'] == 'paypal'){
                $orderdata['payment_method'] = 'paypal';
            }else{
                $orderdata['payment_method'] = 'Cash on delivery';
                $orderdata['order_status'] = 2;
            }
            $orders = $this->Orders->patchEntity($orders, $orderdata);  
            $save = $this->Orders->save($orders);  
           if ($save) { 
               $last_id = $save['id'];
              foreach($cart['products'] as $orderitem){
               $orderitems = $this->OrderItems->newEntity();         
               ;
               $orderitemsave['order_id'] = $last_id; 
               $orderitemsave['product_id'] = $orderitem['product_id'];  
               $orderitemsave['name'] = $orderitem['name'];
                 $orderitemsave['commission_amount'] = $orderitem['price']*$commission/100;   
             
               $orderitemsave['image'] = $orderitem['image'];
               $orderitemsave['quantity'] = $orderitem['quantity'];
               $orderitemsave['weight'] = $orderitem['weight'];
               $orderitemsave['price'] = $orderitem['price'];
               $orderitemsave['subtotal'] = $orderitem['subtotal'];    
               $orderitems = $this->OrderItems->patchEntity($orderitems, $orderitemsave);
               $saveitem = $this->OrderItems->save($orderitems);              
              }    
              
               $data = $this->Orders->find('all', array('contain'=>array('Users','OrderItems'),'conditions' => array('Orders.id' => $last_id)));  
               $data = $data->first()->toArray();           
               $email = new Email('default');     

                  $sendmail = $email->from([$this->adminemail() => 'Magical Zaika'])      
                        ->emailFormat('html')
                        ->template('order')
                        ->cc($this->adminemail())
                        ->to($orderemail)
                        ->subject('New Order Received!')    
                        ->viewVars(array('order' => $data))           
                        ->send();         
               
             $amt = $cart['cartInfo']['total'] ;  
			 $response['msg'] = 'Successfully order done!';
			 $response['status'] = true;
			 $response['data'] = $data; 			 
			 $this->success($user_id,$sesid,$this->request->data['transaction_id'],$amt,$this->request->data['payment_status'],$last_id);	
 
            
           }
        } 
               
        }else{
			
			$response['msg'] = 'Shopping Cart is empty';
			$response['status'] = false; 
        }
        }else{ 
			$response['msg'] = 'Please login to the website in order to have access to the request.';
			$response['status'] = false; 
        }
       $this->set(compact('response')); 
       $this->set('_serialize', ['response']); 

    }
    
      public function success($uid,$sesid,$transaction_id=null,$payment_gateway_price=null,$payment_status=null,$order_id=0) {
          
        $uid      = $uid;    
        $sesid    = $sesid; 
        $user_id = $uid?$uid:0; 
        $cart = $this->displaycart($user_id, $sesid); 
        if(empty($cart['products'])){  
			$response['msg'] = 'Shopping Cart is empty';
			$response['status'] = false;  			
        } 
        
        $this->loadModel('Products');
        $this->loadModel('Orders');
        
        if(isset($_REQUEST['tx'])){ 
                $this->Orders->updateAll(array(
                    'transaction_id'=> $transaction_id,
                    'payment_gateway_price'=>$payment_gateway_price,
                    'payment_status'=> $payment_status,
                    'order_status'=> 2    
                ),array(
                    'Orders.id'=>$order_id
                )); 
         }
        
            $data = $this->Orders->find('all', array('contain'=>['OrderItems'],'conditions' => array('Orders.id' => $order_id)));     
            $data = $data->first(); 
        // print_r($data); exit;      
         // manage stock 
         if(isset($data)){   
             foreach ($data['order_items'] as $orderItem) { 
        $product = $this->Products->find('all',array('conditions'=>array('Products.id'=>$orderItem['product_id'])));  
        $product = $product->first();
        if($product){    
            $updated_quantity = $product['quantity']-$orderItem['quantity'];
            if($updated_quantity >0){
                $this->Products->updateAll(array(
                    'quantity'=>$updated_quantity
                ),array(
                    'Products.id'=>$product['id']
                ));
            }else{
                $this->Products->updateAll(array(
                    'quantity'=>0
                ),array(
                    'Products.id'=>$product['id']
                ));
            }

        }
        
        
      }
    }
        
        $this->Cart->clear();     
		return $response;
      }
  
      public function ipn() {  
        $fc = fopen('ipn_data.txt', 'wb');
        ob_start();
        print_r($_REQUEST);
        $req = 'cmd=' . urlencode('_notify-validate');
        foreach ($_REQUEST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.developer.paypal.com'));
        $res = curl_exec($ch);
        curl_close($ch);
        if (strcmp($res, "VERIFIED") == 0) {
            $custom_field = $_REQUEST['custom'];
            $trn_id = $_REQUEST['txn_id'];
            $pay = $_REQUEST['mc_gross'];
            $this->loadModel('Orders');
            $this->Orders->query("UPDATE `orders` SET `order_status` = 1, `payment_status` = '$res',`transaction_id`='$trn_id', `payment_gateway_price`='$pay' WHERE `id` ='$custom_field';");
            $this->set('smtp_errors', "none");
        } else if (strcmp($res, "INVALID") == 0) {
            
        } 
        $xt = ob_get_clean();   
        fwrite($fc, $xt);
        fclose($fc);
        exit;
         
    }
        
}
