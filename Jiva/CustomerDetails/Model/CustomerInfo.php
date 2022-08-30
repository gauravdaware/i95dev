<?php


namespace Jiva\CustomerDetails\Model;

use Jiva\CustomerDetails\Api\Data\CustomerInfoInterface;
use Jiva\CustomerDetails\Api\Data\CustomerInfoInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class CustomerInfo extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'jiva_customerdetails_customerinfo';
    protected $customerinfoDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CustomerInfoInterfaceFactory $customerinfoDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Jiva\CustomerDetails\Model\ResourceModel\CustomerInfo $resource
     * @param \Jiva\CustomerDetails\Model\ResourceModel\CustomerInfo\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        CustomerInfoInterfaceFactory $customerinfoDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Jiva\CustomerDetails\Model\ResourceModel\CustomerInfo $resource,
        \Jiva\CustomerDetails\Model\ResourceModel\CustomerInfo\Collection $resourceCollection,
        array $data = []
    ) {
        $this->customerinfoDataFactory = $customerinfoDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve customerinfo model with customerinfo data
     * @return CustomerInfoInterface
     */
    public function getDataModel()
    {
        $customerinfoData = $this->getData();
        
        $customerinfoDataObject = $this->customerinfoDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $customerinfoDataObject,
            $customerinfoData,
            CustomerInfoInterface::class
        );
        
        return $customerinfoDataObject;
    }
}
