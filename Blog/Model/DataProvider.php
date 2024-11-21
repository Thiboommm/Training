<?php

declare (strict_types=1);

namespace Convert\Blog\Model;

use Convert\Blog\Model\ResourceModel\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{

    protected $collection;
    protected array $loadedData = [];

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $postCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string            $name,
        string            $primaryFieldName,
        string            $requestFieldName,
        CollectionFactory $postCollectionFactory,
        array             $meta = [],
        array             $data = []
    )
    {
        $this->collection = $postCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData(): array
    {
        {
            $items = $this->collection->getItems();
            foreach ($items as $blog) {
                $this->loadedData[$blog->getId()] = $blog->getData();
            }
            return $this->loadedData;
        }
    }
}
