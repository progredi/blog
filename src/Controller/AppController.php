<?php
namespace Progredi\Blog\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Session;

/**
 * Blog AppController
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
class AppController extends BaseController
{
	/**
	 * Helpers
	 *
	 * @var array
	 * @access public
	 */
	public $helpers = [
		'Html' => ['templates' => 'templates'],
		'Paginator' => ['templates' => 'templates-paginator'],
		'Tanuck/Markdown.Markdown'
	];

	/**
	 * BeforeFilter method
	 *
	 * @access public
	 * @return void
	 */
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
	}

	/**
	 * Initialize method
	 *
	 * @access public
	 * @return void
	 */
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Flash');
		$this->loadComponent('Paginator');
	}

	// SHARED FUNCTIONS

	/**
	 * Index method [Admin]
	 *
	 * @access public
	 * @return array
	 */
	public function admin_index()
	{
		$conditions = [];
		$model = $this->name;

		if ($this->request->is(['post', 'put'])) {
			$column = $this->request->data['column'];
			$value = $this->request->data['value'];
			$conditions = $column == 'id' ? ["$model.$column" => [$value]]
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
