<!--登録結果!-->
<?php
session_start();

require_once '/xampp/htdocs/PD/classes/RegLogic.php';


$token = filter_input(INPUT_POST,'csrf_token');
$img_data = $_SESSION['img_data'];
//トークンがない、一致しない
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
    header('Location: imgregister.php');
    exit();
}

unset($_SESSION['csrf_token']);
unset($_SESSION['img_data']);

$filename = date('Y-m-d_H-i-s');
$posts = $_POST;
$file = array('name'=>$filename, 'type'=>$posts['type'],'tmp_name'=>$img_data,'size'=>$posts['size']);
unset($posts['name']);
unset($posts['type']);
unset($posts['tmp_name']);
unset($posts['size']);
#エラー処理
$err = [];

$hasCreated = UserLogic::createUser($posts,$file);

    if(!$hasCreated){
        $err[] = '投稿失敗しました。';
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./registerStyle.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿完了画面</title>
</head>
<body>
<div id="particles-js"></div>
<div id="wrapper">
    <!-- エラーがあればエラー文表示　無ければ完了表示 -->
    <div class = "answer">
    <?php if (count($err) > 0) : ?>
            <h1 class =title>確認事項</h1>
            <?php foreach($err as $e) : ?>
                <p class = "check"><?php echo $e; ?></p>
            <?php endforeach ?>
        <?php else : ?>
            <p class = "check">登録完了しました。</p>
        <?php endif ?>
        <div class = "btn">
            <form method='POST' action='./imgregister.php'>  
                <input class = "btn1" type='submit' value="投稿フォームへ戻る">
            </form>
        </div>
    </div>
</div>
<script src="/js/app.js"></script>
<script src="/js/particles.js"></script>
</body>
</html>
