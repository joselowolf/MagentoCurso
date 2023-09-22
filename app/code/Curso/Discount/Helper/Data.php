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
            self::XML_PATH_CUSTOM_SECTION . '/general/' . $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getValueType($storeId = null)
    {
        return $this->getConfigValue('value_type', $storeId);
    }

    public function getCustomValue($storeId = null)
    {
        return $this->getConfigValue('custom_value', $storeId);
    }
}
