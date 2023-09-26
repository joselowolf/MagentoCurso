<?php
namespace Curso\Producto\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_CUSTOM_SECTION = 'curso_producto';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CUSTOM_SECTION . $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getVariantType($storeId = null)
    {
        return $this->getConfigValue('/general/variant_type', $storeId);
    }

    public function getVariant($storeId = null)
    {
        return $this->getConfigValue('/general/variant', $storeId);
    }

    public function getIncrement($storeId = null)
    {
        return $this->getConfigValue('/general/incremental', $storeId);
    }

    public function getGroups($storeId = null)
    {
        return $this->getConfigValue('/general/groups', $storeId);
    }

    

    
}
