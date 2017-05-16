<?php
class Straas_Live_Adminhtml_LivebackendController extends Mage_Adminhtml_Controller_Action
{

	protected function _isAllowed()
	{
		//return Mage::getSingleton('admin/session')->isAllowed('live/livebackend');
		return true;
	}

	public function indexActionN()
    {
       $this->loadLayout();
	   $this->_title($this->__("Straas"));
	   $this->renderLayout();
    }
    protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('live/livebackend')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Live Video Manager'), Mage::helper('adminhtml')->__('Live Video Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
	
		$this->_title($this->__('Straas'))
			->_title($this->__('Manage live video'));
		$this->_initAction()
			->renderLayout();
	}
	
	private function requestLive($data, $straas_live_id = null, $token = null){
		$url =  Mage::getConfig()->getNode('default/straas/urls/base') . Mage::getConfig()->getNode('default/straas/urls/create_live');
		if($token == null) $token = Mage::getConfig()->getNode('default/straas/token/content');
		
		if(!$straas_live_id){
			//create live
			
		}
		else{
			//update live
			// $url .= . $straas_live_id;
		}
		
		$data_json = json_encode($data);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$token));
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		curl_close($ch);
        
        $result = json_decode($result);
		
		
		return $result;
	}
	
	private function createLive($data){
		$result = $this->requestLive($data);
		
		// check token, if token is expired, generate a new one, then redo the request
		if(isset($result->error)):
			if($result->error === 'JWT expired'):
				$api = new Straas_Live_Model_Observer();
			
				$token = $api->generateToken();
			
				$result = $this->requestLive($data, null, $token);
				//print_r($token);
			endif;
		endif;
		
		return $result;
	}
	
	private function updateLive($data, $straas_live_id){
	
	}
	
	private function getLives($token){
		$url =  Mage::getConfig()->getNode('default/straas/urls/base') . Mage::getConfig()->getNode('default/straas/urls/create_live');
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$token));
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
		//curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		curl_close($ch);
		
        $result = json_decode($result);
		
		
		return $result;
	}
	
	private function getToken(){
		$token = Mage::getConfig()->getNode('default/straas/token/content');
		
		// initiate a dummy request to check whether the token is valid
		$result = $this->getLives($token);
		//echo "<pre>"; print_r($result); echo "</pre>"; exit;
		
		// otherwise, generate a new token
		if(isset($result->error)):
			if($result->error === 'JWT expired'):
				$api = new Straas_Live_Model_Observer();
			
				$token = $api->generateToken();
			
				//print_r($token);
			endif;
		endif;
		// otherwise, generate a new token
		
		return $token;
	}
	
	private function deleteCards($video_id){
		$url =  Mage::getConfig()->getNode('default/straas/urls/cards_base') . Mage::getConfig()->getNode('default/straas/urls/video_cards') . 
				'/:' .$video_id;
		$token = $this->getToken();
		echo $token;
		
		//$data_json = json_encode($data);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$token));
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
		//curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		curl_close($ch);
        
        $result = json_decode($result);
		
		print_r($result); exit;
		return $result;
	}
	
	private function createCard($data, $account_id, $video_id){
		$url =  Mage::getConfig()->getNode('default/straas/urls/cards_base') . Mage::getConfig()->getNode('default/straas/urls/video_cards') . 
				'/' .$account_id . '/' .$video_id;
		$token = $this->getToken();
		//echo $url;
		//echo $token; exit;
		
		//print_r($data);
		
		$param = array();
		//echo $data['start_time'];
		$time = $data['start_time'];
		$dt = new DateTime("1970-01-01 $time", new DateTimeZone('UTC'));
		$seconds = (int)$dt->getTimestamp();
		$param['time'] = $seconds;
		$param['title'] = $data['sku'];
		
		//print_r($param);
		$data_json = json_encode($param);
		//exit;
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$token));
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		curl_close($ch);
        
        $result = json_decode($result);
		
		//print_r($result); exit;
		return $result;
	}
	
	public function saveAction() {

        if ($data = $this->getRequest()->getPost()) {
        	
        	
        	if(isset($data['cards'])):
		    	$collection = array();
				foreach($data['cards']['value'] as $val){
		    		$card = new stdClass();
					$card->id = $val['id'];
					$card->sku = $val['sku'];
					$card->start_time = $val['start_time'];
					//$card->end_time = $val['end_time'];
					array_push($collection, $card);
		    	}
		    	
		    	
		    	//echo "<pre>"; print_r($collection); echo "</pre>";
		    	
		    	//echo json_encode($collection);
		    	
		    	
		    	$data['cards'] = json_encode($collection);
        	endif;
        	
        	//echo "<pre>"; print_r($data); echo "</pre>"; exit;
			
			$model = Mage::getModel('live/straaslive');		
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			$straas_live_id = $this->getRequest()->getParam('id');
			$straas_account_id = null;
			
			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) { 
					// new live stream, request new stream_key and stream_server_url
					$result = $this->createLive($data);
					//print_r($result); exit;
					$model->setStreamServerUrl($result->stream_server_url)
						->setStreamKey($result->stream_key)
						->setResLiveId($result->id);
					
					$straas_live_id = $result->id;
					$straas_account_id = $result->account_id;
					//var_dump($model);
					//exit;
					$model->setCreatedTime(now())
						->setUpdateTime(now());
					
					
				} else {
					$result = $this->updateLive($data, $straas_live_id);
					print_r($result); exit;
					$model->setUpdateTime(now());
				}
				
				//$model->setStores(implode(',',$data['stores']));
				/*if (isset($data['category_ids'])){
					$model->setCategories(implode(',',array_unique(explode(',',$data['category_ids']))));
				}*/
				
				
				if(isset($data['cards'])):
				//print_r($data['cards']); exit;
				
					// delete all cards related to the live video
	//				$deletecards = $this->deleteCards($straas_live_id);
				
					// then create the cards the user just inserted / updated
					// $createcards = $this->createCards($data, $straas_live_id);
					foreach($this->getRequest()->getPost()['cards']['value'] as $val){
						$createCard = $this->createCard($val, $straas_account_id, $straas_live_id);
					}
				endif;
				
				$model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('live')->__('Banner Image was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('live')->__('Unable to save Banner Image'));
        $this->_redirect('*/*/');
	}
	
	public function newAction() {
		$this->_forward('edit');
	}	
	
	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('live/straaslive')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('straaslive_data', $model);
			
			$this->_title($this->__('Straas'))
				->_title($this->__('Manage Live Video'));
			if ($model->getId()){
				$this->_title($model->getTitle());
			}else{
				$this->_title($this->__('New Live Video'));
			}

			$this->loadLayout();
			$this->_setActiveMenu('live/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
//print_r($this->getLayout()->createBlock('live/adminhtml_livebackend_edit'));
			$this->_addContent($this->getLayout()->createBlock('live/adminhtml_livebackend_edit'))
				->_addLeft($this->getLayout()->createBlock('live/adminhtml_livebackend_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('live')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('live/straaslive');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}
	
}
