<?php

declare (strict_types=1);

namespace Convert\Blog\Block\Adminhtml\Blog;

use Convert\Blog\Api\Data\BlogInterface;
use Magento\Backend\Block\Template;
use Convert\Blog\Api\BlogRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends Template
{
    protected BlogRepositoryInterface $blogRepository;

    public function __construct(
        Template\Context        $context,
        BlogRepositoryInterface $blogRepository,
        array                   $data = []
    )
    {
        $this->blogRepository = $blogRepository;
        parent::__construct($context, $data);
    }

    public function getBlog(): ?BlogInterface
    {
        $blogId = $this->getRequest()->getParam('id');
        if ($blogId) {
            try {
                return $this->blogRepository->getById($blogId);
            } catch (NoSuchEntityException $e) {
                return null;
            }
        }
        return null;
    }
}
