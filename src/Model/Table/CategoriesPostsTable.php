<?php

namespace Progredi\Blog\Model\Table;

//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
//use Cake\Validation\Validator;
use Progredi\Blog\Model\Table\AppTable;

/**
 * Categories Posts Table
 *
 * PHP5/7
 *
 * @category  Model\Table
 * @package   Progredi\Blog
 * @since     0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/blog
 */
class CategoriesPostsTable extends AppTable
{
    /**
     * Initialize method
     *
     * @access public
     * @param array $config Table configuration data
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('blog_categories_posts');
    }
}
