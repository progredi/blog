<?php

namespace Progredi\Blog\Model\Table;

use Cake\Cache\Cache;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Progredi\Blog\Model\Table\AppTable;

/**
 * Categories Table
 *
 * PHP5/7
 *
 * @category  Model\Table
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */
class CategoriesTable extends AppTable
{
	/**
	 * Initialize method
	 *
	 * @param array $config Configuration for the Table.
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
			'className' => 'Progredi/Blog.Categories',
			'joinTable' => 'blog_categories_posts',
			'foreignKey' => 'category_id'
		]);
	}

	/**
	 * ValidationDefault method
	 *
	 * @param object $validator
	 * @access public
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
	 * @param boolean $created
	 * @param options $options
	 * @access public
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
	 * @return array Select options list for table
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
