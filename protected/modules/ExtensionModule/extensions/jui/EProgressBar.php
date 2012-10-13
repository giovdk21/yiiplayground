<?php
/*
 * EProgressBar class file.
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
 * EProgressBar: some rails for the jQuery UI widget "ProgressBar".
 *
 * @see: http://jqueryui.com/demos/progressbar/
 *
 * @author: ironic
 * @package: application.extensions.jui
 * @since: 1.0.2
 *
 */
class EProgressBar extends EJqueryUiWidget
{
   //***************************************************************************
   // Internal properties
   //***************************************************************************
	/**
	 * The valid script Options for the accordion widget.
	 *
	 * See @link http://jqueryui.com/demos/progressbar/#options
	 *
	 * @var array
	 */
	protected $validOptions = array(
		'value'	=> array('type' => 'integer'),
	);

   /**
	* See @link http://jqueryui.com/demos/progressbar/#events
	*
	* @var array
	*/
   protected $validCallbacks = array('change');

   //***************************************************************************
   // Utilities
   //***************************************************************************
   /**
	* Generates the javascript code for the widget
	* @return string
	*/
	protected function jsCode($id)
	{
		if(!empty($this->options))
		{
			$options = CJavaScript::encode($this->options);
			$script = '$("#'.$id.'").progressbar('.$options.');';
		}
		else
			$script = '$("#'.$id.'").progressbar();';

		if(!empty($this->callbacks['change']))
			$script .= "\n$('#".$id."').bind('progressbarchange', ".$this->callbacks['change'].");";

		return $script;
	}

   //***************************************************************************
   // Run Lola, Run
   //***************************************************************************
   
	/**
	 * Executes the widget.
	 * This method is called by {@link CBaseController::endWidget}.
	 */
	public function run()
	{
		list($name, $id) = $this->resolveNameID();

		$this->publishAssets();
		$this->registerClientScripts();

		$this->clientScript->registerScript('Yii.'.get_class($this).'#'.$id,
											$this->jsCode($id),
											CClientScript::POS_READY);

		echo CHtml::tag('div', array('id'=>$id), "");
	}
}