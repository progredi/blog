<?php

/**
 * Category List  Template
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
<ul class="list">
<?php foreach($categories as $category) : ?>
<li class="item"><?= $this->Html->link(
	h($category->name) . ' (' . $category->post_count . ')',
	['controller' => 'Categories', 'action' => 'view', h($category->slug)]
); ?><?php
if (count($category->children)) :
	echo $this->element('ui/categories', ['categories' => $category->children]);
endif;
?></li>
<?php endforeach; ?>
</ul>
