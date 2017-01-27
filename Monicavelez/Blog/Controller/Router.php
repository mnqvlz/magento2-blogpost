<?php

/**
 * Created by PhpStorm.
 * User: mvelez
 * Date: 1/25/2017
 * Time: 10:47 AM
 */

namespace Monicavelez\Blog\Controller;


class Router implements \Magento\Framework\App\RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */

    protected $actionFactory;

    /**
     * Post factory
     *
     * @var \Monicavelez\Blog\Model\PostFactory
     */
    protected $_postFactory;

    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Monicavelez\Blog\Model\PostFactory $postFactory
     */

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory, \Monicavelez\Blog\Model\PostFactory $postFactory)
    {
        $this->actionFactory = $actionFactory;
        $this->_postFactory = $postFactory;
    }

    /**
     *
     * Validate and Match Blog Post and modify request
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     *
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        // TODO: Implement match() method.

        $url_key = explode('/blog/', $request->getPathInfo());
        $url_key = array_slice($url_key, 1);
        $url_key = implode('/', $url_key);
        $url_key = rtrim($url_key,'/');

        /** @var \Monicavelez\Blog\Model\Post $post */
        $post = $this->_postFactory->create();
        $post_id = $post->checkUrlKey($url_key);

        if(!$post_id){
            return null;
        }

        $request->setModuleName('blog')
            ->setControllerName('view')
            ->setParam('post_id', $post_id);
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $url_key);

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward');

    }


}