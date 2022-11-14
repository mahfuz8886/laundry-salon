<?php 
$langs = DB::table('hubs')->select('id','title_bn','subtitle_bn','text_bn')->get();
$output = array();
foreach ($langs as $lang) {
	$output['title'.$lang->id] = $lang->title_bn;
	$output['subtitle'.$lang->id] = $lang->subtitle_bn;
	$output['text'.$lang->id] = $lang->text_bn;
}
return $output;
?>