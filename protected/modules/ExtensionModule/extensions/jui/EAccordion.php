<?php
/*
 * EDatePicker class file.
 *
 * @author ironic
 * @version 2.4.1
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2009 ironic
 * @license dual GPL (3.0 or later) and MIT, at your choice.
 * @license http://www.opensource.org/licenses/mit-license.php
 * @license http://www.opensource.org/licenses/gpl-3.0.php
 *
 * See doc/gpl-3.0.txt and doc/MIT-LICENSE.txt for the full text of the
 * licenses.
 *
 * The MIT license:
 *
 * Copyright (c) 2009 ironic
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * The GPL license:
 *
 * Copyright (C) 2009 ironic
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'EJqueryUiWidget.php');

/**
 *
 * EAccordion: some rails for the jQuery UI widget "Accordion".
 *
 * @see: http://jqueryui.com/demos/accordion/
 * @see: http://docs.jquery.com/UI/Accordion
 *
 * @author: ironic
 * @package: application.extensions.jui
 * @since: 1.0.2
 *
 */
class EAccordion extends EJqueryUiWidget
{
   //***************************************************************************
   // Configuration
   //***************************************************************************

   /**
    * The body of the widget
    *
    * @var string
    */
   private $body = '';

	/**
	 * The panels of the accordion widget.
	 * @var array
	 */
	private $_panels = array();

	/**
	 * The wrapping html tag for the header-part
	 * of a accordion panel.
	 * @var string
	 */
	private $_headerHtml = 'h3';

	/**
	 * The functions supported by the
	 * jquery accordion script
	 * @var array
	 */
	private $_functions = array();

	/**
	 * determines wether to use the jquery.easing
	 * plugin or not...
	 * @var boolean
	 */
	private $_useEasing = false;

   //***************************************************************************
   // Internal properties
   //***************************************************************************

	/**
	 * The valid script Options for the accordion widget.
	 *
	 * See @link http://jqueryui.com/demos/accordion/#options
	 *
	 * @var array
	 */
	protected $validOptions = array(
      'active'=>array('type'=>array('boolean', 'number')), // Selector for the active element. Set to false to display none at start. Needs «collapsible: true». Default: first child
      'animated'=>array('type'=>array('boolean', 'string')), // Choose your favorite animation, or disable them (set to false). In addition to the default, 'bounceslide' and 'easeslide' are supported (both require the easing plugin). Default: false
      'autoHeight'=>array('type'=>'boolean'), // If set, the highest content part is used as height reference for all other parts. Provides more consistent animations. Default: true
      'clearStyle'=>array('type'=>'boolean'), // If set, clears height and overflow styles after finishing animations. This enables accordions to work with dynamic content. Won't work together with autoHeight. Default: false
      'collapsible'=>array('type'=>'boolean'), // Whether all the sections can be closed at once. Allows collapsing the active section by the triggering event (click is the default). Default: false
      'event'=>array('type'=>'string'), // The event on which to trigger the accordion. Default: 'click'
      'fillSpace'=>array('type'=>'boolean'), // If set, the accordion completely fills the height of the parent element. Overrides autoheight. Default: false
      'header'=>array('type'=>'string'), // Selector for the header element. Default: '> li > :first-child,> :not(li):even'
      'icons'=>array('type'=>'array'), // Icons to use for headers. Icons may be specified for 'header' and 'headerSelected', and we recommend using the icons native to the jQuery UI CSS Framework manipulated by jQuery UI ThemeRoller. Default: { 'header': 'ui-icon-triangle-1-e', 'headerSelected': 'ui-icon-triangle-1-s' }
      'navigation'=>array('type'=>'boolean'), // If set, looks for the anchor that matches location.href and activates it. Great for href-based state-saving. Use navigationFilter to implement your own matcher. Default: false
	);

   /**
	* See @link http://jqueryui.com/demos/accordion/#options
	*
	* @var array
	*/
	protected $validFunctions = array('navigationFilter');

   /**
	* See @link http://jqueryui.com/demos/accordion/#events
	*
	* @var array
	*/
   protected $validCallbacks = array('change');

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
	* Sets the panels property.
	* Format:
	* array(
	*	'Panel 1 Header' => '<p>Panel 1 Content</p>',
	*	'Panel 2 Header' => '<ul><li>Panel 2 Content</li></ul>',
	* )
	* @param array
	*/
	public function setPanels(array $panels)
	{
		$this->_panels = $panels;
	}

