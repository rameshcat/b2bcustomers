<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Roma\B2BCustomers\Controller\Adminhtml\B2BCustomers;

use Magento\Framework\Exception\NoSuchEntityException;

use Roma\B2BCustomers\Api\Data\B2BInterface;
use Roma\B2BCustomers\Controller\Adminhtml\B2BCustomers as BaseAction;

class Edit extends BaseAction
{
    const ACL_RESOURCE      = 'roma_b2bcustomers::uicreate';
    const MENU_ITEM         = 'roma_b2bcustomers::uicreate';
    const PAGE_TITLE        = 'Edit Lesson';
    const BREADCRUMB_TITLE  = 'Edit Lesson';

    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);

        if (!empty($id)) {
            try {
                $model = $this->repository->getById($id);
            } catch (NoSuchEntityException $exception) {
                $this->logger->error($exception->getMessage());
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));
                return $this->redirectToGrid();
            }

        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addErrorMessage("Lesson not found");
            return $this->redirectToGrid();
        }

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register(B2BInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}
