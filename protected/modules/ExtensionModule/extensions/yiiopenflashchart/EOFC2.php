<?php

/*
 * The Open Flash Chart 2 Extension is free software. It is released under the terms of the following BSD License.
 * 
 * Copyright © 2009 by Sergei Kuznecov <kuznecov.sg@gmail.com>, SummerCode.ru
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 * 
 *    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer
 *      in the documentation and/or other materials provided with the distribution.
 *    * Neither the name of SummerCode.ru nor the names of its contributors may be used to endorse or promote products derived from
 *      this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING,
 * BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENTSHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
 * OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */
 
 /*
  * English Disclaimer:
  * 
  * Open Flash Chart 2 Extension is an Yii framework extension for easy making cool viewing charts on interface of an Yii application
  * 
  * Additional information you could take from
  * http://summercode.ru/blog/10
  * 
  */
 
/*
 * Copyright © 2009 by Сергей Кузнецов <kuznecov.sg@gmail.com>, SummerCode.ru
 * Разрешается повторное распространение и использование как в виде исходного кода, так и в
 * двоичной форме, с изменениями или без, при соблюдении следующих условий:
 * 
 *    * При повторном распространении исходного кода должно оставаться указанное выше
 *      уведомление об авторском праве, этот список условий и последующий отказ от гарантий.
 *    * При повторном распространении двоичного кода должна сохраняться указанная выше
 *      информация об авторском праве, этот список условий и последующий отказ от гарантий в
 *      документации и/или в других материалах, поставляемых при распространении. 
 *    * Ни название SummerCode.ru, ни имена ее сотрудников не могут быть использованы в
 *      качестве поддержки или продвижения продуктов, основанных на этом ПО без
 *      предварительного письменного разрешения. 
 *      
 * ЭТА ПРОГРАММА ПРЕДОСТАВЛЕНА ВЛАДЕЛЬЦАМИ АВТОРСКИХ ПРАВ И/ИЛИ ДРУГИМИ СТОРОНАМИ
 * "КАК ОНА ЕСТЬ" БЕЗ КАКОГО-ЛИБО ВИДА ГАРАНТИЙ, ВЫРАЖЕННЫХ ЯВНО ИЛИ ПОДРАЗУМЕВАЕМЫХ,
 * ВКЛЮЧАЯ, НО НЕ ОГРАНИЧИВАЯСЬ ИМИ, ПОДРАЗУМЕВАЕМЫЕ ГАРАНТИИ КОММЕРЧЕСКОЙ ЦЕННОСТИ И
 * ПРИГОДНОСТИ ДЛЯ КОНКРЕТНОЙ ЦЕЛИ. НИ В КОЕМ СЛУЧАЕ, ЕСЛИ НЕ ТРЕБУЕТСЯ СООТВЕТСТВУЮЩИМ
 * ЗАКОНОМ, ИЛИ НЕ УСТАНОВЛЕНО В УСТНОЙ ФОРМЕ, НИ ОДИН ВЛАДЕЛЕЦ АВТОРСКИХ ПРАВ И НИ ОДНО
 * ДРУГОЕ ЛИЦО, КОТОРОЕ МОЖЕТ ИЗМЕНЯТЬ И/ИЛИ ПОВТОРНО РАСПРОСТРАНЯТЬ ПРОГРАММУ, КАК БЫЛО
 * СКАЗАНО ВЫШЕ, НЕ НЕСЁТ ОТВЕТСТВЕННОСТИ, ВКЛЮЧАЯ ЛЮБЫЕ ОБЩИЕ, СЛУЧАЙНЫЕ,
 * СПЕЦИАЛЬНЫЕ ИЛИ ПОСЛЕДОВАВШИЕ УБЫТКИ, ВСЛЕДСТВИЕ ИСПОЛЬЗОВАНИЯ ИЛИ НЕВОЗМОЖНОСТИ
 * ИСПОЛЬЗОВАНИЯ ПРОГРАММЫ (ВКЛЮЧАЯ, НО НЕ ОГРАНИЧИВАЯСЬ ПОТЕРЕЙ ДАННЫХ, ИЛИ ДАННЫМИ,
 * СТАВШИМИ НЕПРАВИЛЬНЫМИ, ИЛИ ПОТЕРЯМИ ПРИНЕСЕННЫМИ ИЗ-ЗА ВАС ИЛИ ТРЕТЬИХ ЛИЦ, ИЛИ ОТКАЗОМ
 * ПРОГРАММЫ РАБОТАТЬ СОВМЕСТНО С ДРУГИМИ ПРОГРАММАМИ), ДАЖЕ ЕСЛИ ТАКОЙ ВЛАДЕЛЕЦ ИЛИ
 * ДРУГОЕ ЛИЦО БЫЛИ ИЗВЕЩЕНЫ О ВОЗМОЖНОСТИ ТАКИХ УБЫТКОВ.
 * 
 */
 
 /*
 * Russian Disclaimer:
 * 
 * Open Flash Chart 2 Extension
 * 
 * Расширение для Yii которое позволяет просто (небольшим количеством кода) создавать красивые флеш-графики на страницах приложения.
 * 
 * Детальная информация может найдена по адресу: http://summercode.ru/blog/10
 * 
 */

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'Set.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'String.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'vendor/open-flash-chart.php');

