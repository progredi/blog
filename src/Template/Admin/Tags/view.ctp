<?php

/**
 * Category Admin View Template
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
        [__('Tags'), __('Tags Dashboard'), ['action' => 'index']],
        [null, null, []]
    ]
]); ?>

<h1><?= __('View Tag'); ?>: <strong><?= h($tag->name); ?></strong></h1>

<div class="tag view">

<div class="ui top attached tabular menu">
<a class="active item" data-tab="tag"><?= __('Tag'); ?></a>
<a class="item" data-tab="posts"><?= __('Posts'); ?></a>
</div>

<!--[ TAG ]-->

<div class="ui bottom attached active tab segment" data-tab="tag">

<div class="ui three column stackable grid">
<div class="six wide column">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label"><?= __('Name'); ?>: </span><span class="value"><?=
    h($tag->name);
?></span></p>

</div>
<div class="five wide column">

<h2><?= __('Meta'); ?></h2>

<p class="view"><span class="label"><?= __('Title'); ?>: </span><span class="value"><?=
    h($tag->meta_title);
?></span></p>

<p class="view"><span class="label"><?= __('Description'); ?>: </span><span class="value"><?=
    h($tag->meta_description);
?></span></p>

<p class="view"><span class="label"><?= __('Keywords'); ?>: </span><span class="value"><?=
    h($tag->meta_keywords);
?></span></p>

</div>
<div class="five wide column">

<h2><?= __('RSS Channel'); ?></h2>

<p class="view"><span class="label"><?= __('Title'); ?>: </span><span class="value"><?=
    h($tag->rss_channel_title);
?></span></p>

<p class="view"><span class="label"><?= __('Description'); ?>: </span><span class="value"><?=
    h($tag->rss_channel_description);
?></span></p>

</div>
</div>

</div>

<!--[ POSTS ]-->

<div class="ui bottom attached tab segment" data-tab="posts">

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

<?php if (empty($category->posts)) : ?>
<tr>
<td colspan="4"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($category->posts as $post): ?>
<tr>
<td><?= h($post->title); ?></td>
<td><?= h($post->author); ?></td>
<td class="center aligned status"><?=

$post->enabled ?
    $this->Html->link('<i class="large enabled icon"></i>',
        ['action' => 'disable', $post->id],
        ['title' => __('Post') . ' ' . __('enabled: click to disable'), 'escape' => false]) :
    $this->Html->link('<i class="large disabled icon"></i>',
        ['action' => 'enable', $post->id],
        ['title' => __('Post') . ' ' . __('disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
    ['action' => 'view', $post->id],
    ['title' => __('View post'), 'escape' => false]);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
    ['action' => 'edit', $post->id],
    ['title' => __('Edit post'), 'escape' => false]);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
    ['action' => 'delete', $post->id],
    ['title' => __('Delete post'), 'confirm' => __('Are you sure?'), 'escape' => false]);

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
