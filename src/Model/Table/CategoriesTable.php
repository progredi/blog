<?php

namespace Progredi\Blog\Model\Table;

use Cake\Cache\Cache;
//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Progredi\Blog\Model\Table\AppTable;

/**
 * Categories Table
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
class CategoriesTable extends AppTable
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

        $this->setTable('blog_categories');

        // Behaviors

        $this->addBehavior('Tree');
        $this->addBehavior('CounterCache', [
            'Categories' => ['post_count']
        ]);

        // Associations

        $this->belongsToMany('Posts', [
            'className' => 'Progredi/Blog.Posts',
            'joinTable' => 'blog_categories_posts',
            'foreignKey' => 'post_id'
        ]);
    }

    /**
     * ValidationDefault method
     *
     * @access public
     * @param \Cake\Validation\Validator $validator
     * @return \Cake\Validation\Validator $validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notBlank('name');

        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('lft', 'valid', ['rule' => 'numeric'])
            //->requirePresence('lft', 'create')
            ->notEmpty('lft');

        $validator
            ->add('rght', 'valid', ['rule' => 'numeric'])
            //->requirePresence('rght', 'create')
            ->notEmpty('rght');

        return $validator;
    }

    /**
     * AfterSave method
     *
     * @access public
     * @param boolean $created
     * @param options $options
    public function afterSave($created, $options = [])
    {
        if ($created) {
            $event = new Event('PluginName.Model.ModelName.created', $this, $options);
            $this->eventManager()->dispatch($event);
        }
    }
     */

    /**
     * FindTreeList method
     *
     * @access public
     * @return array Query tree list for table
    public function findTreeList(Query $query, array $options)
    {
        $user = $options['user'];
        return $query->where(['author_id' => $user->id]);
    }
     */

    /**
     * Select options method
     *
     * @access public
     * @return array Select options list from enabled records
     */
    public function options()
    {
        $categories = $this;
        return Cache::remember('blog_categories_options', function () use ($categories) {

            $query = $categories->find('treeList', [
                    'keyPath' => 'id',
                    'valuePath' => 'name',
                    'spacer' => "&nbsp;&nbsp;&ndash;&nbsp;"
                ])
                ->where(['enabled' => true])
                ->order(['name' => 'ASC']);

//echo "<pre>Category Options: " . print_r($query->toArray(), true) . "</pre>";
//exit();

            return $query->toArray();
        });
    }
}
