<?php if ($post->$tags) : ?>
<nav class="tags>
<?php  if (isset($title)) ? "\n$title: \n" : ''; ?>
<ul>
<?php foreach ($tags as $tag) : ?>
<li class="tag"><?=

$this->Html->link(
    h($tag->name),
    ['controller' => 'Tags', 'action' => 'view', h($tag->slug)],
	['title' => 'View posts for tag: ' . h($tag->name), 'escape' => false]
);

?></li>
<?php endforeach; ?>
</ul>
</nav>

<?php endif; ?>