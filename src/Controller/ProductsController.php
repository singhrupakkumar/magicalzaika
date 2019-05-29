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
class ProductsController extends AppController
{


    
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
    public function index()
    {

      

    }



        public function view($slug = null)
    {
        $this->loadModel('Categories');

         $product = $this->Products->find('all', array(
                'contain'=>['Categories','Reviews'=>['Users']],
                'conditions' => ['Products.slug'=>$slug]   
            ));  

         $product = $product->first();




         $related = $this->Products->find('all', array(
                'conditions' => ['Products.cat_id'=>$product['cat_id']] ,
                'limit'=>3  
            ))->toArray();  

        $this->set('related', $related);
        $this->set('product', $product);
        $this->set('_serialize', ['rest','related']);
    }
	
	
	public function search() { 
              
        $search = null;
        if(!empty($this->request->query['search']) || !empty($this->request->data['name']) || !empty($this->request->query['catid'])) {
            $search = empty($this->request->query['search']) ? isset($this->request->data['name']) : $this->request->query['search'];
            $search = preg_replace('/[^a-zA-Z0-9 ]/', '', $search);
            if(isset($search)){
            $terms = explode(' ', trim($search));
            $terms = array_diff($terms, array('')); 
            }  
            $conditions = array(
                'Products.status' => 1
            );
              
           
            if(!empty($this->request->query['catid'])){
               $conditions = array(
                'Products.cat_id' => $this->request->query['catid']
            );
            }  
            
           if(!empty($terms)){ 
            foreach($terms as $term) {
                $terms1[] = preg_replace('/[^a-zA-Z0-9]/', '', $term);
                $conditions[] = array('Products.name LIKE' => '%' . $term . '%');
            }
           }   
            
           
            
 
            $products = $this->Products->find('all', array(  
                'contain' => array(
                    'Reviews'
                ),
                'conditions' => $conditions,
                'limit' => 200,
            ));
 
            
             $products = $products->all(); 
             $products = $products->toArray(); 
   
            if(count($products) == 1) {
             
                return $this->redirect(array('controller' => 'products', 'action' => 'view/'.$products[0]['slug'])); 
            }
            
         if(!empty($terms1)){
            $terms1 = array_diff($terms1, array(''));
         }
         
       
            $this->set(compact('products', 'terms1'));
        }
        $this->set(compact('search'));  

        if ($this->request->is('ajax')) {
            $this->layout = false;
            $this->set('ajax', 1);
        } else {
            $this->set('ajax', 0);
        }

        $this->set('title_for_layout', 'Search');

        $description = 'Search';
        $this->set(compact('description'));

        $keywords = 'search';
        $this->set(compact('keywords'));
    }
	
	
 public function searchjson() {
        $term = null;
        if(!empty($this->request->query['term'])) {
            $term = $this->request->query['term'];
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
                'fields' => array(
                    'Products.id',
                    'Products.name',
                    'Products.image'
                ),
                'conditions' => $conditions,
                'limit' => 20,
            ));
        }
        
         $products = $products->all(); 
          $products = $products->toArray();
        
        echo json_encode($products);
        exit;
    }


     public function savereview(){
        if(empty($this->Auth->user('id'))){
            $this->Flash->error(__('You must login first!'));
            return $this->redirect('//' .$_POST['server']); 
        }
       $this->loadModel('Reviews');
        if ($this->request->is('post')) {
        $product_id = $this->request->data['product_id'];
        $punctuality =  $this->request->data['punctuality'];
        $text =  $this->request->data['text'];
        
        $post = array();

        if(!empty($this->Auth->user('id'))){
           $uid =  $this->Auth->user('id');
        }else{
           $uid =  0;   
        }  
        $post['user_id'] = $uid ;
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
                 
                 
                 
               $this->Flash->success(__('Thanks for review'));
               return $this->redirect('//' .$_POST['server']);
             }else{
               $this->Flash->error(__('Something Wrong. Try again!'));
               return $this->redirect('//' .$_POST['server']);     
             }
         
        } else {   
           $this->Flash->success(__('You have been already submitted the review')); 
           return $this->redirect('//' .$_POST['server']);
        }

  }  

    }



}
