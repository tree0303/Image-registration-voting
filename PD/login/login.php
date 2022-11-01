<?php
session_start();
require_once '/xampp/htdocs/PD/functions.php';
$flag=true;
if(isset($_SESSION['login_user'])){
    $flag=false;
}
$session = isset($_SESSION['back']) ? $_SESSION['back'] : null;
unset($_SESSION['back']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css" type="text/css">
    <title>ログインフォーム</title>
</head>
<body>
<div id="particles-js"></div>
<div id="wrapper">
    <h2>ログインフォーム</h2>
    <div class="main">
    <?php if($flag): ?>
        <form action="loginconfi.php" method="POST">
            
            <div class="ele">
                <label for="email">メールアドレス</label>
                <input type="text" name="email" value="<?php echo isset($session['email']) ? h($session['email']) : "" ; ?>">
                <?php if(isset($session['err_email'])): ?> 
                <p class="err_message"><?php echo h($session['err_email']); ?></p>
                <?php endif; ?>
            </div>
            <div class="ele">
                <label for="password">パスワード</label>
                <input type="password" name="password">
                <?php if(isset($session['err_password'])): ?> 
                <p class="err_message"><?php echo h($session['err_password']); ?></p>
                <?php endif; ?>
            </div>
            <!-- トークン -->
            <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
            <input type="submit" value="ログイン" class='btn1'>
            <?php if(isset($session['msg'])): ?> 
                <p class="err_message"><?php echo h($session['msg']); ?></p>
            <?php endif; ?>
            <!-- ホームに戻るボタン -->
            <button value="ホームページ" formaction="/home/home.php" class='btn1'>戻る</button>
        </form>
    <?php else: ?>

        <div class="ele">
            ログイン済みです。別のアカウントでログインする場合は一度ログアウトしてください。
            <form method='POST' action='/home/home.php'>  
            <input class = "btn1" type='submit' value="ホームページ">
        </form>
            <br>
            <a href="<?php $_SESSION['logout'] = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            echo '/logout/logout.php';?>">ログアウトはこちら</a>

        </div>
    <?php endif; ?>
        
        <a href="../account/accountcrea.php">アカウント未登録の方はこちら</a>
        
    </div>
</div>
<script src="../js/app.js"></script>
<script src="../js/particles.js"></script>
</body>
</html>