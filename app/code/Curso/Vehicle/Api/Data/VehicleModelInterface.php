<?php
namespace Curso\Vehicle\Api\Data;

interface VehicleModelInterface
{
    const VEHICLE_MODEL_ID = 'vehicle_model_id';
    const BRAND_ID = 'vehicle_brand_id';
    const MODEL = 'model';

    public function getId();
    public function setId($id);

    public function getBrandId();
    public function setBrandId($brandId);

    public function getModel();
    public function setModel($model);

}
