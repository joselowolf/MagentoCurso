<?php
namespace Curso\Vehicle\Controller\Adminhtml\VehicleBrand;

class NewAction extends \Magento\Backend\App\Action
{
    protected $_resultForwardFactory;

    const ADMIN_RESOURCE = 'Curso_Vehicle::brand/newaction';
    const PAGE_TITLE = 'Page Title';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ){
        $this->_resultForwardFactory = $resultForwardFactory;
        return parent::__construct($context);
    }
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();
        $resultForward->forward('edit');
        return $resultForward;
    }

}
