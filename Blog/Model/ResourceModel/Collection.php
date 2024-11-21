<?php

declare (strict_types=1);

namespace Convert\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected string $idFieldName = 'id';

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('Convert\Blog\Model\Blog',
            'Convert\Blog\Model\ResourceModel\Blog');
    }
}
