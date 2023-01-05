<?php

// 定义一个布尔变量表示游戏是否结束
$gameOver = false;

// 定义一个整数变量表示玩家的血量
$playerHealth = 100;

// 定义一个整数变量表示玩家的背包容量
$playerInventory = array();

// 定义一个字符串变量表示玩家当前所在的房间
$currentRoom = "entryway";

// 定义一个数组，用来存储所有房间的信息
$rooms = array(
  "entryway" => array(
    "description" => "你站在一个寂静的入口处。面前有一扇木门和一条长廊。",
    "items" => array("key"),
    "exits" => array("north" => "corridor")
  ),
  "corridor" => array(
    "description" => "你走进了一条长廊，周围没有任何声音。你感到一阵寒意袭来。",
    "items" => array(),
    "exits" => array("south" => "entryway", "east" => "bedroom", "west" => "kitchen")
  ),
  "bedroom" => array(
    "description" => "你来到了一间卧室。床上的被子散发着淡淡的清香。",
    "items" => array("medkit"),
    "exits" => array("west" => "corridor")
  ),
  "kitchen" => array(
    "description" => "你来到了厨房。里面弥漫着浓浓的饭菜味。",
    "items" => array("food"),
    "exits" => array("east" => "corridor")
    )
    );
    
    // 定义一个数组，用来存储所有怪物的信息
    $monsters = array(
    "zombie" => array(
    "name" => "僵尸",
    "health" => 50,
    "damage" => 10
    ),
    "mummy" => array(
    "name" => "木乃伊",
    "health" => 75,
    "damage" => 15
    ),
    "vampire" => array(
    "name" => "吸血鬼",
    "health" => 100,
    "damage" => 20
    )
    );
    
    // 定义一个函数，用来打印玩家当前的状态
    function printStatus() {
    global $playerHealth, $playerInventory, $currentRoom;
    echo "血量：$playerHealth\n";
    echo "背包：" . implode(", ", $playerInventory) . "\n";
    echo "所在房间：$currentRoom\n";
    }
    
    // 定义一个函数，用来处理玩家的输入
    function processInput($input) {
    global $gameOver, $playerHealth, $playerInventory, $currentRoom, $rooms, $monsters;
    
    // 去除输入字符串两端的空白字符
    $input = trim($input);
    
    // 将输入字符串按空格拆分成数组
    $inputArr = explode(" ", $input);
    
    // 取出命令（数组的第一个元素）
    $command = array_shift($inputArr);
    
    // 根据命令进行不同的处理
    switch($command) {
    case "go":
    // 玩家想要移动到其他房间
    $direction = array_shift($inputArr);
    if($direction && !empty($rooms[$currentRoom]["exits"][$direction])) {
    // 玩家输入的方向有效，更新当前房间
    $currentRoom = $rooms[$currentRoom]["exits"][$direction];
    echo $rooms[$currentRoom]["description"] . "\n";
} else {
// 玩家输入的方向无效，提示错误信息
echo "无法从这里出发。\n";
}
break;
case "get":
// 玩家想要获取房间中的物品
$item = array_shift($inputArr);
if($item && in_array($item, $rooms[$currentRoom]["items"])) {
// 玩家输入的物品存在，从房间的物品数组中删除这个物品，并将其添加到玩家的背包中
$index = array_search($item, $rooms[$currentRoom]["items"]);
unset($rooms[$currentRoom]["items"][$index]);
$playerInventory[] = $item;
echo "你获得了 $item 。\n";
} else {
// 玩家输入的物品无效，提示错误信息
echo "这里没有这个物品。\n";
}
break;
case "use":
// 玩家想要使用背包中的物品
$item = array_shift($inputArr);
if($item && in_array($item, $playerInventory)) {
// 玩家输入的物品存在，从玩家的背包中删除这个物品
$index = array_search($item, $playerInventory);
unset($playerInventory[$index]);
if($item == "medkit") {
// 如果物品是药箱，则回复玩家的血量
$playerHealth = 100;
echo "你使用了药箱，血量回复满。\n";
} else if($item == "food") {
// 如果物品是食物，则回复玩家的血量
$playerHealth = min(100, $playerHealth + 20);
echo "你使用了食物，血量回复了 20 点。\n";
} else {
// 其他物品无法使用
echo "这个物品无法使用。\n";
}
} else {
// 玩家输入的物品无效，提示错误信息
echo "你没有这个物品。\n";
}
break;
case "attack":
// 玩家想要攻击怪物
$monster = array_shift($inputArr);
if($monster && isset($monsters[$monster])) {
// 玩家输入的怪物存在
$monsterHealth = $monsters[$monster]["health"];
$monsterDamage = $monsters[$monster]["damage"];
$monsterName = $monsters[$monster]["name"];
// 循环进行攻击，直到有一方血量为 0
while($playerHealth > 0 && $monsterHealth > 0) {
$monsterHealth -= 10;
$playerHealth -= $monsterDamage;
}
if($playerHealth <= 0) {
// 玩家死亡，游戏结束
$gameOver = true;
echo "你被 $monsterName 杀死了！\n";
} else {
// 玩家击败了怪物
echo "你击败了 $monsterName ！\n";
}
} else {
// 玩家输入的怪物无效，提示错误信息
echo "这里没有这个怪物。\n";
}
break;
case "exit":
// 玩家想要结束游戏
$gameOver = true;
break;
default:
// 玩家输入了无效的命令，提示错误信息
echo "无效的命令。\n";
break;
}
}

while(!$gameOver) {
    // 打印玩家的状态
    printStatus();
    // 输出提示信息
    echo "> ";
    // 读取玩家的输入
    $stdin = fopen('php://stdin', 'r');
    $input = fgets($stdin);
    
    // 处理玩家的输入
    processInput($input);
  }
  
  