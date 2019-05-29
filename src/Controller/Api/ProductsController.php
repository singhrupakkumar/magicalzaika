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
class ProductsController extends AppController
{


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
    public function index()
    {
		$product = $this->Products->find('all', [
            'contain' => ['Categories','Subcategories']
        ])->toArray();
		
		if($product){
			$response['status'] = true;
            $response['data'] = $product;  
		}else{
			$response['status'] = false;
            $response['msg'] = 'Data not found!';
		}

       $this->set(compact('response'));

       $this->set('_serialize', ['response']);

    }
	
	 public function productaByCatId($id = null)
    {
		$product = $this->Products->find('all', [
            'contain' => ['Categories','Reviews'=>['Users']],
			'conditions' => ['Products.cat_id'=>$id]
        ])->toArray();
		
		if($product){
			$response['status'] = true;
            $response['data'] = $product;  
		}else{
			$response['status'] = false;
            $response['msg'] = 'Data not found!';
		}

       $this->set(compact('response'));

       $this->set('_serialize', ['response']);

    }




        public function view($id = null)
    {
  
         $product = $this->Products->find('all', array(
                'contain'=>['Categories','Reviews'=>['Users']],
                'conditions' => ['Products.id'=>$id]   
            ));  

         $product = $product->first();

		if($product){
			$response['status'] = true;
            $response['data'] = $product;  
		}else{
			$response['status'] = false;
            $response['msg'] = 'Data not found!';
		}

       $this->set(compact('response'));

       $this->set('_serialize', ['response']);
    }
	
	
	
	
	
 public function search() {
        $term = null;
        if(!empty($this->request->data['name'])) {
            $term = $this->request->data['name'];
            $terms = explode(' ', trim($term));
            $terms = array_diff($terms, array(''));
            $conditions = array(
                // 'Brand.active' => 1,
                'Products.status' => 1
            );
            foreach($terms as $term) {
                $conditions[] = array('Products.name LIKE' => '%' . $term . '%');
            }
            $products = $this->Products->find('all', array(
                'contain' => array(
                     'Categories'
                ),
                'conditions' => $conditions,
                'limit' => 20,
            ));
			
		  $products = $products->all(); 
          $products = $products->toArray();
		if($products){
			$response['status'] = true;
            $response['data'] = $products;  
		}else{
			$response['status'] = false;
            $response['msg'] = 'Data not found!';
		}
        }else{
			$response['status'] = false;
            $response['msg'] = 'Please enter product name!';
			
		}
        
  
       $this->set(compact('response'));

       $this->set('_serialize', ['response']);
    }


     public function savereview(){
       
        $this->loadModel('Reviews');
        if ($this->request->is('post')) {
		if(empty($this->request->data['user_id'])){
            $response['status'] = false;
            $response['msg'] = 'User Id required';
        }elseif(empty($this->request->data['product_id'])){
			$response['status'] = false;
            $response['msg'] = 'Product Id required';
		}elseif(empty($this->request->data['punctuality'])){
			$response['status'] = false;
            $response['msg'] = 'Rating Id required';
		}else{
			
		$uid	= $this->request->data['user_id'] ;	
        $product_id = $this->request->data['product_id'];
        $punctuality =  $this->request->data['punctuality'];
        $text =  $this->request->data['text'];
        
        $post = array();  
        $post['user_id'] = $this->request->data['user_id'] ;
        $post['text'] = $text ;
        $post['rating'] = $punctuality ;
        $post['product_id'] = $product_id ;    
        
        
        $review = $this->Reviews->newEntity();
        $cnt = $this->Reviews->find('all', array('conditions' => array('AND' => array('Reviews.user_id' => $uid, 'Reviews.product_id' => $product_id))));
        $cnt = $cnt->first(); 
        if (empty($cnt)) {
             $review = $this->Reviews->patchEntity($review, $post);
             if ($this->Reviews->save($review)) {
                 
                 
                $datacnt = $this->Reviews->find('all', array('conditions' =>array('Reviews.product_id' => $product_id)));
                $datacnt = $datacnt->all()->toArray();
                $sum = 0;
                foreach($datacnt as $datra ){
                  $sum +=  $datra['rating'];
                }
        
        $count = count($datacnt);
        $avg = (int) $sum / (int)$count ; 
                $av_reiew = $avg?$avg:1;
                $this->Products->updateAll(array('avg_rating' =>$av_reiew),
                 array('Products.id' => $product_id));   
                 
                 
             $response['status'] = true;
             $response['msg'] = 'Thanks for review'; 
             
             }else{
			   $response['status'] = false;
               $response['msg'] = 'Something Wrong. Try again!'; 
               
             }
         
        } else { 
			$response['status'] = false;
            $response['msg'] = 'You have been already submitted the review'; 
         
        }
			
		}
			
		

		} 

		 $this->set(compact('response'));

       $this->set('_serialize', ['response']);	

    }



}
