<?php

namespace Progredi\Blog\Controller;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;
//use Cake\Network\Session;
use Progredi\Blog\Controller\AppController;

/**
 * Tags Controller
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
class TagsController extends AppController
{
    /**
     * Index method
     *
     * @access public
     * @throws \Cake\Network\Exception\NotFoundException On paging error
     * @return \Cake\Http\Response Redirects on pagination error, otherwise renders view
     */
    public function index()
    {
        // Configure pagination request.

        $this->paginate['Tags'] = [
            'conditions' => parent::index(),
            'limit' => $this->paginate['limit'],
            'order' => ['Tags.name' => 'asc']
        ];

        // Check for invalid pagination requests.

        try {
            $tag = $this->paginate($this->Tags);
        } catch (NotFoundException $e) {
            // Check for out of range page request.
            $this->Flash->error(__("Page request out of range"));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('title_for_layout', __('Tags') . TS . __('Blog') . TS . __('Admin'));

        $this->set('tags', $tag);
        $this->set('_serialize', ['tags']);
    }

    /**
     * View method
     *
     * @access public
     * @param string|null $id
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Cake\Datasource\Exception\InvalidPrimaryKeyException When primary key invalid
     * @return \Cake\Http\Response Redirects on failed entity retrieval, otherwise renders view.
     */
    public function view($id = null)
    {
        // Check for entity request errors.

        try {
            $tag = $this->Tags->get($id, [
                'contain' => ['Posts']
            ]);
        } catch (RecordNotFoundException $e) {
            // Record primary key not found in table.
            $this->Flash->error(__('Tag not found'));
            return $this->redirect(['action' => 'index']);
        } catch (InvalidPrimaryKeyException $e) {
            // Invalid primary key, e.g. NULL.
            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('title_for_layout', __('View Tag') . TS . __('Blog') . TS . __('Admin'));

        $session = $this->request->session();
        $session->write('App.referrer', $this->referer());

        $this->set('tag', $tag);
        $this->set('_serialize', ['tag']);
    }
}
