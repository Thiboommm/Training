<?php

declare(strict_types=1);

namespace Convert\Training\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Convert\Training\Logger\Logger;

class productSaveAfter implements ObserverInterface
{

    private Logger $logger;

    public function __construct(
        Logger $logger,
    )
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        if (!$productId = $product->getId()) {
            return $this;
        }
        $productName = $product->getName();
        $message = "'$productName' was saved with the ID '$productId'.";
        $this->logger->info($message);
        return $this;
    }
}
