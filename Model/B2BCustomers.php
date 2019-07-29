<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 09.07.19
 * Time: 18:05
 */

namespace Roma\B2BCustomers\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Stdlib\DateTime;

use Roma\B2BCustomers\Api\Data\B2BInterface;
use Roma\B2BCustomers\Model\ResourceModel\B2BCustomers as ResourceModel;

class B2BCustomers extends AbstractModel implements B2BInterface, IdentityInterface
{
    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", \Roma\B2BCustomers\Api\Data\B2BInterface::CACHE_TAG, $this->getId())];
    }

    /** {@inheritdoc} */
    public function getFirstName()
    {
        return $this->getData(\Roma\B2BCustomers\Api\Data\B2BInterface::FIRST_NAME_FIELD);
    }

    /** {@inheritdoc} */
    public function setFirstName($firstName)
    {
        $this->setData(\Roma\B2BCustomers\Api\Data\B2BInterface::FIRST_NAME_FIELD, $firstName);

        return $this;
    }

    /** {@inheritdoc} */
    public function getLastName()
    {
        return $this->getData(\Roma\B2BCustomers\Api\Data\B2BInterface::LAST_NAME_FIELD);
    }

    /** {@inheritdoc} */
    public function setLastName($lastName)
    {
        $this->setData(\Roma\B2BCustomers\Api\Data\B2BInterface::LAST_NAME_FIELD, $lastName);

        return $this;
    }

    /** {@inheritdoc} */
    public function getCode()
    {
        return $this->getData(\Roma\B2BCustomers\Api\Data\B2BInterface::CODE_FIELD);
    }

    /** {@inheritdoc} */
    public function setCode($code)
    {
        return $this->setData(\Roma\B2BCustomers\Api\Data\B2BInterface::CODE_FIELD, $code);
    }
}