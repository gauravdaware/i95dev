<?php


namespace Jiva\CustomerDetails\Api\Data;

interface CustomerInfoSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get customerInfo list.
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface[]
     */
    public function getItems();

    /**
     * Set FirstName list.
     * @param \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
