<?php
namespace Curso\Events\Controller\Index;
use Magento\Framework\Event\ManagerInterface as EventManager;

class Event extends \Magento\Framework\App\Action\Action
{
    /**
     * @var EventManager
     */
    private $eventManager;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Event\ManagerInterface $eventManager
    ) {
        $this->pageFactory = $pageFactory;
        $this->eventManager = $eventManager;
        parent::__construct($context);
    }

    public function execute()
    {
        //Event dispatch
        $eventData = [
            "event"=>"custom_event",
            "why?"=>"Why not?"
        ];
        $this->eventManager->dispatch('curso_event_after', ['myEventData' => $eventData]);
        //Page render
        $pageFactory = $this->pageFactory->create();
        $pageFactory ->getConfig()->getTitle()->set(__('Módulo de eventos'));
        return $this->pageFactory->create();
    }
}