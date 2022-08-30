<?php


namespace Jiva\CustomerDetails\Model;

use Jiva\CustomerDetails\Api\Data\CustomerInfoSearchResultsInterfaceFactory;
use Jiva\CustomerDetails\Model\ResourceModel\CustomerInfo\CollectionFactory as CustomerInfoCollectionFactory;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Jiva\CustomerDetails\Model\ResourceModel\CustomerInfo as ResourceCustomerInfo;
use Jiva\CustomerDetails\Api\Data\CustomerInfoInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Reflection\DataObjectProcessor;
use Jiva\CustomerDetails\Api\CustomerInfoRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomerInfoRepository implements CustomerInfoRepositoryInterface
{

    protected $customerInfoCollectionFactory;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $dataObjectHelper;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    protected $resource;

    protected $searchResultsFactory;

    protected $dataCustomerInfoFactory;

    protected $customerInfoFactory;

    protected $dataObjectProcessor;


    /**
     * @param ResourceCustomerInfo $resource
     * @param CustomerInfoFactory $customerInfoFactory
     * @param CustomerInfoInterfaceFactory $dataCustomerInfoFactory
     * @param CustomerInfoCollectionFactory $customerInfoCollectionFactory
     * @param CustomerInfoSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceCustomerInfo $resource,
        CustomerInfoFactory $customerInfoFactory,
        CustomerInfoInterfaceFactory $dataCustomerInfoFactory,
        CustomerInfoCollectionFactory $customerInfoCollectionFactory,
        CustomerInfoSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->customerInfoFactory = $customerInfoFactory;
        $this->customerInfoCollectionFactory = $customerInfoCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomerInfoFactory = $dataCustomerInfoFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface $customerInfo
    ) {
        /* if (empty($customerInfo->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $customerInfo->setStoreId($storeId);
        } */
        
        $customerInfoData = $this->extensibleDataObjectConverter->toNestedArray(
            $customerInfo,
            [],
            \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface::class
        );
        
        $customerInfoModel = $this->customerInfoFactory->create()->setData($customerInfoData);
        
        try {
            $this->resource->save($customerInfoModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customerInfo: %1',
                $exception->getMessage()
            ));
        }
        return $customerInfoModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($customerInfoId)
    {
        $customerInfo = $this->customerInfoFactory->create();
        $this->resource->load($customerInfo, $customerInfoId);
        if (!$customerInfo->getId()) {
            throw new NoSuchEntityException(__('customerInfo with id "%1" does not exist.', $customerInfoId));
        }
        return $customerInfo->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customerInfoCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface $customerInfo
    ) {
        try {
            $customerInfoModel = $this->customerInfoFactory->create();
            $this->resource->load($customerInfoModel, $customerInfo->getCustomerinfoId());
            $this->resource->delete($customerInfoModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the customerInfo: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($customerInfoId)
    {
        return $this->delete($this->getById($customerInfoId));
    }
}
