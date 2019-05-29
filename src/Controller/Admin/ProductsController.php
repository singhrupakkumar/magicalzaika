<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Core\Configure;

use Cake\Error\Debugger; 
use Cake\ORM\TableRegistry;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[] paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
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

   $this->Auth->allow(['slugify','gallery']); 

   $this->authcontent();
   ini_set('memory_limit', '-1');    

}

private function slugify($str) { 
                // trim the string
    $str = strtolower(trim($str));
                // replace all non valid characters and spaces with an underscore
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', "-", $str);
    return $str;
} 



    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {  	



    /*  $products = $this->Products->find('all',[
         'contain' => ['Categories','Subcategories','Restaurants'],
         'order'		=> ['Products.id' => 'desc']
     ]); */
	 
	 $products = $this->Products->find('all',[
         'contain' => ['Categories','Restaurants'],
         'order'		=> ['Products.id' => 'desc']
     ]);

     $products = $products->all()->toArray();

     foreach($products as &$data){
      if ($data['image'] != '') {
        if (!filter_var($data['image'], FILTER_VALIDATE_URL) === false) {
            $data['image'] = $data['image'];
        } else {
            $data['image'] = Router::url('/', true). "images/products/" . $data['image'];
        }  

    } else {
        $data['image'] = Router::url('/', true). "images/products/no-image.jpg";
    } 
}

$this->set(compact('products'));
$this->set('_serialize', ['products']);
}

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) 
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'Subcategories','Restaurants']
        ]);
        


        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {

            $image = $this->request->data['image'];

            if($image['name'] !=''){
            $name = time().$image['name'];
            $tmp_name = $image['tmp_name'];
            $upload_path = WWW_ROOT.'images/products/'.$name;
            move_uploaded_file($tmp_name, $upload_path);
            $this->request->data['image'] = $name; 

            }else{
                unset($this->request->data['image']);
            }
                
            $this->request->data['slug'] =$this->slugify($this->request->data['name']);
            $product = $this->Products->patchEntity($product, $this->request->getData());
			
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $cats = $this->Products->Categories->find('list', ['limit' => 200]);
        $rests = $this->Products->Restaurants->find('list', ['limit' => 200]);  
        $subcats = $this->Products->Subcategories->find('list', ['limit' => 200]); 

        $this->set(compact('product', 'cats','subcats','rests'));   
        $this->set('_serialize', ['product']);
    }

    
    public function addgallery($productid = null )
    {
        $this->loadModel('Galleries'); 
        $gallery = $this->Galleries->newEntity();
        if ($this->request->is('post')) {

            if(isset($this->request->data['image'])){

                for($i=0; $i<count($this->request->data['image']);$i++){
                    $fileName = $this->request->data['image'][$i]['name'];
                    $fileName = date('His') . $fileName;
                    $uploadPath = WWW_ROOT.'images/gallery/'.$fileName; 
                    $actual_file[] = $fileName;
                    move_uploaded_file($this->request->data['image'][$i]['tmp_name'], $uploadPath);
                    $post['product_id'] = $productid;
                    $post['image']    = $fileName;
                    $gallery = $this->Galleries->newEntity();                    
                    $gallery = $this->Galleries->patchEntity($gallery,$post);            
                    $this->Galleries->save($gallery);
                } 
                $this->Flash->success(__('The gallery has been saved.'));  
                return $this->redirect(['action' => 'gallery/'.$productid]);
            }   


        }
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
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) { 

           $post = $this->request->data;
			//echo "<pre>";print_r($post);die("ppp");
           if($this->request->data['image']['name'] != ''){ 



            $image = $this->request->data['image'];
            $name = time().$image['name'];
            $tmp_name = $image['tmp_name'];
            $upload_path = WWW_ROOT.'images/products/'.$name;
            move_uploaded_file($tmp_name, $upload_path);

            $post['image'] = $name;

        }else{
            unset($this->request->data['image']);
            $post = $this->request->data;
        }
        $product = $this->Products->patchEntity($product, $post );  
		//echo "<pre>";print_r($product);die("ppp");
        if ($this->Products->save($product)) {
            $this->Flash->success(__('The product has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The product could not be saved. Please, try again.'));
    }
     $cats = $this->Products->Categories->find('list', ['limit' => 200]);
        $rests = $this->Products->Restaurants->find('list', ['limit' => 200]);  
        $subcats = $this->Products->Subcategories->find('list', ['limit' => 200]); 

        $this->set(compact('product', 'cats','subcats','rests'));     
    $this->set('_serialize', ['product']);
}

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function gallerydelete($id = null)
    {  
     $this->loadModel('Galleries');
     $this->request->allowMethod(['post', 'delete']);
     $product = $this->Galleries->get($id);
     if ($this->Galleries->delete($product)) {
        $this->Flash->success(__('Image is deleted successfully'));
    } else { 
        $this->Flash->error(__('The Image could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'gallery/'.$product['product_id']]);   
}


}
