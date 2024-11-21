<?php

declare (strict_types=1);

namespace Convert\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Blog extends AbstractDb
{

    protected function _construct(): void
    {
        $this->_init('blog_post', 'id');
    }
}
