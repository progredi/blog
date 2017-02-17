<?php
namespace Progredi\Blog\Controller;

use Progredi\Blog\Controller\AppController;

/**
 * Articles Controller
 *
 * PHP5
 *
 * @category Controller
 * @package  Progredi\Blog
 * @version  0.1.0
 * @author   David Scott <support@progredi.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */
class ArticlesController extends AppController
{
	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index()
	{
		$this->set('title_for_layout', __('Blog'));

		$this->set('articles', $this->paginate($this->Articles));
		$this->set('_serialize', ['articles']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, otherwise renders view.
	 */
	public function add()
	{
		$entityName = $this->TableNamePlural->newEntity();
		if ($this->request->is('post')) {
			$entityName = $this->TableNamePlural->patchEntity($entityName, $this->request->data);
			if ($this->TableNamePlural->save($entityName)) {
				$this->Flash->success(__('Entity Name has been saved'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Entity Name could not be saved, please, try again'));
			}
		}
		$this->set(compact('entityName'));
		$this->set('_serialize', ['entityName']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id User id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$article = $this->Articles->get($id, [
			//'contain' => ['Comments']
		]);

		$this->set('article', $article);
		$this->set('_serialize', ['article']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id User id.
	 * @return void Redirects on successful edit, otherwise renders view.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$entityName = $this->TableNamePlural->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$entityName = $this->TableNamePlural->patchEntity($entityName, $this->request->data);
			if ($this->TableNamePlural->save($entityName)) {
				$this->Flash->success(__('Entity Name has been saved'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Entity Name could not be saved, please try again'));
			}
		}
		$this->set('entityName', $entityName);
		$this->set('_serialize', ['entityName']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id User id.
	 * @return void Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$entityName = $this->TableNamePlural->get($id);
		if ($this->TableNamePlural->delete($entityName)) {
			$this->Flash->success(__('Entity Name has been deleted'));
		} else {
			$this->Flash->error(__('Entity Name could not be deleted, please try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}
}
