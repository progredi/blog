<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Inflector;

/**
 * Comment Entity
 *
 * PHP5/7
 *
 * @category  Entity
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */
class Comment extends Entity
{

	// MUTATOR METHODS

	/**
	 * Title mutator method
	 */
	protected function _setTitle($title)
	{
		$this->set('slug', Inflector::slug($title));
		return $title;
	}
}