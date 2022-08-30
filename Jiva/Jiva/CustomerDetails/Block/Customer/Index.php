<?php


namespace Jiva\CustomerDetails\Block\Customer;

class Index extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->formKey = $formKey;
    }
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
    public function getFormAction()
    {
        return 'info/save/index';
    }
}
