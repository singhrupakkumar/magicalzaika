<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 *
 * @method \App\Model\Entity\Review[] paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController
{
	
	public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin');

        }

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
        $review = $this->Reviews->find('all', [
                'contain'	=>	['Products','Users'], 
                'order'		=>  ['Reviews.id' => 'desc']
        ]);
	
	$review = $review->all()->toArray();   
        $this->set(compact('review'));
        $this->set('_serialize', ['review']);
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('review', $review);
        $this->set('_serialize', ['review']);
    }

   

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function reviews($id = null){
		
		$reviews = $this->Reviews->find('all', [
			'contain'	=>	['Users'],
			'conditions' => ['Reviews.id' => $id],
			'order'		=>  ['Reviews.id' => 'desc']
		]);
		
		$reviews = $reviews->all()->toArray();

        $this->set(compact('reviews'));
        $this->set('_serialize', ['reviews']);
	}
}
