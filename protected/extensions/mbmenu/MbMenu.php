<?php

/**
 * MbMenu class file.
 *
 * @author Mark van den Broek (mark@heyhoo.nl)
 * @copyright Copyright &copy; 2010 HeyHoo
 *
 */

Yii::import('zii.widgets.CMenu');
Yii::import('application.extensions.mbmenu.Browser');

class MbMenu extends CMenu
{
    private $baseUrl;
    private $nljs;
    
    public $cssFile;       
    public $activateParents=true;
    
    /**
     * The javascript needed
     */
    protected function createJsCode()
    {
        $js='';
        $js .= '  $("#nav li").hover(' . $this->nljs;
        $js .= '    function () {' . $this->nljs;
        $js .= '      if ($(this).hasClass("parent")) {' . $this->nljs; 
        $js .= '        $(this).addClass("over");' . $this->nljs;
        $js .= '      }' . $this->nljs;
        $js .= '    },' . $this->nljs; 
        $js .= '    function () {' . $this->nljs;
        $js .= '      $(this).removeClass("over");' . $this->nljs;
        $js .= '    }' . $this->nljs;
        $js .= '  );' . $this->nljs;
        return $js;
    } 
      
	  
    /**
    * Give the last items css 'last' style 
    */	  
	  protected function cssLastItems($items)
	  {
      $i = max(array_keys($items));
      $item = $items[$i];

		  if(isset($item['itemOptions']['class']))
			  $items[$i]['itemOptions']['class'].=' last';
		  else
			  $items[$i]['itemOptions']['class']='last';      

			foreach($items as $i=>$item)
			{
			  if(isset($item['items']))
			  {
          $items[$i]['items']=$this->cssLastItems($item['items']);
        }
      }
      
      return array_values($items);
    }
 
     /**
    * Give the last items css 'parent' style 
    */	  
	  protected function cssParentItems($items)
	  {
	  	foreach($items as $i=>$item)
	  	{
	  		if(isset($item['items']))
	  		{
 		      if(isset($item['itemOptions']['class']))
			      $items[$i]['itemOptions']['class'].=' parent';
		      else
			      $items[$i]['itemOptions']['class']='parent'; 
	  		
	  		$items[$i]['items']=$this->cssParentItems($item['items']);
	  		}
      }
      
      return array_values($items);
    }
    
    /**
    * Initialize the widget
    */
    public function init()
    {
        if(!$this->getId(false))
          $this->setId('nav');

        $this->nljs = "\n";
        $this->items=$this->cssParentItems($this->items);
        $this->items=$this->cssLastItems($this->items);

        parent::init();
    }
      
    
    /**
    * Publishes the assets
    */
    public function publishAssets()
    {
        $dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'source';
        $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
    }
    
    /**
    * Registers the external javascript files
    */
    public function registerClientScripts()
    {
        // add the script
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        
        $js = $this->createJsCode();
        $cs->registerScript('mbmenu_'.$this->getId(), $js, CClientScript::POS_READY);
    }
 
 	  public function registerCssFile($url=null)
	  {
        // add the css
        if ($this->baseUrl === '')
            throw new CException(Yii::t('MbMenu', 'baseUrl must be set. This is done automatically by calling publishAssets()'));
 
	  	  $cs=Yii::app()->getClientScript();
	  	  if($url===null) { 
	  		  $url=$this->baseUrl.'/mbmenu.css';
          $cs->registerCssFile($url,'screen');
          $browser = Browser::detect();
          if ($browser['name'] == 'msie' && $browser['version'] < 8)
            $cs->registerCssFile($this->baseUrl.'/mbmenu_iestyles.css','screen');
        } else {
	  	    $cs->registerCssFile($url,'screen');
        }
	  }
    
	  protected function renderMenuRecursive($items)
	  {
	  	  foreach($items as $item)
	  	  {
	  	  	echo CHtml::openTag('li', isset($item['itemOptions']) ? $item['itemOptions'] : array());
	  	  	if(isset($item['url']))
	  	  		echo CHtml::link('<span>'.$item['label'].'</span>',$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
	  	  	else
	  	  		echo CHtml::link('<span>'.$item['label'].'</span>',"javascript:void(0);",isset($item['linkOptions']) ? $item['linkOptions'] : array());
	  	  	if(isset($item['items']) && count($item['items']))
	  	  	{
	  	  		echo "\n".CHtml::openTag('ul',$this->submenuHtmlOptions)."\n";
	  	  		$this->renderMenuRecursive($item['items']);
	  	  		echo CHtml::closeTag('ul')."\n";
	  	  	}
	  	  	echo CHtml::closeTag('li')."\n";
	  	  }
	  }

	  protected function normalizeItems($items,$route,&$active, $ischild=0)
	  {
	  	foreach($items as $i=>$item)
	  	{
	  		if(isset($item['visible']) && !$item['visible'])
	  		{
	  			unset($items[$i]);
	  			continue;
	  		}
	  		if($this->encodeLabel)
	  			$items[$i]['label']=CHtml::encode($item['label']);
	  		$hasActiveChild=false;
	  		if(isset($item['items']))
	  		{
	  			$items[$i]['items']=$this->normalizeItems($item['items'],$route,$hasActiveChild, 1);
	  			if(empty($items[$i]['items']) && $this->hideEmptyItems)
	  				unset($items[$i]['items']);
	  		}
	  		if(!isset($item['active']))
	  		{
	  			if(($this->activateParents && $hasActiveChild) || $this->isItemActive($item,$route))
	  				$active=$items[$i]['active']=true;
	  			else
	  				$items[$i]['active']=false;
	  		}
	  		else if($item['active'])
	  			$active=true;
	  		if($items[$i]['active'] && $this->activeCssClass!='' && !$ischild)
	  		{
	  			if(isset($item['itemOptions']['class']))
	  				$items[$i]['itemOptions']['class'].=' '.$this->activeCssClass;
	  			else
	  				$items[$i]['itemOptions']['class']=$this->activeCssClass;
	  		}
	  	}
	  	return array_values($items);
	  }
    
    /**
    * Run the widget
    */
    public function run()
    {
          $this->publishAssets();
          $this->registerClientScripts();
			    $this->registerCssFile($this->cssFile);    
          $htmlOptions['id']='nav-container';
          echo CHtml::openTag('div',$htmlOptions)."\n";          
          $htmlOptions['id']='nav-bar';
          echo CHtml::openTag('div',$htmlOptions)."\n";
          parent::run();
          echo CHtml::closeTag('div');
          echo CHtml::closeTag('div');
    }
	
}