<?php

namespace Convert\Blog\Model;

use Convert\Blog\Api\Data\BlogSearchResultInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Convert\Blog\Api\BlogRepositoryInterface;
use Convert\Blog\Api\Data\BlogInterface;
use Convert\Blog\Api\Data\BlogSearchResultInterfaceFactory;
use Convert\Blog\Model\ResourceModel\CollectionFactory;
use Exception;

class BlogRepository implements BlogRepositoryInterface
{

    private \Convert\Blog\Model\ResourceModel\Blog $blogResource;
    private BlogFactory $blogFactory;
    private CollectionFactory $collectionFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private BlogSearchResultInterfaceFactory $blogSearchResultInterfaceFactory;

    public function __construct(
        \Convert\Blog\Model\ResourceModel\Blog $blogResource,
        BlogFactory                            $blogFactory,
        CollectionFactory                      $collectionFactory,
        CollectionProcessorInterface           $collectionProcessor,
        BlogSearchResultInterfaceFactory       $blogSearchResultInterfaceFactory
    )
    {
        $this->blogResource = $blogResource;
        $this->blogFactory = $blogFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->blogSearchResultInterfaceFactory = $blogSearchResultInterfaceFactory;
    }

    /**
     * @param BlogInterface $blog
     * @return BlogInterface
     * @throws CouldNotDeleteException
     */
    public function save(BlogInterface $blog): BlogInterface
    {
        try {
            $this->blogResource->save($blog);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return $blog;
    }

    /**
     * @param $blogId
     * @return BlogInterface
     * @throws NoSuchEntityException
     */
    public function getById($blogId): BlogInterface
    {
        $blog = $this->blogFactory->create();
        $this->blogResource->load($blog, $blogId);

        if (!$blog->getId()) {
            throw new NoSuchEntityException(__('Blog with id "%1" does not exist.', $blogId));
        }

        return $blog;
    }

    /**
     * @param BlogInterface $blog
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(BlogInterface $blog): bool
    {
        try {
            $this->blogResource->delete($blog);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }

    /**
     * @param $blogId
     * @return void
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($blogId): void
    {
        $this->delete($this->getById($blogId));
    }

    public function getList(SearchCriteriaInterface $searchCriteria): BlogSearchResultInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var  BlogSearchResultInterface $searchResults */
        $searchResults = $this->blogSearchResultInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
