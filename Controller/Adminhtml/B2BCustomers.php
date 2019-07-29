<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Roma\B2BCustomers\Controller\Adminhtml;

use Psr\Log\LoggerInterface;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;


use Roma\B2BCustomers\Api\Data\B2BInterface;
use Roma\B2BCustomers\Api\B2BRepositoryInterface;
use Roma\B2BCustomers\Model\B2BCustomersFactory;

abstract class B2BCustomers extends Action
{
    const ACL_RESOURCE          = 'Roma_B2BCustomers::b2bcustomers';
    const MENU_ITEM             = 'Roma_B2BCustomers::b2bcustomers';
    const PAGE_TITLE            = 'Roma B2BCustomers';
    const BREADCRUMB_TITLE      = 'B2BCustomers';
    const QUERY_PARAM_ID        = 'id';

    /** @var Registry  */
    protected $registry;

    /** @var PageFactory  */
    protected $pageFactory;

    /** @var  B2BCustomersFactory */
    protected $modelFactory;

    /** @var B2BInterface */
    protected $model;

    /** @var Page */
    protected $resultPage;

    /** @var B2BRepositoryInterface */
    protected $repository;

    /** @var Logger */
    protected $logger;

    /**
     * @param Context                       $context
     * @param Registry                      $registry
     * @param PageFactory                   $pageFactory
     * @param B2BRepositoryInterface        $repository
     * @param B2BCustomersFactory           $factory
     * @param LoggerInterface               $logger
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        B2BRepositoryInterface $repository,
        B2BCustomersFactory $factory,
        LoggerInterface $logger
    ){
        $this->registry       = $registry;
        $this->pageFactory    = $pageFactory;
        $this->repository     = $repository;
        $this->modelFactory   = $factory;
        $this->logger         = $logger;

        parent::__construct($context);

    }

    /** {@inheritdoc} */
    public function execute()
    {
        $this->_setPageData();

        return $this->resultPage;
    }

    /** {@inheritdoc} */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);

        return $result;
    }

    /**
     * @return Page
     */
    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }

        return $this->resultPage;
    }

    /**
     * @return B2BCustomers
     */
    protected function _setPageData()
    {
        $resultPage = $this->_getResultPage();
        $resultPage->setActiveMenu(static::MENU_ITEM);
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));

        return $this;
    }

    /** @return B2BInterface */
    protected function getModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }

        return $this->model;
    }

    /**
     * @return ResultInterface
     */
    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());

        return $redirect;
    }

    /**
     * @return ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/listing');
    }
}
