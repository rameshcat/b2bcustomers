<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 09.07.19
 * Time: 17:11
 */

namespace Roma\B2BCustomers\Api;

interface B2BRepositoryInterface
{
    /**
     * @param int $id
     * @return \Roma\B2BCustomers\Api\Data\B2BInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);
    /**
     * @param int $id
     * @return \Roma\B2BCustomers\Api\B2BRepositoryInterface
     */
    public function deleteById($id);
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria | null
     * @return \Roma\B2BCustomers\Api\Data\B2BSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
    /**
     * @param \Roma\B2BCustomers\Api\Data\B2BInterface $b2bCustomers
     * @return \Roma\B2BCustomers\Api\Data\B2BInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Roma\B2BCustomers\Api\Data\B2BInterface $b2bCustomers);
    /**
     * @param \Roma\B2BCustomers\Api\Data\B2BInterface $b2bCustomers
     * @return \Roma\B2BCustomers\Api\B2BRepositoryInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Roma\B2BCustomers\Api\Data\B2BInterface $b2bCustomers);
}