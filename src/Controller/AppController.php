<?php

namespace Progredi\Blog\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

/**
 * Blog AppController
 *
 * PHP5/7
 *
 * @category  Controller
 * @package   Progredi/Blog
 * @since     0.1.0
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
     * @access public
     * @var array
     */
    public $paginate = [
        'limit' => 10
    ];

    /**
     * BeforeFilter method
     *
     * @access public
     * @param \Cake\Event\Event $event
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
}
