<?php

class SUMOHeavy_CustomerGrid_Model_Resource_Customer_Entity_Grid_Indexer
    extends Mage_Index_Model_Resource_Abstract
{
    /**
     * Grid columns
     *
     * @var array|null
     */
    protected $_gridColumns           = null;

    /**
     * Customer entity columns
     *
     * @var array|null
     */
    protected $_customerEntityColumns = null;

    /**
     * Define main table
     *
     */
    protected function _construct()
    {
        $this->_init('sumoheavy_customergrid/customer_entity_grid', 'entity_id');
    }

    /**
     * Update records in grid table
     *
     * @param array|int $ids
     * @return SUMOHeavy_CustomerGrid_Model_Resource_Customer_Entity_Grid_Indexer
     */
    public function updateGridRecords($ids = null)
    {
        $writeAdapter = $this->_getWriteAdapter();
        $this->beginTransaction();

        try {
            $customerColumns = $this->getCustomerEntityColumns();
            $gridColumns = $this->getGridColumns();
            $flatColumnsToSelect = array_intersect($customerColumns, $gridColumns);

            $collection = Mage::getModel('customer/customer')->getCollection();

            if(!empty($ids)) {
                if(!is_array($ids)) {
                    $ids = array($ids);
                }
                $collection
                    ->addFieldToFilter($this->getIdFieldName(), array('in' => $ids));
            }
            $collection->getSelect()->reset(Zend_Db_Select::COLUMNS);
            $collection->getSelect()->columns($flatColumnsToSelect);

            $collection->addNameToSelect();
            $collection
                ->joinAttribute('billing_postcode', 'customer_address/postcode', 'default_billing', null, 'left')
                ->joinAttribute('billing_city', 'customer_address/city', 'default_billing', null, 'left')
                ->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left')
                ->joinAttribute('billing_region', 'customer_address/region', 'default_billing', null, 'left')
                ->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left');

            $columnsToSelect = array();
            $selectColumns = $collection->getSelect()->getPart(Zend_Db_Select::COLUMNS);
            foreach($selectColumns as $col) {
                if(!empty($col[2])) {
                    $columnsToSelect[] = $col[2];
                } elseif(!empty($col[1])) {
                    $columnsToSelect[] = $col[1];
                }
            }

            $select = $collection->getSelect();
            $table = $this->getGridTable();
            $this->_getWriteAdapter()->query($select->insertFromSelect($table, $columnsToSelect, true));

            $this->commit();
        } catch (Exception $e) {
            $this->rollBack();
            throw $e;
        }

        return $this;
    }

    /**
     * Reindex all
     *
     * @return SUMOHeavy_CustomerGrid_Model_Resource_Customer_Entity_Grid_Indexer
     */
    public function reindexAll()
    {
        $this->updateGridRecords();

        return $this;
    }

    /**
     * Reindex by ID
     *
     * @return SUMOHeavy_CustomerGrid_Model_Resource_Customer_Entity_Grid_Indexer
     */
    public function reindexById($id)
    {
        $this->updateGridRecords($id);

        return $this;
    }

    public function getCustomerEntityTable()
    {
        return $this->getTable('customer/entity');
    }

    /**
     * Retrieve grid table
     *
     * @return string
     */
    public function getGridTable()
    {
        return $this->getTable('sumoheavy_customergrid/customer_entity_grid');
    }

    /**
     * Retrieve list of grid columns
     *
     * @return array
     */
    public function getGridColumns()
    {
        if ($this->_gridColumns === null) {
            $this->_gridColumns = array_keys(
                $this->_getReadAdapter()
                    ->describeTable($this->getTable('sumoheavy_customergrid/customer_entity_grid'))
            );
        }

        return $this->_gridColumns;
    }

    /**
     * Retrieve list of customer_entity columns
     *
     * @return array
     */
    public function getCustomerEntityColumns()
    {
        if ($this->_customerEntityColumns === null) {
            $this->_customerEntityColumns = array_keys($this->_getReadAdapter()
                ->describeTable(
                    $this->getCustomerEntityTable()
                )
            );
        }

        return $this->_customerEntityColumns;
    }
}
