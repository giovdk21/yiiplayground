<?php
/**
 * EDatePicker class file.
 *
 * @author MetaYii
 * @version 2.4.2
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
 * EDatePicker is a Yii widget which encapsulates the functionality of the
 * jQuery UI datepicker widget to generate a date picker.
 *
 * Works with jQuery 1.3 and jQuery UI 1.7
 *
 * @link http://docs.jquery.com/UI/Datepicker
 *
 * @author MetaYii
 * @package application.extensions.jui
 * @since 1.0.2
 */
class EDatePicker extends EJqueryUiWidget
{
   //***************************************************************************
   // Configuration
   //***************************************************************************

   /**
    * In case a button is used, use just the button or both button and focus
    * methods. Possible values: 'button', 'both'
    * 
    * @var string
    */
   private $showOn = 'both';

   /**
    * How to show:
    *
    * focus - show calendar on focus
    * button - show calendar when a button is clicked
    * imagebutton - show calendar when an image is clicked
    * 
    * @var string
    */
   private $mode = 'button';

   /**
    * The URL for the image used in the imagebutton mode.
    *
    * @var string
    */
   public $image = '';

   /**
    * The language for the widget.
    *
    * @var string the language suffix
    */
   private $language = 'en';

   /**
    * The date format. This is a string in a date() style, where you can use
    * these letters as the formatters:
    *
    * d - day of month (no leading zero)
    * dd - day of month (two digit)
    * D - day name short
    * DD - day name long
    * m - month of year (no leading zero)
    * mm - month of year (two digit)
    * M - month name short
    * MM - month name long
    * y - year (two digit)
    * yy - year (four digit)
    * '...' - literal text
    * '' - single quote
    *
    * You can also use these special strings for some preset formats:
    *
    * ATOM
    * COOKIE
    * ISO_8601
    * RFC_822
    * RFC_850
    * RFC_1036
    * RFC_1123
    * RFC_2822
    * RSS
    * TIMESTAMP
    * W3C
    *
    * @var string the format
    */
   private $dateFormat = 'ISO_8601';

   /**
    * Minimun date in a range
    *
    * @var string
    */
   public $minDate = '';

   /**
    * Maximun date in a range
    *
    * @var string
    */
   public $maxDate = '';

   /**
    * The font size. This also controls the size of the widget.
    *
    * @var string
    */
   public $fontSize = '0.5em';

   /**
    * Enable or disable the widget
    *
    * @var boolean
    */
   private $enabled = true;

   /**
    * Display effects.
    * See {@link http://docs.jquery.com/UI/Datepicker/datepicker#options}
    *
    * Possible values: show, slideDown, fadeIn
    *
    * @var string
    */
   private $effect = 'slideDown';

   /**
    * Optional array of effect options.
    * See {@link http://docs.jquery.com/UI/Datepicker/datepicker#options}
    *
    * Format: key => value
    *
    * @var array
    */
   private $effectOptions = array();

   //***************************************************************************
   // Internal properties (not for configuration)
   //***************************************************************************

   /**
    * Whetever to use a special preset format or not
    *
    * @var boolean
    */
   private $useSpecialFormat = true;

   /**
    * Valid effects
    *
    * @var array
    */
   private $validEffects = array('show', 'slideDown', 'fadeIn', 'blind', 'clip', 'drop', 'explode', 'fold', 'puff', 'slide', 'scale', 'size', 'pulsate', 'bounce', 'shake');

   /**
    * Valid languages
    *
    * @var array
    */
   private $validLanguages = array('ar','bg','ca','cs','da','de','el','eo','es','fa','fi','fr','he','hr','hu','hy','id','is','it','ja','ko','lt','lv','ms','nl','no','pl','pt-BR','ro','ru','sk','sl','sq','sv','th','tr','uk','zh-CN','zh-TW');

   /**
    * Preset formats (shortcuts)
    * 
    * @var array
    */
   private $validPresetDateFormats = array('ATOM','COOKIE','ISO_8601','RFC_822','RFC_850','RFC_1036','RFC_1123','RFC_2822','RSS','TIMESTAMP','W3C');

   /**
    * Valid modes
    * 
    * @var array
    */
   private $validModes = array('focus', 'button', 'imagebutton');

