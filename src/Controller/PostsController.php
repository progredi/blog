<?php

namespace Progredi\Blog\Controller;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;
use Progredi\Blog\Controller\AppController;

/**
 * Posts Controller
 *
 * PHP5/7
 *
 * @category  Controller
 * @package   Progredi\Blog
 * @since     0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/blog
 */
class PostsController extends AppController
{
    /**
     * Index method
     *
     * @access public
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     * @return void
     */
    public function index()
    {
        // Configure pagination request.

        $this->paginate['Posts'] = [
            //'conditions' => ['Posts.published !=' => null],
            /*'fields' => [
                'Posts.id',
                'Posts.title',
                'Posts.slug',
                'Posts.summary',
                'Posts.body',
                'Posts.comment_count',
                'Posts.published',
                'Posts.enabled'
            ],*/
            'limit' => $this->paginate['limit'],
            'order' => ['Posts.published' => 'desc'],
            'contain' => [
                'Comments'
            ]
        ];

        // Check for invalid pagination requests.

        try {
            $posts = $this->paginate($this->Posts);
        } catch (NotFoundException $e) {
            // Check for out of range page request.
            $this->Flash->error(__("Page request out of range"));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('title_for_layout', __('Blog'));

//echo "<pre>\n\nPosts: " . print_r($posts->toArray(), true) . "\n</pre>\n\n";
//exit();

        $this->set('posts', $posts);
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Record identifier
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     * @return void
     */
    public function view($id = null)
    {
        // Check for entity request errors.

        try {
            $post = $this->Posts->get($id, [
                'contain' => ['Comments']
            ]);
        } catch (RecordNotFoundException $e) {
            // Record primary key not found in table.
            $this->Flash->error(__('Post not found'));
            return $this->redirect(['action' => 'index']);
        } catch (InvalidPrimaryKeyException $e) {
            // Invalid primary key, e.g. NULL.
            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(['action' => 'index']);
        }

//echo "<pre>\n\nPost: " . print_r($post->toArray(), true) . "\n</pre>\n\n";
//exit();

        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }
}
