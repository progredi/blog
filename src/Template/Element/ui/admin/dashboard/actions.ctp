<?php

use Cake\Utility\Inflector;

/**
 * Search Filter Element Template
 *
 * PHP5
 *
 * @category  Template\Element
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 *
 * Example Output
 * --------------
 *
 * <div class="filter colspan_6 omega">
 *
 * <!-- SEARCH FILTER -->
 *
 * <?= $this->Form->create('Filter', ['class' => 'ui form']); ?>
 *
 * <div class="three fields">
 *
 * <!-- Column -->
 *
 * <div class="four wide field">
 *
 * <div class="ui fluid selection dropdown">
 *
 * <?= $this->Form->hidden('column'); ?>
 *
 * <div class="default text">Column</div>
 *
 * <i class="dropdown icon"></i>
 *
 * <div class="menu">
 * <div class="item" data-value="id">#</div>
 * <div class="item" data-value="code">Code</div>
 * <div class="item" data-value="title">Title</div>
 * <div class="item" data-value="type">Type</div>
 * </div>
 *
 * </div>
 *
 * </div>
 *
 * <!-- Value -->
 *
 * <?= $this->Form->input('value', ['label' => false, 'class' => 'column', 'div' => 'nine wide field']); ?>
 *
 * <!-- Button -->
 *
 * <?= $this->Form->submit('Search', ['class' => 'ui blue submit button', 'div' => ['class' => 'three wide submit field']]) ?>
 *
 * </div>
 *
 * <?= $this->Form->end() ?>
 *
 * </div>
 *
 */

//$default = isset($default) ? $default : 'id';

//if (!isset($column)) {
//	$column = '';
//}
//if (!isset($value)) {
//	$value = '';
//}

$this->Form->templates([
	'inputContainer' => "{{content}}\n",
	'inputContainerError' => "{{content}}{{error}}\n",
	'submitContainer' => '{{content}}',
	]);

?>
<!--[ ACTIONS + SEARCH FILTER ]-->

<div class="ui grid">
<div class="sixteen wide column">

<!-- Add Link -->

<?= $this->Html->link('<i class="plus icon"></i>' . ' ' . __($entity),
	['action' => 'add'],
	['class' => 'ui add button', 'title' => __('Add new ' . strtolower($entity)), 'escape' => false]
); ?>

</div>
<div class="sixteen wide column">

<!-- Search Filter -->

<div class="search filter">

<?= $this->Form->create(
	Inflector::camelize(Inflector::singularize($this->request->params['controller'])),
	['type' => 'get', 'class' => 'ui form', 'role' => 'search']
); ?>

<!-- Column -->

<div class="field">

<div class="ui fluid selection dropdown">

<?= $this->Form->hidden('column', ['value' => isset($column) ? h($column) : null]); ?>

<div class="default text">Column</div>

<i class="dropdown icon"></i>

<div class="menu">
<?php foreach($columns as $column) : ?>
<div class="item" data-value="<?= __("$column"); ?>"><?=
	$column === 'id'
		? '#'
		: __(Inflector::humanize($column));
?></div>
<?php endforeach; ?>
</div>

</div>

</div>

<!-- Value -->

<div class="field">
<?= $this->Form->input('value', ['label' => false, 'value' => isset($value) ? h($value) : null]); ?>
</div>

<!-- Button -->

<div class="field">
<?= $this->Form->submit('Search', ['class' => 'ui search button']); ?>

</div>

<?= $this->Form->end() ?>

</div>

</div>
</div>