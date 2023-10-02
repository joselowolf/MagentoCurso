<?php
namespace Curso\Vehicle\Model\ResourceModel\VehicleBrand;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'vehicle_brand_id';
	protected $_eventPrefix = 'vehiclebrand_vehiclebrand_collection';
    protected $_eventObject = 'vehiclebrand_collection';
	
	/**
     * Define model & resource model
     */
	protected function _construct()
	{
		$this->_init(
			'Curso\Vehicle\Model\VehicleBrand', 
			'Curso\Vehicle\Model\ResourceModel\VehicleBrand'
		);
	}
}