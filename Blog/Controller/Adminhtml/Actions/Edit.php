<?php

declare (strict_types=1);

namespace Convert\Blog\Controller\Adminhtml\Actions;

use Convert\Blog\Api\BlogRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    protected PageFactory $resultPageFactory;
    protected BlogRepositoryInterface $blogRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param BlogRepositoryInterface $blogRepository
     */
    public function __construct(
        Context                 $context,
        PageFactory             $resultPageFactory,
        BlogRepositoryInterface $blogRepository
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->blogRepository = $blogRepository;
        parent::__construct($context);
    }

    public function execute(): Page|ResultInterface|ResponseInterface
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Blog'));
        return $resultPage;
    }
}
