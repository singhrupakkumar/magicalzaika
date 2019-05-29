<?php
namespace App\Controller\Api;  

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Mailchimp\Mailchimp;
use Cake\Auth\DefaultPasswordHasher;

/**

 * Users Controller

 *

 * @property \App\Model\Table\UsersTable $Users

 *

 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])

 */
class UsersController extends AppController {

    public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

      $this->viewBuilder()->setLayout('ajax');

        $this->Auth->allow();   

        $this->authcontent();   
    }
    
	public function adminemail(){ 
		$this->loadModel('Settings');
		$seting = $this->Settings->find('all',['conditions'=>['Settings.key'=>'admin_contact_mail']])->first();
	    return $seting->value;
	} 
    public function index() {
        
            $baseurl = Router::url('/',true);
        $indexInfo['description'] = "Signup (post method)";
        $indexInfo['url'] = $baseurl. "api/users/add.json";
        $indexInfo['parameters'] = 'email:rupak@gmail.com name:Rupak Singh password:123456, phone:5454546 ,dob:12-12-2018<br>';
        $indexarr[] = $indexInfo;    
        $indexInfo['description'] = "User login(post method)";
        $indexInfo['url'] = $baseurl. "api/users/login.json";
        $indexInfo['parameters'] = 'email:rupak@gmail.com password:123456<br>';
        $indexarr[] = $indexInfo;
        $indexInfo['description'] = "User Data(post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/userdata.json";
        $indexInfo['parameters'] = 'id:44 <br>'; 
        $indexarr[] = $indexInfo;
        $indexInfo['description'] = "Edit Profile(post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/edit.json";
        $indexInfo['parameters'] = 'id:45 ,name:Vandana11 phone:565666<br>'; 
        $indexarr[] = $indexInfo;
        $indexInfo['description'] = "Changepassword (post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/changepassword.json"; 
        $indexInfo['parameters'] = 'id:45 ,oldpassword:123456 password:123 ,<br>'; 
        $indexarr[] = $indexInfo;
        $indexInfo['description'] = "Forgot Password (post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/forgot.json"; 
        $indexInfo['parameters'] = 'email:prateek@avainfotech.com ,<br>'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "My Order (post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/myorder.json"; 
        $indexInfo['parameters'] = 'user_id:1<br>'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "My Order Details(post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/orderdetails/1.json"; 
        $indexInfo['parameters'] = 'user_id:6<br>'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "All categories list"; 
        $indexInfo['url'] = $baseurl. "api/categories.json"; 
        $indexInfo['parameters'] = ''; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "All products list"; 
        $indexInfo['url'] = $baseurl. "api/products.json"; 
        $indexInfo['parameters'] = ''; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Subcategories By category Id"; 
        $indexInfo['url'] = $baseurl. "api/categories/subcatBycatId/1.json"; 
        $indexInfo['parameters'] = ''; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Product Details By Id"; 
        $indexInfo['url'] = $baseurl. "api/products/view/1.json"; 
        $indexInfo['parameters'] = ''; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Product List By Category Id"; 
        $indexInfo['url'] = $baseurl. "api/products/productaByCatId/1.json"; 
        $indexInfo['parameters'] = ''; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Search Product By Name"; 
        $indexInfo['url'] = $baseurl. "api/products/search.json"; 
        $indexInfo['parameters'] = 'name:Veg'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Write a review for product"; 
        $indexInfo['url'] = $baseurl. "api/products/savereview.json"; 
        $indexInfo['parameters'] = 'user_id:6,product_id:1,punctuality:5,text:Awesome!'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Testimonials"; 
        $indexInfo['url'] = $baseurl. "api/staticpages/testimonials.json"; 
        $indexInfo['parameters'] = ''; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Terms & conditions"; 
        $indexInfo['url'] = $baseurl. "api/staticpages/view/terms-and-conditions.json"; 
        $indexInfo['parameters'] = ''; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Privacy & Policy"; 
        $indexInfo['url'] = $baseurl. "api/staticpages/view/privacy-policy.json"; 
        $indexInfo['parameters'] = ''; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Contact Us"; 
        $indexInfo['url'] = $baseurl. "api/staticpages/contact.json"; 
        $indexInfo['parameters'] = 'email:abc@gmail.com,name:abc,subject:abc,message:dsdddasd'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "All Restaurants"; 
        $indexInfo['url'] = $baseurl. "api/restaurants.json"; 
        $indexInfo['parameters'] = ''; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Add to cart"; 
        $indexInfo['url'] = $baseurl. "api/restaurants/addtocart.json"; 
        $indexInfo['parameters'] = 'user_id:4,pid:5,quantity:2'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Remove cart"; 
        $indexInfo['url'] = $baseurl. "api/restaurants/webremoveitems.json"; 
        $indexInfo['parameters'] = 'session_id:dssf4,pid:5,user_id:2'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Display cart"; 
        $indexInfo['url'] = $baseurl. "api/restaurants/webdisplaycart.json"; 
        $indexInfo['parameters'] = 'session_id:dfgg,user_id:2'; 
        $indexarr[] = $indexInfo;
     
	    $indexInfo['description'] = "Cart plus"; 
        $indexInfo['url'] = $baseurl. "api/restaurants/cartincreaseqty.json"; 
        $indexInfo['parameters'] = 'session_id:dfgg,pid:4,user_id:2'; 
        $indexarr[] = $indexInfo;
		
		 $indexInfo['description'] = "Cart minus"; 
        $indexInfo['url'] = $baseurl. "api/restaurants/cartdecreaseqty.json"; 
        $indexInfo['parameters'] = 'session_id:dfgg,pid:4,user_id:2'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Change plate Full/Half"; 
        $indexInfo['url'] = $baseurl. "api/restaurants/platerate.json"; 
        $indexInfo['parameters'] = 'session_id:sddf65,user_id:2,pdata:full-1 (Here 1 = product id and full means plate half/full)'; 
        $indexarr[] = $indexInfo;
		
		$indexInfo['description'] = "Payment data save with Order"; 
        $indexInfo['url'] = $baseurl. "api/restaurants/payment.json"; 
        $indexInfo['parameters'] = 'session_id:dfgg,user_id:2,name:rk,email:sd@gmail.com,phone:4454568,address:xyz chandigarh,city:chandigarh,state:chandigarh,zip:554555,pay_method:paypal\Cash on delivery,transaction_id:f5d4654d56,payment_status:Pending/Success'; 
        $indexarr[] = $indexInfo;
		
        $this->set('baseurl', $baseurl); 
        $this->set('indexarr', $indexarr); 
        $this->set('_serialize', ['user']);
   
         
    }

    public function add() {
        
       

        $user = $this->Users->newEntity();


        if ($this->request->is('post')) {
            
            if(!empty($this->request->data['email']) && !empty($this->request->data['password'])){

            $this->request->data['username'] = $this->request->data['email'];

            $post = $this->request->getData();   

            $post['active'] = '0';
            $post['role'] = 'user';  

            $user = $this->Users->patchEntity($user, $post);

            $new_user = $this->Users->save($user);

            if ($new_user) {

                if (isset($user)) { 
                    $burl = Router::fullbaseUrl();
                    $hash = md5(time() . rand(1000000, 9999999));
                    $url = Router::url(['controller' => 'users', 'action' => 'emailverify'. '/' . $user->id . '/' . $hash]);
                    $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));
                    $refer_link =  $burl . $url ; 
                     $email = new Email('default');   

                 $send = $email->from([$this->adminemail() => 'Magical Zaika']) 
                        ->emailFormat('html')
                        ->template('invite')
                        ->to($user->email)
                        ->subject('Welcome to Magical Zaika')
                        ->viewVars(array('link' => $refer_link)) 
                        ->viewVars(array('user' => $user))    
                        ->send();   

                 $response['status'] = true;
                 $response['msg'] = 'Registration done successfully. We have sent a verification mail to your registered email address, Please verify your account. Please be patient, as it may take some time to reach your inbox.';        
                    
                }
                
                
                

            } else {
                 $response['status'] = false;
                 $response['msg'] = 'The user could not be saved. Please try again.';
            }
            
        }else{
            $response['status'] = false;
            $response['msg'] = 'Email address and password required!';
        }
        }

        

        $this->set(compact('response'));

        $this->set('_serialize', ['response']);
    } 

    public function emailverify ($user_id = null,$token = null){ 

           if(!empty($user_id)){

             $useractive = $this->Users->find('all',['conditions'=>['Users.id'=>$user_id]]);
             
             $useractive = $useractive->first();
             if($useractive['active']==1){ 
               return $this->redirect(['controller' => 'restaurents', 'action' => 'index']);      
             }
             
             if($useractive['tokenhash'] ==  $token){  
             $this->Users->updateAll(array('tokenhash' =>' ','active'=>1), array('id' => $user_id));    
             $this->Flash->success(__('Your account has been activated, go for login.'));  
              return $this->redirect(['controller' => 'restaurents', 'action' => 'index']);      
             }else{ 
             $this->Flash->error(__('Token has been expired. Please, try again.'));        
             } 
               
           }
        }



       public function login()

    {
        
		if ($this->request->is('post')) { 
		    
		   

            if (!filter_var($this->request->data['email'], FILTER_VALIDATE_EMAIL) === false) {

                $use = $this->Users->find('all',['conditions'=>['Users.email'=>$this->request->data['email']]]);
            }else{
           
                $use = $this->Users->find('all',['conditions'=>['Users.username'=>$this->request->data['email']]]);  
            }

          

            $use = $use->first();
         

            if (empty($use)){
               $response['msg']='Invalid Email address';
                 $response['status']= false;
                 
            }elseif (!(new DefaultPasswordHasher)->check($this->request->data['password'], $use['password'])) {
              $response['msg']='Wrong password';
              $response['status']=false;   
            }else{

                if ($use['active'] == 0) {   
                     $this->Auth->logout();
                     $response['msg']='You are not active yet!';
                     $response['status']=false;     
                      
                 }else{

				$this->Auth->setUser($use); 

				

				if($this->Auth->user('role') == 'admin'){
					$response['msg']='You are admin';
					$response['status']=false;
				

				}else{	
					if(isset($this->request->data['device_token'])){   
					$this->Users->updateAll(['device_token' =>$this->request->data['device_token'],'device'=>$this->request->data['device']],['id' =>$use['id']]); 
					}		

                     $usedata = $this->Users->find('all',['conditions'=>['Users.id'=>$use['id']]]);
                    $usedata = $usedata->first();
                  	$response['msg']='login successfully';
					$response['status']= true; 
					$response['data']= $usedata;
				}	


              }  

			}

        }
 
        $this->set(compact('response'));

        $this->set('_serialize', ['response']);
    }


 

  public function userdata()
    {	
    	if(empty($this->request->data['id'])){
			$response['msg']='user id required';
			$response['status']= false;
    	}else{
    		$users = $this->Users->find('all', [
			'conditions' => ['Users.id' => $this->request->data['id']]
			]);
			$users = $users->first();
			if($users){
			$response['data']= $users;
			$response['status']= true;
			}else{
			$response['msg']='Invalid user id';	
			$response['data']= '';
			$response['status']= false;	
			}
		
    	}
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }



     public function edit()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$post = $this->request->data; 
			if(empty($post['id'])){
				$response['status'] = false;
            	$response['msg'] = 'User id required.';
			}else{	
			$exit = $this->Users->find('all',['conditions'=>['Users.id'=>$post['id']]]);
			$exit = $exit->first();
			if ($exit) {			
    	
	        $user = $this->Users->get($post['id'], [
	            'contain' => []
	        ]);
             if(!empty($this->request->data['image'])) {
             $uniquename = time().uniqid(rand()).'.png';
             $upload_path = WWW_ROOT . 'images/users/' . $uniquename;
          
             $userimage = base64_decode($post['image']);
             $success = file_put_contents($upload_path, $userimage);
             $post['image']= $uniquename;
             
             }else{
               $post['image']= $user->image;  
             }
            $findbyemail = $this->Users->find('all',['conditions'=>['Users.email'=>$post['email']]]);
            $findbyemail = $findbyemail->first();
            if(empty($findbyemail)){
                  $user = $this->Users->patchEntity($user, $post);
                  $update = $this->Users->save($user);
                  if ($update) {
                        $response['status'] = true;
                        $response['msg'] = 'User data has been updated.';
                        $response['data'] = $update;
                    }else{
                        $response['status'] = false;
                        $response['msg'] = 'The user could not be saved. Please, try again.';
                       
                    }
            } else {
                if($post['id'] == $findbyemail['id']){
                    $user = $this->Users->patchEntity($user, $post);
                    $update = $this->Users->save($user);
                    if ($update) {
                        $response['status'] = true;
                        $response['msg'] = 'User data has been updated.';
                        $response['data'] = $update;
                    }else{
                        $response['status'] = false;
                        $response['msg'] = 'The user could not be saved. Please, try again.';
                       
                    }
                }else{
                    $response['status'] = false;
                    $response['msg'] = 'Email already exist.';
                }
           
            }
	       
            
	        }else{
	        	$response['status'] = false;
            	$response['msg'] = 'Invalid user id.';
	        }
           
			}	
        }
      $this->set(compact('response'));
      $this->set('_serialize', ['response']);
  
    }


    public function changepassword() {
   
        if ($this->request->is(['patch', 'post', 'put'])) {
			if(empty($this->request->data['id'])){
				$response['status'] = false;
            	$response['msg'] = 'User id required.';
			}else{
			    $id = $this->request->data['id'];

				$user = $this->Users->get($id, [
					'contain' => []
				]);


            if ((new DefaultPasswordHasher)->check($this->request->data['oldpassword'], $user['password'])) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                   
					$response['status'] = true;
					$response['msg'] = 'Password Changed Successfully';
                 
                } else {
					$response['status'] = false;
					$response['msg'] = 'Invalid Password, Try again';
                }
            } else {
               
				$response['status'] = false;
				$response['msg'] = 'Old Password did not match';
            }
			}
        }
	  $this->set(compact('response'));
      $this->set('_serialize', ['response']);
    }


    public function forgot() {
        if ($this->request->is('post')) {
			if(empty($this->request->data['email'])){
				$response['status'] = false;
            	$response['msg'] = 'Email required.';
			}else{
            $email = $this->request->data['email'];



            $user = $this->Users->find('all', ['conditions' => ['Users.email' => $email]]);

            $user = $user->first();

            $burl = Router::fullbaseUrl();

            if (empty($user)) {
				$response['status'] = false;
            	$response['msg'] = 'Enter regsitered email address to reset you password.';
             
            } else {

                if ($user->email) {

                    $hash = md5(time() . rand(10000, 99999));

                    $url = Router::url(['controller' => 'users', 'action' => 'reset' . '/' . $hash]);



                    $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));
                    
                    $refer_link =  $burl . $url ; 
					
                     $email = new Email('default');

                 $send = $email->from([$this->adminemail() => 'Magical Zaika']) 
                        ->emailFormat('html')
                        ->template('forgot')
                        ->to($user->email)
                        ->subject('Reset Your Password')
                        ->viewVars(array('link' => $refer_link)) 
                        ->viewVars(array('user' => $user))  
                        ->send(); 

					if($send){
						$response['status'] = true;
            	        $response['msg'] = 'Check your email to reset your Password';
					}else{
						$response['status'] = false;
            	        $response['msg'] = 'Try Again.';
					}
					
             
                  
                } else {
					$response['status'] = false;
            	    $response['msg'] = 'Email Is Invalid';
                 
                }
            }
			}	
        }
	  $this->set(compact('response'));
      $this->set('_serialize', ['response']);
    }

    public function reset($token) {

        $query = $this->Users->find('all', ['conditions' => ['Users.tokenhash' => $token]]);
        $data = $query->first();
        if ($data) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                if ($this->request->data['password1'] != $this->request->data['password']) {
                    $this->Flash->success(__('New password & confirm password does not match!'));
                    return;
                    //$this->redirect(['action' => 'reset/' . $token]);
                }
                $this->request->data['tokenhash'] = md5(time() . rand(10000, 99999));
                $user = $this->Users->get($data->id, [
                    'contain' => []
                ]);
                $user = $this->Users->patchEntity($user, $this->request->getData());  

                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Your password has been changed'));
                    return;
                    //$this->redirect(['action' => 'reset/' . $token]);
                } else {
                    $this->Flash->success(__('Invalid Password, try again'));
                    return;
                    //$this->redirect(['action' => 'reset/' . $token]);
                }
            }
        } else {
            $this->Flash->success(__('Invalid Token, Try Again')); 
            return;
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function myorder(){

    $this->loadModel('Orders');
	if($this->request->is('post')){
		if(empty($this->request->data['user_id'])){
			$response['status'] = false;
			$response['msg'] = 'User Id required.';
		}else{  
			$myorder = $this->Orders->find('all',['contain'=>['OrderItems'],'conditions'=>['Orders.uid'=>$this->request->data['user_id'],'Orders.order_status !='=>1]])->toArray(); 
			$response['status'] = true;
			$response['data'] = $myorder;	
		}
		
	}
    $this->set(compact('response'));
    $this->set('_serialize', ['response']);   

    }

    public function orderdetails($orderid){

	
    $this->loadModel('Orders');
	if($this->request->is('post')){
		if(empty($this->request->data['user_id'])){
			$response['status'] = false;
			$response['msg'] = 'User Id required.';
		}else{  
			$myorder = $this->Orders->find('all',['contain'=>['OrderItems'=>['Products']],'conditions'=>['Orders.uid'=>$this->request->data['user_id'],'Orders.id'=>$orderid]])->first(); 
			$response['status'] = true;
			$response['data'] = $myorder;	
		}
		
	}
    $this->set(compact('response'));
    $this->set('_serialize', ['response']);    
    }

     /***********Newsletter*****************/

    public function newsletter() {

        if(isset($_POST['email'])){
       $email = $_POST['email'];
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        // MailChimp API credentials
        $apiKey = '3f019d94a3a753bda1627fb2ca6a58cc-us16';
        $listID = '449c8ad99f';
        
        // MailChimp API URL
        $memberID = md5(strtolower($email));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
        
        // member information
        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME'     => '',
                'LNAME'     =>''
            ]
        ]);
        
        // send a HTTP POST request with curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // store the status message based on response code
        if ($httpCode == 200) {
           echo "success";
        } else {
            switch ($httpCode) {
                case 214:
                    echo "already";
                    break;
                default:
                     echo "fail";
                    break;
            }
         
        }
    }else{
       echo "worng";
    }
} 


        exit; 
    }

 
}
