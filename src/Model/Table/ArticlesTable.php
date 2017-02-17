<?php

namespace Blog\Model\Table;

use Blog\Model\Table\AppTable;
use Cake\Validation\Validator;

/**
 * Articles Table
 *
 * PHP5
 *
 * @category  Model\Table
 * @package   CakePHP Blog Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */
class ArticlesTable extends AppTable
{
	/**
	 * Initialize method
	 *
	 * @param array $config
	 * @access public
	 */
	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->table('blog_articles');

		// Associations

		$this->hasMany('Comments', [
			'className' => 'Blog.Comments',
			'foreignKey' => 'article_id',
			'sort' => 'created DESC',
			'dependent' => true
		]);
	}

	/**
	 * validationDefault()
	 *
	 * @param object $validator
	 * @access public
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
