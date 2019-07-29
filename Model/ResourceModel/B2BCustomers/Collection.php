<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 09.07.19
 * Time: 18:17
 */

namespace Roma\B2BCustomers\Model\ResourceModel\B2BCustomers;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Roma\B2BCustomers\Model\ResourceModel\B2BCustomers as Model;
use Roma\B2BCustomers\Model\ResourceModel\B2BCustomers as ResourceModel;

class Collection extends AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Roma\B2BCustomers\Model\B2BCustomers::class, \Roma\B2BCustomers\Model\ResourceModel\B2BCustomers::class);
    }
}