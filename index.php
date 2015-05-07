<?php 
/* CMS Main Administration Panel */
?>
<?php
require_once('db.php');
require_once('helper/form.php');
require_once('classes/category.php');

$url = $_SERVER['REQUEST_URI'];
if(strlen($url)>10){
$url = explode('/',$url,5);
//print_r($url);
$dir = $url[1];
$page = $url[2];
$action = $url[3];
$params = @$url[4];
}
if(isset($page) && isset($action)){
$class_name = $page;
$action = $action;

function __autoload($class_name){
	include('classes/'.$class_name.'.php');
}
	
$obj=new $class_name(DB_Settings_API::instance()->connect());

if(isset($params)){
$params = explode('/',$params);
$p = '';
foreach($params as $param){
$p .= $param.",";
}
$args = rtrim($p,',');
return $obj->$action($args);
}else{
return $obj->$action();
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS - Admin Panel</title>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">	
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<!--<script src="vendor/ckeditor/ckeditor.js"></script>-->
</head>
<body>
<table border="0" width="100%" height="700px">
<tr><td colspan="2" height="100px" style="vertical-align:top; font-size:24px; font-weight:bold; border:#CCC 2px solid;">Administration Panel</td></tr>
<tr>
<td width="25%" style="vertical-align:top; border:#CCC 2px solid">
<?php 
require_once('nav.php');?>
</td>
<td width="75%" style="vertical-align:top; border:#CCC 2px solid">
<div class="content"><div id="msg"></div><div id="result"></div></div>
</td>
</tr>
</table>
</body>
</html>
