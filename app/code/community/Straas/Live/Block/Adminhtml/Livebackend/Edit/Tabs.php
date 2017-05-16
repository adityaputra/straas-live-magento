<?php
/**
 *
 * Version			: 1.0.4
 * Edition 			: Community 
 * Compatible with 	: Magento 1.5.x to latest
 * Developed By 	: Magebassi
 * Email			: magebassi@gmail.com
 * Web URL 			: www.magebassi.com
 * Extension		: Magebassi Easy Banner slider
 * 
 */
?>
<?php

class Straas_Live_Block_Adminhtml_Livebackend_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('straaslive_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('live')->__('Live Video Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('live')->__('Live Video Information'),
          'title'     => Mage::helper('live')->__('Live Video Information'),
          'content'   => $this->getLayout()->createBlock('live/adminhtml_livebackend_edit_tab_form')->toHtml(),
      ));
      
	  $this->addTab('card_section', array(
          'label'     => Mage::helper('live')->__('Manage Cards'),
          'title'     => Mage::helper('live')->__('Manage Cards'),
          'content'   => $this->getLayout()->createBlock('live/adminhtml_livebackend_edit_tab_cards')->toHtml(),
      ));
	  
     
      return parent::_beforeToHtml();
  }
}
