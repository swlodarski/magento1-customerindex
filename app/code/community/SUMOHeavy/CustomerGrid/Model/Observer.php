<?php

class SUMOHeavy_CustomerGrid_Model_Observer
{
    public function onCustomerSaveCommitAfter(Varien_Event_Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();

        if($customer->hasDataChanges()) {
            $indexer = Mage::getSingleton('index/indexer');
            $indexer->processEntityAction(
                $customer,
                SUMOHeavy_CustomerGrid_Helper_Data::CUSTOMER_ENTITY,
                Mage_Index_Model_Event::TYPE_SAVE
            );
        }

        return $this;
    }

    public function onCustomerAddressSaveCommitAfter(Varien_Event_Observer $observer)
    {
        $address = $observer->getEvent()->getCustomerAddress();
        $customer = $address->getCustomer();

        if($address->hasDataChanges()) {
            $indexer = Mage::getSingleton('index/indexer');
            $indexer->processEntityAction(
                $customer,
                SUMOHeavy_CustomerGrid_Helper_Data::CUSTOMER_ADDRESS_ENTITY,
                Mage_Index_Model_Event::TYPE_SAVE
            );
        }

        return $this;
    }

    public function onCustomerAddressDeleteCommitAfter(Varien_Event_Observer $observer)
    {
        $address = $observer->getEvent()->getCustomerAddress();
        $customer = $address->getCustomer();

        $indexer = Mage::getSingleton('index/indexer');
        $indexer->processEntityAction(
            $customer,
            SUMOHeavy_CustomerGrid_Helper_Data::CUSTOMER_ADDRESS_ENTITY,
            Mage_Index_Model_Event::TYPE_DELETE
        );

        return $this;
    }
}
