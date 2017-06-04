<?php

/**
 * Category Form Element
 *
 * PHP5/7
 *
 * @category  Element
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */

?>
<div class="ui top attached tabular menu">
<a class="active item" data-tab="category"><?= __('Category'); ?></a>
</div>

<!--[ CATEGORY ]-->

<div class="ui bottom attached active tab segment" data-tab="category">

<div class="ui three column stackable grid">
<div class="eight wide column">

<h2><?= __('Details'); ?></h2>

<?= $this->Form->input('name', [
	'templateVars' => [
		'format' => ' sixteen wide field'
	]
]); ?>

<?= $this->Form->input('parent_id', [
	'templateVars' => [
		'format' => ' sixteen wide field'
	],
	'type' => 'select',
	'label' => __('Parent'),
	'class' => 'ui dropdown',
	'options' => $categoriesOptions,
	'escape' => false,
	'empty' => true
]); ?>

<h2><?= __('Meta'); ?></h2>

<?= $this->Form->input('meta_title', [
	'templateVars' => [
		'format' => ' sixteen wide field'
	],
	'label' => __('Title'),
	'default' => null
]); ?>

<?= $this->Form->input('meta_description', [
	'templateVars' => [
		'format' => ' sixteen wide field'
	],
	'label' => __('Description'),
	'default' => null
]); ?>

<?= $this->Form->input('keywords', [
	'templateVars' => [
		'format' => ' sixteen wide field'
	],
	'label' => __('Keywords'),
	'default' => null
]); ?>

</div>
<div class="eight wide column">

<h2><?= __('RSS Channel'); ?></h2>

<?= $this->Form->input('rss_channel_title', [
	'templateVars' => [
		'format' => ' sixteen wide field'
	],
	'label' => __('Title'),
	'default' => null
]); ?>

<?= $this->Form->input('rss_channel_description', [
	'templateVars' => [
		'format' => ' sixteen wide field'
	],
	'label' => __('Description'),
	'default' => null
]); ?>

</div>
</div>

</div>
