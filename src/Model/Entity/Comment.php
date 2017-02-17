<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Inflector;

/**
 * Comment Entity
 *
 * PHP5
 *
 * @category  Entity
 * @package   CakePHP Blog Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */
class Comment extends Entity
{
	protected function _setTitle($title)
	{
		$this->set('slug', Inflector::slug($title));
		return $title;
	}
}