<?php
namespace Progredi\Blog\Controller\Admin;

use Progredi\Blog\Controller\Admin\AppController;

/**
 * Articles Controller
 *
 * PHP5
 *
 * @category  Controller
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2016 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */
class ArticlesController extends AppController
{
	/**
	 * Index method [Admin]
	 *
	 * @return void
	 */
	public function index()
	{
		// Configure pagination request.

		$this->paginate['Articles'] = [
			'conditions' => parent::index(),
			//'fields' => ['Articles.title', 'Articles.comment_count', 'Articles.published', 'Articles.enabled'],
			'limit' => $this->paginate['limit'],
			'order' => ['Articles.published' => 'desc'],
			'contain' => [
				'Comments'
			]
		];

		// Check for invalid pagination requests.

		try {
			$articles = $this->paginate($this->Articles);
		}
		catch (NotFoundException $e) {

			// Check for out of range page request.

			$this->Flash->error(__("Page request out of range"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('Articles') . TS . __('Blog') . TS . __('Admin'));

		$this->set([
			'articles' => $articles,
			'_serialize', ['articles']
		]);
	}

	/**
	 * view()
	 */
	public function view($id = null)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

        $post = $this->Articles->get($id);

        $this->set(compact('article'));
    }

	/**
	 * add()
	 */
    public function add() {

        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->data);
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('Post has been saved'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Post could not be saved, please try again'));
        }

        $this->set('post', $post);
    }

	/**
	 * admin_index()
	 */
	public function admin_index() {

        $this->set('results', $this->Blog->find('all'));
	}

	/**
	 * admin_add()
	 */
	public function admin_add() {

		if (!empty($this->request->data)) {

			$this->Blog->create();

			if ($this->Blog->save($this->request->data)) {

				$this->Session->setFlash(__('ModelName has been saved'), 'flash/success');
				if (isset($this->request->data['apply'])) {

					$this->redirect(array('action'=>'edit', $this->Blog->id));
				}
				$this->redirect(array('action'=>'index'));
			}
			else {

				$this->Session->setFlash(__('ModelName could not be saved, please try again'), 'flash/error');
			}
		}

		$this->set('title_for_layout', 'ModelNamePlural :: Add ModelName');
	}

    /**
     * admin_view()
     */
	public function admin_view($id = null) {

        if (!$id) {

            $this->Session->setFlash(__('No ModelName Id was specified'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        $this->Blog->id = $id;
       	$data = $this->Blog->read();

        if (empty($data)) {

            $this->Session->setFlash(__('ModelName does not exist'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        $this->set('title_for_layout', 'ModelNamePlural :: View ModelName');
        $this->set('data', $data);
	}

    /**
     * admin_copy()
     */
    public function admin_copy($id = null) {

        if (!$id) {

            $this->Session->setFlash(__('No ModelName Id was specified'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        $this->Blog->id = $id;
       	$data = $this->Blog->read();

        if (empty($data)) {

            $this->Session->setFlash(__('ModelName does not exist'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        if (!$this->Blog->copy($id)) {

            $this->Session->setFlash(__('ModelName could not be copied'), 'flash/error');
            $this->redirect(array('action'=>'index'));
        }

        $this->Session->setFlash(__('ModelName has been copied - edit below and save'), 'flash/success');
        $this->redirect(array('action'=>'edit', $this->Blog->id));
    }

    /**
     * admin_edit()
     */
	public function admin_edit($id = null) {

        if (!$id) {

            $this->Session->setFlash(__('No ModelName Id was specified'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        if (empty($this->request->data)) {

            $this->Blog->id = $id;
       	    $this->request->data = $this->Blog->read();

            if (empty($this->request->data)) {

                $this->Session->setFlash(__('ModelName does not exist'), 'flash/error');
                $this->redirect(array('action' => 'index'));
            }

        } else {

            if ($this->Blog->save($this->request->data)) {

                $this->Session->setFlash(__('ModelName has been updated'), 'flash/success');
                if (!isset($this->params['form']['apply'])) {
                    $this->redirect(array('action'=>'index'));
                }

            } else {

                $this->Session->setFlash(__('ModelName could not be updated'), 'flash/error');
            }
        }

        $this->set('title_for_layout', 'ModelNamePlural :: Edit ModelName');
	}

    /**
     * admin_enable()
     */
    public function admin_enable($id = null) {

        if (!$id) {

            $this->Session->setFlash(__('No ModelName Id was specified'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        $this->Blog->id = $id;
        $data = $this->Blog->read();

        if (empty($data)) {

            $this->Session->setFlash(__('ModelName does not exist'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        $data['ModelName']['enabled'] = 1;

        if ($this->Blog->save($data)) {

            $this->Session->setFlash(__('ModelName has been enabled'), 'flash/success');
            $this->redirect(array('action'=>'index'));
        }

        $this->Session->setFlash(__('ModelName could not be enabled'), 'flash/error');
        $this->redirect(array('action'=>'index'));
    }

    /**
     * admin_disable()
     */
    public function admin_disable($id = null) {

        if (!$id) {

            $this->Session->setFlash(__('No ModelName Id was specified'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        $this->Blog->id = $id;
        $data = $this->Blog->read();

        if (empty($data)) {

            $this->Session->setFlash(__('ModelName does not exist'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        $data['ModelName']['enabled'] = 0;

        if ($this->Blog->save($data)) {

            $this->Session->setFlash(__('ModelName has been disabled'), 'flash/success');
            $this->redirect(array('action' => 'index'));
        }

        $this->Session->setFlash(__('ModelName could not be disabled'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_delete()
     */
	public function admin_delete($id = null) {

		if ($this->request->is('get')) {

			throw new MethodNotAllowedException();
		}

		if (!$id) {

			$this->Session->setFlash(__('No ModelName Id was specified'), 'flash/error');
			$this->redirect(array('action' => 'index'));
		}

		$this->Blog->id = $id;
		$data = $this->Blog->read();

		if (empty($data)) {

			$this->Session->setFlash(__('ModelName does not exist'), 'flash/error');
			$this->redirect(array('action' => 'index'));
		}

		if ($this->Blog->delete($id)) {

			$this->Session->setFlash(__('ModelName has been deleted'), 'flash/success');
		}
		else {

			$this->Session->setFlash(__('ModelName could not be deleted'), 'flash/error');
		}

		$this->redirect(array('action' => 'index'));
	}
}
