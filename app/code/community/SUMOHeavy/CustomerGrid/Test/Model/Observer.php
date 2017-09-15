<?php

class SUMOHeavy_CustomerGrid_Test_Model_Observer extends EcomDev_PHPUnit_Test_Case
{
    public function testOnCustomerSaveCommitAfter()
    {
        $customerMock = $this->getModelMockBuilder('customer/customer')
           ->setMethods(array('hasDataChanges'))
           ->getMock();
        $customerMock->expects($this->once())
            ->method('hasDataChanges')
            ->willReturn(true);

        $observer = new Varien_Event_Observer();
        $observer->setEvent(new Varien_Event(array('customer' => $customerMock)));

        $indexIndexerMock = $this->getModelMockBuilder('index/indexer')
           ->setMethods(array('processEntityAction'))
           ->getMock();
        $indexIndexerMock->expects($this->once())
            ->method('processEntityAction')
            ->with(
                $customerMock,
                SUMOHeavy_CustomerGrid_Helper_Data::CUSTOMER_ENTITY,
                Mage_Index_Model_Event::TYPE_SAVE
            )
            ->willReturn(null);

        $this->replaceByMock('model', 'index/indexer', $indexIndexerMock);

        Mage::getModel('sumoheavy_customergrid/observer')->onCustomerSaveCommitAfter($observer);
    }

    public function testOnCustomerAddressSaveCommitAfter()
    {
        $customerMock = $this->getModelMockBuilder('customer/customer')
           ->getMock();

        $customerAddressMock = $this->getModelMockBuilder('customer/address')
           ->setMethods(array('getCustomer', 'hasDataChanges'))
           ->getMock();
        $customerAddressMock->expects($this->once())
            ->method('getCustomer')
            ->willReturn($customerMock);

        $customerAddressMock->expects($this->once())
            ->method('hasDataChanges')
            ->willReturn(true);

        $observer = new Varien_Event_Observer();
        $observer->setEvent(new Varien_Event(array('customer_address' => $customerAddressMock)));

        $indexIndexerMock = $this->getModelMockBuilder('index/indexer')
           ->setMethods(array('processEntityAction'))
           ->getMock();
        $indexIndexerMock->expects($this->once())
            ->method('processEntityAction')
            ->with(
                $customerMock,
                SUMOHeavy_CustomerGrid_Helper_Data::CUSTOMER_ADDRESS_ENTITY,
                Mage_Index_Model_Event::TYPE_SAVE
            )
            ->willReturn(null);

        $this->replaceByMock('model', 'index/indexer', $indexIndexerMock);

        Mage::getModel('sumoheavy_customergrid/observer')->onCustomerAddressSaveCommitAfter($observer);
    }

    public function testOnCustomerAddressDeleteCommitAfter()
    {
        $customerMock = $this->getModelMockBuilder('customer/customer')
           ->getMock();

        $customerAddressMock = $this->getModelMockBuilder('customer/address')
           ->setMethods(array('getCustomer'))
           ->getMock();
        $customerAddressMock->expects($this->once())
            ->method('getCustomer')
            ->willReturn($customerMock);

        $observer = new Varien_Event_Observer();
        $observer->setEvent(new Varien_Event(array('customer_address' => $customerAddressMock)));

        $indexIndexerMock = $this->getModelMockBuilder('index/indexer')
           ->setMethods(array('processEntityAction'))
           ->getMock();
        $indexIndexerMock->expects($this->once())
            ->method('processEntityAction')
            ->with(
                $customerMock,
                SUMOHeavy_CustomerGrid_Helper_Data::CUSTOMER_ADDRESS_ENTITY,
                Mage_Index_Model_Event::TYPE_DELETE
            )
            ->willReturn(null);

        $this->replaceByMock('model', 'index/indexer', $indexIndexerMock);

        Mage::getModel('sumoheavy_customergrid/observer')->onCustomerAddressDeleteCommitAfter($observer);
    }
}
