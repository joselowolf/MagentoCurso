<?php
namespace Curso\Vehicle\Api\Data;

interface VehicleBrandInterface
{
    const VEHICLE_BRAND_ID = 'vehicle_brand_id';
    const BRAND = 'brand';

    public function getId();
    public function setId($id);
    public function getBrand();
    public function setBrand($brand);
}
