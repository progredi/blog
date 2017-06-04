<?php

/**
 * Article Element
 *
 * PHP5/7
 *
 * @category  Template\Element
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */

?>
<article class="ui article" itemscope itemtype="http://schema.org/Article">

<header>

<h1 class="ui medium title header"><?= h($post->title) ?></h1>

<div class="meta">
<?php //p><= $post->published->format('d/m/Y') . '/' . h($post->slug);></p ?>
<p class="published">Published <time datetime="<?= $post->published->format(DATE_ATOM); ?>" pubdate><?= date('j F Y', strtotime($post->published)); ?></time></p>
</div>

</header>

<?= $this->Markdown->transform($post->body); ?>

</article>
