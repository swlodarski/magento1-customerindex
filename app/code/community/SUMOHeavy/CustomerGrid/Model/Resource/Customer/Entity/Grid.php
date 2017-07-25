<?php

class SUMOHeavy_CustomerGrid_Model_Resource_Customer_Entity_Grid
    extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('sumoheavy_customergrid/customer_entity_grid', 'entity_id');
    }
}
