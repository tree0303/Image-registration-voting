<?php
session_start();
require_once '/xampp/htdocs/PD/functions.php';
require_once '/xampp/htdocs/PD/classes/Acount.php';


$token = filter_input(INPUT_POST,'csrf_token');
//トークンがない、一致しない
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
    header('Location: accountcrea.php');
    exit();
}
$info = array('Fname'=>$_POST['Fname'],'Lname'=>$_POST['Lname'],'email'=>$_POST['email'],'password'=>$_SESSION['ps']);
unset($_SESSION['csrf_token']);
unset($_SESSION['ps']);
$err = [];
$hasCreated = AccountLogic::createAccount($info);

    if(!$hasCreated){
        $err[] = '投稿失敗しました。';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./accountreg.css" type="text/css">
    <title>アカウント登録完了</title>
</head>
<body>
<div id="particles-js"></div>
<div id="wrapper">
    <!-- エラーがあればエラー文表示　無ければ完了表示 -->
    <?php if (count($err) > 0) : ?>
        <div class = "answer">
            <h1 class =title>確認事項</h1>
            <?php foreach($err as $e) : ?>
                <p class = "check"><?php echo $e; ?></p>
            <?php endforeach ?>
        <?php else : ?>
            <p class = "check">登録完了しました。</p>
        <?php endif ?>
        <div class = "btn">
            <form action='/login/login.php'>  
                <input class = "btn1" type='submit' value="ログイン画面">
            </form>
            <form action='/home/home.php'>  
                <input class = "btn1" type='submit' value="ホームページ">
            </form>
        </div>
    </div>
</div>
<script src="../js/app.js"></script>
<script src="../js/particles.js"></script>
</body>
</html>