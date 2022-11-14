<?php 
$langs = DB::table('prices')->select('id','name_bn','price_bn')->get();
$output = array();
foreach ($langs as $lang) {
	$output['name'.$lang->id] = $lang->name_bn;
	$output['price'.$lang->id] = $lang->price_bn;
}
return $output;
?>