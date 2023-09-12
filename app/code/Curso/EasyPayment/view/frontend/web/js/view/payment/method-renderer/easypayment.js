define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Curso_EasyPayment/payment/easypayment'
            },
            /** Returns send check to info */
            getMailingAddress: function () {
                return window.checkoutConfig.payment.easypayment.mailingAddress;
            }
        });
    }
);