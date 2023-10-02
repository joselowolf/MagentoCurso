<?php
namespace Curso\Vehicle\Controller\Adminhtml\VehicleBrand;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Curso_Vehicle::vehiclebrand';
    const PAGE_TITLE = 'Vehicle Brand';

    protected $_coreRegistry;
    protected $_resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    protected function _initAction()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu(static::ADMIN_RESOURCE);
        $resultPage->addBreadcrumb(__(static::PAGE_TITLE), __(static::PAGE_TITLE));
        $resultPage->getConfig()->getTitle()->prepend(__(static::PAGE_TITLE));

        return $resultPage;
    }
    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $vehicleBrandId = $this->getRequest()->getParam('vehicle_brand_id');
        $model = $this->_objectManager->create('Curso\Vehicle\Model\VehicleBrand');

        if ($vehicleBrandId) {
            $model->load($vehicleBrandId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Vehicle Brand no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('vehicle_brand', $model);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $vehicleBrandId ? __('Edit Vehicle Brand') : __('New Vehicle Brand'),
            $vehicleBrandId ? __('Edit Vehicle Brand') : __('New Vehicle Brand')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Vehicle Brand'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getName() : __('New Vehicle Brand'));

        return $resultPage;
    
    }
}
