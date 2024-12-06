<?php

declare (strict_types=1);

namespace Convert\Blog\Controller\Adminhtml\Actions;

use Convert\Blog\Model\Blog;
use Convert\Blog\Model\ResourceModel\Blog as BlogResourceModel;
use Convert\Blog\Model\ResourceModel\BlogFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
{
    protected BlogFactory $blogFactory;
    protected BlogResourceModel $blogResourceModel;

    public function __construct(
        Context           $context,
        BlogFactory       $blogFactory,
        BlogResourceModel $blogResourceModel
    )
    {
        parent::__construct($context);
        $this->blogFactory = $blogFactory;
        $this->blogResourceModel = $blogResourceModel;
    }

    public function execute(): ResultInterface|ResponseInterface
    {
        $id = $this->getRequest()->getParam('id');
        $blog = $this->blogFactory->create();

        if ($id) {
            /** @var Blog $blog */
            $blog = $this->blogResourceModel->load($blog, $id);
            try {
                $this->blogResourceModel->delete($blog);
                $this->messageManager->addSuccessMessage(__('The blog post has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error deleting blog post: ' . $e->getMessage()));
            }
        }
        return $this->_redirect('*/*/');
    }
}
