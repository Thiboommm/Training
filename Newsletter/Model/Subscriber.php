<?php

declare(strict_types=1);

namespace Convert\Newsletter\Model;

use Magento\Newsletter\Model\Subscriber as NewsletterSubscriber;

class Subscriber extends NewsletterSubscriber
{
    /**
     * @param string $name
     * @return string
     */
    public function setName(string $name): string
    {
        return $this->setName($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData('name');
    }
}
