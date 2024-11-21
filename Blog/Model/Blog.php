<?php

declare (strict_types=1);

namespace Convert\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Convert\Blog\Api\Data\BlogInterface;
use Convert\Blog\Model\ResourceModel\Blog as BlogResource;

class Blog extends AbstractModel implements BlogInterface
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(BlogResource::class);
    }

    /**
     * @return int|null|string
     */
    public function getId(): int|null|string
    {
        return $this->getData(self::ID);
    }

    /**
     * @param $id
     * @return Blog
     */
    public function setId($id): Blog
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @param string $content
     * @return BlogInterface|Blog
     */
    public function setContent(string $content): BlogInterface|Blog
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @param String $title
     * @return BlogInterface|Blog
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }
}
