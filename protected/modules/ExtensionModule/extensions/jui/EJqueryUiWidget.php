<?php
/**
 * EJqueryUiWidget class file.
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

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'IJqueryUiWidget.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'EJqueryUiConfig.php');

/**
 * Do you want to check your user parameters against the valid ones?
 */
define('_CHECK_JS_PARAMETERS_', true);

/**
 * EJqueryUiWidget is a base class for jQuery UI 1.7.1 widget wrappers.
 *
 * @author MetaYii
 * @package application.extensions.jui
 * @since 1.0.2
 */
class EJqueryUiWidget extends CInputWidget implements IJqueryUiWidget
{
   //***************************************************************************
   // Configuration
   //***************************************************************************

   /**
    * Options for each jQuery UI widget. This must be an associative array:
    *
    * $options['option'] = value;
    *
    * @var array
    */
   private $options = array();

   /**
    * Callbacks for each jQuery UI widget. This must be an associative array:
    *
    * $callbacks['callback'] = function;
    *
    * Where function is the code of a javascript function according to the
    * specifications of the widget.
    *
    * @var array
    */
   private $callbacks = array();

   //***************************************************************************
   // Internal properties
   //***************************************************************************

   /**
    * The base URL for the published assets
    *
    * @var string
    */
   protected $baseUrl = '';

   /**
    * The CClientScript instance
    *
    * @var CClientScript
    */
   protected $clientScript = null;

   /**
    * Possible valid options, according to the jQuery UI widget documentation
    *
    * @var array
    */
   protected $validOptions = array();

   /**
    * Possible valid callbacks, according to the jQuery UI widget documentation
    *
    * @var array
    */
   protected $validCallbacks = array();

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @var array $value options
    */
   public function setOptions($value)
   {
      if (!is_array($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'options must be an array'));
      if (_CHECK_JS_PARAMETERS_) self::checkOptions($value, $this->validOptions);
      $this->options = $value;
   }

   /**
    * Getter
    *
    * @return array
    */
   public function getOptions()
   {
      return $this->options;
   }

   /**
    * Setter
    *
    * @param array $value callbacks
    */
   public function setCallbacks($value)
   {
      if (!is_array($value))
         throw new CException(Yii::t('EJqueryUiWidget', 'callbacks must be an associative array'));
      if (_CHECK_JS_PARAMETERS_) self::checkCallbacks($value, $this->validCallbacks);
      $this->callbacks = $value;
   }

   /**
    * Getter
    *
    * @return array
    */
   public function getCallbacks()
   {
      return $this->callbacks;
   }

   /**
    * Sets the theme.
    *
    * You need to set exactly one theme in all your jQuery UI widgets. The first
    * theme defined will be used for all the widgets. A singleton is used to
    * enforce this.
    *
    * @param string $value theme
    */
   public function setTheme($value)
   {
      EJqueryUiConfig::singleton()->setTheme($value);
   }

   /**
    * Gets the theme from the singleton.
    *
    * @return <type>
    */
   public function getTheme()
   {
      return EJqueryUiConfig::singleton()->getTheme();
   }

   /**
    * Setter
    *
    * @param integer $value compression
    */
   public function setCompression($value)
   {
      EJqueryUiConfig::singleton()->setCompression($value);
   }

   /**
    * Getter
    *
    * @return integer
    */
   public function getCompression()
   {
      return EJqueryUiConfig::singleton()->getCompression();
   }

   /**
    * Setter
    *
    * @param boolean $value useBundledStyleSheet
    */
   public function setUseBundledStyleSheet($value)
   {
      EJqueryUiConfig::singleton()->setUseBundledStyleSheet($value);
   }

   /**
    * Getter
    *
    * @return boolean
    */
   public function getUseBundledStyleSheet()
   {
      return EJqueryUiConfig::singleton()->getUseBundledStyleSheet();
   }

   //***************************************************************************
   // Utilities
   //***************************************************************************

   /**
    * Check the options against the valid ones
    *
    * @param array $value user's options
    * @param array $validOptions valid options
    */
   protected static function checkOptions($value, $validOptions)
   {
      if (!empty($validOptions)) {         
         foreach ($value as $key=>$val) {
            if (!array_key_exists($key, $validOptions)) {
               throw new CException(Yii::t('EJqueryUiWidget', '{k} is not a valid option', array('{k}'=>$key)));
            }
            $type = gettype($val);
            if ((!is_array($validOptions[$key]['type']) && ($type != $validOptions[$key]['type'])) || (is_array($validOptions[$key]['type']) && !in_array($type, $validOptions[$key]['type']))) {
               throw new CException(Yii::t('EJqueryUiWidget', '{k} must be of type {t}', array('{k}'=>$key, '{t}'=>implode(',', (is_array($validOptions[$key]['type']))?implode(', ', $validOptions[$key]['type']):$validOptions[$key]['type']))));
            }
            if (array_key_exists('possibleValues', $validOptions[$key])) {
               if (!in_array($val, $validOptions[$key]['possibleValues'])) {
                  throw new CException(Yii::t('EJqueryUiWidget', '{k} must be one of: {v}', array('{k}'=>$key, '{v}'=>implode(', ', $validOptions[$key]['possibleValues']))));
               }
            }
            if (($type == 'array') && array_key_exists('elements', $validOptions[$key])) {
               self::checkOptions($val, $validOptions[$key]['elements']);
            }
         }
      }
   }

   /**
    * Check callbacks against the valid ones
    *
    * @param array $value user's callbacks
    * @param array $validCallbacks valid callbacks
    */
   protected static function checkCallbacks($value, $validCallbacks)
   {
      if (!empty($validCallbacks)) {
         foreach ($value as $key=>$val) {
            if (!in_array($key, $validCallbacks)) {
               throw new CException(Yii::t('EJqueryUiWidget', '{k} must be one of: {c}', array('{k}'=>$key, '{c}'=>implode(', ', $validCallbacks))));
            }
         }
      }
   }

   /**
    * Publishes the assets
    */
   public function publishAssets()
   {
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'jquery';
      $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
   }

   /**
    * Registers the external javascript files
    */
   public function registerClientScripts()
   {
      if ($this->baseUrl === '')
         throw new CException(Yii::t('EJqueryUiWidget', 'baseUrl must be set. This is done automatically by calling publishAssets()'));

      $this->clientScript = Yii::app()->getClientScript();

      $this->clientScript->registerCoreScript('jquery');

      switch ($this->getCompression()) {
         case 'none':
            $this->clientScript->registerScriptFile($this->baseUrl.'/js/jquery-ui-1.7.1.custom.js');
            break;

         case 'packed';
            $this->clientScript->registerScriptFile($this->baseUrl.'/js/jquery-ui-1.7.1.custom.packed.js');
            break;

         default:
            $this->clientScript->registerScriptFile($this->baseUrl.'/js/jquery-ui-1.7.1.custom.min.js');
            break;
      }
      
      if ($this->getUseBundledStyleSheet()) {
         $this->clientScript->registerCssFile($this->baseUrl.'/css/'.$this->getTheme().'/jquery-ui-1.7.1.custom.css');
      }
   }
}