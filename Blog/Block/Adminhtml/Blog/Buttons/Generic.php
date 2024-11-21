<?php

declare (strict_types=1);

namespace Convert\Blog\Block\Adminhtml\Blog\Buttons;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\PageRepositoryInterface;

class Generic
{
    protected Context $context;
    protected PageRepositoryInterface $pageRepository;

    public function __construct(
        Context                 $context,
        PageRepositoryInterface $pageRepository

    )
    {
        $this->context = $context;
        $this->pageRepository = $pageRepository;
    }

    public function getUrl($route = '', $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
