<?php
namespace Curso\Vehicle\Block\Adminhtml;

class VehicleBrand extends \Magento\Backend\Block\Widget\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_vehiclebrand';
        $this->_blockGroup = 'Curso_Vehicle';
        $this->_headerText = __('Vehicle Brand');
        parent::_construct();
    }
}
