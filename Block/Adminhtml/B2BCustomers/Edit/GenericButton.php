<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2018, Pavel Usachev
 */

namespace Roma\B2BCustomers\Block\Adminhtml\B2BCustomers\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

use Roma\B2BCustomers\Api\B2BRepositoryInterface;

class GenericButton
{
    /** @var Context */
    protected $context;

    /** @var B2BRepositoryInterface */
    protected $repository;

    public function __construct(
        Context $context,
        B2BRepositoryInterface $repository
    ) {
        $this->context      = $context;
        $this->repository   = $repository;
    }

    /**
     * Return customer_id
     *
     * @return int|null
     */
    public function getCustomerId()
    {
        try {
            return $this->repository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}