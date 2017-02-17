<?php

use Cake\Core\Configure;
use Cake\Network\Session;

/**
 * Dashboard View
 *
 * PHP5
 *
 * @category  View
 * @package   CakePHP Blog Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */

$session = $this->request->session();

?>
<?= $this->element('navigation/breadcrumbs', [
	'menuItems' => [
		[__('Dashboard'), __('Admin Dashboard'), ['plugin' => 'ProgrediApp', 'controller' => 'Dashboard', 'action' => 'dashboard']],
		[__('Blog'), __('Blog Dashboard'), ['controller' => 'Blog', 'action' => 'dashboard']],
		[null, null, []]
	]
]); ?>

<div class="blog dashboard">

<h1><?= __('Blog Dashboard'); ?></h1>

</div>
