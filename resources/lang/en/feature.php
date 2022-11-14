<?php 
$langs = DB::table('features')->select('id','title','subtitle')->get();
$output = array();
foreach ($langs as $lang) {
	$output['title'.$lang->id] = $lang->title;
	$output['subtitle'.$lang->id] = $lang->subtitle;
}
return $output;
?>