<?php

class SUMOHeavy_CustomerGrid_Test_Helper_Data extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @loadFixture testIsIndexerEnabled
     */
    public function testIsIndexerEnabled()
    {
        $tIsEnabled = Mage::helper('sumoheavy_customergrid')->isIndexerEnabled();
        $this->assertEquals($this->expected('is-indexer-enabled')->getData('value'), $tIsEnabled);
    }
}
