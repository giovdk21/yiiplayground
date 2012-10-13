<?php
/**
 * EDialog class file.
 *
 * @author MetaYii
 * @version 2.4.1
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2009 MetaYii
 * @license dual GPL (3.0 or later) and MIT, at your choice.
 * @license http://www.opensource.org/licenses/mit-license.php
 * @license http://www.opensource.org/licenses/gpl-3.0.php
 *
 * See doc/gpl-3.0.txt and doc/MIT-LICENSE.txt for the full text of the
 * licenses.
 *
 * The MIT license:
 *
 * Copyright (c) 2009 MetaYii
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
 * Copyright (C) 2009 MetaYii
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
 *
 * -----------------------------------------------------------------------------
 *
 * jQuery UI is bundled under the terms of the MIT or GPL licenses, at your
 * choice. Please see {@link http://docs.jquery.com/Licensing} for details.
 * MetaYii is not related to the jQuery UI development team.
 */

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'EJqueryUiWidget.php');

/**
 *
 * EDialog is a Yii widget which encapsulates the functionality of the jQuery UI
 * dialog widget to generate a dialog.
 *
 * Works with jQuery 1.3 and jQuery UI 1.7
 *
 * @link http://jqueryui.com/demos/tabs
 *
 * @author MetaYii
 * @package application.extensions.jui
 * @since 1.0.2
 */
class EDialog extends EJqueryUiWidget
{
   /**
    * The content of the dialog.
    *
    * @var string
    */
   private $body = null;

   /**
    * Associative array key=>value where key is the name of the button, and
    * value es a callback (a valid javascript funcion) which acts upon the click
    *
    * Example:
    *
    * $buttons['Ok'] = 'function(){$(this).dialog("close");}'
      $buttons['Cancel'] = 'function(){alert("cancel");}'
    *
    * @var array
    */
   private $buttons = array();
  
   //***************************************************************************
   // Internal properties (not for configuration)
   //***************************************************************************

   /**
    * See @link http://docs.jquery.com/UI/Dialog/dialog#options
    *
    * @var array
    */
   protected $validOptions = array(
                                   'autoOpen'=>array('type'=>'boolean'), // When autoOpen is true the dialog will open automatically when dialog is called. If false it will stay hidden until .dialog("open") is called on it. Default: true
                                   'bgiframe'=>array('type'=>'boolean'), // When true, the bgiframe plugin will be used, to fix the issue in IE6 where select boxes show on top of other elements, regardless of zIndex. Requires including the bgiframe plugin. Future versions may not require a separate plugin. Default: false
                                   'buttons'=>array('type'=>'array'), // Specifies which buttons should be displayed on the dialog. The property key is the text of the button. The value is the callback function for when the button is clicked. The context of the callback is the dialog element; if you need access to the button, it is available as the target of the event object. Default: {}
                                   'closeOnEscape'=>array('type'=>'boolean'), // Specifies whether the dialog should close when it has focus and the user presses the esacpe (ESC) key. Default: true
                                   'dialogClass'=>array('type'=>'string'), // The specified class name(s) will be added to the dialog, for additional theming. Default: ""
                                   'draggable'=>array('type'=>'boolean'), // If set to true, the dialog will be draggable will be draggable by the titlebar. Default: true
                                   'height'=>array('type'=>array('integer', 'string')), // The height of the dialog, in pixels. Default: 'auto'
                                   'hide'=>array('type'=>'string'), // The effect to be used when the dialog is closed. Default: ""
                                   'maxHeight'=>array('type'=>array('boolean', 'integer')), // The maximum height to which the dialog can be resized, in pixels. Default: false
                                   'maxWidth'=>array('type'=>array('boolean', 'integer')), // The maximum width to which the dialog can be resized, in pixels. Default: false
                                   'minHeight'=>array('type'=>array('boolean', 'integer')), // The minimum height to which the dialog can be resized, in pixels. Default: 150
                                   'minWidth'=>array('type'=>array('boolean', 'integer')), // The minimum width to which the dialog can be resized, in pixels. Default: 150
                                   'modal'=>array('type'=>'boolean'), // If set to true, the dialog will have modal behavior; other items on the page will be disabled (i.e. cannot be interacted with). Modal dialogs create an overlay below the dialog but above other page elements. Default: false
                                   'position'=>array('type'=>array('string', 'array')), //Specifies where the dialog should be displayed. Possible values: 'center', 'left', 'right', 'top', 'bottom', or an array containing a coordinate pair (in pixel offset from top left of viewport) or the possible string values (e.g. ['right','top'] for top right corner). Default: 'center'
                                   'resizable'=>array('type'=>'boolean'), // If set to true, the dialog will be resizeable. Default: true
                                   'show'=>array('type'=>'string'), // The effect to be used when the dialog is opened. Default: null
                                   'stack'=>array('type'=>'boolean'), // Specifies whether the dialog will stack on top of other dialogs. This will cause the dialog to move to the front of other dialogs when it gains focus. Default: true
                                   'title'=>array('type'=>'string'), // Specifies the title of the dialog. The title can also be specified by the title attribute on the dialog source element. Default: ""
                                   'width'=>array('type'=>'integer'), // The width of the dialog, in pixels. Default: 300
                                   'zIndex'=>array('type'=>'integer'), // The starting z-index for the dialog. Default: 1000
                                  );

