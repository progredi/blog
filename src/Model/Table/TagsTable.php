<?php

namespace Progredi\Blog\Model\Table;

use Cake\Cache\Cache;
//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
//use Cake\Validation\Validator;
use Progredi\Blog\Model\Table\AppTable;

/**
 * Tags Table
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
class TagsTable extends AppTable
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

        $this->setTable('blog_tags');

        // Behaviors

        $this->addBehavior('CounterCache', [
            'Tags' => ['post_count']
        ]);

        // Associations

        $this->belongsToMany('Posts', [
            'className' => 'Progredi/Blog.Posts',
            'joinTable' => 'blog_posts_tags',
            'foreignKey' => 'tag_id'
        ]);
    }

    /**
     * Select options method
     *
     * @access public
     * @return array Select options list from enabled records
     */
    public function options()
    {
        $tags = $this;
        return Cache::remember('blog_tags_options', function () use ($tags) {

            $query = $tags->find('list')
                ->select(['id', 'name'])
                ->where(['enabled' => true])
                ->order(['name ASC']);

            return $query->toArray();
        });
    }
}
