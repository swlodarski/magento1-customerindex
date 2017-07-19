<?php

$installer = $this;
$installer->startSetup();

/**
 * Create table 'sumoheavy_customergrid/customer_entity_grid'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('sumoheavy_customergrid/customer_entity_grid'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Entity Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Name')
    ->addColumn('prefix', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Prefix')
    ->addColumn('firstname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Firstname')
    ->addColumn('middlename', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Middlename')
    ->addColumn('lastname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Lastname')
    ->addColumn('suffix', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Suffix')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Email')
    ->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        ), 'Group Id')
    ->addColumn('default_billing', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        ), 'Default Billing')
    ->addColumn('billing_telephone', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Telephone')
    ->addColumn('billing_postcode', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Postcode')
    ->addColumn('billing_country_id', Varien_Db_Ddl_Table::TYPE_TEXT, 2, array(
        ), 'Country ID')
    ->addColumn('billing_region', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Region')
    ->addColumn('billing_city', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'City')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Created At')
    ->addColumn('website_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        ), 'Website Id')
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('website_id')),
        array('website_id'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('email')),
        array('email'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('group_id')),
        array('group_id'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('created_at')),
        array('created_at'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('name')),
        array('name'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('prefix')),
        array('prefix'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('firstname')),
        array('firstname'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('middlename')),
        array('middlename'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('lastname')),
        array('lastname'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('suffix')),
        array('suffix'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('billing_postcode')),
        array('billing_postcode'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('billing_telephone')),
        array('billing_telephone'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('billing_region')),
        array('billing_region'))
    ->addIndex($installer->getIdxName('sumoheavy_customergrid/customer_entity_grid', array('billing_country_id')),
        array('billing_country_id'))
    ->addForeignKey($installer->getFkName('sumoheavy_customergrid/customer_entity_grid', 'entity_id', 'customer/entity', 'entity_id'),
        'entity_id', $installer->getTable('customer/entity'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($installer->getFkName('sumoheavy_customergrid/customer_entity_grid', 'website_id', 'core/website', 'website_id'),
        'website_id', $installer->getTable('core/website'), 'website_id',
        Varien_Db_Ddl_Table::ACTION_SET_NULL, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('SUMOHeavy - Customer Entity Grid');
$installer->getConnection()->createTable($table);

$installer->endSetup();
