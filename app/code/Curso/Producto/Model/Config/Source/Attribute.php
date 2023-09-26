<?php
namespace Curso\Producto\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Attribute implements OptionSourceInterface
{

    protected $collectionFactory;

    /**
     * @param EavConfig $eavConfig
     */
    public function __construct(
        \Magento\Customer\Model\ResourceModel\Group\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $optionArray = [];
        $optionArray = $this->collectionFactory->create()->toOptionArray();
        return $optionArray;
    }
}