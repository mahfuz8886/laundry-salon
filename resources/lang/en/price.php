<?php 
$langs = DB::table('prices')->select('id','name','price')->get();
$output = array();
foreach ($langs as $lang) {
	$output['name'.$lang->id] = $lang->name;
	$output['price'.$lang->id] = $lang->price;
}
return $output;
?>