<h1><?php echo __('Edit ModelName'); ?></h1>

<div id="lid">
<?php echo $this->Html->link(__('ModelNamePlural'), array('action'=>'index'));?> / Edit ModelName
</div>

<div class="form PluginControllerName">

<?php echo $this->Form->create('ModelName'); ?>

<div class="tabbedPanels">

<ul class="tabs>
<li><a class="selected" href="#modelNameDetails"><?php echo __('ModelName'); ?></a></li>
<li><a href="#modelNamePane2"><?php echo __('Pane 2'); ?></a></li>
<li><a href="#modelNamePane3"><?php echo __('Pane 3'); ?></a></li>
</ul>

<div id="modelNameDetails" class="panel">

<?php

echo $this->Form->hidden('id');

echo $this->Form->input('name', array('label' => __('Name'), 'class' => 'name'));
echo $this->Form->input('description', array('label' => __('Description'), 'class' => 'name'));
echo $this->Form->input('start', array('type' => 'datetime', 'label' => __('Start'), 'dateFormat' => 'DMY'));
echo $this->Form->input('end', array('type' => 'datetime', 'label' => __('End'), 'dateFormat' => 'DMY'));

?>

</div>

<div id="modelNamePane2" class="panel">

</div>

<div id="modelNamePane3" class="panel">

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