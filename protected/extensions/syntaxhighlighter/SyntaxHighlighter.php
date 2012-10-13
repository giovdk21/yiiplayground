<?php

/**
 * SyntaxhigHlighter class file.
 */

class SyntaxHighlighter extends CWidget {

	private $baseUrl;
	private $clientScript;


	/**
	 * Publishes the assets
	 */
	public function publishAssets() {
		$dir =dirname(__FILE__).DIRECTORY_SEPARATOR.'source';
		$this->baseUrl =Yii::app()->getAssetManager()->publish($dir);
	}


	public function registerClientScripts() {

		if ($this->baseUrl === '')
			throw new CException(Yii::t('SyntaxHighlighter', 'baseUrl must be set.'));

		$this->clientScript = Yii::app()->getClientScript();

		// JS
		$this->clientScript->registerScriptFile($this->baseUrl.'/src/shCore.js');
		// TODO: load brushes dinamically
		$this->clientScript->registerScriptFile($this->baseUrl.'/scripts/shBrushCss.js');
		$this->clientScript->registerScriptFile($this->baseUrl.'/scripts/shBrushPhp.js');
		$this->clientScript->registerScriptFile($this->baseUrl.'/scripts/shBrushPlain.js');
		$this->clientScript->registerScriptFile($this->baseUrl.'/scripts/shBrushSql.js');
		$this->clientScript->registerScriptFile($this->baseUrl.'/scripts/shBrushJScript.js');
		$this->clientScript->registerScriptFile($this->baseUrl.'/scripts/shBrushXml.js');

		// CSS
		$this->clientScript->registerCssFile($this->baseUrl.'/styles/shCore.css');
		$this->clientScript->registerCssFile($this->baseUrl.'/styles/shThemeDefault.css');
	}


	public function createJsCode() {
		$res='
			jQuery(document).ready(function() {
				SyntaxHighlighter.all();
			});';

		return $res;
	}


	/**
	 * Run the widget
	 */
	public function run() {
		$this->publishAssets();
		$this->registerClientScripts();

		$js = $this->createJsCode();
		$this->clientScript->registerScript('syntaxhl', $js, CClientScript::POS_HEAD);

		parent::run();
	}
}