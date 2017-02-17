<?php

use Cake\Routing\Router;

/**
 * Routes
 *
 * PHP5
 *
 * @category Config
 * @package  CakePHP Blog Plugin
 * @version  0.1.0
 * @author   David Scott <dscott@progredi.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */

Router::defaultRouteClass('DashedRoute');

Router::scope('/', function ($routes) {

	$routes->connect('/blog',
		['plugin' => 'Progredi/Blog', 'controller' => 'Articles', 'action' => 'index']
	);
});

Router::plugin('Progredi/Blog', function ($routes) {

	$routes->connect('/:controller',
		['action' => 'index']
	);
	$routes->connect('/:controller/:action',
		[]
	);
	$routes->connect('/:controller/:action/:id',
		[], ['id' => '[0-9]+', 'pass' => ['id']]
	);
	$routes->connect(
		'/:controller/:year/:month/:day/:slug',
		['action' => 'view'],
		[
			'year' => '[12][0-9]{3}',
			'month' => '0[1-9]|1[012]',
			'day' => '0[1-9]|[12][0-9]|3[01]'
		]
	);
});

Router::prefix('admin', function ($routes) {

	$routes->redirect('/blog',
		['plugin' => 'Progredi/Blog', 'controller' => 'Blog', 'action' => 'dashboard'],
		['status' => 301]
	);

	$routes->plugin('Blog', function ($routes) {

		$routes->connect('/dashboard',
			['controller' => 'Blog', 'action' => 'dashboard']
		);

		$routes->connect('/:controller',
			['action' => 'index']
		);
		$routes->connect('/:controller/:action',
			[]
		);
		$routes->connect('/:controller/:action/:id',
			[],
			['pass' => ['id'], 'id' => '[0-9]+']
		);
	});
});

//Router::connect('/blog/archives/*',   array('plugin' => 'blogs', 'controller' => 'blogs', 'action' => 'index'));
