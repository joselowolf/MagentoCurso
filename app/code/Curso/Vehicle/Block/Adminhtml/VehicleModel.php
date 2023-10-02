<?php
namespace Curso\Vehicle\Block\Adminhtml;

class VehicleModel extends \Magento\Backend\Block\Widget\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_vehiclemodel';
        $this->_blockGroup = 'Curso_Vehicle';
        $this->_headerText = __('Vehicle Model');
        parent::_construct();
    }
}
