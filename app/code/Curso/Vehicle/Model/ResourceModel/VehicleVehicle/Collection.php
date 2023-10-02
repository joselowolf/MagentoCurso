<?php
namespace Curso\Vehicle\Model\ResourceModel\VehicleVehicle;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'vehicle_model_id';
	protected $_eventPrefix = 'vehiclevehicle_vehiclevehicle_collection';
    protected $_eventObject = 'vehiclevehicle_collection';
	
	/**
     * Define model & resource model
     */
	protected function _construct()
	{
		$this->_init(
			'Curso\Vehicle\Model\VehicleVehicle', 
			'Curso\Vehicle\Model\ResourceModel\VehicleVehicle'
		);
	}
}