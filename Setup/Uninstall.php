<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 10.07.19
 * Time: 19:40
 */

namespace Roma\B2BCustomers\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;
use Roma\B2BCustomers\Api\Data\B2BInterface;

class Uninstall implements UninstallInterface
{
    /** {@inheritDoc} */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
       $this->dropTable($setup, B2BInterface::TABLE_NAME);
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param string $tableName
     */
    private function dropTable(SchemaSetupInterface $setup, $tableName)
    {
        $connection = $setup->getConnection();
        $connection->dropTable($this->getTableNameWithPrefix($setup, $tableName));
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param string $tableName
     *
     * @return string
     */
    private function getTableNameWithPrefix(SchemaSetupInterface $setup, $tableName)
    {
        return $setup->getTable($tableName);
    }
}