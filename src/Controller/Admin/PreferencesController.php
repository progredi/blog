<?php

namespace Progredi\Blog\Controller\Admin;

use Progredi\Blog\Controller\Admin\AppController;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Session;

/**
 * Preferences Admin Controller
 *
 * PHP5/7
 *
 * @category  Controller\Admin
 * @package   Progredi\App
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   https://choosealicense.com/licenses/mit/ MIT License
 * @link      https://github.com/progredi/blog
 */
class PreferencesController extends AppController
{
	/**
	 * Index method [Admin]
	 *
	 * @return void
	 */
	public function index()
	{
		// Configure pagination request.

		$this->paginate['Preferences'] = [
			'conditions' => parent::index(),
			//'fields' => ['Preferences.id', 'Preferences.name', 'Preferences.enabled'],
			'limit' => $this->paginate['limit'],
			'order' => ['Preferences.name' => 'asc']
		];

		// Check for invalid pagination requests.

		try {
			$preferences = $this->paginate($this->Preferences);
		}
		catch (NotFoundException $e) {

			// Check for out of range page request.

			$this->Flash->error(__("Page request out of range"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('Preferences') . TS . __('Blog') . TS . __('Admin'));

		$this->set('preferences', $preferences);
		$this->set('_serialize', ['preferences']);
	}

	/**
	 * Add method [Admin]
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$session = $this->request->session();

		$entityName = $this->Preferences->newEntity();

		if ($this->request->is('post')) {
			$entityName = $this->Preferences->patchEntity($entityName, $this->request->data);
			// Validate request data for new entity
			if ($entityName->errors()) {
				// Entity failed validation.
			}
			if ($this->Preferences->save($entityName)) {
				$this->Flash->success(__('Entity name details have been saved'));
				if (isset($this->request->data['apply'])) {
					return $this->redirect(['action' => 'edit', $this->Preferences->id]);
				}
				return $this->redirect($session->read('App.referrer'));
			}
			$this->Flash->error(__('Entity name details could not be saved, please try again'));
		}

		if (!$this->request->data) {
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Add Entity Name') . TS . __('Plugin Name') . TS . __('Admin'));

		$this->set('entityName', $entityName);
		$this->set('_serialize', ['entityName']);

		// Optional dropdown list data
		//$this->set('assocTableNameList', $this->TableName->AssocTableName->options());
	}

	/**
	 * View method [Admin]
	 *
	 * @param string|null $id EntityName id. Can be null for testing purposes.
	 * @return void Redirects on failed entity retrieval, renders view otherwise.
	 */
	public function view($id = null)
	{
		// Check for entity request errors.

		try {
			$entityName = $this->Preferences->get($id, [
				'contain' => ['AssocPreferences']
			]);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Entity Name not found'));
			return $this->redirect(['action' => 'index']);
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('View Entity Name') . TS . __('Plugin Name') . TS . __('Admin'));

		$session = $this->request->session();
		$session->write('App.referrer', $this->referer());

		$this->set('entityName', $entityName);
		$this->set('_serialize', ['entityName']);
	}

	/**
	 * Edit method [Admin]
	 *
	 * @param string|null $id Entity name id.
	 * @return void Redirects to referring page on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		// Check for entity request errors.

		try {
			$entityName = $this->Preferences->get($id, [
				'contain' => ['AssocPreferences']
			]);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Entity Name not found'));
			return $this->redirect(['action' => 'index']);
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$session = $this->request->session();

		if ($this->request->is(['patch', 'post', 'put'])) {
			$entityName = $this->Preferences->patchEntity($entityName, $this->request->data);
			// Validate request data for new entity
			if ($entityName->errors()) {
				// Entity failed validation.
			}
			if ($this->Preferences->save($entityName)) {
				$this->Flash->success(__('Entity name details haves been updated'));
				if (!isset($this->request->data['apply'])) {
					return $this->redirect($session->read('App.referrer'));
				}
			} else {
				$this->Flash->error(__('Entity name details could not be updated, please try again'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $entityName;
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Edit Entity Name') . TS . __('Plugin Name') . TS . __('Admin'));

		$this->set('entityName', $entityName);
		$this->set('_serialize', ['entityName']);

		// Optional dropdown list data
		//$this->set('assocTableNameList', $this->TableName->AssocTableName->options());
	}

	/**
	 * Delete method [Admin]
	 *
	 * @param string|null $id EntityName id.
	 * @return void Redirects to referrer or index method
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);

		// Check for entity request errors.

		try {
			$entityName = $this->Preferences->get($id);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Entity Name not found'));
			return $this->redirect(env('HTTP_REFERER'));
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(env('HTTP_REFERER'));
		}

		if ($this->Preferences->delete($entityName)) {
			$this->Flash->success(__('Entity name has been deleted'));
		} else {
			$this->Flash->error(__('Entity name could not be deleted, please try again'));
		}

		return $this->redirect(preg_match('/view|edit/', env('HTTP_REFERER'))
			? ['action' => 'index']
			: env('HTTP_REFERER')
		);
	}
}
