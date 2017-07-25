<?php

class SUMOHeavy_CustomerGrid_Model_Customer_Entity_Grid
    extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sumoheavy_customergrid/customer_entity_grid');
    }
}
