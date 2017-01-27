<?php
/**
 * Created by PhpStorm.
 * User: mvelez
 * Date: 1/24/2017
 * Time: 3:57 PM
 */

namespace Monicavelez\Blog\Model\ResourceModel\Post;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
       $this->_init('Monicavelez\Blog\Model\Post', 'Monicavelez\Blog\Model\ResourceModel\Post');
    }

}