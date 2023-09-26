<?php

namespace Curso\Producto\Plugin\Model;

use curso\Producto\Helper\Data;
use Psr\Log\LoggerInterface;

use function PHPUnit\Framework\assertTrue;

class Product
{
    protected $_data;
    protected $_logger;
    protected $_type_variant;
    protected $_variant_diff;
    protected $_is_incremental;
    protected $_allow_groups;
    protected $_session;

    public function __construct(
        Data $helperData,
        LoggerInterface $logger,
        \Magento\Customer\Model\Session $session
    ) {
        $this->_data = $helperData;
        $this->_logger = $logger;
        $this->_session = $session;

        $this->_type_variant = $this->_data->getVariantType();
        $this->_variant_diff = $this->_data->getVariant();
        $this->_is_incremental = $this->_data->getIncrement()==1?true:false;



        $this->_logger->info("*** Producto Setting: [getVariantType] ".$this->_type_variant);
        $this->_logger->info("*** Producto Setting: [getVariant]".$this->_variant_diff);
        //$this->_logger->info("*** Producto Setting: [getIncrement]".strval($this->$this->_is_incremental));
        $this->_allow_groups=[];
        if($this->_data->getGroups()!=null){
            $this->_allow_groups = explode(",",$this->_data->getGroups());
        }
        
        $this->_logger->info("*** Producto Setting: [getGrups]". json_encode($this->_allow_groups,false));

    }
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $old_value = $result;
        $currentGroup = $this->getCustomerGroupId();
        
        $allow = $this->isAllowByGroup($currentGroup,$this->_allow_groups);
        $this->_logger->info("*** Producto afterGetPrice:[currentGroup]$currentGroup [allow]$allow");
        if($this->_type_variant==null || $this->_variant_diff==0 || $allow==false){
            $this->_logger->info("*** Producto afterGetPrice: no permite");
            return $result;
        }
        $diff = $this->_variant_diff;
        if($this->_type_variant=="percentage"){
            $diff = $result *($this->_variant_diff/100);
        }
        if(!$this->_is_incremental){
            $diff = $diff*-1;
        }

        $result += $diff;
        if($result<0){
            $result=0;
        }
        
        
        $this->_logger->info("*** Producto afterGetPrice: [oldValue] $old_value [result]$result [diff]$diff");

        return $result;
    }

    public function getCustomerGroupId()
    {
        return $this->_session->getCustomerGroupId();
    }
   
    private function isAllowByGroup($currentUserGroup,$gropsAllow){
        if($currentUserGroup===null){
            return false;
        }
        foreach($gropsAllow as $g){
            if($g==$currentUserGroup){
                return true;
            }
        }
        return false;
    }
}
