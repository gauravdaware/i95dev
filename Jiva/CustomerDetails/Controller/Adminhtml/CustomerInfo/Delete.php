<?php


namespace Jiva\CustomerDetails\Controller\Adminhtml\CustomerInfo;

class Delete extends \Jiva\CustomerDetails\Controller\Adminhtml\CustomerInfo
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('customerinfo_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Jiva\CustomerDetails\Model\CustomerInfo::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Customerinfo.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['customerinfo_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Customerinfo to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
