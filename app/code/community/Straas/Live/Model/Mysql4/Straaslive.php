<?php

class Straas_Live_Model_Mysql4_Straaslive extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {            
        $this->_init('live/straaslive', 'live_id');
    }
}
