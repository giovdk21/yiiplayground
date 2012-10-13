<?php
/**
 * EJqueryUiConfig class file.
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

/**
 * EJqueryUiConfig is a singleton for storing EJqueryUiWidget's configuration.
 *
 * @author MetaYii
 * @since 1.0.4
 * @package application.extensions.jui
 */
class EJqueryUiConfig
{
   //***************************************************************************
   // Constants
   //***************************************************************************

   const DEFAULT_THEME = 'base';
   const DEFAULT_COMPRESSION = 'minified';
   const DEFAULT_BUNDLED = true;

   //***************************************************************************
   // Configuration
   //***************************************************************************

   /**
    * The name of the css stylesheet. You can roll your own themes using
    * ThemeRoller {@link http://ui.jquery.com/themeroller/}. If you do so,
    * you'll need to set $useBundledStyleSheet to false, or leave $theme unset.
    *
    * @var string
    */
   protected $theme = null;

   /**
    * Which compression to use for the full jQuery UI library file.
    *
    * Possible values are:
    *
    * none     - no compression
    * minified - minified
    * packed   - packed
    *
    * @var integer
    */
   protected $compression = null;

   /**
    * Set true if you want to use the bundled themes, set false if you want to
    * use your own CSS stylesheets. In this case, you may include your style
    * sheet elsewhere in the view or widget needed.
    *
    * @var boolean
    */
   protected $useBundledStyleSheet = null;

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
    * Valid themes for the widget. You'll need to add here the name of every
    * theme you add to the themes directory.
    *
    * If you want to construct a theme, go to: http://ui.jquery.com/themeroller
    *
    * @link http://ui.jquery.com/themeroller
    *
    * @var array
    */
   protected $validThemes = array(
                                 'base',
                                 'black-tie',
                                 'blitzer',
                                 'cupertino',
                                 'dot-luv',
                                 'excite-bike',
                                 'hot-sneaks',
                                 'humanity',
                                 'mint-choc',
                                 'redmond',
                                 'smoothness',
                                 'south-street',
                                 'start',
                                 'swanky-purse',
                                 'trontastic',
                                 'ui-darkness',
                                 'ui-lightness',
                                 'vader'
                               );

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @param string $value theme
    */
   public function setTheme($value)
   {
      if ($this->theme === null) {
         if (!in_array($value, $this->validThemes))
            throw new CException(Yii::t('EJqueryUiWidget', 'theme must be one of: {t}', array('{t}'=>implode(', ', $this->validThemes))));
         $this->theme = $value;
      }
    }

   /**
    * Getter
    *
    * @return string theme
    */
   public function getTheme()
   {
      if ($this->theme === null) 
         $this->theme = self::DEFAULT_THEME;
      return $this->theme;
   }

   /**
    * Setter
    *
    * @param string $value compression
    */
   public function setCompression($value)
   {
      if ($this->compression === null) {
         if (!in_array($value, array('none', 'minified', 'packed')))
            throw new CException(Yii::t('EJqueryUiWidget', 'compression must be one of: "none", "minified", "packed"'));
         $this->compression = $value;
      }
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getCompression()
   {
      if ($this->compression === null)    
         $this->compression = self::DEFAULT_COMPRESSION;
      return $this->compression;
   }

   /**
    * Setter
    *
    * @param boolean $value useBundledStyleSheet
    */
   public function setUseBundledStyleSheet($value)
   {
      if ($this->useBundledStyleSheet === null) {
         if (!is_bool($value))
            throw new CException(Yii::t('EJqueryUiWidget', 'useBundledStyleSheet must be boolean'));
         $this->useBundledStyleSheet = $value;
      }
   }

   /**
    * Getter
    *
    * @return boolean
    */
   public function getUseBundledStyleSheet()
   {
      if ($this->useBundledStyleSheet === null)
         $this->useBundledStyleSheet = self::DEFAULT_BUNDLED;
      return $this->useBundledStyleSheet;
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
    * @return EJqueryUiTheme
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
       throw new CException(Yii::t('EJqueryUiWidget', 'Clone is not allowed'));
    }
}