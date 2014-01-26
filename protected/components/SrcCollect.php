<?php

/**
 * @author Giovanni Derks
 * @license New BSD License
 * http://twitter.com/giovdk21
 */


class SrcCollect {

	var $start_line=0;
	var $last_file ='';
	var $source_arr =array();


	public function init() {	
	}

	
	public function setStart($line) {
		$this->start_line =(int)$line;
	}
	
	
	public function getSourceToLine($line, $file) {
		$this->last_file =$file;
		$code =file_get_contents($file);
		
		$start =0;
		for ($i =0; $i<$this->start_line; $i++) {
			$start =strpos($code, "\n", $start+1);
		}
		
		$end =0;
		for ($i =0; $i<$line-2; $i++) {
			$end =strpos($code, "\n", $end+1);
		}

		$res =substr($code, $start, $end-$start);
		return $res;
	}

	public function getSourceFromFile($file) {
		$this->last_file =$file;
		$this->setStart(-1);
		return file_get_contents($file);
	}


	public function getSnippetFromFile($str_start, $str_end, $file, $indent=1) {
		$this->last_file =$file;
		$code =file_get_contents($file);
		
		$start =strpos($code, $str_start);
		$end =strpos($code, $str_end, $start)+strlen($str_end);

		// we subtract $indent to $start to grab also first indentation chars
		$res =substr($code, $start-$indent, $end-$start+$indent);

		$this->setStart(substr_count(substr($code, 0, $start), "\n")-1);
		return $res;
	}


	public function getFunctionFromFile($fnc_name, $file, $indent=1) {
		$debug =false;
		$d_log ='<br />';
		$this->last_file =$file;
		$code =file_get_contents($file);
	
		$start =strpos($code, $fnc_name);
		$prev_open =strpos($code, '{', $start)+1;
		$prev_closed =$prev_open;

		// quick find (requires the /* end of functionName */ comment in your code)
		$fnc_name_only =substr($fnc_name, strrpos($fnc_name, ' ')+1);
		$quick_end =stripos($code, "/* end of ".$fnc_name_only." */", $prev_open);
		$d_log.='fnc_name_only: '.$fnc_name_only.'<br />';
		$d_log.='quick_end: '.var_export($quick_end, true)."<br />\n";
		if ($quick_end !== false) {
			$end =strrpos(substr($code, 0, $quick_end), '}');
			$found =true;
			$d_log.='quick find! ('.var_export($end, true).')<br />';
		}
		else {
			$end =0;
			$found =false;
		}
		$d_log.='<br />';

		while(!$found) {
			$next_open =strpos($code, '{', $prev_open);
			$next_closed =strpos($code, '}', $prev_closed);

			// -- debug info
			$d_log.='<span style="font-weight: bold; color: #000;">'.var_export($next_open, true)."</span> [ ".
				substr($code, $next_open-30, 30).
				'<b style="color:red">'.substr($code, $next_open, 1).'</b>'.
				substr($code, $next_open+1, 10).
				' ] <span style="font-weight:	bold; color: #000;">&gt;</span> ';
			$d_log.='<span style="font-weight: bold; color: #000;">'.var_export($next_closed, true)."</span> [ ".
				substr($code, $next_closed-30, 30).
				'<b style="color:red">'.substr($code, $next_closed, 1).'</b>'.
				substr($code, $next_closed+1, 10).
				' ] <span style="font-weight: bold; color: #000;">??</span><br /><br />';
			// -------------

			if ($next_open > $next_closed || $next_open === false) {
				$d_log.='prev_open: '.var_export($prev_open, true)."<br />";
				$d_log.='next_open: '.var_export($next_open, true)."<br />";
				$d_log.='next_closed: '.var_export($next_closed, true)."<br />";
				
				$found =true;
				$end =$next_closed;
			}
			else {
				$prev_closed =$next_closed+1;
				$prev_open =$next_open+1;
			}
		}

		// we subtract $indent to $start to grab also first indentation chars
		$res =substr($code, $start-$indent, $end-$start+1+$indent);

		$d_log.=$start.' -- '.$end;
		$d_log.="<pre>".$res.'</pre>';
		if ($debug) echo $d_log;

		$this->setStart(substr_count(substr($code, 0, $start), "\n")-1);
		return $res;
	}

	
	public function printOut($type, $source, $file=false, $rel_path=false, $start_line=false) {
		$dir =(!$rel_path ? dirname($_SERVER['SCRIPT_FILENAME']).'/' : '');
		$file =(empty($file) ? $this->last_file : $file);
		$file =str_replace('\\', '/', $file);
		$start_line =(empty($start_line) ? $this->start_line : $start_line);

        // since the $file var could contain the real absolute path of the file, deeper than the detected $dir,
        // we check if $dir is found inside the $file path and we add to the position the missing number of characters
        // example:
        // $dir = "/home/abcd/yiiplayground/";
        // $file = '/mounted-storage/home/abcd/yiiplayground/protected/modules/UiModule/views/jui/zii_dialog.php';
        // result: 41
        // substr($file, $rel_pos): protected/modules/UiModule/views/jui/zii_dialog.php
        $rel_pos = strlen($dir);
        if ($rel_pos > 0) {
            $rel_pos += strrpos($file, $dir);
        }

		echo("\n\n".'<p style="font-weight: bold; margin-bottom: 0em; margin-top: 1em; padding-left: 1.4em; color: #000;">'.substr($file, $rel_pos)."</p>");
		echo('<pre class="brush: '.$type.'; ruler: false; first-line: '.($start_line+2).';">'.htmlentities($source).'</pre>'."\n\n");
	}


	public function collect($type, $source, $file=false, $rel_path=false, $start_line=false) {
		$this->source_arr[]=array(
			'type'=>$type,
			'source'=>$source,
			'file'=>(empty($file) ? $this->last_file : $file),
			'rel_path'=>$rel_path,
			'start_line'=>($start_line !== false ? (int)$start_line : $this->start_line),
		);
	}


	public function renderSourceBox() {
		if (!empty($this->source_arr)) {
			Yii::app()->controller->beginContent('application.views.layouts.source');
			foreach ($this->source_arr as $data) {
				$this->printOut($data['type'], $data['source'], $data['file'], $data['rel_path'], $data['start_line']);
			}
			Yii::app()->controller->endContent();
			$this->source_arr =array();
		}
	}

	
}

?>