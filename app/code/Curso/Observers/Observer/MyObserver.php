<?php
namespace Curso\Observers\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class MyObserver implements ObserverInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $_logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    )
    {
        // Observer initialization code...
        // You can use dependency injection to get any class this observer may need.
        $this->_logger = $logger;
    }

    public function execute(Observer $observer)
    {
        // Observer execution code...
        $customer = $observer->getEvent()->getCustomer();
        $customerEmail = $customer->getEmail(); //Get customer Email
        $customerName = $customer->getName(); //Get customer Name
        $this->_logger->info("Curso_Observers -> customer_name: $customerName");
        $this->_logger->info("Curso_Observers -> customer_email: $customerEmail");
    }
}
