<!--投稿フォーム!-->
<?php 
session_start();
require_once '/xampp/htdocs/PD/functions.php';

$session = isset($_SESSION['back']) ? $_SESSION['back'] : null;
unset($_SESSION['back']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./design.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title font-size:100px;>投稿フォーム</title>
</head>
<body ><!--    background="/image/background.jpg"     !-->
<div id="particles-js"></div>
<div id="wrapper">
    <div class="bg_test">
        <!--  フォーム文 !-->
        <form enctype="multipart/form-data" method='POST' action='./regconfirm.php'>
            <legend>投稿フォーム</legend>

            <!-- ファイル入力!-->
            <fieldset class="img">
            <label class="tagu">ファイル<label class="must">必須</label> </label>
            <div class="div1">
            <input type='file' name='image' accept="image/*" value="<?php echo isset($session['image']) ? h($session['image']) : "" ; ?>">
            <?php if(isset($session['file'])): ?> 
                <p class="err_message"><?php echo h($session['file']); ?></p>
                <?php elseif(isset($session['file_type'])): ?>
                <p class="err_message"><?php echo h($session['file_type']); ?></p>
                <?php elseif(isset($session['file_size'])): ?>
                <p class="err_message"><?php echo h($session['file_size']); ?></p>
                <?php elseif(isset($session['file_name'])): ?>
                <p class="err_message"><?php echo h($session['file_name']); ?></p>
            <?php endif; ?>
            </div>
            <hr>
            
            <!-- 画像タイトル名!-->
            <label class="tagu">画像のタイトル名<label class="must">必須</label> </label>
            <div class="div">
            <input type='text' name='image_name' value="<?php echo isset($session['image_name']) ? h($session['image_name']) : "" ; ?>" placeholder="例：ひゃくまんさん">
            <?php if(isset($session['image'])): ?> 
                <p class="err_message"><?php echo h($session['image']); ?></p>
            <?php endif; ?>
            </div>
            <hr>

            <!-- 画像のモチーフ!-->
            <label class="tagu">画像のモチーフ<label class="must">必須</label> </label>
            <div class="div">
            <input type='text' name='image_motif' value="<?php echo isset($session['image_motif']) ? h($session['image_motif']) : "" ; ?>" placeholder="例：金沢城、加賀友禅">
            <?php if(isset($session['motif'])): ?> 
                <p class="err_message"><?php echo h($session['motif']); ?></p>
            <?php endif; ?>
            </div>
            <hr>

            <!-- 氏名!-->
            <label class="tagu">姓<label class="must" >必須</label> </label>
            <div class="div">
            <input type='text' name='user_Fname' value="<?php 
            if(isset($_SESSION['login_user'])){
                echo h($_SESSION['login_user']['Fname']);
            }else{
            echo isset($session['user_Fname']) ? h($session['user_Fname']) : "" ; }?>" 
            placeholder="例：山田" <?PHP echo isset($_SESSION['login_user']) ? h('readonly'): ""; ?>>
            </div>
            
            <label class="tagu">名<label class="must" >必須</label> </label>
            <div class="div">
            <input type='text' name='user_Lname' value="<?php 
            if(isset($_SESSION['login_user'])){
                echo h($_SESSION['login_user']['Lname']);
            }else{
            echo isset($session['user_Lname']) ? h($session['user_Lname']) : "" ; }?>" 
            placeholder="例：太郎" <?PHP echo isset($_SESSION['login_user']) ? h('readonly') : ""; ?>>
            <?php if(isset($session['name'])): ?> 
                <p class="err_message"><?php echo h($session['name']); ?></p>
            <?php endif; ?>
            </div>
            <hr>

            <!-- メールアドレス!-->
            <label class="tagu">メールアドレス<label class="must" >必須</label> </label>
            <div class="div">
            <input type='text' name='user_email' value="<?php 
            if(isset($_SESSION['login_user'])){
                echo h($_SESSION['login_user']['email']);
            }else{
            echo isset($session['user_email']) ? h($session['user_email']) : "" ; }?>" 
            placeholder="例：example@gmail.com" <?PHP echo isset($_SESSION['login_user']) ? h('readonly') : ""; ?>>
            <?php if(isset($session['err_user_email'])): ?> 
                <p class="err_message"><?php echo h($session['err_user_email']); ?></p>
            <?php endif; ?>
            </div>
            <hr>
            
            <!-- 住所!-->
            <label class="tagu">住所<label class="must">必須</label> </label>
            <div class="div">
            <input type='text' name='user_address' value="<?php echo isset($session['user_address']) ? h($session['user_address']) : "" ; ?>" placeholder="例：石川県金沢市野町3丁目11-1">
            <?php if(isset($session['address'])): ?> 
                <p class="err_message"><?php echo h($session['address']); ?></p>
            <?php endif; ?>
            </div>
            <hr>
            
            <!-- 電話番号!-->
            <label class="tagu">電話番号<label class="must">必須</label> </label>
            <div class="div">
            <input type='text' name='user_phonenumber' value="<?php echo isset($session['user_phonenumber']) ? h($session['user_phonenumber']) : "" ; ?>" placeholder="例：09012345678">
            <?php if(isset($session['phone'])): ?> 
                <p class="err_message"><?php echo h($session['phone']); ?></p>
                <?php elseif(isset($session['phone_str'])): ?>
                <p class="err_message"><?php echo h($session['phone_str']); ?></p>
                <?php elseif(isset($session['phone_num'])): ?>
                <p class="err_message"><?php echo h($session['phone_num']); ?></p>
            <?php endif; ?>
            </div>
            <hr>

            <!-- 学校!-->
            <label class="tagu">学校名</label>
            <div class="div">
            <input type='text' name='user_school' value="<?php echo isset($session['user_school']) ? h($session['user_school']) : "" ; ?>" placeholder="例：野町小学校">
            </div>
            <label class="tagu">学年</label>
            <div class="div2">
            <select name="user_grade" value="<?php echo isset($session['user_grade']) ? h($session['user_grade']) : "" ; ?>">
                <option ></option>
                <option value="1年">1年</option>
                <option value="2年">2年</option>
                <option value="3年">3年</option>
                <option value="4年">4年</option>
                <option value="5年">5年</option>
                <option value="6年">6年</option>
            </select>
            <?php if(isset($session['school'])): ?> 
                <p class="err_message"><?php echo h($session['school']); ?></p>
            <?php endif; ?>
            </div>
            <hr>
            <!-- トークン -->
            <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
            <!-- 登録実行ボタン -->
            <input type='submit' value="登録" class='btn1'>
            <!-- ホームに戻るボタン -->
            <button value="戻る" formaction="/home/home.php" class='btn1'>戻る</button>
            </fieldset>
        </form>
    </div>
</div>
<script src="/js/app.js"></script>
<script src="/js/particles.js"></script>
</body>
</html>