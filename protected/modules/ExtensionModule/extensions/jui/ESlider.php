<?php
/**
 * ESlider class file.
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
 * ESlider is a Yii widget which encapsulates the functionality of the jQuery UI
 * slider widget to generate a dialog.
 *
 * Works with jQuery 1.3 and jQuery UI 1.7
 *
 * @link http://docs.jquery.com/UI/Slider
 *
 * @author MetaYii
 * @package application.extensions.jui
 * @since 1.0.2
 */
class ESlider extends EJqueryUiWidget
{
   //***************************************************************************
   // Configuration
   //***************************************************************************

   /**
    * The value of the control. You can pass an float value if you have
    * one handler, o you can pass an array of floats if you have several
    * handlers. For instance, array(13,45,24) sets the first handler to 13, the 
    * second to 45 and the third to 24.
    *
    * @var mixed
    */
   public $value = null;

   /**
    * Enable or disable the widget
    *
    * @var boolean
    */
   private $enabled = true;

   /**
    * The minimun value for the slider
    *
    * @var float
    */
   private $minValue = -100;

   /**
    * The maximun value for the slider
    *
    * @var float
    */
   private $maxValue = 100;

   /**
    * Alternative to stepping, this defines how many steps a slider will have,
    * instead of how many values to jump
    *
    * @var float
    */
   private $step = 1;

   /**
    * Whetever to use a range or not
    *
    * @var boolean
    */
   private $range = false;

   /**
    * Whether slide handle smoothly when user click outside handle on the bar.
    *
    * @var boolean
    */
   private $animate = false;

   /**
    * How many handlers will we use
    *
    * @var float
    */
   private $numberOfHandlers = 1;

   /**
    * This can be a string or an array of strings, and is used to pass the IDs
    * of the elements which will show the values of the handlers. It's most
    * useful, if you're using forms, if these elements are text fields (input
    * form tags of text type)
    *
    * @var mixed
    */
   private $linkedElements = null;

   /**
    * This is the string ID of the element (usually a text field) which will
    * get the range value. This only works when $numberOfHandlers == 2 and
    * range == true
    *
    * @var string
    */
   private $linkedRangeElement = null;

   /**
    * When to show the value on the linked elements: 
    * 
    * 'slide' (when you drag the handlers)
    * 'change' (when you release the mouse button)
    * 
    * @var string
    */
   private $showValueOn = 'slide';

   //***************************************************************************
   // Internal properties (not for configuration)
   //***************************************************************************

   /**
    * See @link http://docs.jquery.com/UI/Slider/slider#options
    *
    * @var array
    */
   protected $validOptions = array(
                                   'animate'=>array('type'=>'boolean'), // Whether to slide handle smoothly when user click outside handle on the bar. Default: false
                                   'max'=>array('type'=>'integer'), // The maximum value of the slider. Default: 100
                                   'min'=>array('type'=>'integer'), // The minimum value of the slider. Default: 0
                                   'orientation'=>array('type'=>'string'), // Normally you don't need to set this option because the plugin detects the slider orientation automatically. If the orientation is not correctly detected you can set this option to 'horizontal' or 'vertical'. Default: 'auto'
                                   'range'=>array('type'=>array('string', 'boolean')), // If set to true, the slider will detect if you have two handles and create a stylable range element between these two. Two other possible values are 'min' and 'max'. A min range goes from the slider min to one handle. A max range goes from one handle to the slider max. Default: false
                                   'step'=>array('type'=>'integer'), // Determines the size or amount of each interval or step the slider takes between min and max. The full specified value range of the slider (max - min) needs to be evenly divisible by the step. Default: 1
                                   'value'=>array('type'=>'integer'), // Determines the value of the slider, if there's only one handle. If there is more than one handle, determines the value of the first handle. Default: 0
                                   'values'=>array('type'=>'array'), // This option can be used to specify multiple handles. If range is set to true, the length of 'values' should be 2. Default: null
                                  );

