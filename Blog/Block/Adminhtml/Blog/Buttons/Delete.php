<?php

declare (strict_types=1);

namespace Convert\Blog\Block\Adminhtml\Blog\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends Generic implements ButtonProviderInterface
{
    public function getButtonData(): array
    {
        return [
            'label' => __('Delete'),
            'class' => 'delete',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'blog_edit.blog_edit_data_source',
                                'actionName' => 'delete',
                                'params' => [
                                    false,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
