<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 10.07.19
 * Time: 11:49
 */

namespace Roma\B2BCustomers\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Roma\B2BCustomers\Api\Data\B2BInterface;

class InstallSchema implements InstallSchemaInterface
{
    /** {@inheritdoc} */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /** create table `roma_b2bcustomers` */
        $table = $installer->getConnection()->newTable(
            $installer->getTable(B2BInterface::TABLE_NAME)
        )->addColumn(
            B2BInterface::ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'Customer ID'
        )->addColumn(
            B2BInterface::FIRST_NAME_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'First Name'
        )->addColumn(
            B2BInterface::LAST_NAME_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Last Name'
        )->addColumn(
            B2BInterface::CODE_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer code'
        )->setComment(
            'B2BCustomers Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}