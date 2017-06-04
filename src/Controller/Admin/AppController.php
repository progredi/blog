<?php

namespace Progredi\Blog\Controller\Admin;

use App\Controller\Admin\AppController as BaseController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

/**
 * Blog AppController
 *
 * PHP5/7
 *
 * @category  Controller
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */
class AppController extends BaseController
{
	/**
	 * Pagination Configuration
	 *
	 * @var array
	 * @access public
	 */
	public $paginate = [
		'limit' => 10
	];

	/**
	 * Initialize()
	 *
	 * @access public
	 * @return void
	 */
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Flash');
		$this->loadComponent('Paginator');
		//$this->loadComponent('Markdown.Markdown');
	}

	/**
	 * BeforeFilter method [Admin]
	 *
	 * @access public
	 * @return void
	 */
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		if ($this->request->is('ajax')) {
			$this->response->disableCache();
		}
	}

	// SHARED FUNCTIONS

	/**
	 * Index method [Admin]
	 * 
	 * Provides text search functionality.
	 *
	 * @access public
	 * @return array
	 */
	public function index()
	{
		$conditions = [];
		$model = $this->name;

		if ($this->request->is(['get']) && isset($this->request->query['column'])) {
			$column = $this->request->query['column'];
			$value = $this->request->query['value'];
			$conditions = $column == 'id'
				? ["$model.id" => [$value]]
				:  ["$model.$column LIKE" => "%$value%"];
		}

		return $conditions;
	}

	/**
	 * Enable method [Admin]
	 *
	 * @access public
	 * @return string
	 */
	public function enable($id = null)
	{
		if (!$id) {
			$this->Flash->error(__('Invalid request: no record id specified'));
			return $this->redirect($this->referer());
		}

		$table = TableRegistry::get($this->request->params['plugin'] . '.' . $this->name);
		$entity = $table->get($id);

		$entity->enabled = true;

		if ($table->save($entity)) {
			$this->Flash->success(__($this->name . ' has been enabled'));
			return $this->redirect($this->referer());
		}
		$this->Flash->error(__($this->name . ' could not be enabled'));
		return $this->redirect($this->referer());
	}

	/**
	 * Disable method [Admin]
	 *
	 * @access public
	 * @return string
	 */
	public function disable($id = null)
	{
		if (!$id) {
			$this->Flash->error(__('Invalid request: no record id specified'));
			return $this->redirect($this->referer());
		}

		$table = TableRegistry::get($this->request->params['plugin'] . '.' . $this->name);
		$entity = $table->get($id);

		$entity->enabled = false;

		if ($table->save($entity)) {
			$this->Flash->success(__($this->name . ' has been disabled'));
			return $this->redirect($this->referer());
		}
		$this->Flash->error(__($this->name . ' could not be disabled'));
		return $this->redirect($this->referer());
	}
}
