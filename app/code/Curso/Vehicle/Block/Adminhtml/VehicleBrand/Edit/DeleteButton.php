<?php
namespace Curso\Vehicle\Block\Adminhtml\VehicleBrand\Edit;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        $data = [];
        if ($this->getBrandId()) {
            $data = [
                'label' => __('Delete Brand'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this brand?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['brand_id' => $this->getBrandId()]);
    }
}