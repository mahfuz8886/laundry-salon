<?php 
$langs = DB::table('services')->select('id','title','text')->get();
$output = array();
foreach ($langs as $lang) {
	$output['title'.$lang->id] = $lang->title;
	$output['text'.$lang->id] = $lang->text;
}
return $output;
?>