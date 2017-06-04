<?php

/**
 * Post List Template
 *
 * PHP5/7
 *
 * @category  Template
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */

?>
<?= $this->element('navigation/breadcrumbs', [
	'menuItems' => [
		[__('Dashboard'), __('Admin Dashboard'), ['plugin' => null, 'controller' => 'Admin', 'action' => 'dashboard']],
		[__('Blog'), __('Blog Dashboard'), ['controller' => 'Blog', 'action' => 'dashboard']],
		[__('Posts'), __('Posts Dashboard'), ['action' => 'index']]
	]
]); ?>

<h1 class="ui large header"><?= __('Posts'); ?></h1>

<div class="ui stackable grid">
<div class="mobile only tablet only four wide column">

<?= $this->element('ui/admin/dashboard/actions', [
	'entity' => 'Post',
	'columns' => ['id', 'title'],
	'defaultColumn' => 'title'
]); ?>

</div>
<div class="twelve wide column">

<!--[ POSTS LIST ]-->

<div class="ui grid">

<div class="sixteen wide column">

<table class="ui striped table">

<thead>

<tr>
<th><?= __('Title'); ?></th>
<th><?= __('Comments'); ?></th>
<th class="datetime"><?= __('Published'); ?></th>
<th class="center aligned status"><?= __('Status');?></th>
<th class="three action icons"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (!$posts) : ?>
<tr>
<td colspan="5"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php //debug($posts->toArray()); ?>
<?php foreach ($posts as $post): ?>
<tr>
<td><?= h($post->title); ?></td>
<td><?= $post->comment_count; ?></td>
<td><?= $post->published;//substr($post->published, 0, -6); ?></td>
<td class="center aligned status"><?=

$post->enabled ?
	$this->Html->link('<i class="large enabled icon"></i>',
		['action' => 'disable', $post->id],
		['title' => __('Post') . ' ' . __('is enabled: click to disable'), 'escape' => false]) :
	$this->Html->link('<i class="large disabled icon"></i>',
		['action' => 'enable', $post->id],
		['title' => __('Post') . ' ' . __('is disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
	['action' => 'view', $post->id],
	['title' => __('View post'), 'escape' => false]
);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
	['action' => 'edit', $post->id],
	['title' => __('Edit post'), 'escape' => false]
);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
	['action' => 'delete', $post->id],
	['title' => __('Delete post'), 'confirm' => __('Are you sure?'), 'escape' => false]
);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
</tbody>

</table>

</div>
<div class="row">
<div class="column">

<?= $this->element('navigation/pagination'); ?>

</div>
</div>
</div>

</div>
<div class="small monitor only large monitor only four wide column">

<?= $this->element('ui/admin/dashboard/actions', [
	'entity' => 'Post',
	'columns' => ['id', 'title'],
	'defaultColumn' => 'title'
]); ?>

</div>
</div>
