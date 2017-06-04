<?php

namespace Progredi\Blog\View\Cell;

use Cake\View\Cell;

/**
 * Category List Cell
 *
 * PHP5/7
 *
 * @category  View\Cell
 * @package   Progredi\Blog
 * @version   0.1.0
 * @author	  David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link	  http://www.progredi.co.uk/cakephp/plugins/blog
 */
class CategoryListCell extends Cell
{
	/**
	 * List of valid options that can be passed into this
	 * cell's constructor.
	 *
	 * @var array
	 */
	protected $_validCellOptions = [];

	/**
	 * Display method
	 * 
	 * Default method when rendering a cell.
	 *
	 * @return void
	 */
	public function display()
	{
        $this->loadModel('Progredi/Blog.Categories');
        $categories = $this->Categories->find('threaded');

//echo "<pre>\n\nRequest Data: " . print_r($categories->toArray(), true) . "\n</pre>\n\n";
//exit();

        $this->set('categories', $categories);
	}
}