   /**
	* Returns the panels property.
	* @return array
	*/
	public function getPanels()
	{
		return $this->_panels;
	}

   /**
	* Sets the header html tag.
	* @param string
	*/
	public function setHeaderHtml($headerHtml)
	{
		if(is_string($headerHtml))
			$this->_headerHtml = $headerHtml;
	}

   /**
	* Returns the header html tag.
	* @return string
	*/
	public function getHeaderHtml()
	{
		return $this->_headerHtml;
	}

   /**
	* Sets the functions property.
	* Format:
    * array(
	*	'navigationFilter' => 'function() {
	*		return this.href.toLowerCase()==location.href.toLowerCase();
	*	}',
	* )
	* @param array
	*/
	public function setFunctions(array $functions)
	{
		$this->_functions = $functions;
	}

   /**
	* Returns the functions property.
	* @return array
	*/
	public function getFunctions()
	{
		return $this->_functions;
	}

   /**
	* Sets the useEasing property.
	* @return array
	*/
	public function setUseEasing($useEasing)
	{
		if(is_bool($useEasing))
			$this->_useEasing = $useEasing;
	}

   /**
	* Returns the useEasing property.
	* @return array
	*/
	public function getUseEasing()
	{
		return $this->_useEasing;
	}

   //***************************************************************************
   // Utilities
   //***************************************************************************

   protected function makeOptions()
   {
		$options = array();
		$options['header'] = $this->_headerHtml;
		$options = CJavaScript::encode(array_merge($options, $this->options));
		return $options;
   }

   /**
	* Generates the javascript code for the widget
	* @return string
	*/
	protected function jsCode($id)
	{
		$options = $this->makeOptions();
		$script = '$("#'.$id.'").accordion('.$options.');';

		$pattern = array("\r\n", "\n", "\r", "\t");

		foreach($this->callbacks as $key => $val) {
			$val = str_replace($pattern, "", $val);
			$script .= "\n$('#".$id."').accordion('option', '".$key."', ".$val.");";
		}

		foreach($this->functions as $key => $val) {
			$val = str_replace($pattern, "", $val);
			$script .= "\n$('#".$id."').accordion('option', '".$key."', ".$val.");";
		}

		return $script;
	}

   /**
	* Generates the html code for the widget
	* @return string
	*/
	public function htmlCode()
	{
      $html = '';
      if (!empty($this->_panels)) {
         foreach ($this->_panels as $panelHeader => $panelBody) {
            $anchor = sprintf("#%s", strtolower(trim($panelHeader)));
            $anchor = str_replace(array("\r\n", "\n", "\r", "\t", " "), "", $anchor);
            $header_link = CHtml::link($panelHeader, $anchor);
            $html .= CHtml::openTag('div');
            $html .= CHtml::tag($this->_headerHtml, array(), $header_link);
            $html .= CHtml::tag('div', array(), $panelBody);
            $html .= CHtml::closeTag('div');
         }
      }
      else {
         $html = CHtml::tag('div', array(), $this->body);
      }

		return $html;
	}

	public function registerClientScripts()
	{
		parent::registerClientScripts();
		if($this->useEasing)
			$this->clientScript->registerScriptFile($this->baseUrl.'/external/easing/jquery.easing.1.3.js');
	}

   //***************************************************************************
   // Run Lola, Run
   //***************************************************************************

   /**
    * Inits the widget.
    */
   public function init()
   {
      if (empty($this->_panels)) {
         ob_start();
      }
   }

	/**
	 * Executes the widget.
	 * This method is called by {@link CBaseController::endWidget}.
	 */
	public function run()
	{
      if (empty($this->_panels)) {
         $this->body = ob_get_contents();
         ob_end_clean();
      }

		list($name, $id) = $this->resolveNameID();

		$this->publishAssets();
		$this->registerClientScripts();

		$this->clientScript->registerScript('Yii.'.get_class($this).'#'.$id,
											$this->jsCode($name),
											CClientScript::POS_READY);

		echo CHtml::tag('div', array('id'=>$id), $this->htmlCode());
	}
}