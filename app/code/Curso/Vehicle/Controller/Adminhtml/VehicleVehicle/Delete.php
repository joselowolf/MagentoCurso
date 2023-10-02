<?php
namespace Curso\Vehicle\Controller\Adminhtml\VehicleVehicle;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Curso_Vehicle::vehicle/delete';
    const PAGE_TITLE = 'Page Title';

    protected $_vehicleVehicleRepository;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Curso\Vehicle\Api\VehicleVehicleRepositoryInterface $vehicleVehicleRepository
    )
    {
        $this->_vehicleVehicleRepository = $vehicleVehicleRepository;
        return parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('vehicle_vehicle_id');
        try {
            $this->_vehicleVehicleRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(__('You deleted the vehicle vehicle.'));
            $this->_dataPersistor->clear('vehicle_vehicle');
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting the vehicle vehicle.'));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/edit', ['vehicle_vehicle_id' => $id]);
    }
}
