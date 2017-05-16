<?php  
class Straas_Live_Block_Adminhtml_Livebackend extends Mage_Adminhtml_Block_Widget_Grid_Container {
public function __construct()
  {
    $this->_controller = 'adminhtml_livebackend';
    $this->_blockGroup = 'live';
    //$this->_headerText = Mage::helper('livebackend')->__('Banner Manager');
    //$this->_addButtonLabel = Mage::helper('livebackend')->__('Add banner image');
    $this->_headerText = 'Live Video Manager';
    $this->_addButtonLabel = 'Add live video';
    parent::__construct();
  }
}