   /**
    * See @link http://docs.jquery.com/UI/Dialog/dialog#options
    *
    * @var array
    */
   protected $validCallbacks = array(
                                     'beforeclose', // This event is triggered when a dialog attempts to close. If the beforeclose event handler (callback function) returns false, the close will be prevented.
                                     'open', // This event is triggered when dialog is opened.
                                     'focus', // This event is triggered when the dialog gains focus.
                                     'dragStart', // This event is triggered at the beginning of the dialog being dragged.
                                     'drag', // This event is triggered when the dialog is dragged.
                                     'dragStop', // This event is triggered after the dialog has been dragged.
                                     'resizeStart', // This event is triggered at the beginning of the dialog being resized.
                                     'resize', // This event is triggered when the dialog is resized.
                                     'resizeStop', // This event is triggered after the dialog has been resized.
                                     'close', // This event is triggered when the dialog is closed.
                                    );
                               
   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @param string $value body
    */
   public function setBody($value)
   {
      $this->body = strval($value);
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getBody()
   {
      return $this->body;
   }

   /**
    * Setter
    *
    * @param array $value buttons
    */
   public function setButtons($value)
   {
      if (!is_array($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'buttons must be an array'));
      $this->buttons = $value;
   }

   /**
    * Getter
    *
    * @return array
    */
   public function getButtons()
   {
      return $this->buttons;
   }

   //***************************************************************************
   // Utilities
   //***************************************************************************

   /**
    * Generates the options for the jQuery widget
    *
    * @return string
    */
   protected function makeOptions()
   {
      $options = array();
      $buttons = array();

      foreach ($this->callbacks as  $key=>$val) {
         $options['callback_'.$key] = $key;
      }

      if (!empty($this->buttons)) {
         $options['buttons'] = 'buttons';
      }

      $encodedOptions = CJavaScript::encode(array_merge($options, $this->options));

      foreach ($this->callbacks as $key=>$val) {
         $encodedOptions = str_replace("'callback_{$key}':'{$key}'", "{$key}: {$val}", $encodedOptions);
      }

      if (!empty($this->buttons)) {
         $b = array();
         foreach ($this->buttons as $key=>$val) {
            $b[] = "'{$key}'".':'.str_replace(array("\n", "\r", "\t"), '', $val);
         }
         $buttons = "'buttons':{" . implode(',', $b) . '}';
      }
      $encodedOptions = str_replace("'buttons':'buttons'", $buttons, $encodedOptions);

      return $encodedOptions;
   }

   /**
    * Generates the javascript code for the widget
    *
    * @return string
    */
   protected function jsCode($id)
   {
      $options = $this->makeOptions();      
      $script =<<<EOP
$('#{$id}').dialog({$options});
EOP;
      return $script;
   }

   /**
    * Generates the HTML markup for the widget
    *
    * @return string
    */
   protected function htmlCode($id)
   {
      $this->htmlOptions['id'] = $id;
      $html = CHtml::tag('div', $this->htmlOptions, $this->body);
      return $html;
   }

   //***************************************************************************
   // Run Lola, Run
   //***************************************************************************

   /**
    * Init the widget. Capture the body.
    */
   public function init()
   {
      ob_start();
   }

   /**
    * Run the widget
    */
   public function run()
   {
      if (is_null($this->body)) {
         $this->body = ob_get_contents();
         ob_end_clean();
      }
      else {
         ob_end_flush();
      }

      list($name, $id) = $this->resolveNameID();

      $this->publishAssets();
      $this->registerClientScripts();

      $js = $this->jsCode($name);
      $this->clientScript->registerScript('Yii.'.get_class($this).'#'.$id, $js, CClientScript::POS_READY);

      $html = $this->htmlCode($id);
      echo $html;
   }
}