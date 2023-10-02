<?php
namespace Curso\Vehicle\Api;

interface VehicleBrandRepositoryInterface
{
    public function save(\Curso\Vehicle\Api\Data\VehicleBrandInterface $brand);
    public function getById($id);
    public function delete(\Curso\Vehicle\Api\Data\VehicleBrandInterface $brand);
    public function deleteById($id);
}
