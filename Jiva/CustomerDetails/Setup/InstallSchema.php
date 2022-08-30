<?php
namespace Jiva\CustomerDetails\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_jiva_customerdetails_customerinfo = $setup->getConnection()->newTable($setup->getTable('jiva_customerdetails_customerinfo'));

        $table_jiva_customerdetails_customerinfo->addColumn(
            'customerinfo_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_jiva_customerdetails_customerinfo->addColumn(
            'FirstName',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'FirstName'
        );

        $table_jiva_customerdetails_customerinfo->addColumn(
            'LastName',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'LastName'
        );

        $table_jiva_customerdetails_customerinfo->addColumn(
            'Email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Email'
        );

        $table_jiva_customerdetails_customerinfo->addColumn(
            'DateOfBirth',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
            null,
            [],
            'DateOfBirth'
        );

        $table_jiva_customerdetails_customerinfo->addColumn(
            'Photo',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Photo'
        );

        $table_jiva_customerdetails_customerinfo->addColumn(
            'Gender',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Gender'
        );
        $setup->getConnection()->createTable($table_jiva_customerdetails_customerinfo);
        $setup->endSetup();
		
	    $installer = $setup;
        $installer->startSetup();

       /* While module install, creates columns in quote_address and sales_order_address table */

       $eavTable1 = $installer->getTable('quote');
       $eavTable2 = $installer->getTable('sales_order');

       $columns = [
           'input_custom_shipping_field' => [
               'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
               'nullable' => true,
               'comment' => 'Input option',
           ],

           'date_custom_shipping_field' => [
               'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
               'nullable' => true,
               'comment' => 'Date Ui component',
           ],

           'select_custom_shipping_field' => [
               'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
               'nullable' => true,
               'comment' => 'Select option',
           ],
       ];

       $connection = $installer->getConnection();
       foreach ($columns as $name => $definition) {
          $connection->addColumn($eavTable1, $name, $definition);
          $connection->addColumn($eavTable2, $name, $definition);
       }
       $installer->endSetup();
    }
}
