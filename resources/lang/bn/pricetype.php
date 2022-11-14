<?php 
$langs = DB::table('pricetypes')->select('id','pricetypeName_bn')->get();
$output = array();
foreach ($langs as $lang) {
	$output['name'.$lang->id] = $lang->pricetypeName_bn;
}
return $output;
?>