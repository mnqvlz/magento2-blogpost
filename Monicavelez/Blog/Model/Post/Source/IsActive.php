<?php

/**
 * Created by PhpStorm.
 * User: mvelez
 * Date: 1/26/2017
 * Time: 11:31 AM
 */

namespace Monicavelez\Blog\Model\Post\Source;

class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Monicavelez\Blog\Model\Post
     *
     */

    protected $post;


    /**
     *
     * Constructor
     *
     * @param \Monicavelez\Blog\Model\Post $post
     *
     */


    public function __construct(\Monicavelez\Blog\Model\Post $post)
    {
        $this->post = $post;
    }

    /**
     *
     * Get options
     *
     * @return array
     *
     */

    public function toOptionArray()
    {
        // TODO: Implement toOptionArray() method.

        $options[] = [
            'label' => '',
            'value' => ''
        ];

        $availableOptions = $this->post->getAvailableStatuses();

        foreach($availableOptions as $key => $value){
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }
}