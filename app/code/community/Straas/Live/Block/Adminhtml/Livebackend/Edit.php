<?php
class Straas_Live_Block_Adminhtml_Livebackend_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'live';
        $this->_controller = 'adminhtml_livebackend';
        
        $this->_updateButton('save', 'label', Mage::helper('live')->__('Save Live Video'));
        $this->_updateButton('delete', 'label', Mage::helper('live')->__('Delete Live Video'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('imageslider_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'imageslider_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'imageslider_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('straaslive_data') && Mage::registry('straaslive_data')->getId() ) {
            return Mage::helper('live')->__("Edit live video '%s'", $this->htmlEscape(Mage::registry('straaslive_data')->getTitle()));
        } else {
            return Mage::helper('live')->__('Add live video');
        }
    }
}
