<?php
/**
 * 函数得到一定比例的缩略图
 * @param string $path 图片路径
 * @param float $scale 缩放比例,0.5缩，1.5放
 */
function getSmallimage($path,$scale){
	if(!is_file($path)){
		return false;
	}
	$ext = pathinfo($path,PATHINFO_EXTENSION);
	if($ext != 'jpeg' && $ext != 'jpg' && $ext != 'png' && $ext != 'gif'){
		return false;
	}
	echo '<pre>';
	print_r(getimagesize($path));
}

getSmallimage('a.jpg',0.5);