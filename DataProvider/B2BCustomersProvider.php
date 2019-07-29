<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2018, Pavel Usachev
 */

namespace Roma\B2BCustomers\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Roma\B2BCustomers\Api\Data\B2BInterface;
use Roma\B2BCustomers\Model\ResourceModel\B2BCustomers\CollectionFactory;

class B2BCustomersProvider extends AbstractDataProvider
{
    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        if (empty($items)) {
            return [];
        }

        /** @var $b2bcustomer B2BInterface */
        foreach ($items as $b2bcustomer) {
            $this->loadedData[$b2bcustomer->getId()] = $b2bcustomer->getData();
        }

        return $this->loadedData;
    }
}