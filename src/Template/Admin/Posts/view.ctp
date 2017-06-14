<?php

/**
 * Post Admin View Template
 *
 * PHP5/7
 *
 * @category  Template
 * @package   Progredi\Blog
 * @since     0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/blog
 */

?>
<?= $this->element('navigation/breadcrumbs', [
    'menuItems' => [
        [__('Dashboard'), __('Admin Dashboard'), ['plugin' => null, 'controller' => 'Admin', 'action' => 'dashboard']],
        [__('Blog'), __('Blog Dashboard'), ['controller' => 'Blog', 'action' => 'dashboard']],
        [__('Posts'), __('Posts Dashboard'), ['action' => 'index']],
        [null, null, []]
    ]
]); ?>

<h1><?= __('View Post'); ?>: <strong><?= h($post->title); ?></strong></h1>

<div class="post view">

<div class="ui top attached tabular menu">
<a class="active item" data-tab="post"><?= __('Post'); ?></a>
<a class="item" data-tab="comments"><?= __('Comments'); ?></a>
<a class="item" data-tab="categories"><?= __('Categories'); ?></a>
<a class="item" data-tab="tags"><?= __('Tags'); ?></a>
</div>

<!--[ POST ]-->

<div class="ui bottom attached active tab segment" data-tab="post">

<div class="ui three column stackable grid">
<div class="eight wide column">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label"><?= __('Title'); ?>: </span><span class="value"><?=
    h($post->title);
?></span></p>

<p class="view"><span class="label"><?= __('Summary'); ?>: </span><span class="value"><?=
    h($post->summary);
?></span></p>

<p class="view"><span class="label"><?= __('Body'); ?>: </span><span class="value"><?=
    h($post->body);
?></span></p>

<div class="ui hidden divider"></div>

<p class="view"><span class="label"><?= __('Image'); ?>: </span><span class="value"><?=
    h($post->image);
?></span></p>

<p class="view"><span class="label"><?= __('Published'); ?>: </span><span class="value"><?=
    h($post->published);
?></span></p>

</div>
<div class="eight wide column">

<h2><?= __(''); ?></h2>

</div>
</div>

</div>

<!--[ COMMENTS ]-->

<div class="ui bottom attached tab segment" data-tab="comments">

<div class="ui one column grid">
<div class="column">

<table class="ui striped table">

<thead>

<tr>
<th class="name"><?= __('Title'); ?></th>
<th><?= __('Author'); ?></th>
<th class="center aligned status"><?= __('Status'); ?></th>
<th class="three action icons"><?= __('Actions'); ?></th>
</tr>

</thead>

<tbody>

<?php if (empty($post->comments)) : ?>
<tr>
<td colspan="4"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($post->comments as $comment): ?>
<tr>
<td><?= h($comment->title); ?></td>
<td><?= h($comment->author); ?></td>
<td class="center aligned status"><?=

$comment->enabled ?
    $this->Html->link('<i class="large enabled icon"></i>',
        ['action' => 'disable', $comment->id],
        ['title' => __('Currency') . ' ' . __('enabled: click to disable'), 'escape' => false]) :
    $this->Html->link('<i class="large disabled icon"></i>',
        ['action' => 'enable', $comment->id],
        ['title' => __('Currency') . ' ' . __('disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
    ['action' => 'view', $comment->id],
    ['title' => __('View comment'), 'escape' => false]);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
    ['action' => 'edit', $comment->id],
    ['title' => __('Edit comment'), 'escape' => false]);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
    ['action' => 'delete', $comment->id],
    ['title' => __('Delete comment'), 'confirm' => __('Are you sure?'), 'escape' => false]);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
<tbody>

</table>

</div>
</div>

</div>

<!--[ CATEGORIES ]-->

<div class="ui bottom attached tab segment" data-tab="categories">

<div class="ui one column grid">
<div class="column">

<table class="ui striped table">

<thead>

<tr>
<th class="name"><?= __('Name'); ?></th>
<th class="center aligned status"><?= __('Status'); ?></th>
<th class="three action icons"><?= __('Actions'); ?></th>
</tr>

</thead>

<tbody>

<?php if (empty($post->categories)) : ?>
<tr>
<td colspan="3"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($post->categories as $category): ?>
<tr>
<td><?= h($category->name); ?></td>
<td class="center aligned status"><?=

$category->enabled ?
    $this->Html->link('<i class="large enabled icon"></i>',
        ['action' => 'disable', $category->id],
        ['title' => __('Category') . ' ' . __('enabled: click to disable'), 'escape' => false]) :
    $this->Html->link('<i class="large disabled icon"></i>',
        ['action' => 'enable', $category->id],
        ['title' => __('Category') . ' ' . __('disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
    ['action' => 'view', $category->id],
    ['title' => __('View category'), 'escape' => false]);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
    ['action' => 'edit', $category->id],
    ['title' => __('Edit category'), 'escape' => false]);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
    ['action' => 'delete', $category->id],
    ['title' => __('Delete category'), 'confirm' => __('Are you sure?'), 'escape' => false]);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
<tbody>

</table>

</div>
</div>

</div>

<!--[ TAGS ]-->

<div class="ui bottom attached tab segment" data-tab="tags">

<div class="ui one column grid">
<div class="column">

<table class="ui striped table">

<thead>

<tr>
<th class="name"><?= __('Name'); ?></th>
<th class="center aligned status"><?= __('Status'); ?></th>
<th class="three action icons"><?= __('Actions'); ?></th>
</tr>

</thead>

<tbody>

<?php if (empty($post->tags)) : ?>
<tr>
<td colspan="3"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($post->tags as $tag): ?>
<tr>
<td><?= h($tag->name); ?></td>
<td class="center aligned status"><?=

$tag->enabled ?
    $this->Html->link('<i class="large enabled icon"></i>',
        ['controller' => 'Tags', 'action' => 'disable', $tag->id],
        ['title' => __('Tag') . ' ' . __('enabled: click to disable'), 'escape' => false]) :
    $this->Html->link('<i class="large disabled icon"></i>',
        ['controller' => 'Tags', 'action' => 'enable', $tag->id],
        ['title' => __('Tag') . ' ' . __('disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
    ['controller' => 'Tags', 'action' => 'view', $tag->id],
    ['title' => __('View tag'), 'escape' => false]);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
    ['controller' => 'Tags', 'action' => 'edit', $tag->id],
    ['title' => __('Edit tag'), 'escape' => false]);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
    ['controller' => 'Tags', 'action' => 'delete', $tag->id],
    ['title' => __('Delete tag'), 'confirm' => __('Are you sure?'), 'escape' => false]);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
<tbody>

</table>

</div>
</div>

</div>

<?= $this->element('Admin/View/buttons'); ?>

</div>
