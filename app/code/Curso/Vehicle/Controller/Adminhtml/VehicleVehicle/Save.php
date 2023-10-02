<?php
namespace Curso\Vehicle\Controller\Adminhtml\VehicleVehicle;
use Magento\Backend\App\Action;
use Vehicle\VehicleVehicle\Model\VehicleVehicle;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Curso_Vehicle::vehicle/save';
    const PAGE_TITLE = 'Page Title';
    protected $_dataPersistor;
    protected $_vehicleVehicleFactory;
    protected $_vehicleVehicleRepository;

    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Curso\Vehicle\Model\VehicleVehicleFactory $vehicleVehicleFactory,
        \Curso\Vehicle\Api\VehicleVehicleRepositoryInterface $vehicleVehicleRepository
    )
    {
        $this->_dataPersistor = $dataPersistor;
        $this->_vehicleVehicleFactory = $vehicleVehicleFactory;
        $this->_vehicleVehicleRepository = $vehicleVehicleRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('vehicle_vehicle_id');
            if ($id) {
                try {
                    $model = $this->_vehicleVehicleRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This vehicle vehicle no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                unset($data['vehicle_vehicle_id']);
                $model = $this->_vehicleVehicleFactory->create();
            }
            $model->setData($data);
            try {
                $this->_vehicleVehicleRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the vehicle vehicle.'));
                $this->_dataPersistor->clear('vehicle_vehicle');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['vehicle_vehicle_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the vehicle vehicle.'));
            }
        }
    }
}
