<?php

declare (strict_types=1);

namespace Convert\Blog\Block\Adminhtml\Blog\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveAndContinue extends Generic implements ButtonProviderInterface
{
    public function getButtonData(): array
    {
        return [
            'label' => __('Save and Continue'),
            'class' => 'save',
            'on_click' => '',
            'sort_order' => 50,
            'data_attribute' => [
                'mage-init' => [
                    'Magento_Ui/js/form/button-adapter' => [
                        'actions' => [
                            [
                                'targetName' => 'blog_edit.blog_edit_data_source',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'save_and_continue' => 1,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],

            ],
        ];
    }
}
