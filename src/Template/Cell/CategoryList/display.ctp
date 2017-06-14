<?php

/**
 * Category List Cell Display Template
 *
 * PHP5/7
 *
 * @category  Template\Cell
 * @package   Progredi\Blog
 * @since     0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/blog
 */
?>
<h3 class="ui medium title header"><?= __('Categories'); ?></h3>

<ul class="ui list">
<?php foreach($categories as $category) : ?>
<li class="item"><?= $this->Html->link(
	h($category->name) . ' (' . $category->post_count . ')',
	['controller' => 'Categories', 'action' => 'view', h($category->slug)]
); ?><?php
if (count($category->children)) :
	echo "\n" . $this->element('ui/categories', ['categories' => $category->children]);
endif;
?></li>
<?php endforeach; ?>
</ul>
