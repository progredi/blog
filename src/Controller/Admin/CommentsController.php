<?php

namespace Progredi\Blog\Controller\Admin;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;
//use Cake\Network\Session;
use Progredi\Blog\Controller\Admin\AppController;

/**
 * Comments Admin Controller
 *
 * PHP5/7
 *
 * @category  Controller\Admin
 * @package   Progredi\Blog
 * @since     0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/blog
 */
class CommentsController extends AppController
{
    /**
     * Index method [Admin]
     *
     * @access public
     * @throws \Cake\Network\Exception\NotFoundException On paging error
     * @return \Cake\Http\Response Redirects on pagination error, otherwise renders view
     */
    public function index()
    {
        // Configure pagination request.

        $this->paginate['Comments'] = [
            'conditions' => parent::index(),
            'limit' => $this->paginate['limit'],
            'order' => ['Comments.name' => 'asc'],
            'contain' => [
                'Posts'
            ]
        ];

        // Check for invalid pagination requests.

        try {
            $comments = $this->paginate($this->Comments);
        } catch (NotFoundException $e) {
            // Check for out of range page request.
            $this->Flash->error(__("Page request out of range"));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('title_for_layout', __('Comments') . TS . __('Blog') . TS . __('Admin'));

        $this->set('comments', $comments);
        $this->set('_serialize', ['comments']);
    }

    /**
     * Add method [Admin]
     *
     * @access public
     * @return \Cake\Http\Response Redirects on successful add, otherwise renders view
     */
    public function add()
    {
        $session = $this->request->session();

        $comment = $this->Comments->newEntity();

        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            // Validate request data for new entity
            //if ($comment->getErrors()) {
                // Entity failed validation.
            //}
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('Comment details have been saved'));
                if (!is_null($this->request->getData('apply'))) {
                    return $this->redirect(['action' => 'edit', $this->Comments->id]);
                }
                return $this->redirect($session->read('App.referrer'));
            }
            $this->Flash->error(__('Comment details could not be saved, please try again'));
        }

        if (!$this->request->getData()) {
            $session->write('App.referrer', $this->referer());
        }

        $this->set('title_for_layout', __('Add Comment') . TS . __('Blog') . TS . __('Admin'));

        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    /**
     * View method [Admin]
     *
     * @access public
     * @param string|null $id
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Cake\Datasource\Exception\InvalidPrimaryKeyException When primary key invalid
     * @return \Cake\Http\Response Redirects on failed entity retrieval, otherwise renders view
     */
    public function view($id = null)
    {
        // Check for entity request errors.

        try {
            $comment = $this->Comments->get($id//, [
                //'contain' => ['Posts']
            //]
            );
        } catch (RecordNotFoundException $e) {
            // Record primary key not found in table.
            $this->Flash->error(__('Comment not found'));
            return $this->redirect(['action' => 'index']);
        } catch (InvalidPrimaryKeyException $e) {
            // Invalid primary key, e.g. NULL.
            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('title_for_layout', __('View Comment') . TS . __('Blog') . TS . __('Admin'));

        $session = $this->request->session();
        $session->write('App.referrer', $this->referer());

        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    /**
     * Edit method [Admin]
     *
     * @access public
     * @param string|null $id
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Cake\Datasource\Exception\InvalidPrimaryKeyException When primary key invalid
     * @return \Cake\Http\Response Redirects to referring page on successful edit, otherwise renders view
     */
    public function edit($id = null)
    {
        // Check for entity request errors.

        try {
            $comment = $this->Comments->get($id);
        } catch (RecordNotFoundException $e) {
            // Record primary key not found in table.
            $this->Flash->error(__('Comment not found'));
            return $this->redirect(['action' => 'index']);
        } catch (InvalidPrimaryKeyException $e) {
            // Invalid primary key, e.g. NULL.
            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(['action' => 'index']);
        }

        $session = $this->request->session();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            // Validate request data for new entity
            //if ($comment->getErrors()) {
            // Entity failed validation.
            //}
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('Comment details haves been updated'));
                if (!is_null($this->request->getData('apply'))) {
                    return $this->redirect($session->read('App.referrer'));
                }
            } else {
                $this->Flash->error(__('Comment details could not be updated, please try again'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $comment;
            $session->write('App.referrer', $this->referer());
        }

        $this->set('title_for_layout', __('Edit Comment') . TS . __('Blog') . TS . __('Admin'));

        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    /**
     * Delete method [Admin]
     *
     * @access public
     * @param string|null $id
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Cake\Datasource\Exception\InvalidPrimaryKeyException When primary key invalid
     * @return \Cake\Http\Response Redirects to index method or referrer
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        // Check for entity request errors.

        try {
            $comment = $this->Comments->get($id);
        } catch (RecordNotFoundException $e) {
            // Record primary key not found in table.
            $this->Flash->error(__('Comment not found'));
            return $this->redirect(env('HTTP_REFERER'));
        } catch (InvalidPrimaryKeyException $e) {
            // Invalid primary key, e.g. NULL.
            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(env('HTTP_REFERER'));
        }

        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('Comment has been deleted'));
        } else {
            $this->Flash->error(__('Comment could not be deleted, please try again'));
        }

        return $this->redirect(preg_match('/view|edit/', env('HTTP_REFERER'))
            ? ['action' => 'index']
            : env('HTTP_REFERER')
        );
    }
}
