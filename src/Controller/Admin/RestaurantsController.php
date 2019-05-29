<?php
namespace App\Controller\Admin;  

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;  

/**
 * Restaurants Controller
 *
 * @property \App\Model\Table\RestaurantsTable $Restaurants
 *
 * @method \App\Model\Entity\Store[] paginate($object = null, array $settings = [])
 */
class RestaurantsController extends AppController
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

   $this->Auth->allow(['slugify']); 

   $this->authcontent();

}  



    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

       $this->paginate = [
        'contain' => [],
    ];
    $restaurants = $this->paginate($this->Restaurants);  

    $this->set(compact('restaurants'));
    $this->set('_serialize', ['restaurants']);
}

    /**
     * View method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $restaurants = $this->Restaurants->get($id, [
            'contain' => ['Products'=>['Categories','Subcategories']]
        ]);

      
        $this->set('restaurants', $restaurants);
        $this->set('_serialize', ['restaurants']);
    }



    public function locations($rest_id = null)
    {
        $this->loadModel('Restaurentlocations');
         $this->paginate = [
            'contain' => [],
            'conditions'=>['Restaurentlocations.rest_id'=>$rest_id],
            'order'=>['Restaurentlocations.id'=>'desc']
        ];
        $restaurentlocations = $this->paginate($this->Restaurentlocations);  
        $this->set(compact('restaurentlocations','rest_id'));
        $this->set('_serialize', ['storelocations']);
    }

      public function locationadd($store_id = null) 
    {
        $this->loadModel('Restaurentlocations');
     
        $restaurentlocations = $this->Restaurentlocations->newEntity();
        if ($this->request->is('post')) { 
            $this->request->data['rest_id'] = $store_id;
            
            $restaurentlocations = $this->Restaurentlocations->patchEntity($restaurentlocations, $this->request->getData());
            if ($this->Restaurentlocations->save($restaurentlocations)) {
                $this->Flash->success(__('The store location has been saved.'));
                return $this->redirect(['action' => 'locations/'.$store_id]);
            }
            $this->Flash->error(__('The store location could not be saved. Please, try again.'));
        }
        
        $this->set(compact('restaurentlocations'));      
        $this->set('_serialize', ['restaurentlocations']);
    }
    

    public function locationedit($id = null)
    {
        $this->loadModel('Restaurentlocations');
        $storelocation = $this->Restaurentlocations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
               $post = $this->request->data;
            $storelocation = $this->Restaurentlocations->patchEntity($storelocation, $post);
            if ($this->Restaurentlocations->save($storelocation)) {
                $this->Flash->success(__('The store location has been saved.'));
                return $this->redirect(['action' => 'locations/'.$storelocation->store_id]);
            }
            $this->Flash->error(__('The store location could not be saved. Please, try again.'));
        }
      
        $this->set(compact('storelocation'));
        $this->set('_serialize', ['storelocation']);
    }

     public function LatLongFromAddress() {
        $complete_address= $_POST['address'];
        if (!empty($complete_address)) {
            $format_address = str_replace(' ', '+', $complete_address);
            $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $format_address . '&key=AIzaSyBQrWZPh0mrrL54_UKhBI2_y8cnegeex1o&sensor=true', false);
          
   

            $output = json_decode($geocodeFromAddr);
            if (!empty($output)) {
                //$data['output']=$output;
                $data['latitude'] = $output->results[0]->geometry->location->lat;
                $data['longitude'] = $output->results[0]->geometry->location->lng;
            }else{
                $data['latitude'] = 0;
                $data['longitude'] = 0;
            }
          
        }
       echo  json_encode($data);
        exit; 
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    
    private function slugify($str) { 
                // trim the string
        $str = strtolower(trim($str));
                // replace all non valid characters and spaces with an underscore
        $str = preg_replace('/[^a-z0-9-]/', '_', $str);
        $str = preg_replace('/-+/', "_", $str);
        return $str;
    }
    public function add() 
    {


        $restaurants = $this->Restaurants->newEntity();
        if ($this->request->is('post')) { 
          $image = $this->request->data['image'];
          if($image['name'] !=''){
              $name = time().$image['name'];
              $tmp_name = $image['tmp_name'];
              $upload_path = WWW_ROOT.'images/restaurants/'.$name;
              move_uploaded_file($tmp_name, $upload_path);  
              $this->request->data['image'] = $name;
          }else{
            unset( $this->request->data['image']);
        }  

        $this->request->data['slug'] = $this->slugify($this->request->data['name']);  
        $restaurants = $this->Restaurants->patchEntity($restaurants, $this->request->getData());
        if ($this->Restaurants->save($restaurants)) { 
            $this->Flash->success(__('The restaurants has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The restaurants could not be saved. Please, try again.'));
    }


    $this->set(compact('restaurants'));      
    $this->set('_serialize', ['restaurants']);
}


 public function locationdelete($locationid = null,$storeid = null)
    {
    
        $this->loadModel('Restaurentlocations');
        $this->request->allowMethod(['post', 'delete']);
        $store = $this->Restaurentlocations->get($locationid);
        if ($this->Restaurentlocations->delete($store)) {
            $this->Flash->success(__('The locations has been deleted.'));
        } else {
            $this->Flash->error(__('The locations could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'locations/'.$storeid]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $restaurants = $this->Restaurants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

         $post = $this->request->data;

         if($this->request->data['image']['name'] != ''){ 



            $image = $this->request->data['image'];
            $name = time().$image['name'];
            $tmp_name = $image['tmp_name'];
            $upload_path = WWW_ROOT.'images/restaurants/'.$name;
            move_uploaded_file($tmp_name, $upload_path);

            $post['image'] = $name;

        }else{
            unset($this->request->data['image']);
            $post = $this->request->data;
        }


        $restaurants = $this->Restaurants->patchEntity($restaurants, $post);
        if ($this->Restaurants->save($restaurants)) {
            $this->Flash->success(__('The restaurants has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The restaurants could not be saved. Please, try again.'));
    }
    
    $this->set(compact('restaurants'));
    $this->set('_serialize', ['restaurants']);
}

    /**
     * Delete method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $store = $this->Restaurants->get($id);
        if ($this->Restaurants->delete($store)) {
            $this->Flash->success(__('The store has been deleted.'));
        } else {
            $this->Flash->error(__('The store could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
