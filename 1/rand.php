<?php
//用php写一个随机图片api接口，获取txt文件内的图片链接，并302跳转，而且要防盗链
// 设置响应头
header("Content-type:text/html;charset=utf-8");

// 读取txt文件内容
$file = fopen("images.txt", "r");

// 获取文件内容
$images = fread($file, filesize("images.txt"));

// 将文件内容转换为数组
$images_arr = explode("\n", $images);

// 获取数组长度
$len = count($images_arr);

// 获取随机数
$rand = mt_rand(0, $len-2);

// 获取随机图片地址
$image_url = $images_arr[$rand];



header("Location: $image_url");

?>