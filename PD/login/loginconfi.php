<!--登録結果!-->
<?php
session_start();
require_once '/xampp/htdocs/PD/functions.php';
require_once '/xampp/htdocs/PD/classes/Login.php';


$token = filter_input(INPUT_POST,'csrf_token');
//トークンがない、一致しない
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
    header('Location: login.php');
    exit();
}
unset($_SESSION['csrf_token']);

//エラー処理
$err = [];
$err = Errors::err($_POST);
if(count($err)>0){
    //エラーがあると戻す
    if(isset($_POST['password'])){
        unset($_POST['password']);
    }
    $_SESSION['back'] = array_merge($err, $_POST);
    header('Location: login.php');
    return;
}

$hasCreated = Logic::login($_POST['email'],$_POST['password']);

    if(!$hasCreated){
        if(isset($_POST['password'])){
            unset($_POST['password']);
        }
        $_SESSION['back'] = array_merge(array('msg'=>$_SESSION['msg']), $_POST);
        header('Location: login.php');
        return;
    }

    unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./registerStyle.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./loginconfi.css" type="text/css">
    <title>投稿完了画面</title>
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
            <p class = "check">ログインしました。</p>
        <?php endif ?>
        <div class = "btn">
            <form action='/public/vote/imgdisplay.php'>  
                <input class = "btn1" type='submit' value="投票ページ">
            </form>
            <form action='/public/register/imgregister.php'> 
                <input class = "btn1" type='submit' value="投稿ページ">
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
