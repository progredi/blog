<?php

use Cake\Core\Configure;

/**
 * Blog Bootstrap
 *
 * PHP5/7
 *
 * @category  Config
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   https://choosealicense.com/licenses/mit/ MIT License
 * @link      https://github.com/progredi/blog
 */

// Define header title separator
if (!defined('TS')) {
    define('TS', Configure::check('Site.title_separator')
        ? Configure::read('Site.title_separator')
        : ' / ');
}
