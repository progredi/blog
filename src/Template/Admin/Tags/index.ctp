<?php

/**
 * Tags Admin List Template
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
        [__('Tags'), __('Tags Dashboard'), ['action' => 'index']]
    ]
]); ?>

<h1 class="ui large header"><?= __('Tags'); ?></h1>

<div class="ui stackable grid">
<div class="mobile only four wide column">

<?= $this->element('ui/admin/dashboard/actions', [
    'entity' => 'Tag',
    'columns' => ['id', 'name'],
    'defaultColumn' => 'name'
]); ?>

</div>
<div class="twelve wide column">

<!--[ POSTS LIST ]-->

<div class="ui grid">
<div class="sixteen wide column">

<table class="ui striped table">

<thead>

<tr>
<th><?= __('Name'); ?></th>
<th><?= __('Posts'); ?></th>
<th class="center aligned status"><?= __('Status');?></th>
<th class="three action icons"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (!$tags) : ?>
<tr>
<td colspan="5"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($tags as $tag): ?>
<tr>
<td><?= h($tag->name); ?></td>
<td><?= $tag->post_count; ?></td>
<td class="center aligned status"><?=

$tag->enabled ?
    $this->Html->link('<i class="large enabled icon"></i>',
        ['action' => 'disable', $tag->id],
        ['title' => __('Tag') . ' ' . __('is enabled: click to disable'), 'escape' => false]) :
    $this->Html->link('<i class="large disabled icon"></i>',
        ['action' => 'enable', $tag->id],
        ['title' => __('Tag') . ' ' . __('is disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
    ['action' => 'view', $tag->id],
    ['title' => __('View tag'), 'escape' => false]
);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
    ['action' => 'edit', $tag->id],
    ['title' => __('Edit tag'), 'escape' => false]
);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
    ['action' => 'delete', $tag->id],
    ['title' => __('Delete tag'), 'confirm' => __('Are you sure?'), 'escape' => false]
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
    'entity' => 'Tag',
    'columns' => ['id', 'name'],
    'defaultColumn' => 'name'
]); ?>

</div>
</div>
