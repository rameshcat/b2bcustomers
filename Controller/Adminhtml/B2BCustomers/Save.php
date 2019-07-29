<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Roma\B2BCustomers\Controller\Adminhtml\B2BCustomers;

use Roma\B2BCustomers\Api\Data\B2BInterface;
use Roma\B2BCustomers\Controller\Adminhtml\B2BCustomers as BaseAction;

class Save extends BaseAction
{
    /** {@inheritdoc} */
    public function execute()
    {
        $isPost = $this->getRequest()->isPost();

        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParam('b2bcustomers');

            if (empty($formData)) {
                $formData = $this->getRequest()->getParams();
            }

            if(!empty($formData[B2BInterface::ID_FIELD])) {
                $id = $formData[B2BInterface::ID_FIELD];
                $model = $this->repository->getById($id);
            } else {
                unset($formData[B2BInterface::ID_FIELD]);
            }

            $model->setData($formData);

            try {
                $model = $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('New B2B Customer has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('B2B Customer doesn\'t save' ));
            }

            $this->_getSession()->setFormData($formData);

            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/uicreate');
        }

        return $this->doRefererRedirect();
    }
}
