<?php 
namespace Curso\Discount\Setup; 
use Magento\Framework\Setup\UpgradeSchemaInterface; 
use Magento\Framework\Setup\ModuleContextInterface; 
use Magento\Framework\Setup\SchemaSetupInterface; 
use Magento\Framework\DB\Ddl\Table; 

class UpgradeSchema implements UpgradeSchemaInterface { 
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;
		$installer->startSetup();
		if(version_compare($context->getVersion(), '1.4.0', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('quote'),
                'custom_discount_amount',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'length' => '12,4',
                    'nullable' => true,
                    'comment' => 'Discount Amount'
                ]
            );
    
            $installer->getConnection()->addColumn(
                $installer->getTable('sales_order'),
                'custom_discount_amount',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'length' => '12,4',
                    'nullable' => true,
                    'comment' => 'Discount Amount'
                ]
            );
    
            $installer->getConnection()->addColumn(
                $installer->getTable('sales_order_grid'),
                'custom_discount_amount',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'length' => '12,4',
                    'nullable' => true,
                    'comment' => 'Discount Amount'
                ]
            );
    
            $setup->endSetup();
        }
    }
}