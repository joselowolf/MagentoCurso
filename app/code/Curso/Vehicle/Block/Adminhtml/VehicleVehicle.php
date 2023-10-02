<?php
namespace Curso\Vehicle\Block\Adminhtml;

class VehicleVehicle extends \Magento\Backend\Block\Widget\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_vehiclevehicle';
        $this->_blockGroup = 'Curso_Vehicle';
        $this->_headerText = __('Vehicle Vehicle');
        parent::_construct();
    }
}
