<?php

/**
 * Comment Admin Add Template
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
        [__('Comments'), __('Comments Dashboard'), ['action' => 'index']],
        [null, null, []]
    ]
]); ?>

<h1><?= __('Add Comment'); ?></h1>

<div class="comment add form">

<?= $this->Form->create($comment, ['class' => 'ui form']); ?>

<?= $this->element('Admin/Comments/form'); ?>

<?= $this->element('Admin/Form/Add/buttons'); ?>

<?= $this->Form->end(); ?>

</div>
