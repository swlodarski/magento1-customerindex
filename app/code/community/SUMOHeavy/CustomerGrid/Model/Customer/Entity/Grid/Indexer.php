<?php

class SUMOHeavy_CustomerGrid_Model_Customer_Entity_Grid_Indexer extends Mage_Index_Model_Indexer_Abstract
{
    /**
     * Index math Entities array
     *
     * @var array
     */
    protected $_matchedEntities = array(
        SUMOHeavy_CustomerGrid_Helper_Data::CUSTOMER_ENTITY => array(
            Mage_Index_Model_Event::TYPE_SAVE,
        ),
        SUMOHeavy_CustomerGrid_Helper_Data::CUSTOMER_ADDRESS_ENTITY => array(
            Mage_Index_Model_Event::TYPE_SAVE,
            Mage_Index_Model_Event::TYPE_DELETE,
        ),
    );

    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('sumoheavy_customergrid/customer_entity_grid_indexer');
    }

    /**
     * Whether the indexer should be displayed on process/list page
     *
     * @return bool
     */
    public function isVisible()
    {
        /** @var $sumoheavy_customergrid SUMOHeavy_CustomerGrid_Helper_Data */
        $helper = Mage::helper('sumoheavy_customergrid');
        return $helper->isIndexerEnabled();
    }

    /**
     * Retrieve Indexer name
     *
     * @return string
     */
    public function getName()
    {
        return Mage::helper('sumoheavy_customergrid')->__('Customer Grid Data');
    }

    /**
     * Retrieve Indexer description
     *
     * @return string
     */
    public function getDescription()
    {
        return Mage::helper('sumoheavy_customergrid')->__('Rebuild Customer Grid Data');
    }

    /**
     * Check if event can be matched by process
     * Overwrote for check if index is enabled
     *
     * @param Mage_Index_Model_Event $event
     * @return bool
     */
    public function matchEvent(Mage_Index_Model_Event $event)
    {
        $helper = Mage::helper('sumoheavy_customergrid');
        if(!$helper->isIndexerEnabled()) {
            return false;
        }
        return parent::matchEvent($event);
    }

    /**
     * Register data required by process in event object
     *
     * @param Mage_Index_Model_Event $event
     */
    protected function _registerEvent(Mage_Index_Model_Event $event)
    {
        $dataObj = $event->getDataObject();
        if($event->getType() == Mage_Index_Model_Event::TYPE_SAVE) {
            $event->addNewData('id', $dataObj->getId());
        } elseif($event->getType() == Mage_Index_Model_Event::TYPE_DELETE) {
            $event->addNewData('id', $dataObj->getId());
        }
    }

    /**
     * Process event
     *
     * @param Mage_Index_Model_Event $event
     */
    protected function _processEvent(Mage_Index_Model_Event $event)
    {
        $data = $event->getNewData();
        if(!empty($data['id'])) {
            $this->_getResource()->reindexById((int)$data['id']);
        }
    }
}
