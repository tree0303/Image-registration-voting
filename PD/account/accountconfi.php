<?php 
session_start();
require_once '/xampp/htdocs/PD/classes/Acount.php';
require_once '/xampp/htdocs/PD/functions.php';

$token = filter_input(INPUT_POST,'csrf_token');
//トークンがない、一致しない
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
    header('Location: accountcrea.php');
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
    if(isset($_POST['password_conf'])){
        unset($_POST['password_conf']);
    }
    $_SESSION['back'] = array_merge($err, $_POST);
    header('Location: accountcrea.php');
    return;
}


?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./accountconfi.css" type="text/css">
    <title>アカウント登録</title>
    <style>
        fieldset.inform{
            display: none;
        }
    </style>
</head>
<body>
<div id="particles-js"></div>
<div id="wrapper">
    <form action="accountreg.php" method="POST">
    <legend>登録内容確認</legend>
    <fieldset class="main">
                <div class="ele">
                <label>氏名:</label>
                <div class="con"><?php $name = $_POST['Fname'].$_POST['Lname']; echo h($name);?></div>
                </div>

                <div class="ele">
                <label>email:</label>
                <div class="con"><?php echo h($_POST['email']); ?></div>
                </div>

                <div class="ele">
                <label>パスワード:</label>
                <div class="con"><?php echo h(str_repeat("・",strlen($_POST['password']))) ?></div>
                </div>
                <!-- 登録実行ボタン -->
                <input type='submit' value="登録" class='btn1'>
                <!-- 戻るボタン -->
                <button value="戻る" formaction="accountcrea.php" class='btn1'>戻る</button>

        </fieldset>
        
        <fieldset class='inform'>
            
            <input type='text' readonly name='Fname' value="<?php echo h($_POST['Fname']); ?>">
            <input type='text' readonly name='Lname' value="<?php echo h($_POST['Lname']); ?>">
            <input type='text' readonly name="email" value="<?php echo h($_POST['email']); ?>">
            <?php $_SESSION['ps'] = $_POST['password']; ?>
            
            
        </fieldset>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
            
        
    </form>
    </div>
<script src="../js/app.js"></script>
<script src="../js/particles.js"></script>
</body>
</html>