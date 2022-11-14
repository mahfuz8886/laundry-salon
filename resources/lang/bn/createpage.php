<?php 
$langs = DB::table('createpages')->select('id','pageName_bn','title_bn','text_bn')->get();
$output = array();
foreach ($langs as $lang) {
	$output['name'.$lang->id] = $lang->pageName_bn;
	$output['title'.$lang->id] = $lang->title_bn;
	$output['text'.$lang->id] = $lang->text_bn;
}
return $output;
?>