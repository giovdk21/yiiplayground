<?php
/**
 * EJqGrid class file.
 *
 * @author MetaYii
 * @version 0.1 beta
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2009 MetaYii
 * @license dual GPL (3.0 or later) and MIT, at your choice.
 * @license http://www.opensource.org/licenses/mit-license.php
 * @license http://www.opensource.org/licenses/gpl-3.0.php
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
 */

/**
 * This extension expects to find the jui extension in application.extensions.jui
 * If you placed the extension somewhere else, just change the alias below:
 */
Yii::import('application.modules.ExtensionModule.extensions.jui.EJqueryUiWidget');

/**
 * Do you want to check your user parameters against the valid ones?
 */
define('__CHECK_JS_PARAMETERS__', true);

/**
 * EJqGrid is a grid which uses jqGrid {see @link http://www.trirand.com/blog/}
 *
 * If your use XML or JSON data sources, you'll need to write an action which
 * takes the following GET parameters:
 *
 * * <b>nd</b> a timestamp (to avoid caching)
 * * <b>_search</b> whether to do search (boolean)
 * * <b>rows</b> how many rows we want to have into the grid
 * * <b>page</b> the requested page
 * * <b>sidx</b> ndex row - i.e. user click to sort
 * * <b>sord</b> the direction
 *
 * @author MetaYii
 * @since 1.0.4
 * @package application.extensions.jqgrid
 * @link http://www.trirand.com/blog/
 */
class EJqGrid extends EJqueryUiWidget
{
   //***************************************************************************
   // Configuration
   //***************************************************************************

   /**
    * jqGrid options.
    *
    * @var array
    */
   protected $options = array();

   /**
    * jqGrid navbar options. Example: {edit:false,add:false,del:false}
    *
    * @var array
    */
   protected $navBarOptions = array('edit'=>false, 'add'=>false, 'del'=>false);

   /**
    * Callback functions.
    *
    * @var array
    */
   protected $callbacks = array();

   /**
    * Whether to use a navbar in the bottom of the grid.
    *
    * @var boolean
    */
   protected $useNavBar = true;
   
   //***************************************************************************
   // Internal properties
   //***************************************************************************

   /**
    * Possible valid options, according to the jQuery UI widget documentation
    *
    * @var array
    */
   protected $validOptions = array(
                                   'url'=>array('type'=>'string'), // Default: ""
                                   'height'=>array('type'=>'integer'), // Default: 150
                                   'page'=>array('type'=>'integer'), // Default: 1
                                   'rowNum'=>array('type'=>'integer'), // Default: 20
                                   'records'=>array('type'=>'integer'), // Default: 0
                                   'pager'=>array('type'=>'string'), // Default: ""
                                   'pgbuttons'=>array('type'=>'boolean'), // Default: true
                                   'pginput'=>array('type'=>'boolean'), // Default: true
                                   'colModel'=>array('type'=>'array'), // Default: []
                                   'rowList'=>array('type'=>'array'), // Default: []
                                   'colNames'=>array('type'=>'array'), // Default: []
                                   'sortorder'=>array('type'=>'string'), // Default: "asc"
                                   'sortname'=>array('type'=>'string'), // Default: ""
                                   'datatype'=>array('type'=>'string', 'possibleValues'=>array('xml', 'json', 'local')), // Default: "xml"
                                   'mtype'=>array('type'=>'string'), // Default: "GET"
                                   'altRows'=>array('type'=>'boolean'), // Default: false
                                   'selarrrow'=>array('type'=>'array'), // Default: []
                                   'savedRow'=>array('type'=>'array'), // Default: []
                                   'shrinkToFit'=>array('type'=>'boolean'), // Default: true
                                   'xmlReader'=>array('type'=>'array'), // Default: {}
                                   'jsonReader'=>array('type'=>'array'), // Default: {}
                                   'subGrid'=>array('type'=>'boolean'), // Default: false
                                   'subGridModel'=>array('type'=>'array'), // Default: []
                                   'reccount'=>array('type'=>'integer'), // Default: 0
                                   'lastpage'=>array('type'=>'integer'), // Default: 0
                                   'lastsort'=>array('type'=>'integer'), // Default: 0
                                   'selrow'=>array('type'=>'integer'), // Default: null
                                   'viewrecords'=>array('type'=>'boolean'), // Default: false
                                   'loadonce'=>array('type'=>'boolean'), // Default: false
                                   'multiselect'=>array('type'=>'boolean'), // Default: false
                                   'multikey'=>array('type'=>'boolean'), // Default: false
                                   'editurl'=>array('type'=>'string'), // Default: null
                                   'search'=>array('type'=>'boolean'), // Default: false
                                   'searchdata'=>array('type'=>'array'), // Default: {}
                                   'caption'=>array('type'=>'string'), // Default: ""
                                   'hidegrid'=>array('type'=>'boolean'), // Default: true
                                   'hiddengrid'=>array('type'=>'boolean'), // Default: false
                                   'postData'=>array('type'=>'array'), // Default: {}
                                   'userData'=>array('type'=>'array'), // Default: {}
                                   'treeGrid'=>array('type'=>'boolean'), // Default: false
                                   'treeGridModel'=>array('type'=>'boolean'), // Default: 'nested'
                                   'treeReader'=>array('type'=>'array'), // Default: {}
                                   'treeANode'=>array('type'=>'integer'), // Default: -1
                                   'ExpandColumn'=>array('type'=>'string'), // Default: null
                                   'tree_root_level'=>array('type'=>'integer'), // Default: 0
                                   'prmNames'=>array('type'=>'array'), // Default: {page:"page",rows:"rows", sort: "sidx",order: "sord"},
                                   'forceFit'=>array('type'=>'boolean'), // Default: false
                                   'gridstate'=>array('type'=>'string'), // Default: "visible"
                                   'cellEdit'=>array('type'=>'false'), // Default: false
                                   'cellsubmit'=>array('type'=>'string'), // Default: "remote"
                                   'nv'=>array('type'=>'integer'), // Default: 0
                                   'loadui'=>array('type'=>'string'), // Default: "enable"
                                   'toolbar'=>array('type'=>array('boolean', 'string')), // Default: [false,""]
                                   'scroll'=>array('type'=>'boolean'), // Default: false
                                   'multiboxonly'=>array('type'=>'boolean'), // Default: false
                                   'deselectAfterSort'=>array('type'=>'boolean'), // Default: true
                                   'scrollrows'=>array('type'=>'boolean'), // Default: false
                                   'autowidth'=>array('type'=>'boolean'), // Default: false
                                  );

