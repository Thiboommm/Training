<?php

declare (strict_types=1);

namespace Convert\Blog\Block\Adminhtml\Blog;

use Magento\Backend\Block\Template;
use Convert\Blog\Api\BlogRepositoryInterface;

class NewPost extends Template
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
}
