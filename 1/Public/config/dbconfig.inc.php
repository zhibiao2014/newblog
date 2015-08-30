<?php
/*数据库配置信息*/
return array(
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'biao',
	'DB_USER' => 'root',
	'DB_PWD' => '',
	'DB_PORT'  => '3306',
	'DB_PREFIX' => 'iqishe_',
	'RBAC_ROLE_TABLE' => 'iqishe_role',
	'RBAC_USER_TABLE'=>'iqishe_role_user',
	'RBAC_ACCESS_TABLE'=>'iqishe_access',
	'RBAC_NODE_TABLE'=>'iqishe_node',
    'db_charset'=> 'utf8',
);
?>