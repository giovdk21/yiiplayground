<?php

class RightMenu extends CWidget {

		public $items;
		

		public function run() {
			$links =array();

			$i =0;
			foreach($this->items as $label=>$href) {
				$links[$i]['label']=$label;
				if (is_array($href)) {
					$links[$i]['href']=CHtml::normalizeUrl($href);

					// Check if the current item is the selected one..
					$route =$this->getController()->getRoute();
					// check if href is longer than the route, to see if we have
					// a complete route in href that begins with '/'
					if (strlen($href[0]) > strlen($route)) {
						$href[0]=trim($href[0], '/');
					}
					// We consider it valid if the href equals to the right part of the route
					// and if the first char of the href is not a '/'. We also check that
					// $href['#'] is not set cause we don't automatically select an anchor
					if ((substr($route, -(strlen($href[0]))) == $href[0]) &&
					    substr($href[0], 0, 1) != '/' && !isset($href['#'])) {
						$links[$i]['class']='selected';
					}
				} else {
					$links[$i]['href']=$href;
				}

				$i++;
			}

			// append the "last" class to last item
			$links[$i-1]['class']=(
				!empty($links[$i-1]['class']) ?
				$links[$i-1]['class'].' ' :
				''
			).'last';

			$this->getWidgetJs();
			$this->render('RightMenu', array('links'=>$links));
		}


		protected function getWidgetJs() {
			$js =Yii::app()->uiSettings->getIsOn('viewRightMenu') ?
				'right_menu.setStartStatus(true);' :
				'right_menu.setStartStatus(false);';
			Yii::app()->clientScript->registerScript('rightMenu', $js, CClientScript::POS_LOAD);

			Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/right_menu.js');
		}

}

?>
