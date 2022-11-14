<?php 
$langs = DB::table('hubs')->select('id','title','subtitle','text')->get();
$output = array();
foreach ($langs as $lang) {
	$output['title'.$lang->id] = $lang->title;
	$output['subtitle'.$lang->id] = $lang->subtitle;
	$output['text'.$lang->id] = $lang->text;
}
return $output;
?>