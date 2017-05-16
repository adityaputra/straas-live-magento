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

class Straas_Live_Block_Adminhtml_Livebackend_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('imageslider_form', array('legend'=>Mage::helper('live')->__('Live Video Information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('live')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));	
	  
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('live')->__('Live Video Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('live')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('live')->__('Disabled'),
              ),
          ),
      ));
      
      $fieldset->addField('highest_resolution', 'select', array(
          'label'     => Mage::helper('live')->__('Highest Resolution'),
          'name'      => 'highest_resolution',
          'class'	  => 'required-entry',
          'values'    => array(
              array(
                  'value'     => '_720p',
                  'label'     => Mage::helper('live')->__('720p'),
              ),

              array(
                  'value'     => '_1080p',
                  'label'     => Mage::helper('live')->__('1080p'),
              ),
          ),
      ));
      /*
      $fieldset->addField('start_time', 'text', array(
          'label'     => Mage::helper('live')->__('Start Time'),
          'class'     => '',
          'required'  => false,
          'name'      => 'start_time',
      ));
      */
      $fieldset->addField('start_time', 'date',array(
          'name'      =>    'start_time', 
          'time'      =>    true,
          'class'     => '',
          'required'  => false,        
          'format'    =>    $this->escDates(),
          'label'     =>    Mage::helper('live')->__('Start Time'),
          'image'     =>    $this->getSkinUrl('images/grid-cal.gif')
      ));
      
      $fieldset->addField('product_sku', 'text', array(
          'label'     => Mage::helper('live')->__('Product SKU'),
          'class'     => '',
          'required'  => false,
          'name'      => 'product_sku',
      ));	
      
      $fieldset->addField('stream_server_url', 'text', array(
          'label'     => Mage::helper('live')->__('Stream Server URL'),
          'class'     => 'disabled',
          'disabled'  => 'disabled',
          'required'  => false,
          'name'      => 'stream_server_url',
      ));	
      $fieldset->addField('stream_key', 'text', array(
          'label'     => Mage::helper('live')->__('Stream Key'),
          'class'     => 'disabled',
          'disabled'  => 'disabled',
          'required'  => false,
          'name'      => 'stream_key',
      ));	
      
      
      
      
      
      /*
      
      
      $fieldset->addField('filename', 'image', array(
          'label'     => Mage::helper('live')->__('Image'),
          'required'  => false,
          'name'      => 'filename',
	  ));	
	  
      $fieldset->addField('content_type', 'select', array(
          'label'     => Mage::helper('live')->__('Content type'),
          'name'      => 'content_type',
          'values'    => array(
              array(
                  'value'     => 'img',
                  'label'     => Mage::helper('live')->__('Plain Image'),
              ),

              array(
                  'value'     => 'ig',
                  'label'     => Mage::helper('live')->__('Instagram'),
              ),
          ),
      ));
		
	  $fieldset->addField('linktarget', 'select', array(
				  'label'     => Mage::helper('live')->__('Link Target'),
				  'name'      => 'linktarget',
				  'after_element_html' => "<small>New Tab: To open in new tab, Same Tab: To open in same tab</small>",
				  'values'    => array(
					  array(
						  'value'     => '_self',
						  'label'     => Mage::helper('live')->__('Same Tab'),
					  ),
				  
					  array(
						  'value'     => '_blank',
						  'label'     => Mage::helper('live')->__('New Tab'),
					  )
				  ),
			));
			
		$fieldset->addField('linktarget', 'select', array(
				  'label'     => Mage::helper('live')->__('Content Type'),
				  'name'      => 'linktarget',
				  'after_element_html' => "",
				  'values'    => array(
					  array(
						  'value'     => 'image',
						  'label'     => Mage::helper('live')->__('Plain Image'),
					  ),
				  
					  array(
						  'value'     => 'instagram',
						  'label'     => Mage::helper('live')->__('Instagram'),
					  ),
					  array(
						  'value'     => 'gif',
						  'label'     => Mage::helper('live')->__('GIF'),
					  ),
					  array(
						  'value'     => 'quote',
						  'label'     => Mage::helper('live')->__('Quote'),
					  ),
					  array(
						  'value'     => 'youtube',
						  'label'     => Mage::helper('live')->__('Youtube'),
					  ),
				  ),
			));
			
		$fieldset->addField('weblink', 'text', array(
              'label'     => Mage::helper('live')->__('Source & Target Url'),
		      'class'     => 'validate-url',
              'required'  => false,
		      'after_element_html' => "<br/><small>For Instagram / Youtube, insert the source url (REQUIRED).</small>",
              'name'      => 'weblink',
          ));	
			
		$fieldset->addField('sort_order', 'text', array(
			'name'		=> 'sort_order',
			'label'		=> $this->__('Sort Order'),
			'title'		=> $this->__('Sort Order'),
			'class'		=> 'validate-digits'
		));
		
		$fieldset->addField('tags', 'text', array(
          'label'     => Mage::helper('live')->__('Tags (comma separated)'),
          'class'     => '',
          'required'  => false,
          'name'      => 'tags',
      ));	
			
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('live')->__('Content'),
          'title'     => Mage::helper('live')->__('Content'),
          'style'     => 'width:280px; height:100px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));
			*/
     
      if ( Mage::getSingleton('adminhtml/session')->getImageSliderData() )
      {
          $data = Mage::getSingleton('adminhtml/session')->getImageSliderData();
          Mage::getSingleton('adminhtml/session')->setImageSliderData(null);
      } elseif ( Mage::registry('straaslive_data') ) {
          $data = Mage::registry('straaslive_data')->getData();
      }
	  if (isset($data['stores'])) {
		$data['store_id'] = explode(',',$data['stores']);
	  }
	  $form->setValues($data);
	  
      return parent::_prepareForm();
  }
  
  private function escDates() {
        return 'yyyy-MM-dd HH:mm:ss';   
  }
}
