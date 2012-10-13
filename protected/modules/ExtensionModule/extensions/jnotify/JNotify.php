<?php

/**
 * JNotify class file.
 */

class JNotify extends CWidget {

	private $baseUrl;
	private $clientScript;
	
	public $statusBarOneAtTime =true;
	public $notificationOneAtTime =false;
	public $notificationAppendType ='append';

	public $statusBarId ='StatusBar';
	public $notificationId ='Notification';

	public $notificationWidth =false;
	public $notificationShowAt =false; // topRight, bottomRight, bottomLeft, topLeft
	public $notificationVSpace ='20px';
	public $notificationHSpace ='20px';
	public $notificationCss =array(
		'position'=>'absolute',
		'margin-top'=>false, // will be set by init()
		'right'=>false, // will be set by init()
		'width'=>'250px',
		'z-index'=>'9999',
	);


	/**
	 * Publishes the assets
	 */
	public function publishAssets() {
		$dir =dirname(__FILE__).DIRECTORY_SEPARATOR.'jnotify';
		$this->baseUrl =Yii::app()->getAssetManager()->publish($dir);
	}


	public function registerClientScripts() {

		if ($this->baseUrl === '')
			throw new CException(Yii::t('JNotify', 'baseUrl must be set.'));

		$this->clientScript = Yii::app()->getClientScript();

		// JS
		$this->clientScript->registerScriptFile($this->baseUrl.'/jquery.jnotify.js');

		// CSS
		$this->clientScript->registerCssFile($this->baseUrl.'/jquery.jnotify.css');
	}


	public function createJsCode() {
		$res="
$(document).ready(function() {
".
	// For jNotify Inizialization
	// Parameter:
	// oneAtTime : true if you want show only one message for time
	// appendType: 'prepend' if you want to add message on the top of stack, 'append' otherwise
"
	$('#".$this->statusBarId."').jnotifyInizialize({
		oneAtTime: ".($this->statusBarOneAtTime ? 'true' : 'false')."
	});
	$('#".$this->notificationId."')
		.jnotifyInizialize({
			oneAtTime: ".($this->notificationOneAtTime ? 'true' : 'false').",
			appendType: '".$this->notificationAppendType."'
		})
		.css(".CJSON::encode($this->notificationCss).");	
// -----------------------------------------------------
});
";

		return $res;
	}


	/**
	 * Run the widget
	 */
	public function run() {
		$this->publishAssets();
		$this->registerClientScripts();

		$js = $this->createJsCode();		
		$this->clientScript->registerScript('jnotify_init', $js, CClientScript::POS_HEAD);

		parent::run();
	}


	public function init() {

		if (!empty($this->notificationWidth)) {
			$this->notificationCss['width']=$this->notificationWidth;
		}

		$this->notificationCss['margin-top']=$this->notificationVSpace;
		$this->notificationCss['right']=$this->notificationHSpace;

		if (!empty($this->notificationShowAt)) {

			unset($this->notificationCss['margin-top']);
			unset($this->notificationCss['bottom']);
			unset($this->notificationCss['left']);
			unset($this->notificationCss['right']);

			switch ($this->notificationShowAt) {
				case "topRight": {
					$this->notificationCss['margin-top']=$this->notificationVSpace;
					$this->notificationCss['right']=$this->notificationHSpace;
				} break;
				case "bottomRight": {
					$this->notificationCss['margin-top']='auto';
					$this->notificationCss['bottom']=$this->notificationVSpace;
					$this->notificationCss['right']=$this->notificationHSpace;
				} break;
				case "bottomLeft": {
					$this->notificationCss['bottom']=$this->notificationVSpace;
					$this->notificationCss['left']=$this->notificationHSpace;
				} break;
				case "topLeft": {
					$this->notificationCss['margin-top']=$this->notificationVSpace;
					$this->notificationCss['left']=$this->notificationHSpace;
				} break;
			}
		}

		parent::init();
	}


}