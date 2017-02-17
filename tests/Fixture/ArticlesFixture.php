<?php
namespace Progredi\Blog\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ArticlesFixture extends TestFixture
{
	// Optional. Set this property to load fixtures to a different test datasource
	public $connection = 'test';

	public $fields = [
		'id' => ['type' => 'integer'],
		'title' => ['type' => 'string', 'length' => 255, 'null' => false],
		'body' => 'text',
		'published' => ['type' => 'integer', 'default' => '0', 'null' => false],
		'created' => 'datetime',
		'modified' => 'datetime',
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['id']]
		]
	];

	public $records = [
		[
			'title' => 'First Article',
			'body' => 'First Article Body',
			'published' => '1',
			'created' => '2007-03-18 10:39:23',
			'modified' => '2007-03-18 10:41:31'
		],
		[
			'title' => 'Second Article',
			'body' => 'Second Article Body',
			'published' => '1',
			'created' => '2007-03-18 10:41:23',
			'modified' => '2007-03-18 10:43:31'
		],
		[
			'title' => 'Third Article',
			'body' => 'Third Article Body',
			'published' => '1',
			'created' => '2007-03-18 10:43:23',
			'modified' => '2007-03-18 10:45:31'
		  ]
	];

	/**
	 * Init method
	 *
	 * Use to initialise:
	 * - records requiring use of functions / dynamic data
	 */
	public function init()
	{
		/**
		 * To use functions or other dynamic data to define fixtures you can
		 * define $records in the init() method of your fixture. For example
		 * if you wanted all the created and modified timestamps to reflect
		 * today’s date you could do the following:
		 */
		$this->records = [
			[
				'title' => 'First Article',
				'body' => 'First Article Body',
				'published' => '1',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s'),
			],
		];
		parent::init();
	}
}