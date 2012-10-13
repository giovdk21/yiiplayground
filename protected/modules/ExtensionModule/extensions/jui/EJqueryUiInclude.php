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

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'EJqueryUiConfig.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'EJqueryUiWidget.php');

/**
 * EJqueryUiInclude is a class which can be used to include the jQuery UI }
 * library without the need of including a widget in your view. This is useful
 * in case you need to use just an effect, for instance.
 *
 * This class is intended to work standalone. Don't use this class if you're
 * goint to use a jQuery UI widget wrapper.
 *
 * @author MetaYii
 * @since 1.0.4
 * @package application.extensions.jui
 */
 class EJqueryUiInclude extends CWidget
{
   //***************************************************************************
   // Setters and getters
   //***************************************************************************

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
   // Run Lola Run
   //***************************************************************************

   /**
    * Run the widget, including the js files.
    */
   public function run()
   {
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'jquery';
      $baseUrl = Yii::app()->getAssetManager()->publish($dir);

      $clientScript = Yii::app()->getClientScript();

      $clientScript->registerCoreScript('jquery');

      switch ($this->getCompression()) {
         case 'none':
            $clientScript->registerScriptFile($baseUrl.'/js/jquery-ui-1.7.1.custom.js');
            break;

         case 'packed';
            $clientScript->registerScriptFile($baseUrl.'/js/jquery-ui-1.7.1.custom.packed.js');
            break;

         default:
            $clientScript->registerScriptFile($baseUrl.'/js/jquery-ui-1.7.1.custom.min.js');
            break;
      }

      if ($this->getUseBundledStyleSheet()) {
         $clientScript->registerCssFile($baseUrl.'/css/'.$this->getTheme().'/jquery-ui-1.7.1.custom.css');
      }
   }
}