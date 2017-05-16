<?php
class Straas_Live_Block_Adminhtml_Livebackend_Edit_Tab_Cards extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('live_cards_form', array('legend'=>Mage::helper('live')->__('Cards')));

        //[...]

        $cards_field = $fieldset->addField('cards', 'text', array(
            'name'      => 'cards',
            'label'     => Mage::helper('live')->__('Cards'),
            'required'  => false,
        ));

        $cards_form = $form->getElement('cards');

        $cards_form->setRenderer(
            $this->getLayout()->createBlock('live/adminhtml_livebackend_edit_renderer_cards')
        );


        //[...]
    }
}
?>
