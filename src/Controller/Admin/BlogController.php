<?php
namespace Progredi\Blog\Controller\Admin;

use Progredi\Blog\Controller\Admin\AppController;

/**
 * Blog Controller
 *
 * PHP5
 *
 * @category  Controller
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2016 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
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
