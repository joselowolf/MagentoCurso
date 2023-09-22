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
     * @var \Magento\Checkout\Model\Cart
     */
    private $_cart;
    /**
     * @var \Magento\Catalog\Model\Product
     */
    private $_product;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    private $_categoryCollection;
    /**
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency [description]
     */
    public function __construct(
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Curso\Discount\Helper\Data $helperData,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Model\Product $product,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
    ) {
        $this->setCode('customdiscount');
        $this->_priceCurrency = $priceCurrency;
        $this->_helperData = $helperData;
        $this->_logger = $logger;
        $this->_cart = $cart;
        $this->_product = $product;
        $this->_categoryCollection = $categoryCollectionFactory;
    }

    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
        
        if ($quote->getSubtotal() == null){
            return $this;
        }
        $customDiscountValue = $this->getDiscount($quote->getSubtotal()) ;
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
            'value' => $this->getDiscount($quote->getSubtotal())
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
    private function getDiscount(Float $total) : Float{
        $type = $this->_helperData->getValueType();
        $discountValue = $this->_helperData->getCustomValue();
        
        // Check if the category filters are valid
        $validCategory = $this->checkCategoryFilters();
        if(!$validCategory){
            return 0.0;
        }
        // Check if the price range filters are valid
        $validPriceRange = $this->chekPriceRangeFilter();
        if(!$validPriceRange){
            return 0.0;
        }
        
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
    /**
     * @return boolean
     */
    private function checkCategoryFilters() : bool{
        $categories = explode(",", $this->_helperData->getCategories());
        $itemsCollection = $this->_cart->getQuote()->getItemsCollection();
        $itemsVisible = $this->_cart->getQuote()->getAllVisibleItems();
        $products = $this->_cart->getQuote()->getAllItems();
        $allProductsInCategories = true;
        foreach($products as $product) {
            $productCategories = $this->getProductCategories($product->getProductId());
            $allProductsInCategories = $this->someValueInArray($categories, $productCategories);
            if($allProductsInCategories){
                break;
            }
        }
        return $allProductsInCategories;
    }
    /**
     * @param integer $productId
     * @return array
     */
    private function getProductCategories(int $productId) : array{
        $product = $this->_product->load($productId);
        $categoryIds = $product->getCategoryIds();
        $categories = $this->_categoryCollection->create()->addAttributeToSelect('*')->addAttributeToFilter('entity_id', $categoryIds);
        $categoryIds = [];
        foreach ($categories as $category) {
            $categoryIds[] = $category->getId();
        }
        return $categoryIds;
    }
    /**
     * @param array $array1
     * @param array $array2
     * @return boolean
     */
    function someValueInArray(array $array1, array $array2) : bool {
        foreach ($array1 as $valor) {
            if (in_array($valor, $array2)) {
                return true;
            }
        }
        return false;
    }
    /**
     * @return boolean
     */
    private function chekPriceRangeFilter() : bool{
        $priceFrom = $this->_helperData->getRangeFrom();
        $priceTo = $this->_helperData->getRangeTo();
        if($priceFrom == "" || $priceTo == ""){
            return false;
        }
        $subTotal = $this->_cart->getQuote()->getSubtotal();
        if($subTotal >= $priceFrom && $subTotal <= $priceTo){
            return true;
        }
        return false;
    }

}