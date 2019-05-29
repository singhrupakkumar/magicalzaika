<?php
namespace App\Controller\Admin;     

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;  

/**
 * Testimonials Controller
 *
 * @property \App\Model\Table\TestimonialsTable $Testimonials
 *
 * @method \App\Model\Entity\Category[] paginate($object = null, array $settings = [])
 */
class TestimonialsController extends AppController
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
    
    

    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => []
        ];
        $testimonials = $this->paginate($this->Testimonials);

        $this->set(compact('testimonials'));
        $this->set('_serialize', ['testimonials']);
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
        $testimonials = $this->Testimonials->get($id, [
        ]);


        $this->set('testimonials', $testimonials);
        $this->set('_serialize', ['testimonials']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testimonials = $this->Testimonials->newEntity(); 
        if ($this->request->is('post')) {
            
            $testimonials = $this->Testimonials->patchEntity($testimonials, $this->request->getData());
            if ($this->Testimonials->save($testimonials)) {
                $this->Flash->success(__('The testimonials has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The testimonials could not be saved. Please, try again.'));
        }
     
        $this->set(compact('testimonials'));
        $this->set('_serialize', ['testimonials']);
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
        $testimonials = $this->Testimonials->get($id, [
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $testimonials = $this->Testimonials->patchEntity($testimonials,  $this->request->getData());
            if ($this->Testimonials->save($testimonials)) {
                $this->Flash->success(__('The testimonials has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The testimonials could not be saved. Please, try again.'));
        }

        $this->set(compact('testimonials'));
        $this->set('_serialize', ['testimonials']);
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
        $testimonials = $this->Testimonials->get($id);

        if ($this->Testimonials->delete($testimonials)) {
            $this->Flash->success(__('The testimonial has been deleted.'));
        } else {
            $this->Flash->error(__('The testimonial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }  
}
