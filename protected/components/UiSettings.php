<?php
class UiSettings extends CApplicationComponent{

	private $_setting;
	
	public function init(){
		parent::init();	

		$this->_setting =Yii::app()->session->get('uiSettings');

		$js =$this->getIsOn('viewSource') ? 'source.show(false);' : 'source.hide(false);';		
		Yii::app()->clientScript->registerScript('uiSettings', $js, CClientScript::POS_LOAD);
		
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/base.js');
	}


	/**
	 * @param <type> $what
	 * @return <bool> returns true by default
	 */
	public function getIsOn($what) {
		return (
			isset($this->_setting[$what]) ?
			$this->_setting[$what] :
			true
		);	
	}


	public function setIsOn($what, $val) { echo $what; var_dump($val);		
		$this->_setting[$what]=(bool)$val;
		Yii::app()->session['uiSettings']=$this->_setting;
	}


	public function toggleIsOn($what) {
		$this->setIsOn($what, !$this->getIsOn($what));
	}
}