/**
 * Open Flash Chart 2 Extension
 * (based on CakePHP OFC2 helper)
 * 
 * Author: Sergei Kuznecov <kuznecov.sg@gmail.com>
 * 
 */
class EOFC2 extends CComponent
{
	protected $baseUrl = '';
	protected $clientScript = null;
	
	private $chartId = null;
	
	/**
	 * The Vendor OpenFlashChart object.
	 *
	 * @var object
	 */
	public $Chart = null;
	
	/**
	 * The number data to be used to generate the charts.
	 *
	 * @var array
	 */
	public $data = array();
	
	/**
	 * Add JAVASCRIPT CODE to this variable to define the ofc_ready function
	 * that is an auto callback in the OFC vendor. Function is called
	 * when the flash is ready.
	 *
	 * @example $this->Chart->ready = 'alert('ready');';
	 * @var string
	 */
	public $ready = '';
	
	/**
	 * Add JAVASCRIPT CODE to this variable to define the open_flash_chart_data
	 * function that is auto callback in the OFC vendor. Function is called
	 * when the data is beeing loaded.
	 *
	 * @example 'alert('loading');'
	 * @var string
	 */
	public $loading = '';
	
	private $stackColours = array();

	// Default background color
	private $bg_colour = '#ffffff';
	// Default grid color
	private $grid_colour = '#cccccc';
	// Default title style
	private $title_style = '{color:#ee0000;font-size:40px;text-align:left;padding:0 0 15px 30px;}';
	// Default legend style
	private $legend_style = '{font-size:20px;color:#778877}';
	// Tooltip template is stored here at runtime
	private $tooltip = null;
	// Labels path (As per Set::extract) is stored here at runtime
	private $labelsPath = false;
	// Numbers path (Set::extract) is stored here at runtime
	private $numbersPath = null;
	// Default settings, also default parameters for the FlashChart::begin() method
	private $settings = array('width' => 300, 'height' => 200);
	// Default axis ranges
	private $defaultRange = array('x' => array(0, 100, 1), 'y' => array(0, 100, 1));
	// Default scatter chart options
	private $scatter_options = array(
			'x_key' => 'x',
			'y_key' => 'y',
			'colour' => '#aacc99',
			'size' => 3);
	// container for Spoke Labels, null = not used
	private $spoke_labels = null;
	// Default Radar axis
	private $radarAxis = array(
		'max' => 5,
		'steps' => 1,
		'colour' => '#aa2222',
		'grid_colour' => '#cccccc',
		'label_colour' => '#777777'
	);
	
	/**
	 * Publishing assets directory with swf object and js scripts
	 */
	public function publishAssets()
	{
		$dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
	}
	
	/**
	 * Register js scripts in the head of document
	 */
	public function registerClientScripts()
	{
		if ($this->baseUrl === '')
			throw new CException(Yii::t('EOFC2', 'baseUrl must be set. This is done automatically by calling publishAssets()'));
		
		$this->clientScript = Yii::app()->getClientScript();
		
		$this->clientScript->registerScriptFile($this->baseUrl.'/json/json2.js');
		$this->clientScript->registerScriptFile($this->baseUrl.'/swfobject.js');
	}
	
	/**
	 * Initialize the helper and includes the js libraries needed.
	 * Call only once.
	 *
	 * @param array $options valid options are 'prototype'
	 * @example $flashChart->begin();
	 * @example $flashChart->begin(array('prototype'=>true));
	 * @return string Javascript library includes
	 */
	public function begin($options = array())
	{
		$this->Chart   = new open_flash_chart();
		$this->chartId = md5(rand(1, time()));
	}
	
	/**
	 * returns the data array in a json array way.
	 *
	 * @return string
	 */
	public function renderData($type = 'bar', $options = array(), $datasetName = 'default', $chartId = null)
	{
		$options = preg_replace('/\s+/', ' ', $options);
		echo $this->chart($type, $options, $datasetName, $chartId);
	}
	
