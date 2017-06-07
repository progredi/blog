<?php

namespace Progredi\Blog\Controller\Admin;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Session;
use Progredi\Blog\Controller\Admin\AppController;

/**
 * Posts Admin Controller
 *
 * PHP5/7
 *
 * @category  Controller
 * @package   Progredi\Blog
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/blog
 */
class PostsController extends AppController
{
	/**
	 * Index method [Admin]
	 *
     * @access public
     * @throws \Cake\Network\Exception\NotFoundException On paging error
     * @return \Cake\Http\Response|void Redirects on pagination error, renders view otherwise.
	 */
	public function index()
	{
		//$posts = $this->Posts->find('all')->contain(['Tags']);

//echo "<pre>\n\nRequest Data: " . print_r($posts->toArray(), true) . "\n</pre>\n\n";
//exit();

		// Configure pagination request.

		$this->paginate['Posts'] = [
			'conditions' => parent::index(),
			//'fields' => ['Posts.title', 'Posts.comment_count', 'Posts.published', 'Posts.enabled'],
			'limit' => $this->paginate['limit'],
			'order' => ['Posts.published' => 'desc'],
			'contain' => [
				'Comments',
				'Categories',
				'Tags'
			]
		];

		// Check for invalid pagination requests.

		try {
			$posts = $this->paginate($this->Posts);
		} catch (NotFoundException $e) {
			// Check for out of range page request.
			$this->Flash->error(__("Page request out of range"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('Posts') . TS . __('Blog') . TS . __('Admin'));

		$this->set('posts', $posts);
		$this->set('_serialize', ['posts']);
	}

	/**
	 * Add method [Admin]
	 *
     * @access public
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$session = $this->request->session();

		$post = $this->Posts->newEntity();

		if ($this->request->is('post')) {
			$post = $this->Posts->patchEntity($post, $this->request->getData());
			// Validate request data for new entity
			if ($post->errors()) {
				// Entity failed validation.
			}
			if ($this->Posts->save($post)) {
				$this->Flash->success(__('Post details have been saved'));
				if (!is_null($this->request->getData('apply'))) {
					return $this->redirect(['action' => 'edit', $this->Posts->id]);
				}
				return $this->redirect($session->read('App.referrer'));
			}
			$this->Flash->error(__('Post details could not be saved, please try again'));
		}

		if (!$this->request->getData()) {
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Add Post') . TS . __('Blog') . TS . __('Admin'));

		$this->set('post', $post);
		$this->set('_serialize', ['post']);
	}

	/**
	 * View method [Admin]
	 *
	 * @param string|null $id
	 * @return void Redirects on failed entity retrieval, renders view otherwise.
	 */
	public function view($id = null)
	{
		// Check for entity request errors.

		try {
			$post = $this->Posts->get($id, [
				'contain' => [
					'Comments',
					'Categories',
					'Tags'
				]
			]);
		} catch (RecordNotFoundException $e) {
			// Record primary key not found in table.
			$this->Flash->error(__('Post not found'));
			return $this->redirect(['action' => 'index']);
		} catch (InvalidPrimaryKeyException $e) {
			// Invalid primary key, e.g. NULL.
			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('View Post') . TS . __('Blog') . TS . __('Admin'));

		$session = $this->request->session();
		$session->write('App.referrer', $this->referer());

		$this->set('post', $post);
		$this->set('_serialize', ['post']);
	}

	/**
	 * Edit method [Admin]
	 *
	 * @param string|null $id
	 * @return void Redirects to referring page on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		// Check for entity request errors.

		try {
			$post = $this->Posts->get($id, [
				'contain' => ['Comments']
			]);
		} catch (RecordNotFoundException $e) {
			// Record primary key not found in table.
			$this->Flash->error(__('Post not found'));
			return $this->redirect(['action' => 'index']);
		} catch (InvalidPrimaryKeyException $e) {
			// Invalid primary key, e.g. NULL.
			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$session = $this->request->session();

		if ($this->request->is(['patch', 'post', 'put'])) {
			$post = $this->Posts->patchEntity($post, $this->request->getData());
			// Validate request data for new entity
			if ($post->errors()) {
				// Entity failed validation.
			}
			if ($this->Posts->save($post)) {
				$this->Flash->success(__('Post details haves been updated'));
                if (!is_null($this->request->getData('apply'))) {
					return $this->redirect($session->read('App.referrer'));
				}
			} else {
				$this->Flash->error(__('Post details could not be updated, please try again'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $post;
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Edit Post') . TS . __('Blog') . TS . __('Admin'));

		$this->set('post', $post);
		$this->set('_serialize', ['post']);
	}

	/**
	 * Delete method [Admin]
	 *
     * @access public
     * @param string|null $id
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Cake\Datasource\Exception\InvalidPrimaryKeyException When primary key invalid
     * @return \Cake\Http\Response Redirects to index method or referrer
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);

		// Check for entity request errors.

		try {
			$post = $this->Posts->get($id);
		} catch (RecordNotFoundException $e) {
			// Record primary key not found in table.
			$this->Flash->error(__('Post not found'));
			return $this->redirect(env('HTTP_REFERER'));
		} catch (InvalidPrimaryKeyException $e) {
			// Invalid primary key, e.g. NULL.
			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(env('HTTP_REFERER'));
		}

		if ($this->Posts->delete($post)) {
			$this->Flash->success(__('Post has been deleted'));
		} else {
			$this->Flash->error(__('Post could not be deleted, please try again'));
		}

		return $this->redirect(preg_match('/view|edit/', env('HTTP_REFERER'))
			? ['action' => 'index']
			: env('HTTP_REFERER')
		);
	}
}
