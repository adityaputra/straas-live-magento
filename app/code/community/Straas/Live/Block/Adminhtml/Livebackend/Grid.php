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

class Straas_Live_Block_Adminhtml_Livebackend_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('livebackendGrid');
      $this->setDefaultSort('livevideo_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
      $mod = Mage::getModel('live/straaslive')->getData();
		//var_dump($mod);
		
  }

  protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'live/straaslive';
    }
     
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('live/straaslive')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }
    
    protected function _prepareColumns()
    {
        // Add the columns that should appear in the grid
        $this->addColumn('live_id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'live_id'
            )
        );
        $this->addColumn('title', array(
          'header'    => 'Live Title',
          'align'     => 'left',
          'index'     => 'title',
	    ));
        $this->addColumn('product_sku', array(
          'header'    => 'Product SKU',
          'align'     => 'center',
          'index'     => 'product_sku',
	    ));
        $this->addColumn('start_time', array(
          'header'    => 'Start Time',
          'align'     => 'center',
          'index'     => 'start_time',
	    ));
         
        $this->addColumn('edit',
            array(
                'header'    =>  Mage::helper('live')->__('Edit'),
                'width'     => '50',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('live')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    ),
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
        
        $this->addColumn('delete',
            array(
                'header'    =>  Mage::helper('live')->__('Delete'),
                'width'     => '50',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('live')->__('Delete'),
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'id'
                    ),
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
        
        
		
		$this->addExportType('*/*/exportCsv', Mage::helper('live')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('live')->__('XML'));
		
        return parent::_prepareColumns();
    }
     
    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

  

}
