<?php

namespace Progredi\Blog\Controller\Admin;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;
use Progredi\Blog\Controller\Admin\AppController;

/**
 * ControllerName Controller
 *
 * PHP5
 *
 * @category  Controller\Admin
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */
class CategoriesController extends AppController
{
	/**
	 * BeforeFilter method [Admin]
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);

		$this->Categories->recover();
	}
	 */

	/**
	 * Index method [Admin]
	 *
	 * @return void
	 */
	public function index()
	{
		// Configure pagination request.

		$this->paginate['Categories'] = [
			'conditions' => parent::index(),
			'limit' => $this->paginate['limit'],
			'order' => [
				'Categories.name' => 'asc'
			]
		];

		// Check for invalid pagination requests.

		try {
			$categories = $this->paginate($this->Categories);

//echo "<pre>\n\nRequest Data: " . print_r($categories->toArray(), true) . "\n</pre>\n\n";
//exit();
		}
		catch (NotFoundException $e) {

			// Check for out of range page request.

			$this->Flash->error(__("Page request out of range"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('Categories') . TS . __('Blog') . TS . __('Admin'));

		$this->set('categories', $categories);
		$this->set('_serialize', ['categories']);
	}

	/**
	 * Add method [Admin]
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$session = $this->request->session();

		$category = $this->Categories->newEntity();

		if ($this->request->is('post')) {
			$category = $this->Categories->patchEntity($category, $this->request->data);
			// Validate request data for new entity
			if ($category->errors()) {
				// Entity failed validation.
			}
			if ($this->Categories->save($category)) {
				$this->Flash->success(__('Category details have been saved'));
				if (isset($this->request->data['apply'])) {
					return $this->redirect(['action' => 'edit', $this->Categories->id]);
				}
				return $this->redirect($session->read('App.referrer'));
			}
			$this->Flash->error(__('Category details could not be saved, please try again'));
		}

		if (!$this->request->data) {
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Add Category') . TS . __('Blog') . TS . __('Admin'));

		$this->set('category', $category);
		$this->set('_serialize', ['category']);

		$this->set('categoriesOptions', $this->Categories->options());
	}

	/**
	 * View method [Admin]
	 *
	 * @param string|null $id category id. Can be null for testing purposes.
	 * @return void Redirects on failed entity retrieval, renders view otherwise.
	 */
	public function view($id = null)
	{
		// Check for entity request errors.

		try {
			$category = $this->Categories->get($id, [
				//'contain' => ['Posts']
			]);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Category not found'));
			return $this->redirect(['action' => 'index']);
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('View Category') . TS . __('Blog') . TS . __('Admin'));

		$session = $this->request->session();
		$session->write('App.referrer', $this->referer());

		$this->set('category', $category);
		$this->set('_serialize', ['category']);
	}

	/**
	 * Edit method [Admin]
	 *
	 * @param string|null $id Category id.
	 * @return void Redirects to referring page on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		// Check for entity request errors.

		try {
			$category = $this->Categories->get($id, [
				//'contain' => ['Posts']
			]);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Category not found'));
			return $this->redirect(['action' => 'index']);
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$session = $this->request->session();

		if ($this->request->is(['patch', 'post', 'put'])) {
			$category = $this->Categories->patchEntity($category, $this->request->data);
			// Validate request data for new entity
			if ($category->errors()) {
				// Entity failed validation.
			}
			if ($this->Categories->save($category)) {
				$this->Flash->success(__('Category details haves been updated'));
				if (!isset($this->request->data['apply'])) {
					return $this->redirect($session->read('App.referrer'));
				}
			} else {
				$this->Flash->error(__('Category details could not be updated, please try again'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $category;
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Edit Category') . TS . __('Blog') . TS . __('Admin'));

		$this->set('category', $category);
		$this->set('_serialize', ['category']);


		$this->set('categoriesOptions', $this->Categories->options());
	}

	/**
	 * MoveUp method [Admin]
	 *
	 * @param string|null $id category id.
	 * @return void Redirects to referrer or index method
	 */
    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $category = $this->Categories->get($id);
        if ($this->Categories->moveUp($category)) {
            $this->Flash->success('Category has been moved Up');
        } else {
            $this->Flash->error('Category could not be moved up, please try again');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

	/**
	 * MoveDown method [Admin]
	 *
	 * @param string|null $id category id.
	 * @return void Redirects to referrer or index method
	 */
    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $category = $this->Categories->get($id);
        if ($this->Categories->moveDown($category)) {
            $this->Flash->success('The category has been moved down.');
        } else {
            $this->Flash->error('The category could not be moved down, please try again');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

	/**
	 * Delete method [Admin]
	 *
	 * @param string|null $id category id.
	 * @return void Redirects to referrer or index method
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);

		// Check for entity request errors.

		try {
			$category = $this->Categories->get($id);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Category not found'));
			return $this->redirect(env('HTTP_REFERER'));
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(env('HTTP_REFERER'));
		}

		if ($this->Categories->delete($category)) {
			$this->Flash->success(__('Category has been deleted'));
		} else {
			$this->Flash->error(__('Category could not be deleted, please try again'));
		}

		return $this->redirect(preg_match('/view|edit/', env('HTTP_REFERER'))
			? ['action' => 'index']
			: env('HTTP_REFERER')
		);
	}
}
