<?php

declare(strict_types=1);

namespace Convert\Newsletter\Setup\Patch\Schema;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\DB\Ddl\Table;

class AddSubscriberNameColumn implements SchemaPatchInterface
{
    private SchemaSetupInterface $schemaSetup;

    public function __construct(SchemaSetupInterface $schemaSetup)
    {
        $this->schemaSetup = $schemaSetup;
    }

    public function apply(): void
    {
        $setup = $this->schemaSetup;
        $setup->startSetup();

        if (!$setup->getConnection()->tableColumnExists('newsletter_subscriber', 'name')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('newsletter_subscriber'),
                'name',
                [
                    'type' => Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'comment' => 'Subscriber Name',
                ]
            );
        }

        $setup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
