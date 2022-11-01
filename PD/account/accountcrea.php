<?php
session_start();
require_once '/xampp/htdocs/PD/functions.php';
$session = isset($_SESSION['back']) ? $_SESSION['back'] : null;
unset($_SESSION['csrf_token']);
unset($_SESSION['back']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./acountcrea.css" type="text/css">
    <title>アカウント作成フォーム</title>
</head>
<body>
<div id="particles-js"></div>
<div id="wrapper">
    <h2>アカウント作成フォーム</h2>
    <div class="main">
        <form action="accountconfi.php" method="POST">
            <div class="name">
                <label for="name">姓</label>
                <input type="text" name="Fname" value="<?php echo isset($session['Fname']) ? h($session['Fname']) : "" ; ?>" class="name">
                
                <label for="name">名</label>
                <input type="text" name="Lname" value="<?php echo isset($session['Lname']) ? h($session['Lname']) : "" ; ?>" class="name">
                <?php if(isset($session['err_name'])): ?> 
                <p class="err_message"><?php echo h($session['err_name']); ?></p>
                <?php endif; ?>
            </div>
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
            <div class="ele">
                <label for="password_conf">パスワード確認</label>
                <input type="password" name="password_conf">
                <?php if(isset($session['err_password_conf'])): ?> 
                <p class="err_message"><?php echo h($session['err_password_conf']); ?></p>
                <?php endif; ?>
            </div>
            <!-- トークン -->
            <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
            <input type="submit" value="アカウント作成" class="btn1">
            <button value="戻る" formaction="/home/home.php" class='btn1'>ホームページ</button>
        </form>
        <!-- ホームに戻るボタン -->
        
        <a href="/login/login.php">ログインはこちら</a>

    </div>
</div>
<script src="../js/app.js"></script>
<script src="../js/particles.js"></script>
</body>
</html>