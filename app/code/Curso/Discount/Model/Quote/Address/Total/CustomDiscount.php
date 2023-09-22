<?php
namespace Curso\Discount\Model\Quote\Address\Total;

class CustomDiscount extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{

    /**
    * @var \Magento\Framework\Pricing\PriceCurrencyInterface
    */
    protected $_priceCurrency;
    /**
     *
     * @var \Curso\Discount\Helper\Data
     */
    protected $_helperData;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $_logger;

    /**
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency [description]
     */
    public function __construct(
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Curso\Discount\Helper\Data $helperData,
        \Psr\Log\LoggerInterface $logger,
    ) {
        $this->_priceCurrency = $priceCurrency;
        $this->_helperData = $helperData;
        $this->_logger = $logger;
        $this->setCode('customdiscount');
    }

    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
            $this->_logger->info($quote->getSubtotal());
            // $this->_logger->info(type($quote->getSubtotal()));
            $customDiscountValue = $this->getNewTotal($quote->getSubtotal()) ;
            if ($customDiscountValue == 0) {
                return $this;
            }
            $customDiscount = $customDiscountValue *-1;
            $total->addTotalAmount('customdiscount', $customDiscount);
            $total->addBaseTotalAmount('customdiscount', $customDiscount);
            $quote->setCustomDiscount($customDiscount);
        return $this;
    }

    /**
     * Assign subtotal amount and label to address object
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        return [
            'code' => $this->getCode(),
            'title' => $this->getLabel(),
            'value' => $this->getNewTotal($quote->getSubtotal())
        ];
    }

    /**
     * get label
     * @return string
     */
    public function getLabel()
    {
        return __('Custom Discount');
    }
    /**
     * @param Float $total
     * @return Float
     */
    private function getNewTotal(Float $total) : Float{
        $type = $this->_helperData->getValueType();
        $discountValue = $this->_helperData->getCustomValue();
        $newTotal = 0.0;
        if ($type == "" || $discountValue == "") {
            return 0.0;
        }        
        if ($type == 'fixed'){
            if($discountValue <= $total){
                $newTotal = floatval($discountValue);
            }
        }else{
            if ($discountValue <= 100) {
                $newTotal = $total * ($discountValue/100);
            }
        }
        return $newTotal;
    }
}