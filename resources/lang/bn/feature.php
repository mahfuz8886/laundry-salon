<?php 
$langs = DB::table('features')->select('id','title_bn','subtitle_bn')->get();
$output = array();
foreach ($langs as $lang) {
	$output['title'.$lang->id] = $lang->title_bn;
	$output['subtitle'.$lang->id] = $lang->subtitle_bn;
}
return $output;
?>