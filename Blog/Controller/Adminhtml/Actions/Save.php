<?php

declare (strict_types=1);

namespace Convert\Blog\Controller\Adminhtml\Actions;

use Convert\Blog\Model\Blog;
use Convert\Blog\Model\BlogFactory;
use Convert\Blog\Model\ResourceModel\Blog as BlogResourceModel;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Save extends Action
{
    protected BlogFactory $blogFactory;
    protected BlogResourceModel $blogResourceModel;
    protected DateTime $date;

    public function __construct(
        Context           $context,
        BlogResourceModel $blogResourceModel,
        BlogFactory       $blogFactory,
        DateTime          $date
    )
    {
        parent::__construct($context);
        $this->blogResourceModel = $blogResourceModel;
        $this->blogFactory = $blogFactory;
        $this->date = $date;
    }

    public function execute(): ResultInterface|ResponseInterface
    {
        $id = $this->getRequest()->getParam('id');
        $title = $this->getRequest()->getParam('title');
        $content = $this->getRequest()->getParam('content');

        /** @var Blog $model */
        $model = $this->blogFactory->create();
        if ($id) {
            $this->blogResourceModel->load($model, $id);
        }
        $model->setTitle($title);
        $model->setContent($content);
        try {
            $this->blogResourceModel->save($model);
            $this->messageManager->addSuccessMessage(__('The blog post has been saved.'));

            if ($this->getRequest()->getParam('back')) {
                return $this->_redirect('*/actions/edit', ['id' => $model->getId(), '_current' => true]);
            }
            return $this->_redirect('*/post/index');
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Error saving the blog post.'));
            return $this->_redirect('blog/actions/edit', ['id' => $id]);
        }
    }
}
