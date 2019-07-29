<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 10.07.19
 * Time: 12:03
 */

namespace Roma\B2BCustomers\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;

use Roma\B2BCustomers\Api\Data\B2BInterface;
use Roma\B2BCustomers\Api\Data\B2BInterfaceFactory;

class InstallData implements InstallDataInterface
{
    /** @var B2BInterfaceFactory  */
    private $b2bCustomersFactory;

    /** @var TransactionFactory */
    private $transactionFactory;

    /** LoggerInterface */
    private $logger;

    public function __construct(
        B2BInterfaceFactory $b2bCustomersFactory,
        TransactionFactory $transactionFactory,
        LoggerInterface $logger
    ) {
        $this->b2bCustomersFactory       = $b2bCustomersFactory;
        $this->transactionFactory   = $transactionFactory;
        $this->logger               = $logger;
    }

    /** {@inheritdoc} */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var Transaction $transactionalModel */
        $transactionalModel = $this->transactionFactory->create();

        for ($i = 1; $i < 11; $i++) {
            /** @var B2BInterface $b2bCustomers */
            $b2bCustomers = $this->b2bCustomersFactory->create();
            $b2bCustomers->setFirstName(sprintf("FirstName %d", $i));
            $b2bCustomers->setLastName(sprintf("LastName %d", $i));
            $b2bCustomers->setCode(sprintf("Code %d", $i));

            $transactionalModel->addObject($b2bCustomers);
        }

        try {
            $transactionalModel->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}