<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Text;

/**
 * Comment Entity
 *
 * PHP5/7
 *
 * @category  Model\Entity
 * @package   Progredi\Blog
 * @since     0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/blog
 */
class Comment extends Entity
{
    /**
     * Accessible properties
     *
     * Properties that can be mass assigned using newEntity() or patchEntity().
     *
     * @access protected
     * @var array
     */
    protected $_accessible = [
        '*' => true
    ];

    /**
     * Virtual properties
     *
     * Properties to be exposed / made visible in data, especially when to be
     * exported as array/JSON.
     *
     * @access protected
     * @var array
     */
    protected $_virtual = [
    ];

    /**
     * Hidden properties
     *
     * Properties containing sensitive data not to be exposed, e.g. password
     * hashes, security questions, etc.
     *
     * @access protected
     * @var array
     */
    protected $_hidden = [
    ];

    /**
     * Title mutator method
     *
     * Creates slug from comment title
     *
     * @access protected
     * @param string $name
     * @return string $name
     */
    protected function _setTitle($title)
    {
        $this->set('slug', Text::slug($title));
        return $title;
    }
}