<?php


namespace Jiva\CustomerDetails\Model\ResourceModel;

class CustomerInfo extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('jiva_customerdetails_customerinfo', 'customerinfo_id');
    }
}
