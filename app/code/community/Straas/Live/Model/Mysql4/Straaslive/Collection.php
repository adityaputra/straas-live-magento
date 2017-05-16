<?php

class Straas_Live_Model_Mysql4_Straaslive_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('live/straaslive');
    }	
}