	/**
	 * Outputs the embeded flash, rendering the charts.
	 * For multiple independent charts around your page, call this multiple times,
	 * using different $chartId
	 *
	 * @param int $width pixel with of flash chart
	 * @param int $height pixel height of flash chart
	 * @param string $chartId name of chart for when using multiple seperate charts
	 * @param string $domId if you wish to target a dom id instead of rendering directly
	 * @return string flashHelper flash embed output
	 */
	public function render($width = null, $height = null, $chartId = null, $domId = false)
	{
		if (!is_null($chartId)) {
			$this->chartId = $chartId;
		}
		
		$this->publishAssets();
		$this->registerClientScripts();
		
		if (!is_null($width)) {
			$this->settings['width'] = $width;
		}
		if (!is_null($height)) {
			$this->settings['height'] = $height;
		}
		
		echo '<script type="text/javascript">/*<![CDATA[*/swfobject.embedSWF("', $this->baseUrl, '/open-flash-chart.swf","chart_', $this->chartId, '","', $this->settings['width'], '","', $this->settings['height'], '","9.0.0","",{"get-data":"get_data_', $this->chartId, '"});/*]]>*/</script><div id="chart_', $this->chartId, '"></div>';
	}
	
	/**
	 * Private method used by the helper to extract the data from the array based on
	 * the numbersPath and cast them to Integer if they are string (as they often are
	 * coming from a cake model.
	 *
	 * @access private
	 * @param string $datasetName The name to be used to associate charts with data
	 * @return array
	 */
	private function getNumbers($datasetName = 'default')
	{
		if ($this->numbersPath[$datasetName] != '{n}')
		{
			$numbers = Set::extract($this->data[$datasetName], $this->numbersPath[$datasetName]);
		}
		else
		{
			$numbers = $this->data[$datasetName];
		}
		
		foreach ($numbers as $key => $value)
		{
			if (is_numeric($value))
			{
				$numbers[$key] = $value + 0;
			}
		}
		return $numbers;
	}
	
	/**
	 * Returns the data array in a json array way.
	 *
	 * @access private
	 * @return string
	 */
	private function data($chartId = null)
	{
		if (!is_null($chartId))
		{
			$this->chartId = $chartId;
		}
		
		return
		'<script type="text/javascript">/*<![CDATA[*/var data_'.$this->chartId.' = ' . $this->Chart->toString() . '; function get_data_' . $this->chartId . '() { return JSON.stringify(data_' . $this->chartId . '); }/*]]>*/</script>';
	}
	
	/**
	 * Add a dataset to be rendered by the helper.  
	 * Always call this method at least once, and you must call it after begin() and 
	 * before axis(), or else you may get errors. This tells the helper what data 
	 * to generate graphs from. You can call it multiple times to put in multiple
	 * datasets. You must call the render method in the same order you set the data.
	 * You can optionally set the extract paths (see cake documentation for 
	 * Set::extract() ) directly with this method or use the specific methods (
	 * setNumbersPath() and setLabelsPath() ).
	 * 
	 * The data can be in any format you want, using the paths to tell the helper
	 * how to find your data. If you give no path, neither here, nor with the above
	 * mentioned methods, it expects the data array to be array(12,32,15,23).
	 *    
	 * @example $flashChart->setData(array(1,5,23,35));
	 * @example $flashChart->setData($users,'/User/age','/User/name');
	 * @example $flashChart->setData($data,'{n}.Event.grade','{n}.Girl.name', 'Girls');
	 * @param array $data
	 * @param string $numbersPath
	 * @param string $labelsPath (if string, this dataset will overwrite any previous label path.)
	 * @param string $datasetName The name to be used to associate charts with data
	 * @param string $chartId Name of chart. Use for seperate charts.
	 */	
	public function setData($data, $numbersPath = '{n}', $labelsPath = false, $datasetName = 'default')
	{
		$this->data[$datasetName] = $data;
		if (is_string($numbersPath))
		{
			$this->numbersPath[$datasetName] = $numbersPath;
		}
		if (is_string($labelsPath))
		{
			if (substr($labelsPath,0,1) == '/')
			{
				$labelsPath = '/'.$datasetName.$labelsPath;
			}
			else
			{
				$labelsPath = $datasetName.'.'.$labelsPath;				
			}
			$this->labelsPath = $labelsPath;
		}
	}
	
