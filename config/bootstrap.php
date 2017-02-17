<?php

use Cake\Core\Configure;

/**
 * Blog Bootstrap
 *
 * PHP5
 *
 * @category  Config
 * @package   Progredi CakePHP 3.x Blog Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */

// Define header title separator
if (!defined('TS')) {
	define('TS', Configure::check('Site.title_separator')
		? Configure::read('Site.title_separator')
		: ' / ');
}
