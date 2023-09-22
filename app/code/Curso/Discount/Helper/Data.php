<?php
namespace Curso\Discount\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_CUSTOM_SECTION = 'curso_discount';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CUSTOM_SECTION . $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getValueType($storeId = null)
    {
        return $this->getConfigValue('/general/value_type', $storeId);
    }

    public function getCustomValue($storeId = null)
    {
        return $this->getConfigValue('/general/custom_value', $storeId);
    }

    public function getCategories($storeId = null)
    {
        return $this->getConfigValue('/rules/categories', $storeId);
    }

    public function getRangeFrom($storeId = null)
    {
        return $this->getConfigValue('/rules/price_range_from', $storeId);
    }

    public function getRangeTo($storeId = null)
    {
        return $this->getConfigValue('/rules/price_range_to', $storeId);
    }
}
