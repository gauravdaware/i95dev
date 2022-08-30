<?php


namespace Jiva\CustomerDetails\Controller\Adminhtml\CustomerInfo;

class Edit extends \Jiva\CustomerDetails\Controller\Adminhtml\CustomerInfo
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('customerinfo_id');
        $model = $this->_objectManager->create(\Jiva\CustomerDetails\Model\CustomerInfo::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Customerinfo no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('jiva_customerdetails_customerinfo', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Customerinfo') : __('New Customerinfo'),
            $id ? __('Edit Customerinfo') : __('New Customerinfo')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Customerinfos'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Customerinfo %1', $model->getId()) : __('New Customer Info'));
        return $resultPage;
    }
}
