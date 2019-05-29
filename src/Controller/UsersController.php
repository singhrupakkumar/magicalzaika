<?php
namespace App\Controller;  

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



        $this->Auth->allow(['add','forgot','reset','emailverify','newsletter']);   

        $this->authcontent();   
    }


    public function add() {

        if ($this->Auth->user()) {

            return $this->redirect('/');
        }

        $user = $this->Users->newEntity();


        if ($this->request->is('post')) {

            $this->request->data['username'] = $this->request->data['email'];

            $post = $this->request->getData();   

            $post['active'] = 0;
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

                 $send = $email->from(['rupak@avainfotech.com' => 'Magical Zaika']) 
                        ->emailFormat('html')
                        ->template('invite')
                        ->to($user->email)
                        ->subject('Welcome to Magical Zaika')
                        ->viewVars(array('link' => $refer_link)) 
                        ->viewVars(array('user' => $user))    
                        ->send();   

                        
                        $this->Flash->success(__('Registration done successfully. We have sent a verification mail to your registered email address, Please verify your account. Please be patient, as it may take some time to reach your inbox.'));   
                    
                }
                
                
                

            } else {

                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }



        $this->set(compact('user'));

        $this->set('_serialize', ['user']);
    } 

    public function emailverify ($user_id = null,$token = null){ 

           if(!empty($user_id)){

             $useractive = $this->Users->find('all',['conditions'=>['Users.id'=>$user_id]]);
             
             $useractive = $useractive->first();
             if($useractive['active']==1){ 
               return $this->redirect(['controller' => 'restaurants', 'action' => 'index']);      
             }
             
             if($useractive['tokenhash'] ==  $token){  
             $this->Users->updateAll(array('tokenhash' =>' ','active'=>1), array('id' => $user_id));    
             $this->Flash->success(__('Your account has been activated, go for login.'));  
              return $this->redirect(['controller' => 'restaurants', 'action' => 'index']);      
             }else{ 
             $this->Flash->error(__('Token has been expired. Please, try again.'));        
             } 
               
           }
        }



        public function login() {

     $this->loadModel('Carts');
    if(empty($this->Auth->user('id'))){
        
        
        if ($this->request->is('post')) {   

             $oldsession = $this->request->session()->id();    
  
            $this->request->session()->delete('user_id');    

            if ($this->request->data['username'] == '') {
                $this->Flash->error(__('Please enter your Email Address!'));
            
            } else if ($this->request->data['password'] == '') { 
                $this->Flash->error(__('Please enter your Password!'));
             
            } else {

                if (!filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL) === false) {

                    $this->Auth->config('authenticate', [

                        'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]
                    ]);

                    $this->Auth->constructAuthenticate();

                    $this->request->data['email'] = $this->request->data['username'];

                    unset($this->request->data['username']);
                }

                $user = $this->Auth->identify();
                if ($user) {         
                    if ($user['active'] == 0) {   
                        $this->Auth->logout();
                       $this->Flash->error(__('You are not active Yet!'));
                      
                    } else {
                        $this->Auth->setUser($user);  
                        $updatenewsession = $this->request->session()->id(); 
                     $this->Carts->updateAll(array('uid' => $user['id'],'sessionid'=>"$updatenewsession"), array('sessionid' => $oldsession)); 
                        if ($this->Auth->user('role') == 'admin') {
                            //$this->Auth->logout();
                            $this->Flash->success(__('Your Role Is Admin'));
                            return $this->redirect(['prefix' => 'admin','controller' => 'dashboard', 'action' => 'index']);  
                          
                        } else { 
                             
        
                           
                         
                        $this->Flash->success(__('Logged In Successfully')); 
                        if($this->request->session()->read('checkout')=='yes'){
                            $this->request->session()->delete('checkout');    
                            $this->redirect(['controller' => 'restaurants', 'action' => 'checkout']);    
                        }else{
                            $this->redirect($this->referer());         
                        }
                        }
                    }
                } else { 
                    $this->Flash->error(__('Invalid email address & Password'));

                }
            }

        } 
        }else{
             return $this->redirect('/');   
        }
        $this->set(compact('response'));

        $this->set('_serialize', ['response']);
        
    }

    public function logout() {   
        if ($this->Auth->logout()) {
        	 $this->Flash->success(__('Good bye!')); 
            return $this->redirect('/');
        }
    }
 

  public function myaccount(){
      $uid =  $this->Auth->user('id');
      if($uid){
        $userdata  = $this->Users->find('all',array('conditions'=>array('Users.id'=>$uid)));
        $userdata  = $userdata->first();

      }else {
      return $this->redirect('/'); 
      }
         $this->set(compact('userdata'));
        $this->set('_serialize', ['userdata']);
      
    }



    public function edit() {
        
        $id = $this->Auth->user('id');
       if($id){
          
              $user = $this->Users->get($id, [

            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
 
            $post = $this->request->data;

                if ($this->request->data['image']['name'] != '') {

                    if ($user->image != '') {
                        unlink(WWW_ROOT . 'images/users/' . $user->image);
                    }

                    $image = $this->request->data['image'];
                    $name = time() . $image['name'];
                    $tmp_name = $image['tmp_name'];
                    $upload_path = WWW_ROOT . 'images/users/' . $name;
                    move_uploaded_file($tmp_name, $upload_path);

                    $post['image'] = $name;
                } else {
                    unset($this->request->data['image']);
                    $post = $this->request->data;
                }

            $user = $this->Users->patchEntity($user, $post);

            if ($this->Users->save($user)) {

                $this->Flash->success(__('Your profile has been updated successfully.'));
            } else {

                $this->Flash->error(__('The user could not be saved. Please, Try Again.'));
            }
        }

           
       }else{
           $this->Flash->error(__('Please login to the website in order to have access to the request.'));  
         return $this->redirect('/');     
       } 

        $this->loadModel('Countries');

        $countries = $this->Countries->find('all');
        $countries = $countries->all();

        $this->set(compact('countries'));

        $this->set(compact('user'));

        $this->set('_serialize', ['user']);
    }


    public function changepassword() {
        $id = $this->Auth->user('id');

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($this->request->data['password1'])) {
                if ($this->request->data['password'] != $this->request->data['password1']) {
                    $this->Flash->error(__('New and confirm password does not match'));
                    return;
                }
            }
            if ((new DefaultPasswordHasher)->check($this->request->data['opassword'], $user['password'])) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Password Changed Successfully'));

                    if (isset($_GET['route'])) {
                        return $this->redirect(['action' => 'edit', $id]);
                    } else {
                        return $this->redirect(['action' => 'changepassword']);
                    }
                } else {
                    $this->Flash->error(__('Invalid Password, Try again'));
                    if (isset($_GET['route'])) {
                        return $this->redirect(['action' => 'edit', $id]);
                    } else {
                        return $this->redirect(['action' => 'changepassword']);
                    }
                }
            } else {
                $this->Flash->error(__('Old Password did not match'));
                if (isset($_GET['route'])) {
                    return $this->redirect(['action' => 'edit', $id]);
                } else {
                    return $this->redirect(['action' => 'changepassword']);
                } 
            }
        }
    }


