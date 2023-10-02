<?php
namespace Curso\Vehicle\Api;

interface VehicleVehicleRepositoryInterface
{
    public function save(\Curso\Vehicle\Api\Data\VehicleVehicleInterface $vehicle);
    public function getById($id);
    public function delete(\Curso\Vehicle\Api\Data\VehicleVehicleInterface $vehicle);
    public function deleteById($id);
}
