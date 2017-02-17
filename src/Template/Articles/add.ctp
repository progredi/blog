<h1>Add Post</h1>

<?= $this->Form->create(); ?>

<?= $this->Form->input('title'); ?>

<?= $this->Form->input('body', ['rows' => '3']); ?>

<?= $this->Form->button(__('Save')); ?>

<?= $this->Form->end(); ?>