<?php

namespace Curso\Vehicle\Block\Adminhtml\VehicleVehicle\Edit;

use Curso\Vehicle\Api\VehicleVehicleRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    protected $context;
    protected $vehicleVehicleRepository;

    public function __construct(
        Context $context,
        VehicleVehicleRepositoryInterface $vehicleVehicleRepository
    ) {
        $this->context = $context;
        $this->vehicleVehicleRepository = $vehicleVehicleRepository;
    }
    public function getVehicleVehicleId()
    {
        try {
            return $this->vehicleVehicleRepository->getById(
                $this->context->getRequest()->getParam('vehicle_vehicle_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }
}
