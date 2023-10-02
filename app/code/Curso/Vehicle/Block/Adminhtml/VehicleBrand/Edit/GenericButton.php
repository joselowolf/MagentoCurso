<?php
namespace Curso\Vehicle\Block\Adminhtml\VehicleBrand\Edit;
use Curso\Vehicle\Api\VehicleBrandRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    protected $context;
    protected $vehicleBrandRepository;
    
    public function __construct(
        Context $context,
        VehicleBrandRepositoryInterface $vehicleBrandRepository
    ) {
        $this->context = $context;
        $this->vehicleBrandRepository = $vehicleBrandRepository;
    }

    public function getVehicleBrandId()
    {
        try {
            return $this->vehicleBrandRepository->getById(
                $this->context->getRequest()->getParam('vehicle_brand_id')
            )->getId();
        }
		catch (NoSuchEntityException $e) {
        
		}
        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}