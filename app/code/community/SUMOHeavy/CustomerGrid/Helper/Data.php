<?php

class SUMOHeavy_CustomerGrid_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Customer Grid Config
     */
    const XML_PATH_INDEXER_ENABLED = 'sumoheavy_customergrid/indexer/enabled';

    const CUSTOMER_ENTITY = 'customer';
    const CUSTOMER_ADDRESS_ENTITY = 'customer';

    /**
     * Check Customer Grid functionality is enabled
     *
     * @param int|string|null|Mage_Core_Model_Store $store
     *
     * @return bool
     */
    public function isIndexerEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_INDEXER_ENABLED);
    }
}
