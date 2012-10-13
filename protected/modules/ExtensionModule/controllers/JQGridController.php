<?php
class JQGridController extends Controller {
	public function run()
	{
		//this method is only for producing XML...
		$xml = '<?xml version="1.0" encoding="utf-8"?>
		<rows>
		<page>1</page>
		<total>1</total>
		<records>4</records>
		<row id="1">
		<cell>1</cell>
		<cell>F-14</cell>
		<cell>Grumman</cell>
		</row>
		<row id="2">
		<cell>2</cell>
		<cell>F-15</cell>
		<cell>Boeing</cell>
		</row>
		</rows>
		';
		header("Content-Type: application/xml");
		header("Content-Length: " . strlen($xml));
		echo $xml;
	}
	
}