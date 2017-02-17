<h1><?php echo __('Add PluginModelName'); ?></h1>

<div id="lid">
<?php echo $this->Html->link(__('PluginModelNamePlural'), array('action'=>'index'));?> / Add
</div>

<div class="form PluginControllerName">

<?php echo $this->Form->create('PluginModelName'); ?>

<div id="tabbedPanels">

<ul class="tabs">
<li><a class="selected" href="#main"><?php echo __('PluginModelName'); ?></a></li>
<li><a href="#pane2"><?php echo __('Pane 2'); ?></a></li>
<li><a href="#pane3"><?php echo __('Pane 3'); ?></a></li>
</ul>

<div id="main" class="panel">

<?php

echo $this->Form->input('name', array('label' => __('Name'), 'class' => 'name'));
echo $this->Form->input('description', array('label' => __('Description'), 'class' => 'name'));
echo $this->Form->input('start', array('type' => 'datetime', 'label' => __('Start'), 'dateFormat' => 'DMY'));
echo $this->Form->input('end', array('type' => 'datetime', 'label' => __('End'), 'dateFormat' => 'DMY'));

?>

</div>

<div id="pane2" class="panel">

</div>

<div id="pane3" class="panel">

</div>

</div>

<div class="buttons">
<?php

echo $this->Form->submit(__('Apply'), array('name' => 'apply'));
echo $this->Form->end(__('Save'));
echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'cancel'));

?>

</div>

</div>