	/**
	 * Renders the javascript with data and customization for one graph chart. To be called last, but 
	 * may be called multiple times with different datasetNames for different datasets or different
	 * type (and options) for different display of the same data in the same chart.
	 * What options are valid vary from chart type to chart type, and the helper is set up in such 
	 * a way as to pass the options on to the vendor, therefore letting you use an updated vendor 
	 * without changes to the helper. This also means that the helper doesnt know (or care) what 
	 * options you send, but if they do not exist in the vendor, you will throw an error.
	 * 
	 *   For options documentation see;
	 *   http://teethgrinder.co.uk/open-flash-chart-2/
	 *  
	 * @example echo $flashChart->chart();
	 * @example echo $flashChart->chart('bar_3d', array('colour'=>'#aa55AA'));
	 * @example echo $flashChart->chart('line',array('colour'=>'green'),'Apples');
	 * @param string $type Valid types - see doc in top
	 * @param array $options varies depending on type. See vendor documentation
	 * @param string $datasetName The name to be used to associate charts with data
	 * @param string $chartId Name of chart. Use for seperate charts.
	 * @return string
	 */
	private function chart($type = 'bar', $options = array(), $datasetName = 'default', $chartId = null)
	{
		if (!is_null($chartId))
		{
			$this->chartId = $chartId;
		}
		
		switch ($type)
		{
			case 'pie':
				return $this->pie($options, $datasetName, $this->chartId);
				break;
			case 'sketch':
				return $this->sketch($options, $datasetName, $this->chartId);
				break;
			case 'scatter':
				return $this->scatter($options, $datasetName, $this->chartId);
				break;
			case 'scatter_line':
				$options['type'] = $type;
				return $this->scatter($options, $datasetName, $this->chartId);
				break;
			case 'bar_stack':
				return $this->barStack($options, $datasetName, $this->chartId);
				break;
			case 'radar':
				return $this->radar($options, $datasetName, $this->chartId);
				break;
			case 'radar_filled':
				$options['type'] = 'filled';
				return $this->radar($options, $datasetName, $this->chartId);
				break;
			case 'line':
			case 'line_dot':
			case 'line_hollow':
			case 'bar':
			case 'bar_filled':
			case 'bar_glass':
			case 'bar_3d':
			case 'area_line':
			case 'area_hollow':
				if (empty($this->data[$datasetName]))
				{
					return false;
				}
				$this->Chart->set_bg_colour($this->bg_colour);
				$element = new $type();
				foreach ($options as $key => $setting)
				{
					switch ($key)
					{
						case 'line_style':
							$line_style = new line_style($setting[0],$setting[1]);
							$element->line_style($line_style);
							break;
						default:
							$set_method = 'set_' . $key;
							if (is_array($setting))
							{
								$element->$set_method($setting[0], $setting[1]);
							}
							else
							{
								$element->$set_method($setting);
							}
							break;
					}
				}
				if (!empty($this->tooltip))
				{
					$element->set_tooltip($this->tooltip);
				}
				$numbers = $this->getNumbers($datasetName);
				$element->set_values($numbers);
				$this->Chart->add_element($element);
				return $this->data($this->chartId);
				break;
			default:
				return false;
		}
	}
	
	/**
	 * Alias for FlashChart::chart('bar_stack');
	 *
	 * @param array $options
	 * @param string $datasetName The name to be used to associate charts with data
	 * @param string $chartId Name of chart. Use for seperate charts.
	 * @return string
	 */
	public function barStack($options = array(), $datasetName = 'default', $chartId = null) {
		if (!is_null($chartId))
		{
			$this->chartId = $chartId;
		}
				
		if (empty($this->data[$datasetName]))
		{
			return false;
		}
		
		$bar_stack = new bar_stack();
		$numbers = $this->getNumbers($datasetName);
		
		foreach ($numbers as $values)
		{
			$tmp = array();
			if (sizeof($this->stackColours) == sizeof($values))
			{
				foreach ($values as $key => $value)
				{
					$tmp[] = new bar_stack_value($value, $this->stackColours[$key]);
				}
			}
			else
			{
				$tmp = $values;
			}
			$bar_stack->append_stack($tmp);
		}
		
		if (!empty($this->tooltip))
		{
			$bar_stack->set_tooltip($this->tooltip);
		}
		foreach ($options as $key => $setting)
		{
			$set_method = 'set_' . $key;
			if (is_array($setting))
			{
				$bar_stack->$set_method($setting[0], $setting[1]);
			}
			else
			{
				$bar_stack->$set_method($setting);
			}
		}		
		
		$this->Chart->set_bg_colour($this->bg_colour);
		$this->Chart->add_element($bar_stack);
		
		return $this->data($this->chartId);
	}
	
