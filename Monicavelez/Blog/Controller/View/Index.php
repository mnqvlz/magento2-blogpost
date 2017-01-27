<?php

/**
 * Created by PhpStorm.
 * User: mvelez
 * Date: 1/25/2017
 * Time: 12:08 PM
 */

namespace Monicavelez\Blog\Controller\View;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{

    /** @var \Magento\Framework\View\Result\Page */

    protected $resultPageFactory;

    /** @param \Magento\Framework\App\Action\Context $context */
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory)
    {
        $this->resultPageFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Blog Index, shows a list of recent blog posts
     * @return \Magento\Framework\View\Result\PageFactory
     */


    public function execute(){
        $post_id = $this->getRequest()->getParam('post_id', $this->getRequest()->getParam('id', false));

        /** @var \Monicavelez\Blog\Helper\Post $post_helper */

        $post_helper = $this->_objectManager->get('Monicavelez\Blog\Helper\Post');
        $result_page = $post_helper->prepareResultPost($this, $post_id);

        if(!$result_page){
            $resultForward = $this->resultPageFactory->create();
            return $resultForward->forward('noroute');
        }
        return $result_page;
    }
}