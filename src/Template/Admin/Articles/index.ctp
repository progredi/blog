<?= $this->element('navigation/breadcrumbs', [
	'menuItems' => [
		[__('Dashboard'), __('Admin Dashboard'), ['plugin' => 'ProgrediApp', 'controller' => 'Dashboard', 'action' => 'index']],
		[__('Blog'), __('Blog Dashboard'), ['controller' => 'Blog', 'action' => 'dashboard']],
		[__('Articles'), __('Articles Dashboard'), ['action' => 'index']]
	]
]); ?>

<h1><?= __('Articles'); ?></h1>

<div class="ui grid">
<div class="nine wide column">

<?= $this->Html->link('<i class="plus icon"></i> Article',
	['action' => 'add'],
	['class' => 'ui add button', 'title' => __('Create a new article'), 'escape' => false]
); ?>

</div>
<div class="seven wide column">

<?= $this->element('search-filter', [
	'columns' => ['id', 'title'],
	'default' => 'id'
]); ?>

</div>
</div>

<div class="ui grid">
<div class="column">

<table class="ui striped table">

<thead>

<tr>
<th><?= __('Title'); ?></th>
<th><?= __('Comments'); ?></th>
<th class="datetime"><?= __('Published'); ?></th>
<th class="centered status"><?= __('Status');?></th>
<th class="three icons actions"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (empty($articles->toArray())) : ?>
<tr>
<td colspan="4"><?= __('No articles found'); ?></td>
</tr>

<?php else: ?>
<?php //debug($articles->toArray()); ?>
<?php foreach ($articles as $article): ?>
<tr>
<td><?= h($article->title); ?></td>
<td><?= $article->comment_count; ?></td>
<td><?= $article->published;//substr($article->published, 0, -6); ?></td>
<td class="centered status"><?=

$article->enabled ?
	$this->Html->link('<i class="large enabled icon"></i>',
		['action' => 'disable', $article->id],
		['title' => __('Article') . ' ' . __('is enabled: click to disable'), 'escape' => false]) :
	$this->Html->link('<i class="large disabled icon"></i>',
		['action' => 'enable', $article->id],
		['title' => __('Article') . ' ' . __('is disabled: click to enable'), 'escape' => false]);

?></td>
<td class="actions"><?=

$this->Html->link('<i class="large view record icon"></i>',
	['action' => 'view', $article->id],
	['title' => __('View article'), 'escape' => false]
);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
	['action' => 'edit', $article->id],
	['title' => __('Edit article'), 'escape' => false]
);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
	['action' => 'delete', $article->id],
	['title' => __('Delete article'), 'confirm' => __('Are you sure?'), 'escape' => false]
);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
<tbody>

</table>

<?= $this->element('navigation/pagination'); ?>

</div>
</div>

<?php //debug($articles->toArray()); ?>