	/**
	 * Alias for FlashChart::chart('scatter'), this method renders only
	 * the scatter chart type
	 *
	 * Online documentation :
	 * http://teethgrinder.co.uk/open-flash-chart-2/scatter-chart.php
	 * 
	 * @param array $options
	 * 		valid option keys : colour, size, x_key, y_key
	 * @param string $datasetName The name to be used to associate charts with data
	 * @param string $chartId Name of chart. Use for seperate charts.
	 * @return string
	 */
	public function scatter($options = array(), $datasetName = 'default', $chartId = null)
	{
		if (!is_null($chartId))
		{
			$this->chartId = $chartId;
		}
		
		if (empty($this->data[$datasetName]))
		{
			return false;
		}
		
		$options = am($this->scatter_options, $options);
		if (isset($options['type']) && $options['type'] == 'scatter_line')
		{
			$scatter = new scatter_line($options['colour'], $options['size']);
		}
		else
		{
			$scatter = new scatter($options['colour'], $options['size']);
		}
		$values = array();
		foreach ($this->data[$datasetName] as $row)
		{
			$values[] = new scatter_value($row[$options['x_key']], $row[$options['y_key']]);
		}
		if (!empty($this->tooltip))
		{
			$element->set_tooltip($this->tooltip);
		}
		$scatter->set_values($values);
		$this->Chart->add_element($scatter);
		$this->Chart->set_bg_colour($this->bg_colour);
		return $this->data($this->chartId);	
	}
	
	/**
	 * Alias for FlashChart::chart('radar'); 
	 *
	 * The Radar chart needs special axis and also
	 * have special methods for stokes and labes
	 * 
	 * @todo Each value can have it's own tooltip using the dot_value class
	 *
	 * @example echo $flashChart->radar(array('loop'=>false','colour'=>'336699'));
	 * @example echo $flashChart->radar(array('type'=>filled'),'Dataset2');
	 * @param array $options
	 * @param string $datasetName The name to be used to associate charts with data
	 * @param string $chartId Name of chart. Use for seperate charts.
	 * @return string
	 */
	public function radar($options = array(), $datasetName = 'default', $chartId = null)
	{
		if (!is_null($chartId))
		{
			$this->chartId = $chartId;
		}
		
		if (empty($this->data[$datasetName])) {
			return false;
		}	
		$this->Chart->set_bg_colour($this->bg_colour);
		
		if (isset($options['type']) && $options['type'] == 'filled') {
			$line = new area_hollow();
			
		} else {
			$line = new line_hollow();
			if (!isset($options['loop']) || (isset($options['loop']) && $options['loop'])) {
				$line->loop();
			}
			if (isset($options['loop'])) {
				unset($options['loop']);
			}
			
		
		}
		
		$values = $this->getNumbers($datasetName);
		/* @todo code below is not getting expected result
		if (isset($options['tooltip_path'])) {
			$numbers = $values;
			$values = array();
			$tooltips = Set::extract($xpath,$this->data[$datasetName]);
			if (isset($options['tooltip_colour'])) {
				$colour = $options['tooltip_colour'];
				unset($options['tooltip_colour']);	
			} else {
				$colour = $this->grid_colour;
			}
			foreach ($numbers as $key => $number) {
				$tmp = new dot_value( $number, $colour );
		    	$tmp->set_tooltip($tooltips[$key]);
		    	$values[] = $tmp;
			}			
			unset($options['tooltip_path']);	
		}*/
		
		if (isset($options['type'])) {
			unset($options['type']);	
		}
		foreach ($options as $key => $setting) {
			$set_method = 'set_' . $key;
			if (is_array($setting)) {
				$line->$set_method($setting[0], $setting[1]);
			} else {
				$line->$set_method($setting);
			}			
		}		
		$radar_axis_object = new radar_axis($this->radarAxis['max']);
		$radar_axis_object->set_steps($this->radarAxis['steps']);
		$radar_axis_object->set_colour($this->radarAxis['colour']);
		$radar_axis_object->set_grid_colour($this->radarAxis['grid_colour']);
		if (!empty($this->radarAxis['labels'])) {
			$labels = new radar_axis_labels($this->radarAxis['labels']);
			$labels->set_colour($this->radarAxis['label_colour']);
			$radar_axis_object->set_labels($labels);
		}		
		if (!is_null($this->spoke_labels)) {
			$radar_axis_object->set_spoke_labels($this->spoke_labels);
		}
		$this->Chart->set_radar_axis($radar_axis_object);	
		
		$line->set_values($values);		
		$this->Chart->add_element($line);
		return $this->data($chartId);
	}
	
