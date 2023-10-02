<?php
namespace Curso\Vehicle\Api;

interface VehicleModelRepositoryInterface
{
    public function save(\Curso\Vehicle\Api\Data\VehicleModelInterface $model);
    public function getById($id);
    public function delete(\Curso\Vehicle\Api\Data\VehicleModelInterface $model);
    public function deleteById($id);
}
