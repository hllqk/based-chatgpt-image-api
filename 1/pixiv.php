<?php
require_once 'same.php';
#用php获取https://pixiv.moeyy.xyz/api/illust/random?format=image的重定向跳转后链接并添加到txt
$urls = array(
  "https://pixiv.moeyy.xyz/api/illust/random?format=image",
  "https://img.xjh.me/random_img.php?return=302",
  "https://api.paugram.com/wallpaper/",
  "https://api.anosu.top/img/"
);
foreach ($urls as $url) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$data = curl_exec($ch);
$headers = curl_getinfo($ch);
$info = curl_getinfo($ch); 
if($info['http_code'] == 200) {
    break;
} else { 
  echo $url.' of Link is invalid'; 
} 
curl_close($ch);
}



$file = fopen('images.txt','a');
if(search($headers['url']) == true){
    die("链接已经存在");
  }
fwrite($file, $headers['url']."\n");
fclose($file);
echo "爬取完成";