<?php
#エラー処理
$err = [];


if(!$file = filter_input(INPUT_POST,'image')){
    $err[] = 'ファイルを登録してください';
}
if(!$imagename = filter_input(INPUT_POST,'image_name')){
    $err[] = 'ファイルの名前を入力してください';
}
$username = filter_input(INPUT_POST,'user_name');

#エラーがないとき、、ファイルの投稿処理
if (count($err)===0){

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿完了画面</title>
    
</head>
<body>
    <?php if (count($err) > 0) : ?>
        <?php foreach($err as $e) : ?>
            <p><?php echo $e ?></p>
        <?php endforeach ?>
    <?php else : ?>
        <p>登録完了しました。</p>
    <?php endif ?>
    <form method='POST' action='./imgregister.php'>  
        <input type='submit' value="戻る">
    </form>
</body>
</html>