	/**
	 * This is an alias for FlashChart::chart('bar_scetch',$options);
	 *
	 * Unfortunatly the Sketch class takes in is options as constructor
	 * values instead of using the set methods like the other classes. 
	 * 
	 * @param array $options
	 * 		valid option keys : colour, outline_colour, fun_factor
	 * @param string $datasetName The name to be used to associate charts with data
	 * @param string $chartId Name of chart. Use for seperate charts.
	 * @return string
	 */
	public function sketch($options = array(), $datasetName = 'default', $chartId = null)
	{
		if (!is_null($chartId))
		{
			$this->chartId = $chartId;
		}
		
		if (empty($this->data[$datasetName])) {
			return false;
		}
		$this->Chart->set_bg_colour($this->bg_colour);
		$element = new bar_sketch($options['colour'], $options['outline_colour'], $options['fun_factor']);
		if (!empty($this->tooltip)) {
			$element->set_tooltip($this->tooltip);
		}
		$numbers = $this->getNumbers($datasetName);
		$element->set_values($numbers);
		$this->Chart->add_element($element);
		return $this->data($this->chartId);
	}
	
	/**
	 * This is an alias to FlashChart::chart('pie') that is only used for the 
	 * pie type.
	 *
	 * For options documentation; 
	 * http://teethgrinder.co.uk/open-flash-chart-2/pie-chart.php
	 * 
	 * @example echo $flashChart->renderPie();
	 * @example echo $flashChart->renderPie(array('animate'=>false);
	 * @param array $options
	 * 		Valid options : values, animate, start_angle, tooltip
	 * @param string $datasetName The name to be used to associate charts with data
	 * @param string $chartId Name of chart. Use for seperate charts.
	 * @return string
	 */
	public function pie($options = array(), $datasetName = 'default', $chartId = null)
	{
		if (!is_null($chartId))
		{
			$this->chartId = $chartId;
		}
		
		if (empty($this->data[$datasetName])) {
			return false;
		}
		$this->Chart->set_bg_colour($this->bg_colour);
		$pie = new Pie();
		foreach ($options as $key => $setting) {
			$set_method = 'set_' . $key;
			$pie->$set_method($setting);
		}
		if (!empty($this->tooltip)) {
			$pie->set_tooltip($this->tooltip);
		}
		$pies = array();
		$labels = Set::extract($this->data, $this->labelsPath);
		$numbers = $this->getNumbers($datasetName);
		foreach ($numbers as $key => $value) {
			if (isset($labels[$key]) && is_string($labels[$key])) {
				$pies[] = new pie_value($value, $labels[$key]);
			} else {
				$pies[] = $value;
			}
		}
		$pie->set_values($pies);
		$this->Chart->add_element($pie);
		return $this->data($this->chartId);
	}
	
	/**
	 * Sets the tool tip for the chart by using a string with replaceable
	 * codewords like #val#. Check OFC2 for documentation. Also you can style
	 * the tooltips look and behavior using the options parameter.
	 * 
	 * Documentation:
	 * http://teethgrinder.co.uk/open-flash-chart-2/tooltip-menu.php
	 * 
	 * @example $flashChart->setToolTip('#val#%');
	 * @param string $tooltip
	 * @param array $options see OFC2 doc for valid options
	 */
	public function setToolTip($tooltip = '', $options = array())
	{
		if (is_string($tooltip))
			$this->tooltip = $tooltip;
		if (!empty($options))
		{
			$tool_tip_object = new tooltip();
			foreach ($options as $key => $setting)
			{
				$set_method = 'set_' . $key;
				$tool_tip_object->$set_method($setting);
			}
			$this->Chart->set_tooltip($tool_tip_object);
		}
	}
	
	/**
	 * Sets the title above the chart. You can also style it with
	 * css as the second parameter.
	 *
	 * @example $flashChart->setTitle('Awesomeness');
	 * @example $flashChart->setTitle('Coolness, by date','{font-size:26px;}');
	 * @param string $title_text
	 * @param string $style css
	 */
	public function setTitle($title_text, $style = '')
	{
		$title = new title($title_text);
		if (empty($style))
		{
			$style = $this->title_style;
		}
		$title->set_style($style);
		$this->Chart->set_title($title);
	}
	
