<?php

class SUMOHeavy_CustomerGrid_Model_Resource_Customer_Entity_Grid_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('sumoheavy_customergrid/customer_entity_grid');
    }
}
