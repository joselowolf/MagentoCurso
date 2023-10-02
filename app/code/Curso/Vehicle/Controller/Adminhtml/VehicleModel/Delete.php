<?php
namespace Curso\Vehicle\Controller\Adminhtml\VehicleModel;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Curso_Vehicle::model/delete';
    const PAGE_TITLE = 'Page Title';

    protected $_vehicleModelRepository;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Curso\Vehicle\Api\VehicleModelRepositoryInterface $vehicleModelRepository
    )
    {
        $this->_vehicleModelRepository = $vehicleModelRepository;
        return parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('vehicle_model_id');
        try {
            $this->_vehicleModelRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(__('You deleted the vehicle model.'));
            $this->_dataPersistor->clear('vehicle_model');
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting the vehicle model.'));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/edit', ['vehicle_model_id' => $id]);
    }
}