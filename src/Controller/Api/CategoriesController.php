<?php
namespace App\Controller\Api;

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Routing\Router;

use Cake\Mailer\Email;         

use Cake\Auth\DefaultPasswordHasher;
/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[] paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
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
		$category = $this->Categories->find('all', [
            'contain' => ['Products','Subcategories']
        ])->toArray();
		
		if($category){
			$response['status'] = true;
            $response['data'] = $category;
		}else{
			$response['status'] = false;
            $response['msg'] = 'Data not found!';
		}

       $this->set(compact('response'));

       $this->set('_serialize', ['response']);

    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $category = $this->Categories->find('all', [
            'contain' => ['Products','Subcategories'],
            'conditions'=>['Categories.slug'=>$slug]
        ])->first();

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }


        public function subcatBycatId($cat = null)
    { 
        $this->loadModel('Subcategories');
        $category = $this->Subcategories->find('all', [
            'contain' => [],
            'conditions'=>['Subcategories.category_id'=>$cat]
        ])->toArray();

      	if($category){
			$response['status'] = true;
            $response['data'] = $category;
		}else{
			$response['status'] = false;
            $response['msg'] = 'Data not found!';
		}

       $this->set(compact('response'));

       $this->set('_serialize', ['response']);
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
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
