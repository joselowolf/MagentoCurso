<?php
namespace Curso\Vehicle\Api\Data;

interface VehicleVehicleInterface
{
    
    public const VEHICLE_VEHICLE_ID = 'vehicle_vehicle_id';
    public const PLATE = 'plate';
    public const VEHICLE_MODEL_ID = 'vehicle_model_id';
    // public const VEHICLE_COLO = 'color';

    public function getId();
    public function setId($id);

    public function getPlate();
    public function setPlate($plate);
    
    public function getVehicleModelId();
    public function setVehicleModelId($vehicleModelId);

    // public function getColor();
    // public function setColor($color);
    


}
