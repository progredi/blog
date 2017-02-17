<?php

namespace Blog\Model\Table;

use Blog\Model\Table\AppTable;
use Cake\Validation\Validator;

/**
 * Comments Table
 *
 * PHP5
 *
 * @category  Model\Table
 * @package   CakePHP Blog Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) Progredi Web Development
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
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
		$this->table('blog_comments');

		$this->addBehavior('Timestamp');

		$this->belongsTo('Articles', [
			'className' => 'Blog.Articles',
			'foreignKey' => 'article_id'
		]);
	}
}
