<?php

namespace Tanuck\Markdown\View\Helper;

/**
 * Articles List
 *
 * @category View
 * @package  CakePHP Blog Plugin
 * @version  0.1.0
 * @author   David Scott <support@progredi.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */

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
<div class="sixteen wide column">

<?php if (empty($articles->toArray())): ?>
<p><?= __('No posts have been posted at the moment. Please look in later.'); ?></p>

<?php else: ?>
<?php foreach ($articles as $article): ?>
<article class="ui article">

<header>

<h2 class="ui medium title header"><?=

$this->Html->link(
	h($article->title),
	['controller' => 'Articles', 'action' => 'view', $article->published->format('Y/m/d') . DS . h($article->slug)],
	['escape' => false]
);

?></h2>

<p><?= $article->published->format('Y/m/d') . DS . h($article->slug); ?></p>

<div class="meta">
<p class="published">Published <time datetime="<?= $article->published->format(DATE_ATOM); ?>" pubdate><?= date('j F Y', strtotime($article->published)); ?></time></p>
</div>

</header>

<?= $this->Markdown->transform($article->summary); ?>

</article>

<div class="ui divider"></div>

<?php endforeach; ?>
<?php endif; ?>

</div>
</div>

<?/*= $this->Html->link('Add Post', ['action' => 'add']) */?>

</div>
