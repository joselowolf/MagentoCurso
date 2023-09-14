<?php
namespace Curso\News\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper 
{
	const XML_PATH_CURSO_NEWS = 'curso_news/';
    /**
     * @param [type] $field
     * @param [type] $storeCode
     * @return void
     */
	public function getConfigValue($field, $storeCode = null)
	{
		return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeCode);
	}
    /**
     * @param [type] $fieldid
     * @param [type] $storeCode
     * @return void
     */
	public function getGeneralConfig($fieldid, $storeCode = null)
	{
		return $this->getConfigValue(self::XML_PATH_CURSO_NEWS.'general/'.$fieldid, $storeCode);
	}
    /**
     
     * @param [type] $fieldid
     * @param [type] $storeCode
     * @return void
     */
	public function getStorefrontConfig($fieldid, $storeCode = null)
	{
		return $this->getConfigValue(self::XML_PATH_CURSO_NEWS.'storefront/'.$fieldid, $storeCode);
	}
}
?>
