<?php
/*
 * ECLEditor widget class file.
 * @author Thiago Otaviani Vidal <thiagovidal@othys.com>
 * @link http://www.othys.com
 * Copyright (c) 2010 Thiago Otaviani Vidal
 * MADE IN BRAZIL
 
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:

 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.

 * ECLEditor extends CInputWidget and implements a base class for a CLEditor jQuery plugin.
 * more about CLEditor can be found at http://premiumsoftware.net/cleditor/
 * @version: 1.0
 */
class ECLEditor extends CInputWidget
{
	public $options=array();
	
	public function init()
	{
		$this->publishAssets();
	}
	
    public function run()
    {
		list($name,$id)=$this->resolveNameID();

		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];
		else
			$this->htmlOptions['name']=$name;

		if($this->hasModel())
			echo CHtml::activeTextArea($this->model,$this->attribute,$this->htmlOptions);
		else
			echo CHtml::textArea($name,$this->value,$this->htmlOptions);
	
		
		$options=CJavaScript::encode($this->options);	
		Yii::app()->clientScript->registerScript($id,"
			$('#{$id}').cleditor({$options});
		");
	}
	
	protected static function publishAssets()
	{
		$assets=dirname(__FILE__).'/assets';
		$baseUrl=Yii::app()->assetManager->publish($assets);
		if(is_dir($assets)){
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/jquery.cleditor.min.js',CClientScript::POS_HEAD);
			Yii::app()->clientScript->registerCssFile($baseUrl.'/jquery.cleditor.css');
		} else {
			throw new Exception('EClEditor - Error: Couldn\'t find assets to publish.');
		}
	}
}