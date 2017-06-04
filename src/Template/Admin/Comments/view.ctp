<?php

/**
 * Post View Template
 *
 * PHP5/7
 *
 * @category  Template
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-world-plugin
 */

?>
<?= $this->element('navigation/breadcrumbs', [
	'menuItems' => [
		[__('Dashboard'), __('Admin Dashboard'), ['plugin' => null, 'controller' => 'Admin', 'action' => 'dashboard']],
		[__('Blog'), __('Blog Dashboard'), ['controller' => 'Blog', 'action' => 'dashboard']],
		[__('Comments'), __('Comments Dashboard'), ['action' => 'index']],
		[null, null, []]
	]
]); ?>

<h1><?= __('View Comment'); ?>: <strong><?= h($comment->title); ?></strong></h1>

<div class="comment view">

<div class="ui top attached tabular menu">
<a class="active item" data-tab="comment"><?= __('Comment'); ?></a>
</div>

<!--[ COMMENT ]-->

<div class="ui bottom attached active tab segment" data-tab="comment">

<div class="ui three column stackable grid">
<div class="eight wide column">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label"><?= __('Title'); ?>: </span><span class="value"><?=
	h($comment->title);
?></span></p>

<p class="view"><span class="label"><?= __('Body'); ?>: </span><span class="value"><?=
	h($comment->body);
?></span></p>

</div>
<div class="eight wide column">

<h2><?= __(''); ?></h2>

</div>
</div>

</div>

<?= $this->element('Admin/View/buttons'); ?>

</div>
