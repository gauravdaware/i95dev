<?php
namespace Jiva\CustomerDetails\Controller\Save;

use Magento\Framework\App\Action\Action;
use  Magento\Framework\App\Filesystem\DirectoryList;

class Index extends Action
{
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;
    private $resultPageFactory;
    protected $_objectManager;
    protected $_messageManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\Message\ManagerInterface $messageManager

    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->_objectManager = $objectManager;
        $this->_messageManager = $messageManager;
        parent::__construct($context);
    }
    public function execute()
    {
        try{
            $postData = (array)$this->getRequest()->getPost();
            extract($postData);
            $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'image']);
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
            //Save data in an array as array('database column Name' => $variable)
            $data = array(
                'FirstName'=>$fname,
                'LastName'=>$lname,
                'Email'=>$email,
                'DateOfBirth'=>$dob,
                'Photo'=>$imagepath,
                'Gender'=>$gender
            );
            $customerDetails = $this->_objectManager->create('Jiva\CustomerDetails\Model\CustomerInfo');
            $customerDetails->setData($data);
            $customerDetails->save();
            $this->messageManager->addSuccess(
                __('Thanks for providing your information.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('customer/account/');
            return $resultRedirect;
            // if (!$result) {
            //     throw new LocalizedException(
            //         __('File cannot be saved to path: $1', $destinationPath)
            //     );
            // }
            /* you need yo save image 
                 $result['file'] at datbaseQQ 
            */
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('We can\'t process your request right now. Sorry, that\'s all we know.'.$e->getMessage()));
        }
    }
}
