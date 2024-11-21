<?php

declare (strict_types=1);

namespace Convert\Blog\Api\Data;

use Magento\Framework\Api\Search\SearchResultInterface;

interface BlogSearchResultInterface extends SearchResultInterface
{
    /**
     * @return BlogInterface[]
     */
    public function getItems(): array;

    /**
     * @param BlogInterface[] $items
     * @return SearchResultInterface
     */
    public function setItems(array $items = null): SearchResultInterface;
}
