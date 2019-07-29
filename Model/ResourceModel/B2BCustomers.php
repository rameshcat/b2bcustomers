<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 09.07.19
 * Time: 18:02
 */

namespace Roma\B2BCustomers\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Roma\B2BCustomers\Api\Data\B2BInterface;

class B2BCustomers extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Roma\B2BCustomers\Api\Data\B2BInterface::TABLE_NAME, \Roma\B2BCustomers\Api\Data\B2BInterface::ID_FIELD);
    }
}