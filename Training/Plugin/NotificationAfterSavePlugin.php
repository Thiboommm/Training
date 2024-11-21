<?php

declare(strict_types=1);

namespace Convert\Training\Plugin;

use Convert\Training\Logger\Logger;
use Magento\Catalog\Model\ResourceModel\Product as ProductResourceModel;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\RequestInterface;


class NotificationAfterSavePlugin
{
    private Logger $logger;
    private RequestInterface $request;

    public function __construct(
        Logger           $logger,
        RequestInterface $request
    )
    {
        $this->logger = $logger;
        $this->request = $request;
    }

    /**
     * @param ProductResourceModel $subject
     * @param Product $product
     * @return Product[]
     */
    public function beforeSave(
        ProductResourceModel $subject,
        Product              $product,
    ): array
    {
        $productId = $product->getId();
        $productName = $product->getName();
        $beforeMessage = "BEFORE: '$productName' was saved with the ID '$productId'.";
        $this->logger->info($beforeMessage);
        return [$product];
    }

    public function afterSave(
        ProductResourceModel $subject,
        ProductResourceModel $result,
    )
    {
        $params = $this->request->getParams();
        $productId = $params['id'];
        $productName = $params['product']['name'];
        $beforeMessage = "AFTER: '$productName' was saved with the ID '$productId'.";
        $this->logger->info($beforeMessage);
        return $result;
    }

    public function aroundSave(
        ProductResourceModel $subject,
        \Closure             $proceed,
        Product              $product
    )
    {
        $productId = $product->getId();
        $productName = $product->getName();
        // Log before the save action
        $this->logger->info("AROUND-BEFORE: '$productName' was saved with the ID '$productId'.");

        // Proceed with the original save method
        $result = $proceed($product);

        // Log after the save action
        $this->logger->info("AROUND-AFTER: '$productName' was saved with the ID '$productId'.");

        // Return the result of the save method
        return $result;
    }
}
