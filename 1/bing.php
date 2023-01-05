<?php
require_once 'same.php';

//if(search($url);
$url = 'http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1';
$data = file_get_contents($url);
$data = json_decode($data,true);
$imgurl = "http://cn.bing.com".$data['images'][0]['url'];
if(search($imgurl) == true){
    die("链接已经存在");
  }
$file = fopen("images.txt", "a+");
fwrite($file, $imgurl."\n");
fclose($file);
echo "添加成功";