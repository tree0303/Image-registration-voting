<?php
session_start();

require_once '/xampp/htdocs/PD/functions.php';
require_once '/xampp/htdocs/PD/classes/RegLogic.php';


$token = filter_input(INPUT_POST,'csrf_token');
//CSRF、二重送信
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
    header('Location: imgregister.php');
    exit();
}
unset($_SESSION['csrf_token']);
unset($_SESSION['back']);

$posts = $_POST;
$file = $_FILES['image'];

#エラー処理
$err = [];
$err = Errors::err($_POST,$_FILES);

if(count($err)>0){
    //エラーがあると戻す
    $_SESSION['back'] = array_merge($err, $_POST);
    header('Location: imgregister.php');
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./regconfirm.css" type="text/css">
    <link rel="stylesheet" href="/ress.css" type="text/css">
    <title>投稿確認</title>
</head>
<body>
<div id="particles-js"></div>
<div id="wrapper">
<legend>投稿確認</legend>
<div class="main">
    <form enctype="multipart/form-data" method='POST' action='./register.php'>
        <fieldset class="dis">
                <?php $img_data = file_get_contents($file['tmp_name']);
                        $_SESSION['img_data']=$img_data;
                        $img = base64_encode($img_data); ?>
                <img src="data:<?php h($file['type']); ?>;base64,<?php echo h($img); ?>" width="300">

                
                <section><div class="ele">タイトル名:</div>     <div class="con"><?php echo h($posts['image_name']); ?></div></section>
                <section><div class="ele">モチーフ:</div>     <div class="con"><?php echo h($posts['image_motif']); ?></div></section>
                <section><div class="ele">氏名:</div>           <div class="con"><?php echo h($posts['user_Fname']); ?><?php echo h($posts['user_Lname']); ?></div></section>
                <section><div class="ele">メールアドレス:</div>  <div class="con"><?php echo h($posts['user_email']); ?></div></section>
                <section><div class="ele">住所:</div>           <div class="con"><?php echo h($posts['user_address']); ?></div></section>
                <section><div class="ele">電話番号:</div>       <div class="con"><?php echo h($posts['user_phonenumber']); ?></div></section>
                <section><div class="ele">学校名:</div>         <div class="con"><?php echo h($posts['user_school']); ?></div></section>
                <section><div class="ele">学年:</div>           <div class="con"><?php echo h($posts['user_grade']); ?></div></section>
                
                <!-- 登録実行ボタン -->
                <input type='submit' value="登録" class='btn1'>
                <!-- 戻るボタン -->
            <button value="戻る" formaction="./imgregister.php" class="btn1">戻る</button>

        </fieldset>
        
        <fieldset class='inform'>
            <input type='text' name='name' value="<?php echo h($file['name']); ?>" readonly>
            <input type='text' name='type' value="<?php echo h($file['type']); ?>" readonly>
            <input type='text' name='tmp_name' value="<?php echo h($file['tmp_name']); ?>" readonly>
            <input type='text' name='size' value="<?php echo h($file['size']); ?>" readonly>
            
            <input type='text' name='image_name' value="<?php echo h($posts['image_name']); ?>" readonly>
            <input type='text' name='image_motif' value="<?php echo h($posts['image_motif']); ?>" readonly>
            <input type='text' name='user_Fname' value="<?php echo h($posts['user_Fname']); ?>" readonly>
            <input type='text' name='user_Lname' value="<?php echo h($posts['user_Lname']); ?>" readonly>
            <input type='text' name='user_email' value="<?php echo h($posts['user_email']); ?>" readonly>
            <input type='text' name='user_address' value="<?php echo h($posts['user_address']); ?>" readonly>
            <input type='text' name='user_phonenumber' value="<?php echo h($posts['user_phonenumber']); ?>" readonly>
            <input type='text' name='user_school' value="<?php echo h($posts['user_school']); ?>" readonly> 
            <input type='text' name="user_grade" value="<?php echo h($posts['user_grade']); ?>" readonly>

            
            
        </fieldset>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
            
        
    </form>
</div>
<script src="/js/app.js"></script>
<script src="/js/particles.js"></script>
</div> 
</body>
</html>