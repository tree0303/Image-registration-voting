<?php
session_start();
require_once '/xampp/htdocs/PD/classes/VoteLogic.php';
require_once '/xampp/htdocs/PD/classes/Paging.php';
require_once '/xampp/htdocs/PD/functions.php';

if(empty($_SESSION['login_user'])){
    header('Location:/login/login.php');
    $_SESSION['msg'] = '投票はログインしてからお願いします。';
    exit();
    unset($_SESSION['vote']);
}
$token = setToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票フォーム</title>
    <link rel="stylesheet" href="./imgdisplay.css" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
</head>
<body>
<div id="particles-js"></div>
<div id="wrapper">
    <?php $imagecount = NumberOfimage::countofimage(); 
    $page=0;?>

    <div class="pagination">
        
        <?php 
            $row_count = 4;
            $data = Imagedata::readImages($row_count);
            $pageing = new Paging();
            $pageing -> count = $row_count;
            $pageing -> setHtml($imagecount[0]['count']);
        ?>
        <div class="mid">
            <?php foreach($data as $value): ?>
                <?php $img = base64_encode($value['image']); ?>
                <a href="data:<?php $value['file_type'] ?>;base64,<?php echo $img; ?>" data-lightbox="group">
                    <article class="imagedisplay">
                        <figure>
                            <img src="data:<?php $value['file_type'] ?>;base64,<?php echo $img; ?>" width="300">
                        </figure>
                        <div class="text_content">
                            <h2>タイトル:<?php echo $value['image_name'] ?></h2>
                            <h2>作者:<?php echo $value['user_Fname'].$value['user_Lname'] ?><h2>
                        </div>
                    </article>
                </a>
                <form method='POST' action='./voteconfi.php' class="vote">
                    <input type="hidden" value="<?php echo h($value['ID']); ?>" name="ID">
                    <input type="hidden" value="<?php echo $img;?>" name="image">
                    <input type="hidden" value="<?php echo h($value['file_type']);?>" name="type">
                    <?php if(isset($_GET['page'])){if($_GET['page']>0){
                    echo '<input type="hidden" value="'.$_GET['page'].'" name="page" >';
                    }}?>
                    <input type="hidden" value="FALSE" name="flag">
                    <input type="hidden" value="<?php echo h($token) ?>" name="csrf_token">
                    <input type="submit" class='btn1' value="投票">
                </form>
            <?php endforeach;?>
        </div>
            <form action="/home/home.php"><button value="戻る" class="btn_back">ホームに戻る</button></form>
        <?php echo $pageing -> html; ?>
    </div>

</div>
<script src="/js/app.js"></script>
<script src="/js/particles.js"></script>
</body>
</html>


