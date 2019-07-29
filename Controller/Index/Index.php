<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 10.06.19
 * Time: 13:02
 */

namespace Roma\B2BCustomers\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}