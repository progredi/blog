<?php

namespace App\View;

use Cake\View\View;

/**
 * Blog App View Class
 *
 * PHP5/7
 *
 * @category  View
 * @package   Progredi/Blog
 * @since     0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/blog
 */
class AppView extends View
{
    /**
     * Initialization hook method.
     *
     * For e.g. use this method to load a helper for all views:
     * `$this->loadHelper('Html');`
     *
     * @access public
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadHelper('Form');
        $this->loadHelper('Flash');
        $this->loadHelper('Html');
        $this->loadHelper('Paginator');
        $this->loadHelper('Tanuck/Markdown.Markdown');
    }
}