   /**
    * Valid navbar options
    *
    * @var array
    */
   protected $validNavBarOptions = array(
                                         'edit'=>array('type'=>'boolean'),
                                         'add'=>array('type'=>'boolean'),
                                         'del'=>array('type'=>'boolean')
                                        );

   /**
    * Possible valid callbacks, according to the jQuery UI widget documentation
    *
    * @var array
    */
   protected $validCallbacks = array(
                                     'beforeSelectRow',
                                     'onSelectRow',
                                     'onSortCol',
                                     'ondblClickRow',
                                     'onRightClickRow',
                                     'onPaging',
                                     'onSelectAll',
                                     'loadComplete',
                                     'gridComplete',
                                     'loadError',
                                     'loadBeforeSend',
                                     'afterInsertRow',
                                     'beforeRequest',
                                     'onHeaderClick',
                                    );

   /**
    * Base assets' URL.
    *
    * @var string
    */
   private $_baseUrl = '';

   /**
    * Client script object
    *
    * @var object
    */
   private $_clientScript = null;

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
    * @param string $value language
    */
   public function setLanguage($value)
	{
      EJqGridConfig::singleton()->setLanguage($value);
	}

	/**
	 * Getter
	 *
	 * @return string
	 */
	public function getLanguage()
	{
	   return EJqGridConfig::singleton()->getLanguage();
	}

   /**
    * Setter
    *
    * @param integer $value compression
    */
   public function setCompression($value)
   {
      EJqGridConfig::singleton()->setCompression($value);
    }

   /**
    * Getter
    *
    * @return integer
    */
   public function getCompression()
   {
      return EJqGridConfig::singleton()->getCompression();
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
      EJqGridConfig::singleton()->setTheme($value);
   }

   /**
    * Gets the theme from the singleton.
    *
    * @return <type>
    */
   public function getTheme()
   {
      return EJqGridConfig::singleton()->getTheme();
   }

   /**
    * Setter
    *
    * @param boolean $value useBundledStyleSheet
    */
   public function setUseBundledStyleSheet($value)
   {
      EJqGridConfig::singleton()->setUseBundledStyleSheet($value);
   }

   /**
    * Getter
    *
    * @return boolean
    */
   public function getUseBundledStyleSheet()
   {
      return EJqGridConfig::singleton()->getUseBundledStyleSheet();
   }

