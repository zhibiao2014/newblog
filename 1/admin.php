<?php
	//开启调试模式
	define('APP_DEBUG',true);
	define('APP_NAME','Admin');
	//引入入口文件
	define('APP_PATH','./Admin/');
	define('ENGINE_NAME','sae');
	define('RUI_PATH','./ThinkPHP/');
	require(RUI_PATH.'ThinkPHP.php');
?>