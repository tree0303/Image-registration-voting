<?php
session_start();
require_once '/xampp/htdocs/PD/classes/VoteLogic.php';
require_once '/xampp/htdocs/PD/functions.php';

if(empty($_SESSION['login_user'])){
    header('Location:/login/login.php');
    $_SESSION['msg'] = '投票はログインしてからお願いします。';
    exit();
}

$token = filter_input(INPUT_POST,'csrf_token');
//トークンがない、一致しない
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
    header('Location: imgdisplay.php');
    exit();
}
unset($_SESSION['csrf_token']);

$count = $_SESSION['login_user']['vote_count'];
$arr = [];
if($count=='e'){
    $arr[] = '最大数投票しています。';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vote.css" type="text/css">
    <title>投票確認</title>
</head>
<body>
<div id="particles-js"></div>
<div id="wrapper">
    <div class="main">
    <legend class="ti">投票確認</legend>
    <?php if($_POST['flag'] == "TRUE"): ?>
        <?php 
        $result = Vote::voting($_POST);
        $resultvote = UserofVote::uservote($_POST,$_SESSION['login_user'],$count);
        if(!$result || !$resultvote){
            $arr[] = '投票失敗';
        }
        ?>
        投票しました。
    <?php elseif($_POST['flag'] == "FALSE"): ?>
        <img src="data:<?php $_POST['type'] ?>;base64,<?php echo $_POST['image']; ?>" >
        <form action="voteconfi.php" method="POST">
            <input type="hidden" value="<?php echo h($_POST['ID']); ?>" name="ID">
            <?php if(isset($_POST['page'])) {if($_POST['page']>0){
                echo '<input type="hidden" value="'.$_POST['page'].'" name="page">';
            }}?>
            <input type="hidden" value="TRUE" name="flag">
            <input type="hidden" value="<?php echo h(setToken()); ?>" name="csrf_token">
            <div class="aa">こちらの絵に投票しますか。</div>
            <div><input type="submit" value="投票確定" class="btn1"></div>
        </form>
    <?php endif; ?>
    <div>
        <form action="./imgdisplay.php" method="GET">
            <?php if(isset($_POST['page'])) {if($_POST['page']>0){
                echo '<input type="hidden" value="'.$_POST['page'].'" name="page">';
                }}?>
            <input type="submit" value="戻る" class = "back">
        </form>
    </div>
    </div>

</div>
<script src="/js/app.js"></script>
<script src="/js/particles.js"></script>
</body>
</html>