   /**
    * Setter
    *
    * @param array $value options
    */
   public function setOptions($value)
   {
      if (!is_array($value))
         throw new CException(Yii::t('EJqGrid', 'options must be an array'));
      if (__CHECK_JS_PARAMETERS__) self::checkOptions($value, $this->validOptions);
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
    * @param array $value navBarOptions
    */
   public function setNavBarOptions($value)
   {
      if (!is_array($value))
         throw new CException(Yii::t('EJqGrid', 'navBarOptions must be an array'));
      if (__CHECK_JS_PARAMETERS__) self::checkOptions($value, $this->validNavBarOptions);
      $this->navBarOptions = $value;
   }

   /**
    * Getter
    *
    * @return array
    */
   public function getNavBarOptions()
   {
      return $this->navBarOptions;
   }

   /**
    * Setter
    *
    * @param array $value callbacks
    */
   public function setCallbacks($value)
   {
      if (!is_array($value))
         throw new CException(Yii::t('EJqGrid', 'callbacks must be an array'));
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
    * Setter
    *
    * @param boolean $value useNavBar
    */
   public function setUseNavBar($value)
   {
      if (!is_bool($value))
         throw new CException(Yii::t('EJqGrid', 'useNavBar must be boolean'));
      $this->useNavBar = $value;
   }

   /**
    * Getter
    *
    * @return boolean
    */
   public function getUseNavBar()
   {
      return $this->useNavBar;
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
               throw new CException(Yii::t('EJqGrid', '{k} is not a valid option', array('{k}'=>$key)));
            }
            $type = gettype($val);
            if ((!is_array($validOptions[$key]['type']) && ($type != $validOptions[$key]['type'])) || (is_array($validOptions[$key]['type']) && !in_array($type, $validOptions[$key]['type']))) {
               throw new CException(Yii::t('EJqGrid', '{k} must be of type {t}', array('{k}'=>$key, '{t}'=>implode(',', (is_array($validOptions[$key]['type']))?implode(', ', $validOptions[$key]['type']):$validOptions[$key]['type']))));
            }
            if (array_key_exists('possibleValues', $validOptions[$key])) {
               if (!in_array($val, $validOptions[$key]['possibleValues'])) {
                  throw new CException(Yii::t('EJqGrid', '{k} must be one of: {v}', array('{k}'=>$key, '{v}'=>implode(', ', $validOptions[$key]['possibleValues']))));
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
               throw new CException(Yii::t('EjqGrid', '{k} must be one of: {c}', array('{k}'=>$key, '{c}'=>implode(', ', $validCallbacks))));
            }
         }
      }
   }

   /**
    * Publishes the assets
    */
   public function publishAssets()
   {
      parent::publishAssets();
      
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
      $this->_baseUrl = Yii::app()->getAssetManager()->publish($dir);
   }

   /**
    * Registers the external javascript files
    */
   public function registerClientScripts()
   {
      if ($this->_baseUrl === '') throw new CException(Yii::t('EJqGrid', 'baseUrl must be set. This is done automatically by calling publishAssets()'));

      parent::registerClientScripts();

      $files = array();
      $subdir = '';
      $subfile = '';

      $this->_clientScript = Yii::app()->getClientScript();
      
      $this->_clientScript->registerCoreScript('jquery');

      $this->_clientScript->registerCssFile($this->_baseUrl.'/css/ui.jqgrid.css');

      if ($this->getCompression() === 'none') {
         $this->_clientScript->registerScriptFile($this->_baseUrl.'/i18n/grid.locale-'.$this->getLanguage().'.js');
      }
      else {
         $subdir = 'min/';
         $subfile = '-min';
         $this->_clientScript->registerScriptFile($this->_baseUrl.'/i18n/min/grid.locale-'.$this->getLanguage().'.js');
      }

      $this->_clientScript->registerScriptFile($this->_baseUrl.'/js/jqModal.js');
      $this->_clientScript->registerScriptFile($this->_baseUrl.'/js/jqDnR.js');      

      $files[] = "{$subdir}grid.base{$subfile}.js"; // jqGrid base
      $files[] = "{$subdir}grid.common{$subfile}.js"; // jqGrid common for editing
      $files[] = "{$subdir}grid.formedit{$subfile}.js"; // jqGrid Form editing
      $files[] = "{$subdir}grid.inlinedit{$subfile}.js"; // jqGrid inline editing
      $files[] = "{$subdir}grid.celledit{$subfile}.js"; // jqGrid cell editing
      $files[] = "{$subdir}grid.subgrid{$subfile}.js"; // jqGrid subgrid
      $files[] = "{$subdir}grid.treegrid{$subfile}.js"; // jqGrid treegrid
      $files[] = "{$subdir}grid.custom{$subfile}.js"; // jqGrid custom
      $files[] = "{$subdir}grid.postext{$subfile}.js"; // jqGrid postext      
      $files[] = "{$subdir}grid.setcolumns{$subfile}.js"; // jqGrid setcolumns
      $files[] = "{$subdir}grid.import{$subfile}.js"; // jqGrid import
      $files[] = "{$subdir}jquery.fmatter{$subfile}.js"; // jqGrid formater
      $files[] = "{$subdir}json2{$subfile}.js"; // json utils
      $files[] = "{$subdir}JsonXml{$subfile}.js"; // xmljson utils

      $plugins[] = "jquery.contextmenu.js"; // jqGrid table to grid
      $plugins[] = "jquery.tablednd.js"; // jqGrid table to grid

      foreach ($files as $file) {
         $this->_clientScript->registerScriptFile($this->_baseUrl.'/js/'.$file);
      }

      foreach ($plugins as $file) {
         $this->_clientScript->registerScriptFile($this->_baseUrl.'/plugins/'.$file);
      }           
   }