   /**
    * See @link http://docs.jquery.com/UI/Datepicker/datepicker#options
    *
    * @var array
    */
   protected $validOptions = array(
                                   'altField'=>array('type'=>'string'), // The jQuery selector for another field that is to be updated with the selected date from the datepicker. Use the altFormat setting below to change the format of the date within this field. Leave as blank for no alternate field. Default: ""
                                   'altFormat'=>array('type'=>'string'), // The dateFormat to be used for the altField option. This allows one date format to be shown to the user for selection purposes, while a different format is actually sent behind the scenes. For a full list of the possible formats see the formatDate function . Default: ""
                                   'appendText'=>array('type'=>'string'), // The text to display after each date field, e.g. to show the required format. Default: ""
                                   'buttonImage'=>array('type'=>'string'), // The URL for the popup button image. If set, button text becomes the alt value and is not directly displayed. Default: ""
                                   'buttonImageOnly'=>array('type'=>'boolean'), // Set to true to place an image after the field to use as the trigger without it appearing on a button. Default: false
                                   'buttonText'=>array('type'=>'string'), // The text to display on the trigger button. Use in conjunction with showOn equal to 'button' or 'both'. Default: "..."
                                   'changeMonth'=>array('type'=>'boolean'), // Allows you to change the month by selecting from a drop-down list. You can enable this feature by setting the attribute to true. Default: false
                                   'changeYear'=>array('type'=>'boolean'), // Allows you to change the year by selecting from a drop-down list. You can enable this feature by setting the attribute to true. Default: true
                                   'closeText'=>array('type'=>'string'), // The text to display for the close link. This attribute is one of the regionalisation attributes. Use the showButtonPanel to display this button. Default: "Done"
                                   'constrainInput'=>array('type'=>'boolean'), // Initialize a datepicker with the constrainInput option specified. Default: true
                                   'currentText'=>array('type'=>'string'), // The text to display for the current day link. This attribute is one of the regionalisation attributes. Use the showButtonPanel to display this button. Default: "Today"
                                   'dateFormat'=>array('type'=>'string'), // The format for parsed and displayed dates. This attribute is one of the regionalisation attributes. For a full list of the possible formats see the formatDate function. Default: 'mm/dd/yy'
                                   'dayNames'=>array('type'=>'array'), // The list of long day names, starting from Sunday, for use as requested via the dateFormat setting. They also appear as popup hints when hovering over the corresponding column headings. This attribute is one of the regionalisation attributes. Default: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
                                   'dayNamesMin'=>array('type'=>'array'), // The list of minimised day names, starting from Sunday, for use as column headers within the datepicker. This attribute is one of the regionalisation attributes. Default: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']
                                   'dayNamesShort'=>array('type'=>'array'), // The list of abbreviated day names, starting from Sunday, for use as requested via the dateFormat setting. This attribute is one of the regionalisation attributes. Default ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
                                   'defaultDate'=>array('type'=>array('string', 'integer')), // Set the date to highlight on first opening if the field is blank. Specify either an actual date via a Date object, or a number of days from today (e.g. +7) or a string of values and periods ('y' for years, 'm' for months, 'w' for weeks, 'd' for days, e.g. '+1m +7d'), or null for today. Default: null
                                   'duration'=>array('type'=>array('string', 'integer')), // Control the speed at which the datepicker appears, it may be a time in milliseconds, a string representing one of the three predefined speeds ("slow", "normal", "fast"), or '' for immediately. Default: 'normal'
                                   'firstDay'=>array('type'=>'integer'), // Set the first day of the week: Sunday is 0, Monday is 1, ... This attribute is one of the regionalisation attributes. Default: 0
                                   'gotoCurrent'=>array('type'=>'boolean'), // If true, the current day link moves to the currently selected date instead of today. Default: false
                                   'hideIfNotPrevNext'=>array('type'=>'boolean'), // Normally the previous and next links are disabled when not applicable (see minDate/maxDate). You can hide them altogether by setting this attribute to true. Default: false
                                   'isRTL'=>array('type'=>'boolean'), // True if the current language is drawn from right to left. This attribute is one of the regionalisation attributes. Default: false
                                   'maxDate'=>array('type'=>array('string', 'integer')), // Set a maximum selectable date via a Date object, or a number of days from today (e.g. +7) or a string of values and periods ('y' for years, 'm' for months, 'w' for weeks, 'd' for days, e.g. '+1m +1w'), or null for no limit. Default: null
                                   'minDate'=>array('type'=>array('string', 'integer')), // Set a minimum selectable date via a Date object, or a number of days from today (e.g. +7) or a string of values and periods ('y' for years, 'm' for months, 'w' for weeks, 'd' for days, e.g. '-1y -1m'), or null for no limit. Default: null
                                   'monthNames'=>array('type'=>'array'), // The list of full month names, as used in the month header on each datepicker and as requested via the dateFormat setting. This attribute is one of the regionalisation attributes. Default: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
                                   'monthNamesShort'=>array('type'=>'array'), // The list of abbreviated month names, for use as requested via the dateFormat setting. This attribute is one of the regionalisation attributes. Default: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                   'navigationAsDateFormat'=>array('type'=>'boolean'), // When true the formatDate function is applied to the prevText, nextText, and currentText values before display, allowing them to display the target month names for example. Default: false
                                   'nextText'=>array('type'=>'string'), // The text to display for the next month link. This attribute is one of the regionalisation attributes. With the standard ThemeRoller styling, this value is replaced by an icon. Default: "Next"
                                   'numberOfMonths'=>array('type'=>array('integer', 'array')), // Set how many months to show at once. The value can be a straight integer, or can be a two-element array to define the number of rows and columns to display. Default: 0
                                   'prevText'=>array('type'=>'string'), // The text to display for the previous month link. This attribute is one of the regionalisation attributes. With the standard ThemeRoller styling, this value is replaced by an icon. Default: "Prev"
                                   'shortYearCutoff'=>array('type'=>array('string', 'integer')), // Set the cutoff year for determining the century for a date (used in conjunction with dateFormat 'y'). If a numeric value (0-99) is provided then this value is used directly. If a string value is provided then it is converted to a number and added to the current year. Once the cutoff year is calculated, any dates entered with a year value less than or equal to it are considered to be in the current century, while those greater than it are deemed to be in the previous century. Default: "+10"
                                   'showAnim'=>array('type'=>'string'), // Set the name of the animation used to show/hide the datepicker. Use 'show' (the default), 'slideDown', 'fadeIn', or any of the show/hide jQuery UI effects. Default: "show"
                                   'showButtonPanel'=>array('type'=>'boolean'), // Whether to show the button panel. Default: false
                                   'showCurrentAtPos'=>array('type'=>'integer'), // Specify where in a multi-month display the current month shows, starting from 0 at the top/left. Default: 0
                                   'showMonthsAfterYear'=>array('type'=>'boolean'), // Whether to show the month after the year in the header. Default: false
                                   'showOn'=>array('type'=>'string', 'possibleValues'=>array('button', 'both')), // Have the datepicker appear automatically when the field receives focus ('focus'), appear only when a button is clicked ('button'), or appear when either event takes place ('both'). Default: "focus"
                                   'showOptions'=>array('type'=>'array'), // If using one of the jQuery UI effects for showAnim, you can provide additional settings for that animation via this option. Default: {}
                                   'showOtherMonths'=>array('type'=>'boolean'), // Display dates in other months (non-selectable) at the start or end of the current month. Default: false
                                   'stepMonths'=>array('type'=>'number'), // Set how many months to move when clicking the Previous/Next links. Default: 1
                                   'yearRange'=>array('type'=>'string') // Control the range of years displayed in the year drop-down: either relative to current year (-nn:+nn) or absolute (nnnn:nnnn). Default: '-10:+1'
                                  );

