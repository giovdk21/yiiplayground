<?php

class MoreInfoBox extends CWidget {

		public $references; // Links to official documentation
		public $see_also; // Links to other Yii Playground examples
		public $external_links; // Links to external documentation that could be obsolete


		public function run() {

			Yii::app()->clientScript->registerScript(
				'moreinfobox',
				$this->getWidgetJs(),
				CClientScript::POS_BEGIN
			);

			$this->render('MoreInfoBox',array(
					'references'=>$this->references,
					'see_also'=>$this->see_also,
					'external_links'=>$this->external_links
				)
			);
		}


		protected function getWidgetJs() {
			$res ='jQuery(document).ready(function() {'."\n".
				"	jQuery('#more_topic_info_link').click(function(event) {\n".
				"		event.preventDefault();\n".
				"		$('#moreinfobox_dialog').dialog('open');\n".
				"	});\n".
				"	$('#more_topic_info').css('display', 'block');\n".
				'});';
			
			return $res;
		}

}

?>