public function forgot() {
        if ($this->Auth->user('id')) {  
            $this->redirect('/');
        }


        if ($this->request->is('post')) {

            $email = $this->request->data['email'];



            $user = $this->Users->find('all', ['conditions' => ['Users.email' => $email]]);

            $user = $user->first();

            $burl = Router::fullbaseUrl();

            if (empty($user)) {

                $this->Flash->error(__('Enter regsitered email address to reset you password'));
            } else {

                if ($user->email) {

                    $hash = md5(time() . rand(10000, 99999));

                    $url = Router::url(['controller' => 'users', 'action' => 'reset' . '/' . $hash]);



                    $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));
                    
                    $refer_link =  $burl . $url ; 
                     $email = new Email('default');

                 $send = $email->from(['rupak@avainfotech.com' => 'Magical Zaika']) 
                        ->emailFormat('html')
                        ->template('forgot')
                        ->to($user->email)
                        ->subject('Reset Your Password')
                        ->viewVars(array('link' => $refer_link)) 
                        ->viewVars(array('user' => $user))  
                        ->send();  



                    $this->Flash->success(__('Check your email to reset your Password'));
                } else {

                    $this->Flash->error(__('Email Is Invalid'));
                }
            }
        }
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
        $myorder = $this->Orders->find('all',['contain'=>['OrderItems'],'conditions'=>['Orders.uid'=>$this->Auth->user('id'),'Orders.order_status !='=>1]])->toArray(); 
    $this->set(compact('myorder'));
    $this->set('_serialize', ['myorder']);   

    }

    public function orderdetails($orderid){

        $this->loadModel('Orders');
        $myorder = $this->Orders->find('all',['contain'=>['OrderItems'=>['Products']],'conditions'=>['Orders.uid'=>$this->Auth->user('id'),'Orders.id'=>$orderid]])->first(); 

    $this->set(compact('myorder'));
    $this->set('_serialize', ['myorder']);  
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
