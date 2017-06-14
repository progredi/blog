<?php

namespace Progredi\Blog\Controller;

use Progredi\Blog\Controller\AppController;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;

/**
 * Categories Controller
 *
 * PHP5/7
 *
 * @category  Controller
 * @package   Progredi\Blog
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/blog
 */
class CategoriesController extends AppController
{
    /**
     * View method
     *
     * @access public
     * @param string|null $id Record id
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Cake\Datasource\Exception\InvalidPrimaryKeyException When primary key invalid
     * @return \Cake\Http\Response|void Redirects on failed entity retrieval, otherwise renders view.
     */
    public function view($id = null)
    {
        // Check for entity request errors.

        try {
            $category = $this->Categories->get($id, [
                'contain' => ['Posts']
            ]);
        } catch (RecordNotFoundException $e) {
            // Record primary key not found in table.
            $this->Flash->error(__('Category not found'));
            return $this->redirect(['action' => 'index']);
        } catch (InvalidPrimaryKeyException $e) {
            // Invalid primary key, e.g. NULL.
            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(['action' => 'index']);
        }

        $category = $this->Categories->get($id)
            ->contain([
                'Posts'
            ]);

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, otherwise renders view.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
    public function edit($id = null)
    {
        $category = $this->Categories->get($id)
            ->contain([
                'AssocCategories'
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $entityName = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($entityName)) {
                $this->Flash->success(__('Category has been saved'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Category could not be saved, please try again'));
            }
        }
        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }
    */

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $entityName = $this->Categories->get($id);

        if ($this->Categories->delete($entityName)) {
            $this->Flash->success(__('Entity Name has been deleted'));
        } else {
            $this->Flash->error(__('Entity Name could not be deleted, please try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */
}