	/**
	 * Set the descriptive texts next to the axies to describe their meaning.
	 * You can also style it directly here using CSS.
	 *
	 * @example $flashChart->setLegend('x','Time of day');
	 * @example $flashChart->setLegend('y','Coolness factor','{font-size:10px;color:#FF0000;}');
	 * @param string $axis 'x' or 'y'
	 * @param string $title
	 * @param string $style css
	 */
	public function setLegend($axis, $title, $style = '')
	{
		$legend_object_name = $axis . '_legend';
		$legend_set_method = 'set_' . $axis . '_legend';
		$legend_object = new $legend_object_name($title);
		if (empty($style))
		{
			$style = $this->legend_style;
		}
		$legend_object->set_style($style);
		$this->Chart->$legend_set_method($legend_object);
	}
	
	/** 
	 * Use this method to set up the axis' range and labels. There are also a number
	 * of options (mostly styling) that can be set up. The two axis have different 
	 * options, but a full documentation can be found on the links given under.
	 * Importantly though, the y has a range option that takes an array with 3 values
	 * (minimum value, max value and step size). On the x axis you will often want
	 * to use the labels from the dataset and the helper will add those labels if
	 * you have defined a proper labels path, either as the third parameter of 
	 * setDate() or using the setLabelsPat() method. Note, that even if you require
	 * no options for the x-axis, you will have to call this method on that axis
	 * for it to use those labels.
	 *
	 * See documentation for options ;
	 * http://teethgrinder.co.uk/open-flash-chart-2/x-axis.php
	 * http://teethgrinder.co.uk/open-flash-chart-2/y-axis.php
	 * 
	 * @example $flashChart->axis('x'); //Sets labels from dataset
	 * @example $flashChart->axis('x',array('labels'=>array('Things','To','Do')),array('colour'=>'#aaFF33', 'vertical'=>true)); 
	 * @example $flashChart->axis('y', array('range'=>array(0,50,5), 'tick_length'=>15);
	 * @param string $axis 'x' or 'y'
	 * @param array $options
	 * @param array $labelsOptions used to customize x axis labels
	 */
	public function axis($axis, $options = array(), $labelsOptions = array())
	{
		$axis_object_name = $axis . '_axis';
		$axis_set_method = 'set_' . $axis . '_axis';
		$axis_object = new $axis_object_name();
		
		foreach ($options as $key => $setting)
		{
			// special options set direcly bellow
			if (in_array($key, array('labels', 'range')))
				continue;
			$set_method = 'set_' . $key;
			if (is_array($setting))
			{
				switch ($key)
				{
					case 'colours':
						$axis_object->set_colours($setting[0], $setting[1]);
						break;
					default:
						$axis_object->$set_method($setting);
				}
			}
			else
			{
				$axis_object->$set_method($setting);
			}
		}
		// that wich must always be set :
		if (!isset($options['colour']))
		{
			$axis_object->set_colour($this->grid_colour);
		}
		if (!isset($options['grid_colour']))
		{
			$axis_object->set_grid_colour($this->grid_colour);
		}
		
		if (isset($options['range']))
		{
			if (isset($options['range'][0]))
			{
				$min = $options['range'][0]; 
			}
			else
			{
				$min = $this->defaultRange[$axis][0];
			}
			if (isset($options['range'][1]))
			{
				$max = $options['range'][1]; 
			}
			else
			{
				$max = $this->defaultRange[$axis][1];
			}
			if (isset($options['range'][2]))
			{
				$step = $options['range'][2]; 
			}
			else
			{
				$step = $this->defaultRange[$axis][2];
			}
			
			if ($axis == 'y')
			{
				$axis_object->set_range($min, $max, $step);
			}
			else
			{ // $axis == 'x'
				$axis_object->set_range($min, $max);
				$axis_object->set_steps($step);
			}			
		}
		else
		{
			if ($axis == 'y')
			{
				$axis_object->set_range($this->defaultRange[$axis][0], $this->defaultRange[$axis][1], $this->defaultRange[$axis][2]);
			}
		} 
		if ($axis == 'x' && is_string($this->labelsPath) && !empty($this->labelsPath) )
		{
            if (sizeof($labelsOptions) > 0)
			{
                $labels = Set::extract($this->data, $this->labelsPath);
                $x_axis_label = new x_axis_labels;        
                foreach ($labelsOptions as $key => $setting)
				{
                    $set_method = 'set_' . $key;
                    $x_axis_label->$set_method($setting);      
                }    
                $x_axis_label->set_labels($labels); 
                $axis_object->set_labels($x_axis_label);
            }
			else
			{
                $labels = Set::extract($this->data, $this->labelsPath);
                $axis_object->set_labels_from_array($labels);
			}
		}
		elseif (isset($options['labels']) && is_array($options['labels']) && $axis == 'x')
		{
            if (isset($labelsOptions['vertical']) && $labelsOptions['vertical'] == true)
			{
                $x_axis_label = new x_axis_labels;           
                $x_axis_label->set_vertical();          
                $x_axis_label->set_labels($options['labels']); 
                $axis_object->set_labels($x_axis_label);
            }
			else
			{
                $axis_object->set_labels_from_array($options['labels']);
            }			
		}
		elseif (isset($options['labels']))
		{
			$axis_object->set_labels($options['labels']);
		}		
		$this->Chart->$axis_set_method($axis_object);
	}
	
