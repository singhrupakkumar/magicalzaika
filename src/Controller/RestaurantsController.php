<?php
namespace App\Controller;
    
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
 
 ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        parent::beforeFilter($event);



        $this->Auth->allow();

        $this->authcontent();
  
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function adminemail1(){ 
		$this->loadModel('Settings');
		$seting = $this->Settings->find('all',['conditions'=>['Settings.key'=>'admin_contact_mail']])->first();
	    return $seting->value;
	} 
    public function index()
    {

        $this->loadModel('Products');
        $this->loadModel('Categories');
        $this->loadModel('Testimonials');
        
        $latestdish = $this->Products->find('all',['order'=>'Products.id desc','limit'=>8])->toArray();
        $random = $this->Products->find('all',['order'=>'rand()','limit'=>20])->toArray();
        $topcat = $this->Categories->find('all',['order'=>'Categories.id desc','limit'=>8])->toArray();
        
        $testimonials = $this->Testimonials->find('all',['order'=>'Testimonials.id desc','limit'=>4])->toArray();
          
     $this->set(compact('latestdish','topcat','testimonials','random'));
     $this->set('_serialize', ['latestdish','topcat','testimonials','random']); 

    }


        public function search()
    {

        $this->loadModel('Restaurentlocations');
        $conn = ConnectionManager::get('default');
       if ($this->request->is('post')) { 
          $lat = $this->request->data['lat'] ; 
          $long = $this->request->data['long'] ;  
         $query = "SELECT *, get_distance_in_miles_between_geo_locations('".$lat."','".$long."',`lat`,`long`) as distance FROM restaurentlocations ORDER BY distance";
        $data = $conn->execute($query);  
        $data = $data->fetchAll('assoc');  
            $cnt = count($data);
            for ($i = 0; $i < $cnt; $i++) {
                if ($data[$i]['distance'] < 10000) {
                    
                } else {
                    unset($data[$i]);
                }
            }  
          $distance_myarrar = [];  
        foreach ($data as $key => $value) {
          $store_id[] = $value['rest_id'];
          $distance_myarrar[$value['rest_id']] = $value['distance'];
       
        }

        if(!empty($store_id)){

        $storedata = $this->Restaurants->find('all',['contain'=>['Products'],'conditions'=>['Restaurants.id in'=> $store_id]]);
        $storedata = $storedata->all()->toArray();
    
        foreach ($storedata as $key => &$value) {
             if($value['image']){   
             $value['image'] = Router::url('/', true)."images/restaurants/". $value['image'];
             }else{
             $value['image'] = Router::url('/', true)."images/restaurants/no-image.jpg";   
             }
 
             if(isset($distance_myarrar[$value['id']])){
                 $value['distance'] = $distance_myarrar[$value['id']];
             }else{
                $value['distance'] = 0;
             }
              
          
        }

    }else{
       $this->Flash->error(__('Restaurants not found in your area'));    
    }
 
      
       }  

    if (!empty($storedata) && count($storedata) == 1) {
        return $this->redirect(array('action' => 'view/'.$storedata[0]['slug']));
    }   

    $this->set(compact('storedata')); 
     $this->set('_serialize', ['storedata']); 


    }


        public function view($slug = null)
    {
        $this->loadModel('Products');
        $this->loadModel('Categories');

         $rest = $this->Restaurants->find('all', array(
                'conditions' => ['Restaurants.slug'=>$slug]   
            ));  

         $rest = $rest->first();
        if($this->request->is('post')){
           $pname = $this->request->data['pname'];
           $cat_id = $this->request->data['category']; 
           $rating = $this->request->data['rating'];  

           $conditions = array();
           if(!empty($pname)){
           $conditions[] =  ['Products.rest_id'=>$rest['id'],'Products.name LIKE' => '%' . $pname . '%'];
           }

           if(!empty($cat_id)){
           $conditions[] =  ['Products.rest_id'=>$rest['id'],'Products.cat_id' =>$cat_id];
           }


           if(!empty($rating)){
           $conditions[] =  ['Products.rest_id'=>$rest['id'],'Products.avg_rating' =>$rating];
           }

           // $product = $this->Products->find('all', array('contain'=>['Categories'],
           //      'conditions' =>  $conditions   
           //  ))->toArray(); 

       $this->paginate = [
            'contain' => ['Categories'],
            'conditions' =>  $conditions,
            'limit'=>9
        ]; 
        $product = $this->paginate($this->Products); 

        }else{

         // $product = $this->Products->find('all', array('contain'=>['Categories'],
         //        'conditions' => ['Products.rest_id'=>$rest['id']]   
         //    ))->toArray();

        $this->paginate = [
            'contain' => ['Categories'],
            'conditions' => ['Products.rest_id'=>$rest['id']],
            'limit'=>9
        ]; 
        $product = $this->paginate($this->Products); 
       
        }
        
       
        $catlist = $this->Categories->find('list');

        $this->set('rest', $rest);
        $this->set('product', $product);
        $this->set('catlist', $catlist);
        $this->set('_serialize', ['rest']);
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
             $uid = $this->Auth->user('id');
             if(!empty($uid)){ 
               $uid = $uid;  
             }else{
                 $uid = 0 ;
             }
            $id = $this->request->data['id'];  

            $quantity = isset($this->request->data['quantity']) ? $this->request->data['quantity'] : null;

            $productmodId = isset($this->request->data['mods']) ? $this->request->data['mods'] : null;
            $exits = $this->Carts->find('all',array('conditions'=>array('AND'=>array('Carts.product_id'=>$id,'Carts.sessionid'=>$this->request->session()->id()))));
            $exits = $exits->first();   
            
            $cartfind = $this->Carts->find('all',array(
                'conditions'=>array('Carts.uid'=>$uid,'Carts.sessionid'=>$this->request->session()->id())
                )); 
            $cartfind = $cartfind->first();   
            
            if(!empty($exits)){
              $this->Flash->success(__('Product is already added in your cart.'));   
             // $product = true; 
            }else{
            $product = $this->Cart->add($id, $quantity, $productmodId,$uid);  
                if(!empty($product)) { 
                    $this->Flash->success(__($product['name'] . ' is added to your cart successfully.'));
                } else {  
                     $this->Flash->error(__('Unable to add this product to your shopping cart.'));  

                } 
            
            }
            

            
        }  
        
        //$this->redirect($this->referer());
        $this->redirect(array('action' => 'cart'));
    }



   public function cart() {    
        $shop = $this->request->session()->read('Shop');
   
        $this->set(compact('shop')); 
    }
    
    public function remove($id = null) {
        $product = $this->Cart->remove($id);
        if(!empty($product)) {
            $this->Flash->error(__($product['Product']['name'] . ' was removed from your shopping cart'));
         
        } 
        return $this->redirect(array('action' => 'cart'));
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
          $sid   = $this->request->session()->id();
          
          $uid = $this->Auth->user('id'); 
          $user_id= $uid?$uid:0;
          $data = $this->displaycart($user_id, $sid); 
       
    
        if (!empty($data)) { 
            $response['error'] = "0";
            $response['data'] = $data;

        } else { 
            $response['error'] = "1";   
            $response['data'] = "error";
        }     

        echo json_encode($response);
        exit;    
    }




     public function webremoveitems() { 
            $sid   = $this->request->session()->id();
            $uid = $this->Auth->user('id'); 
            $id = $this->request->data['id'];
            $this->loadModel('Carts');  
            $cartItems = $this->Carts->find('all',array('conditions'=>array('AND'=>array('Carts.product_id'=>$id,'Carts.sessionid'=>$sid))));
            $cartItems = $cartItems->first();
                $cart = $this->Carts->get($cartItems['id']);
                $delet = $this->Carts->delete($cart);  
                if($delet){
                  $response['msg'] = "deleted";     
                }else{
                    $response['msg'] = "issue";    
                }
               $user_id= $uid?$uid:0;
                $data = $this->displaycart($user_id, $sid); 
        if (!empty($data)) { 
            $response['error'] = "0";
            $response['data'] = $data; 
          
        } else {    
            $response['error'] = "1";   
            $response['data'] = "error";
        }     

        echo json_encode($response);
        exit;  
        }
        
        
         public function cartincreaseqty() {    
            $sesid = $this->request->session()->id();
            $product_id = $this->request->data['id']; 
            if($this->Auth->user('id')){
            $uid = $this->Auth->user('id');
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
                    $response['error'] = "1";
                    $response['msg'] = 'Available Item(s) in Stock : '.$d['product']['quantity'];   
                  }     
    
        }
             $user_id= $uid?$uid:0;   
             $data = $this->displaycart($user_id, $sesid);  
             $response['error'] = "0";
             $response['data'] = $data; 
          echo  json_encode($response);
          exit;     
     
    }  
    
        public function cartdecreaseqty() { 
        $product_id = $this->request->data['id'];
        $sesid = $this->request->session()->id();
        $this->loadModel('Carts');
         $this->loadModel('Products');
         if($this->Auth->user('id')){
            $uid = $this->Auth->user('id');
            }else{
                $uid =0;
            }
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
             $response['error'] = "0"; 
             $response['data'] = $data; 
          echo  json_encode($response);
          exit;  
    }
    
    
      public function platerate() { 
        $pdata = $this->request->data['pdata'];
        $dataarray = explode("-",$pdata);
        $plate = $dataarray[0];
        $product_id = $dataarray[1];
        $sesid = $this->request->session()->id();
        $this->loadModel('Carts');
         $this->loadModel('Products');
         if($this->Auth->user('id')){
            $uid = $this->Auth->user('id');
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
             $response['error'] = "0"; 
             $response['data'] = $data; 
          echo  json_encode($response);
          exit;  
    }

    

      public function checkout(){
         $uid = $this->Auth->user('id');
        if($this->Auth->user('id')){
            
            if($this->request->is('post')){ 
             
            $address = array(
                'name'=> $this->request->data['name'],
                'email'=> $this->request->data['email'],
                'phone'=> $this->request->data['phone'],
                'address'=> $this->request->data['address'],
                'city'=> $this->request->data['city'],
                'state'=> $this->request->data['state'],
                'zip'=> $this->request->data['zip']
                );  
          
            $this->request->session()->write('shippingaddress',$address);
            if($this->request->session()->read('shippingaddress')){
              $res['status'] = true;
              $res['msg'] = 'Shipping address saved';
            }else{
             $res['status'] = false;
              $res['msg'] = 'Try Again';   
            }
             echo json_encode($res);  
             exit; 
            }
           $this->loadModel('Users');
           $user = $this->Users->find('all',['conditions'=>['Users.id'=>$this->Auth->user('id')]]);
           $user = $user->first();
            
        }else{ 
            $this->request->session()->write('checkout','yes');     
            $this->Flash->error(__('Please login to the website in order to have access to the request.'));  
            return $this->redirect(array('controller'=>'users','action' => 'login')); 
        }
        $sesid = $this->request->session()->id();     
        $user_id = $uid?$uid:0;   
        $cart = $this->displaycart($user_id, $sesid); 
         
        $shippingaddress = $this->request->session()->read('shippingaddress');  
        $this->set('user', $user);
        $this->set('cart', $cart);   
        $this->set('shippingaddress', $shippingaddress); 
    }

	


     public function payment() {
        $this->loadModel('Orders');
        $this->loadModel('OrderItems');  
        $this->loadModel('Users');
        $this->loadModel('Settings');
        $settings =  $this->Settings->find('all',['conditions'=>['Settings.key'=>'sale_commission']]); 
        $settings = $settings->first();
        $commission = $settings['value'] ;

        $uid      = $this->Auth->user('id');
        $sesid    = $this->request->session()->id(); 
        $shipping = $this->request->session()->read('shippingaddress');
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

                 $send = $email->from([$this->adminemail1() => 'Magical Zaika'])      
                        ->emailFormat('html')
                        ->template('order')
                        ->cc($this->adminemail1())
                        ->to($orderemail)
                        ->subject('New Order Received!')    
                        ->viewVars(array('order' => $data))           
                        ->send();         
               
               $amt = $cart['cartInfo']['total'] ;     
               $returnUrl = Router::url('/', true)."restaurants/success?order-id=$last_id";  
               $ipnNotificationUrl = Router::url('/', true)."restaurants/ipn";
               
               if($this->request->data['pay_method'] == 'paypal'){

          ///////////////////////////////////////////////payment////////////////////////////////////////////////
                        echo ".<form name=\"_xclick\" action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">
                    <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
                    <input type=\"hidden\" name=\"email\" value=\"magicalstoneweb@gmail.com\">
                    <input type=\"hidden\" name=\"business\" value=\"magicalstoneweb@gmail.com\">
                    <input type=\"hidden\" name=\"currency_code\" value=\"INR\">
                    <input type=\"hidden\" name=\"custom\" value=\"$last_id\">
                    <input type=\"hidden\" name=\"amount\" value=\"$amt\">
                    <input type=\"hidden\" name=\"return\" value=\"$returnUrl\">
                    <input type=\"hidden\" name=\"notify_url\" value=\"$ipnNotificationUrl\"> 
                    </form>";
//                    exit;
                        echo "<script>document._xclick.submit();</script>";
                        
               }else{
                       return $this->redirect(array('action' => 'success?order-id='.$last_id)); 
               }            
            
           }
        } 
               
        }else{
           $this->Flash->error(__('Shopping Cart is empty'));  
           return $this->redirect('/');    
        }
        }else{ 
            $this->Flash->error(__('Please login to the website in order to have access to the request.'));  
            return $this->redirect(array('action' => 'cart')); 
        }
      

    }
    
      public function success() {
          
        $shop     = $this->request->session()->read('Shop');
        $uid      = $this->Auth->user('id');    
        $sesid    = $this->request->session()->id(); 
        $user_id = $uid?$uid:0; 
        $cart = $this->displaycart($user_id, $sesid); 
        if(empty($cart['products'])){    
          $this->Flash->error(__('Shopping Cart is empty'));  
           return $this->redirect('/');               
        } 
        
        $this->loadModel('Products');
        $this->loadModel('Orders');
        
        if(isset($_REQUEST['tx'])){ 
                $this->Orders->updateAll(array(
                    'transaction_id'=> $_REQUEST['tx'],
                    'payment_gateway_price'=> $_REQUEST['amt'],
                    'payment_status'=> $_REQUEST['st'],
                    'order_status'=> 2    
                ),array(
                    'Orders.id'=>$_REQUEST['cm']
                )); 
         }
        
            $data = $this->Orders->find('all', array('contain'=>['OrderItems'],'conditions' => array('Orders.id' => $_GET['order-id'])));     
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
        $this->set(compact('shop','cart'));    
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
