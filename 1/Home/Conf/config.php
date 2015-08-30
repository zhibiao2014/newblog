<?php
$dbconfig = require('./Public/config/dbconfig.inc.php');
$webconfig = require('./Public/config/webconfig.inc.php');
$config = array(
	'URL_MODEL' => 2,
	'TMPL_TEMPLATE_SUFFIX' => '.htm',
	'URL_CASE_INSENSITIVE' => true,
	'URL_HTML_SUFFIX' => 'html', //url伪静态设置
	'TMPL_L_DELIM' => '<{',
	'TMPL_R_DELIM' => '}>',
	'DEFAULT_THEME' => $webconfig['CFG_DF_THEME'],
	'TMPL_PARSE_STRING' => array(
		'__CSS__' => __ROOT__.'/'.APP_NAME.'/Tpl/'.$webconfig['CFG_DF_THEME'].'/Public/style',
		'__JS__' => __ROOT__.'/'.APP_NAME.'/Tpl/'.$webconfig['CFG_DF_THEME'].'/Public/js',
		'__IMG__' => __ROOT__.'/'.APP_NAME.'/Tpl/'.$webconfig['CFG_DF_THEME'].'/Public/images',
	    
	    '__CSSL__' => __ROOT__.'/Common/'.APP_NAME.'/css',
	    '__JSL__' => __ROOT__.'/Common/'.APP_NAME.'/js',
	    '__IMGL__' => __ROOT__.'/Common/'.APP_NAME.'/images',
	    '__STL__' => __ROOT__.'/Common/'.APP_NAME.'/styles',
	    '__ASS__' => __ROOT__.'/Common/'.APP_NAME.'/assets',
	    '__APP__' => __ROOT__.'/Common/'.APP_NAME,
	),
	'URL_ROUTER_ON' => false,
	'URL_ROUTE_RULES' => array(
		//'category/:colid\d' => 'Index/columns',
	),
	'DEFAULT_FILTER' => 'htmlspecialchars,stripslashes',
	'SHOW_PAGE_TRACE' => false,//不显示调试信息
);

return array_merge($dbconfig,$webconfig,$config);
?>