   /**
    * See @link http://docs.jquery.com/UI/Slider/slider#options
    *
    * @var array
    */
   protected $validCallbacks = array(
                                     'start', // Function that gets called when the user starts sliding.
                                     'slide', // Function that gets called on every mouse move during slide. Takes arguments e and ui, for event and user-interface respectively. Use ui.value (single-handled sliders) to obtain the value of the current handle, $(..).slider('value', index) to get another handles' value.
                                     'change', // Function that gets called on slide stop, but only if the slider position has changed. Takes arguments e and ui, for event and user-interface respectively. Use ui.value (single-handled sliders) to obtain the value of the current handle, $(..).slider('value', index) to get another handles' value.
                                     'stop', // Function that gets called when the user stops sliding.
                                    );

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @param string $value showValueOn
    */
   public function setShowValueOn($value)
   {
      if ($value !== 'slide' && $value !== 'change')
         throw new CException(Yii::t('EJqueryUiWidget', 'showValueOn must be one of: "slide", "change"'));
      $this->showValueOn = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getShowValueOn()
   {
      return $this->showValueOn;
   }

   /**
    * Setter
    *
    * @param string $value linkedRangeElement
    */
   public function setLinkedRangeElement($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'linkedRangeElement must be a non-empty string'));
      $this->linkedRangeElement = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getLinkedRangeElement()
   {
      return $this->linkedRangeElement;
   }

   /**
    * Setter
    *
    * @param mixed $value linkedElements
    */
   public function setLinkedElements($value)
   {
      if (!is_string($value) && !is_array($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'linkedElements must be an array of strings or a string'));
      $this->linkedElements = $value;
   }

   /**
    * Getter
    *
    * @return mixed
    */
   public function getLinkedElements()
   {
      return $this->linkedElements;
   }

   /**
    * Setter
    *
    * @param integer $value numberOfHandlers
    */
   public function setNumberOfHandlers($value)
   {
      if (!is_int($value) || intval($value)<1)
         throw new CException(Yii::t('EJqueryUiWidget', 'numberOfHandlers must be an integer'));
      $this->numberOfHandlers = $value;
   }

   /**
    * Getter
    *
    * @return integer numberOfHandlers
    */
   public function getNumberOfHandlers()
   {
      return $this->numberOfHandlers;
   }

   /**
    * Setter
    *
    * @param boolean $value animate
    */
   public function setAnimate($value)
   {
      if (!is_bool($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'animate must be boolean'));
      $this->animate = $value;
   }

   /**
    * Getter
    *
    * @return boolean
    */
   public function getAnimate()
   {
      return $this->animate;
   }

   /**
    * Setter range
    *
    * @param boolean $value
    */
   public function setRange($value)
   {
      if (!is_bool($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'range must be boolean'));
      $this->range = $value;
   }

   /**
    * Getter
    *
    * @return boolean
    */
   public function getRange()
   {
      return $this->range;
   }

   /**
    * Setter step
    *
    * @param integer $value
    */
   public function setStep($value)
   {
      if (!is_float($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'step must be float'));
      $this->step = $value;
   }

   /**
    * Getter
    *
    * @return integer
    */
   public function getStep()
   {
      return $this->step;
   }

   /**
    * Setter
    *
    * @param integer $value minValue
    */
   public function setMinValue($value)
   {
      if (!is_float($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'minValue must be float'));
      $this->minValue = $value;
   }

   /**
    * Getter
    *
    * @return integer
    */
   public function getMinValue()
   {
      return $this->minValue;
   }

   /**
    * Setter
    *
    * @param integer $value maxValue
    */
   public function setMaxValue($value)
   {
      if (!is_float($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'maxValue must be float'));
      $this->maxValue = $value;
   }

   /**
    * Getter
    *
    * @return integer
    */
   public function getMaxValue()
   {
      return $this->maxValue;
   }

   /**
    * Setter
    *
    * @param boolean $value enabled
    */
   public function setEnabled($value)
   {
      if (!is_bool($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'enabled must be boolean'));
      $this->enabled = $value;
   }