   /**
    * Make the options javascript string.
    *
    * @return string
    */
   protected function makeOptions($id)
   {
      $options = array();

      if ($this->useNavBar)
         $options['pager'] = $id . '_pager';
      $options['imgpath'] = $this->_baseUrl . '/themes/' . $this->getTheme() . '/images/';

      $encodedOptions = CJavaScript::encode(array_merge($options, $this->options));
      
      return $encodedOptions;
   }

   /**
    * Generate the javascript code.
    *
    * @param string $id id
    * @return string
    */
   protected function jsCode($id)
   {
      $options = $this->makeOptions($id);
      $navOptions = CJavaScript::encode($this->navBarOptions);

      $nav = '';
      if ($this->useNavBar) {
         $nav = ".navGrid('#{$id}_pager', {$navOptions});";
      }

      $script =<<<EOP
$("#{$id}_grid").jqGrid({$options}){$nav};
EOP;

      return $script;
   }

   /**
    * Make the HTML code
    *
    * @param string $id id
    * @return string
    */
   protected function htmlCode($id)
   {
      $tableOptions = array('id'=>$id.'_grid', 'class'=>'scroll', 'cellpadding'=>0, 'cellspacing'=>0);
      $pagerOptions = array('id'=>$id.'_pager', 'class'=>'scroll', 'style'=>'text-align:center;');

      $html = CHtml::tag('table', $tableOptions, '', true) . "\n";
      if ($this->useNavBar)
         $html .= CHtml::tag('div', $pagerOptions, '', true);

      return $html;
   }

   //***************************************************************************
   // Run Lola, Run!
   //***************************************************************************

   /**
    * Render the widget
    */
   public function run()
   {
      list($name, $id) = $this->resolveNameID();

      $this->publishAssets();
      $this->registerClientScripts();

      $js = $this->jsCode($id);
      $html = $this->htmlCode($id);
      
      $this->_clientScript->registerScript('Yii.'.get_class($this).'#'.$id, $js, CClientScript::POS_READY);

      echo $html;
   }
}

//******************************************************************************

/**
 * Singleton for configuration
 */
class EJqGridConfig extends EJqueryUiConfig
{
   //***************************************************************************
   // Constants
   //***************************************************************************

   const DEFAULT_LANGUAGE = 'en';

   //***************************************************************************
   // Configuration
   //***************************************************************************

   /**
    * Locale code (see {@link $validLanguages})
    *
    * @var string
    */
   private $language = null;

   //***************************************************************************
   // Internal properties
   //***************************************************************************

   /**
    * The singleton instance.
    *
    * @var EJqueryUiTheme
    */
   private static $instance = null;

   /**
    * Valid plugin languages
    *
    * @var string
    */
   protected $validLanguages = array('bg', 'cs', 'de', 'dk', 'el', 'en', 'fa', 'fi', 'fr', 'is', 'it', 'pl', 'pt-br', 'pt', 'ru', 'es', 'sv', 'tr');


   protected $validThemes = array(
                                 'redmond',
                                 );

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @param string $value language
    */
	public function setLanguage($value)
	{
      if ($this->language === null) {
         $lang = (($p = strpos($value, '_')) !== false) ? str_replace('_', '-', $value) : $value;
         if (in_array($lang, $this->validLanguages)) {
            $this->language = $lang;
         }
         else {
            $suffix = empty($lang) ? 'en' : ($p !== false) ? strtolower(substr($lang, 0, $p)) : strtolower($lang);
            if (in_array($suffix, $this->validLanguages)) $this->language = $suffix;
         }
      }
	}

	/**
	 * Getter
	 *
	 * @return string
	 */
	public function getLanguage()
	{
      if ($this->language === null)
         $this->language = self::DEFAULT_LANGUAGE;
	   return $this->language;
	}

   //***************************************************************************
   // Singleton
   //***************************************************************************

   /**
    * A private constructor; prevents direct creation of object.
    */
   private function __construct() {}

   /**
    * The singleton method.
    *
    * @return EJqGrid
    */
   public static function singleton()
   {
      if (!isset(self::$instance)) {
         $c = __CLASS__;
         self::$instance = new $c;
      }
      return self::$instance;
   }

   /**
    * Prevent users to clone the instance.
    */
    public function __clone()
    {
       throw new CException(Yii::t('EJqGrid', 'Clone is not allowed'));
    }
}