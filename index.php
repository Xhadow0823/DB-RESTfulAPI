<?php
require 'F:\MAMP\bin\php\php7.2.10\vendor/autoload.php';
require './DAO.php';
require './tools.php';

$router = new Roller\Router(null, array(
    'cache_id' => 'db_router'
));

DAO::connect("localhost", "root", "admin", "dbproject");
$router->add('/', function(){
    return 'SUCCESS';
});

$router->add('/test', function(){
    // insert 一筆Creator資料 -> 取得該筆資料的ID -> 查看ID
    DAO::query(insertCreatorQuery("IV4", "IV6"));
    DAO::query(getLastID());
    echo json_encode(DAO::getResult())."<br />";

    // 查看所有Creator的數量
    DAO::query(testQuery());
    echo json_encode(DAO::getResult())."<br />";

    return 'TEST'."<br />";
});


// $router->post('/create', function(){
//     $key = isset($_POST['key']) ? $_POST['key'] : 'none';
//     // print_r(json_decode(file_get_contents('php://input'), true));
//     return "/create, key=$key";
// });


// 輸出結果內容
$r = $router->dispatch( isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/' );
if($r){
    echo $r();
}else{
    die('Page not found');
}
DAO::disconnect();

?>