<?php 
$langs = DB::table('createpages')->select('id','pageName','title','text')->get();
$output = array();
foreach ($langs as $lang) {
	$output['name'.$lang->id] = $lang->pageName;
	$output['title'.$lang->id] = $lang->title;
	$output['text'.$lang->id] = $lang->text;
}
return $output;
?>