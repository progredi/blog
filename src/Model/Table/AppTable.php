<?php

namespace Blog\Model\Table;

use Cake\ORM\Table;

/**
 * Blog AppTable
 *
 * PHP5
 *
 * @category Model\Table
 * @package  CakePHP Blog Plugin
 * @version  0.1.0
 * @author   David Scott <support@progredi.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */
class AppTable extends Table
{
	/**
	 * Behaviors
	 *
	 * @var array
	 */
    public $actsAs = [
        'Containable'
    ];

	/**
	 * Initialize method
	 *
	 * @param array $config Configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		// Behaviors

		$this->addBehavior('Timestamp');
	}
}
