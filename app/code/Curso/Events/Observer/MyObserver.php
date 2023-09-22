<?php
namespace Curso\Events\Observer;

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
        $myEventData = $observer->getData('myEventData');
        $this->_logger->info(json_encode($myEventData));
    }
}
