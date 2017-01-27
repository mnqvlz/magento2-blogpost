<?php
/**
 * Created by PhpStorm.
 * User: mvelez
 * Date: 1/26/2017
 * Time: 12:11 PM
 */

namespace Monicavelez\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Monicavelez\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;


class MassDisable extends  \Magento\Backend\App\Action
{

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;


    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        foreach ($collection as $item) {
            $item->setIsActive(false);
            $item->save();
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been disabled.', $collection->getSize()));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }

}