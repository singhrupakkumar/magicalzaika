<?php
namespace App\Controller\Admin;     

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;  

/**
 * Subcategories Controller
 *
 * @property \App\Model\Table\SubcategoriesTable $Subcategories
 *
 * @method \App\Model\Entity\Category[] paginate($object = null, array $settings = [])
 */
class SubcategoriesController extends AppController
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
    
    
    
     private function slugify($str) {  
                // trim the string
                $str = strtolower(trim($str));
                // replace all non valid characters and spaces with an underscore
                $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                $str = preg_replace('/-+/', "_", $str);
        return $str;
     } 
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $subcategories = $this->paginate($this->Subcategories);

        $this->set(compact('subcategories'));
        $this->set('_serialize', ['subcategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subcategories = $this->Subcategories->get($id, [
            'contain' => []
        ]);

        $this->set('subcategories', $subcategories);
        $this->set('_serialize', ['subcategories']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subcategories = $this->Subcategories->newEntity(); 
        if ($this->request->is('post')) {
            
             $image = $this->request->data['image'];


            if($this->request->data['image']['name'] != ''){
    	    $name = time().$image['name']; 
    		$tmp_name = $image['tmp_name'];
    		$upload_path = WWW_ROOT.'images/categories/'.$name; 
    		move_uploaded_file($tmp_name, $upload_path);
            $this->request->data['image'] = $name;  
            }else{
                unset($this->request->data['image']);
            }    
            $this->request->data['slug'] =$this->slugify($this->request->data['name']);
            
            $subcategories = $this->Subcategories->patchEntity($subcategories, $this->request->getData());
            if ($this->Subcategories->save($subcategories)) {
                $this->Flash->success(__('The Sub category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Sub category could not be saved. Please, try again.'));
        }
       $parentCategories = $this->Subcategories->Categories->find('list', ['limit' => 200]);
        $this->set(compact('subcategories','parentCategories'));
        $this->set('_serialize', ['subcategories']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subcategories = $this->Subcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
                   $post = $this->request->data; 

			if($this->request->data['image']['name'] != ''){ 
					
			 	
			 
				$image = $this->request->data['image'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/categories/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				 
				$post['image'] = $name;
			
			}else{
				unset($this->request->data['image']);
				$post = $this->request->data;
			}
            
             
            $subcategories = $this->Subcategories->patchEntity($subcategories, $post);
            if ($this->Subcategories->save($category)) {
                $this->Flash->success(__('The sub categories has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sub categories could not be saved. Please, try again.'));
        }

        $parentCategories = $this->Subcategories->Categories->find('list', ['limit' => 200]);
        $this->set(compact('subcategories','parentCategories'));
        $this->set('_serialize', ['subcategories']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subcategories = $this->Subcategories->get($id);

        if ($this->Subcategories->delete($subcategories)) {
            $this->Flash->success(__('The sub categories has been deleted.'));
        } else {
            $this->Flash->error(__('The subcategories could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }  
}
