<?php
namespace Curso\Vehicle\Controller\Adminhtml\VehicleModel;
use Magento\Backend\App\Action;
use Vehicle\VehicleModel\Model\VehicleModel;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Curso_Vehicle::model/save';
    const PAGE_TITLE = 'Page Title';
    protected $_dataPersistor;
    protected $_vehicleModelFactory;
    protected $_vehicleModelRepository;

    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Curso\Vehicle\Model\VehicleModelFactory $vehicleModelFactory,
        \Curso\Vehicle\Api\VehicleModelRepositoryInterface $vehicleModelRepository
    )
    {
        $this->_dataPersistor = $dataPersistor;
        $this->_vehicleModelFactory = $vehicleModelFactory;
        $this->_vehicleModelRepository = $vehicleModelRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('vehicle_model_id');
            if ($id) {
                try {
                    $model = $this->_vehicleModelRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This vehicle model no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                unset($data['vehicle_model_id']);
                $model = $this->_vehicleModelFactory->create();
            }
            $model->setData($data);
            try {
                $this->_vehicleModelRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the vehicle model.'));
                $this->_dataPersistor->clear('vehicle_model');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['vehicle_model_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the vehicle model.'));
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
