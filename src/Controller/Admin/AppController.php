<?php

namespace Progredi\Blog\Controller\Admin;

use App\Controller\Admin\AppController as BaseController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Blog Admin AppController
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
     * @param Event $event
     * @return void
     */
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);

		if ($this->request->is('ajax')) {
            // Disable browser caching
            $this->response->withDisabledCache();
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

        if ($this->request->is('get')
            && !is_null($this->request->getQuery('column'))
            && !is_null($this->request->getQuery('value'))
        ) {
            $column = $this->request->getQuery('column');
            $value = $this->request->getQuery('value');
            $conditions = $column == 'id'
                ? ["$model.id" => [$value]]
                : ["$model.$column LIKE" => "%$value%"];
        }

        return $conditions;
    }

    /**
     * Enable method [Admin]
     *
     * @access public
     * @param string|null $id
     * @return \Cake\Http\Response
     */
    public function enable($id = null)
    {
        if (!$id) {
            $this->Flash->error(__('Invalid request: no record id specified'));
            return $this->redirect($this->referer());
        }

        $table = TableRegistry::get($this->request->getParam('plugin') . '.' . $this->name);
        $entity = $table->get($id);

        $entity->enabled = true;

        if ($table->save($entity)) {
            $this->Flash->success(__(Inflector::singularize($this->name) . ' has been enabled'));
            return $this->redirect($this->referer());
        }
        $this->Flash->error(__(Inflector::singularize($this->name) . ' could not be enabled'));
        return $this->redirect($this->referer());
    }

    /**
     * Disable method [Admin]
     *
     * @access public
     * @param string|null $id
     * @return \Cake\Http\Response
     */
    public function disable($id = null)
    {
        if (!$id) {
            $this->Flash->error(__('Invalid request: no record id specified'));
            return $this->redirect($this->referer());
        }

        $table = TableRegistry::get($this->request->getParam('plugin') . '.' . $this->name);
        $entity = $table->get($id);

        $entity->enabled = false;

        if ($table->save($entity)) {
            $this->Flash->success(__(Inflector::singularize($this->name) . ' has been disabled'));
            return $this->redirect($this->referer());
        }
        $this->Flash->error(__(Inflector::singularize($this->name) . ' could not be disabled'));
        return $this->redirect($this->referer());
    }
}
