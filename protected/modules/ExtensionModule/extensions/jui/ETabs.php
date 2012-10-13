<?php
/**
 * ETabs class file.
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
 * ETabs is a Yii widget which encapsulates the functionality of the jQuery UI
 * tabs widget to generate a tabbed panel.
 *
 * Works with jQuery 1.3 and jQuery UI 1.7
 *
 * @link http://docs.jquery.com/UI/Tabs
 *
 * @author MetaYii
 * @package application.extensions.jui
 * @since 1.0.2
 */
class ETabs extends EJqueryUiWidget
{
   /**
    * Tabs for AJAX mode. The format is:
    *
    * array(array('title'=>string, 'url'=>string))
    *
    * where title is the tab title and url is the URL to be loaded using AJAX.
    *
    * @var array
    */
   protected $ajaxTabs = array();

   //***************************************************************************
   // Internal properties (not for configuration)
   //***************************************************************************

   /**
    * Widget's body
    *
    * @var string
    */
   private $body = null;

   /**
    * See {@link http://jqueryui.com/demos/tabs}
    *
    * @var array
    */
   protected $validOptions = array(
                                   'ajaxOptions'=>array('type'=>'array'), // Additional Ajax options to consider when loading tab content (see $.ajax). Default: null
                                   'cache'=>array('type'=>'boolean'), // Whether or not to cache remote tabs content, e.g. load only once or with every click. Cached content is being lazy loaded, e.g once and only once for the first click. Note that to prevent the actual Ajax requests from being cached by the browser you need to provide an extra cache: false flag to ajaxOptions. Default: false
                                   'collapsible'=>array('type'=>'boolean'), // Set to true to allow an already selected tab to become unselected again upon reselection. Default: false
                                   'cookie'=>array('type'=>'array'), // Store the latest selected tab in a cookie. The cookie is then used to determine the initially selected tab if the selected option is not defined. Requires cookie plugin. The object needs to have key/value pairs of the form the cookie plugin expects as options. Available options (example): { expires: 7, path: '/', domain: 'jquery.com', secure: true }. Since jQuery UI 1.7 it is also possible to define the cookie name being used via name property. Default: null
                                   'deselectable'=>array('type'=>'boolean'), // deprecated in jQuery UI 1.7, use collapsible. Default: false
                                   'disabled'=>array('type'=>'array'), // An array containing the position of the tabs (zero-based index) that should be disabled on initialization. Default: []
                                   'event'=>array('type'=>'string'), // The type of event to be used for selecting a tab. Default: 'click'
                                   'fx'=>array('type'=>'string'), // Enable animations for hiding and showing tab panels. The duration option can be a string representing one of the three predefined speeds ("slow", "normal", "fast") or the duration in milliseconds to run an animation (default is "normal"). Default: null
                                   'idPrefix'=>array('type'=>'string'), // If the remote tab, its anchor element that is, has no title attribute to generate an id from, an id/fragment identifier is created from this prefix and a unique id returned by $.data(el), for example "ui-tabs-54". Default: 'ui-tabs-'
                                   'panelTemplate'=>array('type'=>'string'), // HTML template from which a new tab panel is created in case of adding a tab with the add method or when creating a panel for a remote tab on the fly. Default: '<div></div>'
                                   'selected'=>array('type'=>'integer'), // Zero-based index of the tab to be selected on initialization. To set all tabs to nselected pass -1 as value. Default: 0
                                   'spinner'=>array('type'=>'string'), // The HTML content of this string is shown in a tab title while remote content is loading. Pass in empty string to deactivate that behavior. Default: '<em>Loading&#8230;</em>'
                                   'tabTemplate'=>array('type'=>'string'), // HTML template from which a new tab is created and added. The placeholders #{href} and #{label} are replaced with the url and tab label that are passed as arguments to the add method. Default: '<li><a href="#{href}"><span>#{label}</span></a></li>'
                                  );

   /**
    * See {@link http://jqueryui.com/demos/tabs}
    *
    * @var array
    */
   protected $validCallbacks = array(
                                     'select', // This event is triggered when clicking a tab.
                                     'load', // This event is triggered after the content of a remote tab has been loaded.
                                     'show', // This event is triggered when a tab is shown.
                                     'add', // This event is triggered when a tab is added.
                                     'remove', // This event is triggered when a tab is removed.
                                     'enable', // This event is triggered when a tab is enabled.
                                     'disable', // This event is triggered when a tab is disabled.
                                    );

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @param array $value
    */
   public function setAjaxTabs($value)
   {
      if (!is_array($value)) {
         throw new CException(Yii::t('EJqueryUiWidget', 'ajaxTabs must be an array.'));
      }
      foreach ($value as $val) {
         if (!is_array($val) || !array_key_exists('title', $val) || !array_key_exists('url', $val)) {
            throw new CException(Yii::t('EJqueryUiWidget', 'ajaxTabs must be an array of arrays in the format array("title"=>$title, "url"=>$url).'));
         }
      }
      $this->ajaxTabs = $value;
   }

   /**
    * Getter
    *
    * @return array
    */
   public function getAjaxTabs()
   {
      return $this->ajaxTabs;
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

      foreach ($this->callbacks as  $key=>$val) {
         $options['callback_'.$key] = $key;
      }

      $encodedOptions = CJavaScript::encode(array_merge($options, $this->options));

      foreach ($this->callbacks as $key=>$val) {
         $encodedOptions = str_replace("'callback_{$key}':'{$key}'", "{$key}: {$val}", $encodedOptions);
      }

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
$('#{$id}').tabs({$options});
EOP;
      return $script;
   }


   public function htmlCode($id)
   {
      $tabs = '';
      if (empty($this->ajaxTabs)) {
         if (preg_match_all('/<div id="([^"]+)" title="([^"]+)">/i', $this->body, $regs)) {
            $c = count($regs[0]);
            for ($i=0; $i<$c; $i++) {
               $tabs .= CHtml::tag('li', array(), CHtml::link($regs[2][$i], '#'.$regs[1][$i]));
            }
         }
         $html = CHtml::tag('div', array('id'=>$id), CHtml::tag('ul', array(), $tabs).$this->body);
      }
      else {
         foreach ($this->ajaxTabs as $tab) {
            $tabs .= CHtml::tag('li', array(), CHtml::link($tab['title'], $tab['url']));
         }
         $html = CHtml::tag('div', array('id'=>$id), CHtml::tag('ul', array(), $tabs));
      }
      return $html;
   }

   //***************************************************************************
   // Run Lola, Run
   //***************************************************************************

   /**
    * Get the output buffer
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
      if (empty($this->ajaxTabs)) {
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