<?php

declare(strict_types=1);

namespace Convert\Newsletter\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class AddNameToSubscriber implements ObserverInterface
{
    protected RequestInterface $request;

    public function __construct(
        RequestInterface $request
    )
    {
        $this->request = $request;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $subscriber = $observer->getEvent()->getSubscriber();

        $subscriberName = $this->request->getParam('name');
        if ($subscriberName) {
            $subscriber->setData('name', $subscriberName);
        }
    }
}
