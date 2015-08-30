<?php
/**
* KindEditor PHP
*
* 本PHP程序是演示程序，建议不要直接在实际项目中使用。
* 如果您确定直接使用本程序，使用之前请仔细确认相关安全设置。
*
*/
require_once 'JSON.php';
$php_path = dirname(__FILE__) . '/';
$php_url = dirname($_SERVER['PHP_SELF']) . '/';
//文件保存目录路径
$save_path = $php_path . '../../res/upload/';
//文件保存目录URL
$save_url = $php_url . '../../res/upload/';
//定义允许上传的文件扩展名
$ext_arr = array('image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),'flash' => array('swf', 'flv'),'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2', 'gif', 'jpg', 'jpeg', 'png', 'bmp'),
);
//最大文件大小
$max_size = 1000000;
$save_path = realpath($save_path) . '/';
//有上传文件时
if (empty($_FILES) === false) {
//原文件名
$file_name = $_FILES['imgFile']['name'];
//服务器上临时文件名
$tmp_name = $_FILES['imgFile']['tmp_name'];
// alert("请选择文件。" . $tmp_name);
//文件大小
$file_size = $_FILES['imgFile']['size'];
//检查文件名
if (!$file_name) {
alert("请选择文件。");
}
$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
//获得文件扩展名
$temp_arr = explode(".", $file_name);
$file_ext = array_pop($temp_arr);
$file_ext = trim($file_ext);
$file_ext = strtolower($file_ext);
//检查扩展名
if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
}
//新文件名
$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
//移动文件
$s = new SaeStorage();
$result = $s->upload('public', $new_file_name, $tmp_name);
if(!$result) {
alert("上传文件失败。");
}
// @chmod($file_path, 0644);
$file_url = $result;
//$s->getUrl( 'redstones' , $new_file_name );
header('Content-type: text/html; charset=UTF-8');
$json = new Services_JSON();
echo $json->encode(array('error' => 0, 'url' => $file_url));
exit;
}
function alert($msg) {
header('Content-type: text/html; charset=UTF-8');
$json = new Services_JSON();
echo $json->encode(array('error' => 1, 'message' => $msg));
exit;
}
?>