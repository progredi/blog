<?php
namespace App\View;

use Cake\View\View;

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * App View class
 */
class AppView extends View
{
	/**
	 * Initialization hook method.
	 *
	 * For e.g. use this method to load a helper for all views:
	 * `$this->loadHelper('Html');`
	 *
	 * @return void
	 */
	public function initialize()
	{
		parent::initialize();

		//$this->loadHelper('Markdown.Markdown');
		//$this->loadHelper('Tanuck/Markdown.Markdown');
		//$this->loadHelper('Html');
		//$this->loadHelper('Form');
		//$this->loadHelper('Flash');
		//$this->loadHelper('Paginator');
	}
}
