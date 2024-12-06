<?php

declare (strict_types=1);

namespace Convert\Blog\Controller\Adminhtml\Actions;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Convert\Blog\Api\BlogRepositoryInterface;

class NewPost extends Action
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

    /**
     * Execute method to load and display the edit page
     *
     * @return Page
     */
    public function execute(): Page
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Add New Blog'));
        return $resultPage;
    }
}
