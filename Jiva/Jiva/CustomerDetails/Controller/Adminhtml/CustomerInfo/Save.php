<?php


namespace Jiva\CustomerDetails\Controller\Adminhtml\CustomerInfo;

use  Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        extract($_POST);
        /**
         * Code for image upload
         */
        $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'Photo']);
        $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
        $imageAdapter = $this->adapterFactory->create();
        /* start of validated image */
        $uploaderFactory->addValidateCallback('custom_image_upload',
        $imageAdapter,'validateUploadFile');
        $uploaderFactory->setAllowRenameFiles(true);
        $uploaderFactory->setFilesDispersion(true);
        $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $destinationPath = $mediaDirectory->getAbsolutePath('custom_image');
        $result = $uploaderFactory->save($destinationPath);
        $imagepath = $result['file'];
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $data['Photo'] = $imagepath;
        if ($data) {
            $id = $this->getRequest()->getParam('customerinfo_id');
        
            $model = $this->_objectManager->create(\Jiva\CustomerDetails\Model\CustomerInfo::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Customerinfo no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Customerinfo.'));
                $this->dataPersistor->clear('jiva_customerdetails_customerinfo');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['customerinfo_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Customerinfo.'));
            }
        
            $this->dataPersistor->set('jiva_customerdetails_customerinfo', $data);
            return $resultRedirect->setPath('*/*/edit', ['customerinfo_id' => $this->getRequest()->getParam('customerinfo_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
