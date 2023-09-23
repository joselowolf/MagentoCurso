<?php
namespace Curso\Discount\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\QuoteFactory;

class CustomDiscountObserver implements ObserverInterface
{
    protected $quoteFactory;

    public function __construct(QuoteFactory $quoteFactory)
    {
        $this->quoteFactory = $quoteFactory;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        if ($order && $order->getId()) {
            $quoteId = $order->getQuoteId();
            // Load the quote from this order
            $quote = $this->quoteFactory->create()->load($quoteId);
            $customDiscountAmount = $quote->getCustomDiscountAmount();
            $order->setData('custom_discount_amount', $customDiscountAmount);
            $order->save();
        }
    }
}
