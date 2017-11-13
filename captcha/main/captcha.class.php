<?php

/**
 * 函数封装16进制验证码
 * @param int $width 验证码宽度
 * @param int $height 验证码高度
 * @param float $vague 干扰度，0%-100%
 * @param int $bit 验证码字母数字位数
 */

function getCaptcha($width,$height,$vague=0.5,$bit=4){

	//生成画布
	$im = imagecreatetruecolor($width,$height);
	$bg_color = imagecolorallocate($im,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
	imagefill($im,0,0,$bg_color);

	$str_color = imagecolorallocatealpha($im,mt_rand(0,50),mt_rand(0,50),mt_rand(0,50),50);
	//生成验证码字符串
	$str = '';
	for($i=0;$i<$bit;$i++){
		$num = mt_rand(0,15);
		$str .= dechex($num);
	}
	$str_arr = str_split($str);
	//背景干扰-像素点
	$num = 1000*$vague;
	$gr = imagecolorallocate($im,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
	for($i=0;$i<$num;$i++){
		imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$gr);
	}
	//背景干扰
	
	//写入字符串
	$font = './font/arial.ttf';
	// $size = mt_rand()
	// 字符y坐标
	$char_y = 35;
	foreach ($str_arr as $key => $value) {
		if($key == 0){
			//第一个字符x
			$fls = ($width - $bit*mt_rand(18,25))/2;
			imagettftext($im,mt_rand(18,25),mt_rand(-15,15),$fls,$char_y,$str_color,$font,$value);
		}else{
			imagettftext($im,mt_rand(18,25),mt_rand(-15,15),$fls+$key*mt_rand(18,25),$char_y,$str_color,$font,$value);
		}
	}
	header('content-type:image/png');
	imagepng($im); 
	imagedestroy($im);
}

//得到模糊后的真实值
