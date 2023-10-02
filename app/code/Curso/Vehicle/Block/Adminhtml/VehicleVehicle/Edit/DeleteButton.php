<?php
namespace Curso\Vehicle\Block\Adminhtml\VehicleVehicle\Edit;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        $data = [];
        if ($this->getVehicleId()) {
            $data = [
                'label' => __('Delete Vehicle'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this vehicle?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['vehicle_id' => $this->getVehicleId()]);
    }
}