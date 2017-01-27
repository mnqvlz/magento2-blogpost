<?php

/**
 * Created by PhpStorm.
 * User: mvelez
 * Date: 1/25/2017
 * Time: 9:40 AM
 */

namespace Monicavelez\Blog\Block;

use Monicavelez\Blog\Api\Data\PostInterface;
use Monicavelez\Blog\Model\ResourceModel\Post\Collection as PostCollection;

class PostList extends \Magento\Framework\View\Element\Template implements \Magento\Framework\DataObject\IdentityInterface
{

    /**
     * @var \Monicavelez\Blog\Model\ResourceModel\Post\CollectionFactory
     */

    protected $_postCollectionFactory;


    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Monicavelez\Blog\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
     * @param array $data
     */

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Monicavelez\Blog\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_postCollectionFactory = $postCollectionFactory;
    }

    /**
     *
     * @return \Monicavelez\Blog\Model\ResourceModel\Post\Collection
     */

    public function getPosts(){
        //Check if posts has already been defined
        //Makes our block nice and reusable
        //pass the 'posts' data to this block, with a collection
        //that has been filtered differently

        if(!$this->hasData('posts')){
            $posts = $this->_postCollectionFactory->create()
                          ->addFilter('is_active', 1)
                          ->addOrder(
                              PostInterface::CREATION_TIME,
                              PostCollection::SORT_ORDER_DESC
                          );
            $this->setData('posts', $posts);
        }

        return $this->getData('posts');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */

    public function getIdentities()
    {
        // TODO: Implement getIdentities() method.

        return[\Monicavelez\Blog\Model\Post::CACHE_TAG . '_' . 'list'];
    }



}