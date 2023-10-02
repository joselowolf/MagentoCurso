<?php
namespace Curso\Vehicle\Controller\Adminhtml\VehicleBrand;
use Magento\Backend\App\Action;
use Vehicle\VehicleBrand\Model\VehicleBrand;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Curso_Vehicle::brand/save';
    const PAGE_TITLE = 'Page Title';

    protected $_dataPersistor;
    protected $_vehicleBrandFactory;
    protected $_vehicleBrandRepository;

    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Curso\Vehicle\Model\VehicleBrandFactory $vehicleBrandFactory,
        \Curso\Vehicle\Api\VehicleBrandRepositoryInterface $vehicleBrandRepository
    )
    {
        $this->_dataPersistor = $dataPersistor;
        $this->_vehicleBrandFactory = $vehicleBrandFactory;
        $this->_vehicleBrandRepository = $vehicleBrandRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('vehicle_brand_id');
            if ($id) {
                try {
                    $model = $this->_vehicleBrandRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This vehicle brand no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                unset($data['vehicle_brand_id']);
                $model = $this->_vehicleBrandFactory->create();
            }
            $model->setData($data);
            try {
                $this->_vehicleBrandRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the vehicle brand.'));
                $this->_dataPersistor->clear('vehicle_brand');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['vehicle_brand_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the vehicle brand.'));
            }
            $this->_dataPersistor->set('vehicle_brand', $data);
            return $resultRedirect->setPath('*/*/edit', ['vehicle_brand_id' => $this->getRequest()->getParam('vehicle_brand_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }


    
}
