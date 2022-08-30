<?php


namespace Jiva\CustomerDetails\Model\ResourceModel\CustomerInfo;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Jiva\CustomerDetails\Model\CustomerInfo::class,
            \Jiva\CustomerDetails\Model\ResourceModel\CustomerInfo::class
        );
    }
}
