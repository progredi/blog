<div class="ui top attached tabular menu">
<a class="active item" data-tab="post"><?= __('Comment'); ?></a>
</div>

<!--[ COMMENT ]-->

<div class="ui bottom attached active tab segment" data-tab="comment">

<div class="ui three column stackable grid">
<div class="eight wide column">

<h2><?= __('Details'); ?></h2>

<?= $this->Form->input('title', [
	'templateVars' => [
		'format' => ' fourteen wide field'
	]
]); ?>

<?= $this->Form->input('body', [
	'templateVars' => [
		'format' => ' fourteen wide field'
	]
]); ?>

</div>
<div class="eight wide column">

<h2><?= __(''); ?></h2>

</div>
</div>

</div>
