<?php

/**
 * Post Form Element
 *
 * PHP5/7
 *
 * @category  Template\Element
 * @package   Progredi\Blog
 * @since     0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/blog
 */

?>
<div class="ui top attached tabular menu">
<a class="active item" data-tab="post"><?= __('Post'); ?></a>
</div>

<!--[ POST ]-->

<div class="ui bottom attached active tab segment" data-tab="post">

<div class="ui three column stackable grid">
<div class="eight wide column">

<h2><?= __('Details'); ?></h2>

<?= $this->Form->input('title', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ]
]); ?>

<?= $this->Form->input('summary', [
    'templateVars' => [
        'format' => ' ten wide field'
    ]
]); ?>

<?= $this->Form->input('body', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ]
]); ?>

<?= $this->Form->input('image', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ]
]); ?>

</div>
<div class="eight wide column">

<h2><?= __(''); ?></h2>

</div>
</div>

</div>
