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
                type: 'curso_stripe',
                component: 'Curso_Stripe/js/view/payment/method-renderer/stripe-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);