<?php
namespace Curso\Producto\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class ValueType implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'fixed', 'label' => __('Fixed Value')],
            ['value' => 'percentage', 'label' => __('Percentage')],
        ];
    }
}
