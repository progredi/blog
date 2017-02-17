<?php

namespace Blog\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Inflector;

/**
 * Article Entity
 *
 * PHP5
 *
 * @category  Entity
 * @package   CakePHP Blog Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-blog-plugin
 */
class Article extends Entity
{
	protected $_accessible = [
		'title' => true,
		'body' => true,
		'*' => true,//false
	];

	/**
	 * SetTitle mutator method
	 * 
	 * @return string Title
	 */
    protected function _setTitle($title)
    {
        $this->set('slug', Text::slug($title));
        return $title;
    }
}