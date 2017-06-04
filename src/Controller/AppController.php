<?php

namespace Progredi\Blog\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Session;

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
	 * Helpers
	 *
	 * @var array
	 * @access public
	public $helpers = [
		'Html' => ['templates' => 'templates'],
		'Paginator' => ['templates' => 'templates/paginator'],
		'Form' => ['templates' => 'templates/form'],
		//'Tanuck/Markdown.Markdown',
		'Markdown.Markdown'
	];
	 */

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
	 * BeforeFilter method
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
		//$this->loadComponent('Markdown.Markdown');
	}
}
