<?php

declare (strict_types=1);

namespace Convert\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Convert\Blog\Api\Data\BlogInterface;
use Convert\Blog\Api\Data\BlogSearchResultInterface;

interface BlogRepositoryInterface
{
    /**
     * @param BlogInterface $blog
     * @return BlogInterface
     */
    public function save(BlogInterface $blog): BlogInterface;

    /**
     * @param $blogId
     * @return BlogInterface
     */
    public function getById($blogId): BlogInterface;

    /**
     * @param BlogInterface $blog
     * @return bool
     */
    public function delete(BlogInterface $blog): bool;

    /**
     * @param string $blogId
     * @return void
     */
    public function deleteById($blogId): void;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return BlogSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): BlogSearchResultInterface;
}
