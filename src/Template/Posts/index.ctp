<?php

/**
 * Posts List Template
 *
 * PHP5/7
 *
 * @category  View
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */

//echo "<pre>\n\nPost: " . print_r($post->toArray(), true) . "\n</pre>\n\n";
//exit();
 
?>
<div class="ui section">

<div class="ui grid container">
<div class="sixteen wide column">

<h1 class="ui large title header"><?= __('CakePHP Development Blog'); ?></h1>
<h4 class="ui medium subtitle header"><?= __('Articles and tutorials on CakePHP web development'); ?></h4>

</div>
</div>

</div>

<div class="ui section">

<div class="ui grid container">
<div class="twelve wide column">

<?php if (!$posts): ?>
<p><?= __('No posts have been posted at the moment. Please look in later.'); ?></p>

<?php else: ?>
<?php foreach ($posts as $post): ?>
<article class="ui article">

<header>

<h2 class="ui medium title header"><?=

//h($post->title)
$this->Html->link(
	h($post->title),
	//['controller' => 'Posts', 'action' => 'view', $post->published->format('d/m/Y') . '/' . h($post->slug)],
	['plugin' => 'Progredi/Blog', 'controller' => 'Posts', 'action' => 'view', $post->id],// . '/' . h($post->slug)
	['escape' => false]
);

?></h2>

<p><?php //= $post->published->format('d/m/Y') . '/' . h($post->slug); ?></p>

<div class="meta">
<p class="published">Published <time datetime="<?= $post->published->format(DATE_ATOM); ?>" pubdate><?= date('j F Y', strtotime($post->published)); ?></time></p>
</div>

</header>

<?= $this->Markdown->transform($post->summary); ?>

</article>

<div class="ui divider"></div>

<?php endforeach; ?>
<?php endif; ?>

</div>
<div class="four wide column">

<?= $this->cell('Progredi/Blog.CategoryList'); ?>

</div>
</div>

</div>
