<?php 
$langs = DB::table('services')->select('id','title_bn','text_bn')->get();
$output = array();
foreach ($langs as $lang) {
	$output['title'.$lang->id] = $lang->title_bn;
	$output['text'.$lang->id] = $lang->text_bn;
}
return $output;
?>