<?php

namespace Progredi\Blog\Model\Table;

//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Progredi\Blog\Model\Table\AppTable;

/**
 * Posts Table
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
class PostsTable extends AppTable
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

        $this->setTable('blog_posts');

        // Behaviors

        $this->addBehavior('CounterCache', [
            'Posts' => ['comment_count']
        ]);

        // Associations

        $this->hasMany('Comments', [
            'className' => 'Progredi/Blog.Comments',
            'foreignKey' => 'post_id',
            'sort' => 'created desc',
            'dependent' => true
        ]);
        $this->belongsToMany('Categories', [
            'className' => 'Progredi/Blog.Categories',
            'joinTable' => 'blog_categories_posts',
            'foreignKey' => 'post_id'
        ]);
        $this->belongsToMany('Tags', [
            'className' => 'Progredi/Blog.Tags',
            'joinTable' => 'blog_posts_tags',
            'foreignKey' => 'post_id'
        ]);
    }

    /**
     * validationDefault()
     *
     * @access public
     * @param \Cake\Validation\Validator $validator
     * @return \Cake\Validation\Validator $validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('title')
            ->notEmpty('title', 'Please fill this field')
            ->add('title', [
                'length' => [
                    'rule' => ['minLength', 10],
                    'message' => 'Titles need to be at least 10 characters long',
                ]
            ])
            ->allowEmpty('published')
            ->add('published', 'boolean', [
                'rule' => 'boolean'
            ])
            ->requirePresence('body')
            ->notEmpty('body')
            ->add('body', 'length', [
                'rule' => ['minLength', 50],
                'message' => 'Articles must have a substantial body.'
            ]);

        return $validator;
    }
}
