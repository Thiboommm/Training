<?php

declare (strict_types=1);

namespace Convert\Blog\Api\Data;

use Convert\Blog\Model\Blog;

interface BlogInterface
{
    const CONTENT = 'content';

    const TITLE = 'title';

    const ID = 'id';

    /**
     * @return int|string|null
     */
    public function getId(): int|null|string;

    /**
     * @param int|null $id
     * @return Blog
     */
    public function setId(?int $id): Blog;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param string $content
     * @return BlogInterface|Blog
     */
    public function setContent(string $content): BlogInterface|Blog;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     * @return BlogInterface|Blog
     */
    public function setTitle($title);
}
