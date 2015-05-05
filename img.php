<?php
include('./system/core/img.class.php');
$img = new img('upload');
//没有参数时直接展示图片
if($_SERVER['QUERY_STRING'] == ''){
	if($img->checkExists(1)){
		$img->showImg(1); exit;
	}else{
		exit('图片不存在！');
	}
}
//存在缩略图就展示
if($img->checkExists(2)){
	$img->showImg(2); exit;
}
//不存在缩略图生成并展示
if($img->checkExists(1)){
	$res = $img->createThumb();
	if(!$res ) exit('缩略图生成失败！');
	$img->showImg(2);
}else{
	exit('源图片不存在');
}
