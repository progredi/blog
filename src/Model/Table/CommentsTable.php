<?php

namespace Progredi\Blog\Model\Table;

use Cake\Cache\Cache;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Progredi\Blog\Model\Table\AppTable;

/**
 * Comments Table
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
class CommentsTable extends AppTable
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

		$this->table('blog_comments');
		//$this->addBehavior('Tree');

		// Associations

		$this->belongsTo('Posts', [
			'className' => 'Progredi\Blog.Posts',
			'foreignKey' => 'post_id'
		]);
	}
}
