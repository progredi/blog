<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * Blog Routes
 *
 * PHP5/7
 *
 * @category  Config
 * @package   Progredi\Blog
 * @since     0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   https://choosealicense.com/licenses/mit/ MIT License
 * @link      https://github.com/progredi/blog
 */

Router::scope('/', function (RouteBuilder $routes) {

    $routes->extensions(['rss']);

    $routes->connect('/blog',
        ['plugin' => 'Progredi/Blog', 'controller' => 'Posts', 'action' => 'index']
    );

    $routes->fallbacks(DashedRoute::class);
});

Router::plugin('Progredi/Blog', ['path' => '/blog'], function (RouteBuilder $routes) {

    $routes->extensions(['rss']);

    $routes->connect(
        '/category/:category',
        ['controller' => 'Categories', 'action' => 'view'],
        ['category' => '[a-zA-Z0-9\-\_]+', 'pass' => ['category']]
    );

/*
    $routes->connect(
        '/:controller/:day/:month/:year/:slug',
        ['action' => 'view'],
        [
            'day' => '0[1-9]|[12][0-9]|3[01]',
            'month' => '0[1-9]|1[012]',
            'year' => '[12][0-9]{3}'
        ]
    );
    $routes->connect(
        '/post/:id',///:slug
        ['controller' => 'Posts', 'action' => 'view'],
        [
            'id' => '[0-9]+',
            //'slug' => '[a-zA-Z0-9-]+',
            'pass' => ['id']//, 'slug'
        ]
    );
    $routes->connect(
        '/posts/:id',
        ['controller' => 'Posts', 'action' => 'view'],
        ['id' => '[0-9]+', 'pass' => ['id']]
    );
*/

    $routes->connect(
        '/posts/:id',
        ['controller' => 'Posts', 'action' => 'view'],
        ['id' => '[0-9]+', 'pass' => ['id']]
    );

    $routes->connect('/:controller',
        ['action' => 'index']
    );
    $routes->connect('/:controller/:action',
        []
    );
    $routes->connect('/:controller/:action/:id',
        [], ['id' => '[0-9]+', 'pass' => ['id']]
    );

    $routes->fallbacks(DashedRoute::class);
});

Router::prefix('admin', function (RouteBuilder $routes) {

    $routes->redirect('/blog',
        ['plugin' => 'Progredi/Blog', 'controller' => 'Blog', 'action' => 'dashboard'],
        ['status' => 301]
    );

    $routes->connect('/blog/preferences',
        ['plugin' => null, 'controller' => 'Preferences', 'action' => 'index', 'blog']
    );

    $routes->plugin('Progredi/Blog', ['path' => '/blog'], function (RouteBuilder $routes) {

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

        $routes->fallbacks(DashedRoute::class);
    });
});