   /**
    * See @link http://docs.jquery.com/UI/Datepicker/datepicker#options
    *
    * @var array
    */
   protected $validCallbacks = array(
                                     'beforeShow',
                                     'beforeShowDay',
                                     'onSelect',
                                     'onChangeMonthYear',
                                     'onClose',
                                    );

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($owner=null)
   {
      parent::__construct($owner);
      $this->setLanguage(Yii::app()->language);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    * 
    * @param string $value effect
    */
   public function setEffect($value)
   {
      if (!in_array($value, $this->validEffects))
         throw new CException(Yii::t('EJqueryUiWidget', 'effect must be one of: {e}', array('{e}'=>implode(', ', $this->validEffects))));
      $this->effect = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getEffect()
   {
      return $this->effect;
   }

   /**
    * Setter
    *
    * @param array $value effectOptions
    */
   public function setEffectOptions($value)
   {
      if (!is_array($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'effectOptions must be an array'));
      $this->effectOptions = $value;
   }

   /**
    * Getter
    *
    * @return array
    */
   public function getEffectOptions()
   {
      return $this->effectOptions;
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

   /**
    * Setter
    *
    * @param string $value showOn
    */
   public function setShowOn($value)
   {
      if ($value !== 'button' && $value !== 'both')
         throw new CException(Yii::t('EJqueryUiWidget', 'showOn must be one of: "button", "both"'));
      $this->showOn = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getShowOn()
   {
      return $this->showOn;
   }

   /**
    * Setter
    *
    * @param string $value mode
    */
   public function setMode($value)
   {
      if (!in_array($value, $this->validModes))
         throw new CException(Yii::t('EJqueryUiWidget', 'mode must be one of: {m}', array('{m}'=>implode(', ', $this->validModes))));
      $this->mode = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getMode()
   {
      return $this->mode;
   }

   /**
    * Setter
    *
    * @param string $value dateFormat
    */
   public function setDateFormat($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'dateFormat must be a string'));
      $this->useSpecialFormat = in_array($value, $this->validPresetDateFormats);
      $this->dateFormat = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getDateFormat()
   {
      return $this->dateFormat;
   }

   /**
    * Setter
    *
    * @param string $value language
    */
	public function setLanguage($value)
	{
      $lang = (($p = strpos($value, '_')) !== false) ? str_replace('_', '-', $value) : $value;
      if (in_array($lang, $this->validLanguages)) {
         $this->language = $lang;
      }
      else {
         $suffix = empty($lang) ? 'en' : ($p !== false) ? strtolower(substr($lang, 0, $p)) : strtolower($lang);
         if (in_array($suffix, $this->validLanguages)) $this->language = $suffix;
      }
	}

	/**
	 * Getter
	 *
	 * @return string
	 */
	public function getLanguage()
	{
	   return $this->language;
	}

   //***************************************************************************
   // Utilities
   //***************************************************************************

   /**
    * Encode an array into a javascript array
    *
    * @param array $value
    * @return string
    */
	private static function encode($value)
	{
      $es = array();
      $n = count($value);
      if (($n) > 0 && array_keys($value) !== range(0, $n-1)) {
         foreach($value as $k=>$v) {
            if (is_array($v)) {
                 $es[] = $k . ':' . self::encode($v);
            }
            elseif ($k === 'yearRange') {
               $es[] = $k . ':' . "'" . $v . "'";
            }
            else {
               $es[] = $k . ':' . $v;
            }
         }
         return '{' . implode(',', $es) . '}';
      }
      else {
         foreach($value as $v) {
            $es[] = "'" . $v . "'";
         }
         return '[' . implode(',', $es) . ']';
      }
	}

   /**
    * Generates the options for the jQuery widget
    *
    * @return string
    */
   protected function makeOptions()
   {
      $options = array();
      if (is_string($this->minDate) && $this->minDate !== '') {
         $options['minDate'] = "'" . $this->minDate . "'";         
      }
      if (is_string($this->maxDate) && $this->maxDate !== '') {
         $options['maxDate'] = "'" . $this->maxDate . "'";
      }

      if ($this->effect !== 'show') {
         $options['showAnim'] = "'" . $this->effect . "'";
         if (!empty($this->effectOptions)) {
            $eo = self::encode($this->effectOptions);
            $options['showOptions'] = $eo;
         }
      }

      $options['dateFormat'] = $this->useSpecialFormat ? '$.datepicker.'.$this->dateFormat : "'" . $this->dateFormat . "'";

      switch ($this->mode) {
         case 'focus':
            break;

         case 'button':
            $options['showOn'] = "'" . $this->showOn . "'";
            break;

         case 'imagebutton':
            if ($this->image === '') {
               $this->image = $this->baseUrl.'/images/calendar.gif';
            }
            $options['showOn'] = "'" . $this->showOn . "'";
            $options['buttonImage'] = "'" . $this->image . "'";
            $options['buttonImageOnly'] = 'true';
            break;
      }

      foreach ($this->callbacks as  $key=>$val) {
         $options['callback_'.$key] = $key;
      }

      $encodedOptions = self::encode(array_merge($options, $this->options));
      
      foreach ($this->callbacks as $key=>$val) {
         $encodedOptions = str_replace("callback_{$key}:{$key}", "{$key}: {$val}", $encodedOptions);
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
      $enabled = $this->enabled ? '' : '.datepicker("disable")';
      $fontSize = '';

      $options = $this->makeOptions();
 
      $js =<<<EOP
$("#{$id}").datepicker({$options}){$enabled};
EOP;

      if (is_string($this->fontSize) && !empty($this->fontSize)) {
         $fontSize =<<<EOP
$("#ui-datepicker-div").css("font-size", "{$this->fontSize}");
EOP;
         $js .= $fontSize;
      }

      return $js;
   }

   /**
    * Generates the HTML markup for the widget
    *
    * @param string $id
    * @return string
    */
   protected function htmlCode($id, $name)
   {
      $this->htmlOptions['id'] = $id;
      $this->htmlOptions['size'] = !isset($this->htmlOptions['size']) ? 10 : $this->htmlOptions['size'];
      $this->htmlOptions['maxlength'] = !isset($this->htmlOptions['maxlength']) ? 10 : $this->htmlOptions['maxlength'];

      if ($this->hasModel())
         $html = CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
      else
         $html = CHtml::textField($name, $this->value, $this->htmlOptions);

      return $html;
   }

   public function registerClientScripts()
   {
      parent::registerClientScripts();
      if ($this->language !== '') {
         $this->clientScript->registerScriptFile("{$this->baseUrl}/js/i18n/ui.datepicker-{$this->language}.js");
      }
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

      $html = $this->htmlCode($id, $name);
      echo $html;
   }
}