   /**
    * Getter
    *
    * @return boolean
    */
   public function getEnabled()
   {
      return $this->enabled;
   }

   //***************************************************************************
   // Utilities
   //***************************************************************************

   /**
    * Generates the options for the jQuery widget
    *
    * @param string $id id
    * @return string
    */
   protected function makeOptions($id)
   {
      $hasChangeCallback = false;
      $assignments = array();

      $options = array();
      $options['min'] = $this->minValue;
      $options['max'] = $this->maxValue;
      $options['range'] = $this->range ? 'true' : 'false';
      $options['step'] = $this->step;
      $options['animate'] = $this->animate ? 'true' : 'false';
      if (!is_array($this->value) && !is_null($this->value)) {         
         $this->value = array($this->value);
      }
      $options['values'] = $this->value;
      
      if (is_array($this->linkedElements) && !empty($this->linkedElements)) {         
         $c = count($this->linkedElements);
         for ($i=0; $i<$c; $i++) {
            $assignments[] = '$("#'.strval($this->linkedElements[$i]).'").attr("value", $("#'.$id.'").slider("values", '.$i.'));';
         }
         $hasChangeCallback = true;
      }

      if ($this->numberOfHandlers === 2 &&  $this->range &&
          is_string($this->linkedRangeElement) && $this->linkedRangeElement !== '') {
         $assignments[] = '$("#'.strval($this->linkedRangeElement).'").attr("values", ui.range);';
         $hasChangeCallback = true;
      }

      if ($hasChangeCallback) {
         $options[$this->showValueOn] = $this->showValueOn;
         $funcall = "{$this->showValueOn}: function(e,ui) { ".implode('', $assignments)." }";
      }

      foreach ($this->callbacks as  $key=>$val) {
         $options['callback_'.$key] = $key;
      }

      $options = array_merge($options, $this->options);
      $encodedOptions = CJavaScript::encode($options);
      $encodedOptions = str_replace("'{$this->showValueOn}':'$this->showValueOn'", $funcall, $encodedOptions);

      foreach ($this->callbacks as $key=>$val) {
         $encodedOptions = str_replace("'callback_{$key}':'{$key}'", "{$key}: {$val}", $encodedOptions);
      }      

      return $encodedOptions;
   }

   /**
    * Generates the javascript code for the widget
    *
    * @param string $id id
    * @return string
    */
   protected function jsCode($id)
   {
      $mv = $js = '';
      $enabled = $this->enabled ? '' : '.slider("disable")';
      $options = $this->makeOptions($id);

      $this->value = (!is_array($this->value)) ? array($this->value) : $this->value;
      if (is_array($this->value)) {
         $c = count($this->value);
         for ($i=0; $i<$c && $i<$this->numberOfHandlers; $i++) {
            $val = floatval($this->value[$i]);
            $mv .=<<<EOP
$("#{$id}").slider("values", {$i}, {$val});
EOP;
         }
      }

      $js =<<<EOP
$("#{$id}").slider({$options}){$enabled};
EOP;
      if ($mv !== '') {
         $js .= "\n" . $mv;
      }
      return $js;
   }

   /**
    * Generates the HTML markup for the widget
    *
    * @param string $id
    * @return string
    */
   protected function htmlCode($id)
   {
      $this->htmlOptions['id'] = $id;

      $handlers = '';
      for ($i=0; $i<$this->numberOfHandlers; $i++) {
         $handlers .= CHtml::tag('div', array('class'=>'ui-slider-handle'), '', true);
      }

      $html = CHtml::tag('div', $this->htmlOptions, $handlers, true);

      return $html;
   }

   //***************************************************************************
   // Run Lola Run
   //***************************************************************************

   /**
    * Run the widget
    */
   public function run()
   {
      list($name, $id) = $this->resolveNameID();

      $this->publishAssets();
      $this->registerClientScripts();

      $js = $this->jsCode($id);      
      $this->clientScript->registerScript('Yii.'.get_class($this).'#'.$id, $js);
      
      $html = $this->htmlCode($id);
      echo $html;
   }
}