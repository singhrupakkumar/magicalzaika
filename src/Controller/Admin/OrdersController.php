<?php
namespace App\Controller\Admin;      

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Routing\Router;

use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;

use Cake\Auth\DefaultPasswordHasher;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\FavouritesTable $Stores
 *
 * @method \App\Model\Entity\Store[] paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{

    
    
    
    	public function beforeFilter(Event $event) {
             parent::beforeFilter($event);

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin'); 
            if($this->Auth->user() && $this->Auth->user('role') !='admin'){
             $this->Auth->logout();
              //  $this->viewBuilder()->setLayout('admin');
            }

        }

        $this->Auth->allow(['index']);  

        $this->authcontent();
 

    }
    
    
    
        public function index()
    {

        $orders = $this->Orders->find('all',['contain' => ['OrderItems','Users'],
            'order'   => ['Orders.id' => 'desc']])->toArray();
    
        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']); 
    }
    
        public function cancelorder()
    {
        $orders = $this->Orders->find('all',[
            'conditions'=>['Orders.order_status in'=>[4,5]],
            'contain' => ['OrderItems','Users'],
            'order'   => ['Orders.id' => 'desc']])->toArray();
    
        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']); 
    }


        public function view($id = null)    
    {
        $order = $this->Orders->get($id, [
            'contain' => ['OrderItems'=>['Products'],'Users']            
        ]);
 
        $this->set('order', $order); 
        $this->set('_serialize', ['order']);    
    }
      


       /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) { 
          if($this->request->getData('order_status') == 3){
             $this->request->data['delivered_date'] = date('Y-m-d H:i:s') ;
          }  
        $order = $this->Orders->patchEntity($order, $this->request->getData());  
        if ($this->Orders->save($order)) {
            if($this->request->getData('order_status') == 3){
               $this->Flash->success(__('The order has been completed.'));  
           }elseif($this->request->getData('order_status') == 4){
                $this->Flash->success(__('The order has been cancelled.')); 
           }else{
             $this->Flash->success(__('The order status has been changed.')); 
           }

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The order status could not be changed. Please, try again.'));
    }


    $this->set(compact('order'));     
    $this->set('_serialize', ['product']);
}
   
   
   
   
    public function payments(){ 
        $connection = ConnectionManager::get('default');
        if($this->request->is('post')){
           $start_date = $this->request->data['from']; 
           $end_date = $this->request->data['to']; 
           if(empty($start_date)){
            $this->Flash->error(__('Please select from date'));    
           }elseif(empty($end_date)){
            $this->Flash->error(__('Please select to date'));    
           }  
           
           $start_date = date("Y-m-d",strtotime($start_date));
           $end_date = date("Y-m-d",strtotime($end_date));
           
       $orders =  $this->Orders->find('all',[ 
            'contain' => ['OrderItems','Users'] ,
          'conditions'=>['Orders.order_status in'=>['2','3'],'Orders.created >='=>$start_date,'Orders.created <='=>$end_date]
         
        ])->toArray();     
                
          
        }else{
            
     $orders =  $this->Orders->find('all',[ 
            'contain' => ['OrderItems','Users'] ,
          'conditions'=>['Orders.order_status in'=>['2','3']]
         
        ])->toArray(); 


        }

        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);   
        
        
    }
    
    public function markpay($id = null){   

         $order = $this->Orders->get($id);
         $post['paid_by_admin'] = 1;
         $order = $this->Orders->patchEntity($order, $post);
        if ($this->Orders->save($order)) {  

            $this->Flash->success(__('Mark successfully.'));

        } else {  
            $this->Flash->error(__('Unable to Mark.'));

        }
        return $this->redirect(['action' => 'cancelorder']);  
        
        
    }
    
  

}
