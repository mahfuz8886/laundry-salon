<?php 
$langs = DB::table('pricetypes')->select('id','pricetypeName')->get();
$output = array();
foreach ($langs as $lang) {
	$output['name'.$lang->id] = $lang->pricetypeName;
}
return $output;
?>