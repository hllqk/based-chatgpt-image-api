<?php

// 利用php最新必应图片关键词爬取

// 设置关键词
$keyword = 'cat';

// 请求的URL
$url = 'https://api.cognitive.microsoft.com/bing/v7.0/images/search?q=' . $keyword;

// 设置请求头
$headers = array(
    'Ocp-Apim-Subscription-Key' => 'xxxxxxxxxxxxxxxxxxxx',
);

// 发起请求
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

// 解析json
$response = json_decode($response);

// 获取图片地址
$image_arr = array();
foreach($response->value as $image) {
    $image_arr[] = $image->contentUrl;
}

// 保存图片
foreach($image_arr as $image_url) {
    $image_name = basename($image_url);
    file_put_contents($image_name, file_get_contents($image_url));
}