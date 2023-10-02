<?php
namespace Curso\Vehicle\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        //Brands
        $table_brand = $installer->getConnection()
            ->newTable($installer->getTable('vehicle_brand'))
                ->addColumn(
                    'vehicle_brand_id', 
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 
                    null, 
                    [
                        'identity' => true, 
                        'unsigned' => true, 
                        'nullable' => false, 
                        'primary' => true
                    ], 
                    'Vehicle brand ID'
                )
                ->addColumn(
                    'brand', 
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 
                    null, 
                    [], 
                    'Brand'
                )
            ->setComment('Brand');
        $installer->getConnection()->createTable($table_brand);
        //Models
        $table_model = $installer->getConnection()
            ->newTable($installer->getTable('vehicle_model'))
                ->addColumn(
                    'vehicle_model_id', 
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 
                    null, 
                    [
                        'identity' => true, 
                        'unsigned' => true, 
                        'nullable' => false, 
                        'primary' => true
                    ], 
                    'Vehicle model ID'
                )->addColumn(
                    'model', 
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 
                    null, 
                    [], 
                    'Model'
                )->addColumn(
                    'vehicle_brand_id', 
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 
                    null, 
                    [
                        'unsigned' => true, 
                        'nullable' => false, 
                    ], 
                    'Vehicle brand ID'
                )->setComment('Model');
        $installer->getConnection()->createTable($table_model);
        //Vehicles
        $table_vehicle = $installer->getConnection()
            ->newTable($installer->getTable('vehicle_vehicle'))
                ->addColumn(
                    'vehicle_vehicle_id', 
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 
                    null, 
                    [
                        'identity' => true, 
                        'unsigned' => true, 
                        'nullable' => false, 
                        'primary' => true
                    ], 
                    'Vehicle vehicle ID'
                )
                ->addColumn(
                    'plate', 
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 
                    null, 
                    [], 
                    'Plate'
                )
                ->addColumn(
                    'vehicle_model_id', 
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 
                    null, 
                    [
                        'unsigned' => true, 
                        'nullable' => false, 
                    ], 
                    'Vehicle model ID'
                )
                ->setComment('Vehicle');
        $installer->getConnection()->createTable($table_vehicle);
        
        // crea la relación entre la tabla model y brand
        $installer->getConnection()->addForeignKey(
            $installer->getFkName(
                'vehicle_model', // nombre de la tabla origen
                'vehicle_brand_id', // nombre de la columna en la tabla origen
                'vehicle_brand', // nombre de la tabla destino
                'vehicle_brand_id' // nombre de la columna en la tabla destino
            ),
            'vehicle_model', // nombre de la tabla origen
            'vehicle_brand_id', // nombre de la columna en la tabla origen
            'vehicle_brand', // nombre de la tabla destino
            'vehicle_brand_id', // nombre de la columna en la tabla destino
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE // cuando se elimine o actualice la tabla origen, se elimina o actualiza la tabla destino
        );
        
        // crea la relación entre la tabla vehicle y model
        $installer->getConnection()->addForeignKey(
            $installer->getFkName(
                'vehicle_vehicle', // nombre de la tabla origen
                'vehicle_model_id', // nombre de la columna en la tabla origen
                'vehicle_model', // nombre de la tabla destino
                'vehicle_model_id' // nombre de la columna en la tabla destino
            ),
            'vehicle_vehicle', // nombre de la tabla origen
            'vehicle_model_id', // nombre de la columna en la tabla origen
            'vehicle_model', // nombre de la tabla destino
            'vehicle_model_id', // nombre de la columna en la tabla destino
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE // cuando se elimine o actualice la tabla origen, se elimina o actualiza la tabla destino
        );
        
        $installer->endSetup();

    }
}
