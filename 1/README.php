

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自适应模板</title>
    <style>
        *{margin: 0; padding: 0;}
        body{width: 100%; font-family: "Microsoft YaHei"; font-size: 14px;}
        .wrap{width: 1200px; margin: 0 auto;}
        .header{width: 100%; background-color: #ccc; height: 50px; line-height: 50px; text-align: center;}
        .main{width: 100%; background-color: #eee;}
        .main .left{width: 200px; float: left; background-color: #f00; height: 300px;}
        .main .right{width: 980px; float: right; background-color: #0f0; height: 300px;}
        .footer{width: 100%; background-color: #ccc; height: 50px; line-height: 50px; text-align: center;}
    </style>
</head>
<body>
    <div class="wrap">
 
<link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css" />
<script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>

<?php
$file = fopen("README.md", "r") or exit("Unable to open file!");
echo '<div class="mdui-textfield">';
echo '<h3>介绍</h3>';
while(!feof($file))
{
echo fgets($file). "<br />";
}
fclose($file);

?>
<br>
<h3>
   写一段关于哔哩哔哩的介绍
   </h3>
   

哔哩哔哩（Bilibili）是一个弹幕视频网站，于2009年7月开始运营，主要提供动画、番剧、音乐、游戏、舞蹈、科技、生活等视频内容，拥有大量的活跃用户，在中国乃至世界都享有极高的口碑。哔哩哔哩的内容涵盖了动画、番剧、音乐、游戏、舞蹈、科技、生活、搞笑、影视等多种类型，拥有大量的活跃用户，并有强大的社区系统，可以让用户发表自己的见解。此外，哔哩哔哩还拥有完善的投稿系统，可以让用户分享自己的作品，推广自己的创作。
    </div>
 </div>
   </div>
   
</body>
</html>