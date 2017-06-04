<?php
namespace Progredi\Blog\Controller\Admin;

use Progredi\Blog\Controller\Admin\AppController;

/**
 * Comments Controller
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
class CommentsController extends AppController
{
	/**
	 * Index method [Admin]
	 *
	 * @return void
	 */
	public function index()
	{
		// Configure pagination request.

		$this->paginate['Comments'] = [
			'conditions' => parent::admin_index(),
			//'fields' => ['Comments.id', 'Comments.name', 'Comments.enabled'],
			'limit' => $this->paginate['limit'],
			'order' => ['Comments.name' => 'asc'],
			'contain' => [
				'Posts'
			]
		];

		// Check for invalid pagination requests.

		try {
			$comments = $this->paginate($this->Comments);
		}
		catch (NotFoundException $e) {

			// Check for out of range page request.

			$this->Flash->error(__("Page request out of range"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('Comments') . TS . __('Blog') . TS . __('Admin'));

		$this->set('comments', $comments);
		$this->set('_serialize', ['comments']);
	}

	/**
	 * Add method [Admin]
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$session = $this->request->session();

		$comment = $this->Comments->newEntity();

		if ($this->request->is('post')) {
			$comment = $this->Comments->patchEntity($comment, $this->request->data);
			// Validate request data for new entity
			if ($comment->errors()) {
				// Entity failed validation.
			}
			if ($this->Comments->save($comment)) {
				$this->Flash->success(__('Comment details have been saved'));
				if (isset($this->request->data['apply'])) {
					return $this->redirect(['action' => 'edit', $this->Comments->id]);
				}
				return $this->redirect($session->read('App.referrer'));
			}
			$this->Flash->error(__('Comment details could not be saved, please try again'));
		}

		if (!$this->request->data) {
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Add Comment') . TS . __('Blog') . TS . __('Admin'));

		$this->set('comment', $comment);
		$this->set('_serialize', ['comment']);
	}

	/**
	 * View method [Admin]
	 *
	 * @param string|null $id comment id. Can be null for testing purposes.
	 * @return void Redirects on failed entity retrieval, renders view otherwise.
	 */
	public function view($id = null)
	{
		// Check for entity request errors.

		try {
			$comment = $this->Comments->get($id//, [
				//'contain' => ['Posts']
			//]
			);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Comment not found'));
			return $this->redirect(['action' => 'index']);
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('View Comment') . TS . __('Blog') . TS . __('Admin'));

		$session = $this->request->session();
		$session->write('App.referrer', $this->referer());

		$this->set('comment', $comment);
		$this->set('_serialize', ['comment']);
	}

	/**
	 * Edit method [Admin]
	 *
	 * @param string|null $id Comment id.
	 * @return void Redirects to referring page on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		// Check for entity request errors.

		try {
			$comment = $this->Comments->get($id, [
				'contain' => ['AssocComments']
			]);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Comment not found'));
			return $this->redirect(['action' => 'index']);
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$session = $this->request->session();

		if ($this->request->is(['patch', 'post', 'put'])) {
			$comment = $this->Comments->patchEntity($comment, $this->request->data);
			// Validate request data for new entity
			if ($comment->errors()) {
				// Entity failed validation.
			}
			if ($this->Comments->save($comment)) {
				$this->Flash->success(__('Comment details haves been updated'));
				if (!isset($this->request->data['apply'])) {
					return $this->redirect($session->read('App.referrer'));
				}
			} else {
				$this->Flash->error(__('Comment details could not be updated, please try again'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $comment;
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Edit Comment') . TS . __('Blog') . TS . __('Admin'));

		$this->set('comment', $comment);
		$this->set('_serialize', ['comment']);

		// Optional dropdown list data
		//$this->set('assocTableNameList', $this->TableName->AssocTableName->options());
	}

	/**
	 * Delete method [Admin]
	 *
	 * @param string|null $id comment id.
	 * @return void Redirects to referrer or index method
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);

		// Check for entity request errors.

		try {
			$comment = $this->Comments->get($id);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Comment not found'));
			return $this->redirect(env('HTTP_REFERER'));
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(env('HTTP_REFERER'));
		}

		if ($this->Comments->delete($comment)) {
			$this->Flash->success(__('Comment has been deleted'));
		} else {
			$this->Flash->error(__('Comment could not be deleted, please try again'));
		}

		return $this->redirect(preg_match('/view|edit/', env('HTTP_REFERER'))
			? ['action' => 'index']
			: env('HTTP_REFERER')
		);
	}
}
