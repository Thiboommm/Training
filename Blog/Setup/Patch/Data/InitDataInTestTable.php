<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Convert\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InitDataInTestTable implements DataPatchInterface
{

    private ModuleDataSetupInterface $moduleDataSetup;


    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $data = [
            ['title' => 'Title 1', 'content' => 'Blog data 1'],
            ['title' => 'Title 2', 'content' => 'Blog data 2'],
        ];
        $this->moduleDataSetup->getConnection()->insertArray(
            $this->moduleDataSetup->getTable('blog_post'),
            ['title', 'content'],
            $data
        );
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
