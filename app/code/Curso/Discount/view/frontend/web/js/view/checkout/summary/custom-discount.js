define(
    [
       'jquery',
       'Magento_Checkout/js/view/summary/abstract-total',
       'Magento_Checkout/js/model/quote',
       'Magento_Checkout/js/model/totals',
       'Magento_Catalog/js/price-utils'
    ],
    function ($,Component,quote,totals,priceUtils) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'Curso_Discount/checkout/summary/custom-discount'
            },
            totals: quote.getTotals(),
            isDisplayedCustomdiscountTotal : function () {
                return true;
            },
            getCustomdiscountTotal : function () {
                var price = 0;
                if (this.totals()) {
                    price = totals.getSegment('customdiscount').value;
                }
                return this.getFormattedPrice(price);
            }
         });
    }
);