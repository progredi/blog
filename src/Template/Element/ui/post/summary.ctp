<?php

/**
 * Post Summary Element
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
<article class="ui article">

<header>

<h1 class="ui medium title header"><?= h($post->title) ?></h1>

<div class="meta">
<?php //p><= $post->published->format('d/m/Y') . '/' . h($post->slug);></p ?>
<p class="published">Published <time datetime="<?= $post->published->format(DATE_ATOM); ?>" pubdate><?= date('j F Y', strtotime($post->published)); ?></time></p>
<p class="meta post-meta">Posted on <span class="updated">February 9, 2017</span>  by <span class="vcard author"><a class="fn" href="https://scottishsocialistvoice.wordpress.com/author/ssvoice/">Scottish Socialist Voice</a></span>   // <a class="mh-comment-scroll" href="https://scottishsocialistvoice.wordpress.com/2017/02/09/the-left-must-educate-agitate-organise/#mh-comments">1 Comment</a>
</div>

</header>

<?= $this->Markdown->transform($post->body); ?>

</article>
