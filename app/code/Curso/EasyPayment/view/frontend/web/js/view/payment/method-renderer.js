define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'easypayment',
                component: 'Curso_EasyPayment/js/view/payment/method-renderer/easypayment'
            }
        );

        /** Add view logic here if needed */
        return Component.extend({});

    }
);x 