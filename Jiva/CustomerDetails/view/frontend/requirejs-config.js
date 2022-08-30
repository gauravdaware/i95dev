

var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/view/shipping': {
                'Jiva_CustomerDetails/js/view/shipping': true
            }
        }
    },
    "map": {
        "*": {
            "Magento_Checkout/js/model/shipping-save-processor/default": "Jiva_CustomerDetails/js/shipping-save-processor"
        }
    }
};
