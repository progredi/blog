<?php

namespace Progredi\Blog\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Text;

/**
 * Category Entity
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
class Category extends Entity
{
	/**
	 * Accessible properties
	 *
	 * Properties that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'*' => true
	];

	/**
	 * Virtual properties
	 *
	 * Properties to be exposed / made visible in data, especially when to be
	 * exported as array/JSON.
	 *
	 * @var array
	 */
	protected $_virtual = [
	];

	/**
	 * Hidden properties
	 *
	 * Properties containing sensitive data not to be exposed, e.g. password
	 * hashes, security questions, etc.
	 *
	 * @var array
	 */
	protected $_hidden = [
	];

	// MUTATOR METHODS

	/**
	 * Title mutator method
	 */
	protected function _setName($name)
	{
		$this->set('slug', Text::slug(strtolower($name)));
		return $name;
	}
}
