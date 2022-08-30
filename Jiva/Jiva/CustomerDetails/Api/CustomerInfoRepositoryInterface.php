<?php


namespace Jiva\CustomerDetails\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomerInfoRepositoryInterface
{

    /**
     * Save customerInfo
     * @param \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface $customerInfo
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface $customerInfo
    );

    /**
     * Retrieve customerInfo
     * @param string $customerinfoId
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($customerinfoId);

    /**
     * Retrieve customerInfo matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete customerInfo
     * @param \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface $customerInfo
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface $customerInfo
    );

    /**
     * Delete customerInfo by ID
     * @param string $customerinfoId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customerinfoId);
}
