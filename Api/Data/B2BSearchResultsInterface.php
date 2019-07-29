<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 09.07.19
 * Time: 17:07
 */

namespace Roma\B2BCustomers\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface B2BSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get B2BCustomers list.
     *
     * @return \Roma\B2BCustomers\Api\Data\B2BInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param B2BInterface[] $items
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function setItems(array $items);
}