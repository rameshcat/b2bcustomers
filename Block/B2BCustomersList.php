<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 09.07.19
 * Time: 17:23
 */

namespace Roma\B2BCustomers\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;

use Roma\B2BCustomers\Api\B2BRepositoryInterface;
use Roma\B2BCustomers\Api\Data\B2BSearchResultsInterface;

class B2BCustomersList extends \Magento\Framework\View\Element\Template
{
    /** @var SearchCriteriaBuilder */
    protected $searchCriteria;

    /** @var B2BRepositoryInterface */
    protected $repository;

    protected $scopeConfig;

    /**
     * @param Context                       $context
     * @param B2BRepositoryInterface        $b2brepository
     * @param SearchCriteriaBuilder         $searchCriteriaBuilder
     * @param array                         $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Roma\B2BCustomers\Api\B2BRepositoryInterface $b2brepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->repository       = $b2brepository;
        $this->searchCriteria   = $searchCriteriaBuilder;
        $this->scopeConfig      = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function toHtml()
    {
        $type = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        $path = 'b2bCustomers/general/is_enabled';
        $result = $this->scopeConfig->getValue($path, $type);
        if ($result == 1){
            return parent::toHtml();
        } return "";
    }

    /**
     * @return \Roma\B2BCustomers\Api\Data\B2BSearchResultsInterface
     */
    public function getActualB2BCustomersList()
    {
        $searchCriteria = $this->searchCriteria->create();

        $searchResult = $this->repository->getList($searchCriteria);

        return $searchResult;
    }
}