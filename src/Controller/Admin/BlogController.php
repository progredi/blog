<?php

namespace Progredi\Blog\Controller\Admin;

use Progredi\Blog\Controller\Admin\AppController;

/**
 * Blog Admin Controller
 *
 * PHP5/7
 *
 * @category  Controller
 * @package   Progredi\Blog
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      https://github.com/progredi/blog
 */
class BlogController extends AppController
{
	/**
	 * Dashboard method
	 *
	 * @return void
	 */
	public function dashboard() {

		$this->set('title_for_layout', __('Dashboard') . TS . __('Blog') . TS . __('Admin'));
	}
}
