<?php

/**
 * Post View Template
 *
 * PHP5/7
 *
 * @category  Template
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */

?>
<div class="ui section">

<div class="ui grid container">
<div class="twelve wide column">

<?= $this->element('ui/post', [
    "post" => $post
]); ?>

</div>
<div class="four wide column">

<?= $this->cell('Progredi/Blog.CategoryList'); ?>

</div>
</div>

</div>
