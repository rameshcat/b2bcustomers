<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 10.07.19
 * Time: 18:03
 */

namespace Roma\B2BCustomers\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

use Roma\B2BCustomers\Api\Data\B2BInterface;
use Roma\B2BCustomers\Api\B2BRepositoryInterface;
use Roma\B2BCustomers\Api\Data\B2BSearchResultsInterfaceFactory;
use Roma\B2BCustomers\Model\ResourceModel\B2BCustomers as ResourceModel;
use Roma\B2BCustomers\Model\B2BCustomersFactory;
use Roma\B2BCustomers\Model\ResourceModel\B2BCustomers\CollectionFactory;

class B2BRepository implements B2BRepositoryInterface
{
    /** @var ResourceModel */
    protected $resource;

    /** @var B2BCustomersFactory  */
    protected $b2bCustomersFactory;

    /** @var CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var CollectionFactory */
    protected $collectionFactory;

    /** @var B2BSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    public function __construct(
        \Roma\B2BCustomers\Model\ResourceModel\B2BCustomers $resource,
        \Roma\B2BCustomers\Model\B2BCustomersFactory $b2bCustomersFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Roma\B2BCustomers\Model\ResourceModel\B2BCustomers\CollectionFactory $collectionFactory,
        \Roma\B2BCustomers\Api\Data\B2BSearchResultsInterfaceFactory $b2bSearchResultsFactory
    ) {
        $this->resource                 = $resource;
        $this->b2bCustomersFactory      = $b2bCustomersFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $b2bSearchResultsFactory;
    }

    /** {@inheritdoc} */
    public function getById($id)
    {
        $b2bCustomers = $this->b2bCustomersFactory->create();
        $this->resource->load($b2bCustomers, $id);

        if (!$b2bCustomers->getId()) {
            throw new NoSuchEntityException(__('Lesson with id "%1" does not exist.', $id));
        }

        return $b2bCustomers;
    }

    /** {@inheritdoc} */
    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }

    /** {@inheritdoc} */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /** {@inheritdoc} */
    public function save(\Roma\B2BCustomers\Api\Data\B2BInterface $b2bCustomers)
    {
        try {
            $this->resource->save($b2bCustomers);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $b2bCustomers;
    }

    /** {@inheritdoc} */
    public function delete(\Roma\B2BCustomers\Api\Data\B2BInterface $b2bCustomers)
    {
        try {
            $this->resource->delete($b2bCustomers);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return $this;
    }
}