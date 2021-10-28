<?php

require_once './env.php';

function connect() 
{
    $host = 'DB_HOST';
    $db = 'DB_NAME';
    $user = 'DB_USER';
    $pass = 'DB_PASS';

    
    $dsn = "mysql:host=localhost;port=3306;dbname=img;charset=utf8mb4";
    try{
        $pdo = new PDO($dsn,'user','password',[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        echo '接続成功';
    }catch(PDOException $e){
        echo '接続失敗'. $e->getMessage();
        exit();
    }
}
