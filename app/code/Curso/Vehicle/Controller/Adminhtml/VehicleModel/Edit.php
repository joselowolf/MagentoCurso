<?php
namespace Curso\Vehicle\Controller\Adminhtml\VehicleModel;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Curso_Vehicle::model/edit';
    const PAGE_TITLE = 'Page Title';

    protected $_coreRegistry;
    protected $_resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
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
    public function execute(){
        $vehicleModelId = $this->getRequest()->getParam('vehicle_model_id');
        $model = $this->_objectManager->create('Curso\Vehicle\Model\VehicleModel');

        if ($vehicleModelId) {
            $model->load($vehicleModelId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Vehicle Model no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('vehicle_model', $model);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $vehicleModelId ? __('Edit Vehicle Model') : __('New Vehicle Model'),
            $vehicleModelId ? __('Edit Vehicle Model') : __('New Vehicle Model')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Vehicle Model'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getName() : __('New Vehicle Model'));

        return $resultPage;
    }
}