	/**
	 * When using multiple charts in one diagram, it may be useful to have a second
	 * y-axis for different values. At the moment this feature is not perfectly 
	 * implemented in the vendor, among other problems, all charts will use the left
	 * y-axis' range for displaying their values.
	 * 
	 * The options it takes in is documented here;
	 * http://teethgrinder.co.uk/open-flash-chart-2/y-axis-right.php
	 *
	 * @param array $options
	 */
	public function rightAxis($options = array())
	{
		$y = new y_axis_right();
		if (!empty($options)) {
			foreach ($options as $key => $setting)
			{
				$set = 'set_' . $key;
				if (is_array($setting) && sizeof($setting) == 2)
				{
					$y->$set($setting[0], $setting[1]);
				}
				else
				{
					$y->$set($setting);
				}
			}
		}
		$this->Chart->set_y_axis_right($y);
	}
			
	/**
	 * Radar charts are circular and this method sets the grid options, more
	 * than an axis really. The options it takes in define the "height" and
	 * steps of the grid and its colour. You can also set the labels for the 
	 * y axis (or what you can think of as the radius).
	 *
	 * @param array $options
	 * 		valid option keys : max, steps, colour, grid_colour, label_colour
	 * @param array $labels
	 * @return string
	 */
	public function setRadarAxis($options = array(), $labels = array())
	{
		$this->radarAxis  = am($this->radarAxis, $options);
		if (!empty($labels))
		{
			$this->radarAxis['labels'] = $labels;
		}
		return  $this->radarAxis;
	}

	/**
	 * Spokes are the labels that name the "radius"-axis of the chart
	 *
	 * @example $flashChart->setRadarSpokes(array('weight','height','strength'));
	 * @example $flashChart->setRadarSpokes(array('red','green','blue'),'#AA3377');
	 * @param array $spokes
	 * @param string $colour
	 */
	public function setRadarSpokes($spokes, $colour = null)
	{
		if (!$colour)
		{
			$colour = $this->defaultSpokeColour;
		}		
		$this->spoke_labels = new radar_spoke_labels( $spokes  );		
		$this->spoke_labels->set_colour( $colour );		
	}
	
	/**
	 * Tells the helper where to find the numbers to generate the graph with. 
	 * This is the same functionality as the 2nd paramter of the setData() 
	 * method. You do not need to set it both places.
	 *
	 * @param string $path
	 * @param string $datasetName The name to be used to associate charts with data
	 */
	public function setNumbersPath($path, $datasetName = 'default')
	{
		$this->numbersPath[$datasetName] = $path;
	}
	
	/**
	 * Tells the helper where to find the labels for the X axis. 
	 * This is the same functionality as the third paramter of the setData() 
	 * method. You do not need to set it both places.
	 * NB. The path should start with the name of the dataset
	 *
	 * @example $flashChart->setLabelsPath('Default.{n}.User.name');
	 * @param string $path
	 */
	public function setLabelsPath($path)
	{
		$this->labelsPath = $path;
	}
	
	/**
	 * Set the background color for the entire diagram. Optional. Will
	 * use the default stored in FlashChart::bg_colour if not used.
	 *
	 * @param string $colour #AA0000
	 */
	public function setBgColour($colour)
	{
		$this->bg_colour = $colour;
	}
	
	/**
	 * For the chart type Bar_stack this method sets the colours of the bars.
	 *
	 * @param array $colours
	 */
	public function setStackColours($colours = array())
	{
		$this->stackColours = $colours; 
	}
}

/**
 * Merge a group of arrays
 * 
 * @param array First array
 * @param array Second array
 * @param array Third array
 * @param array Etc...
 * @return array All array parameters merged into one
 * @link http://book.cakephp.org/view/696/am
 */
function am()
{
	$r = array();
	$args = func_get_args();
	foreach ($args as $a)
	{
		if (!is_array($a))
		{
			$a = array($a);
		}
		$r = array_merge($r, $a);
	}
	
	return $r;
}
