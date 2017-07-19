<?php

class SUMOHeavy_CustomerGrid_Block_Adminhtml_Customer_Grid
    extends Mage_Adminhtml_Block_Customer_Grid
{
    protected function _prepareCollection()
    {
        if(!Mage::helper('sumoheavy_customergrid')->isIndexerEnabled()) {
            return parent::_prepareCollection();
        }

        $collection = Mage::getResourceModel('sumoheavy_customergrid/customer_entity_grid_collection');
        $this->setCollection($collection);

        return Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
    }
}
