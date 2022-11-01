<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>未来のまち創造館-ホーム</title>
        <meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
        <meta name="author" content="Vincent Garreau" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="home.css" >
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    
    </head>
    <body>
    <div id="particles-js"></div>
    <div id="wrapper">
        <nav class="head">
            <ul>
            <li class="current"><a href="home.php">ホーム</a></li>
            <li><a href="../detail/index.html">コンテストについて</a></li>
            <li><a href="../reference/reference.html">参考リンク集</a></li>
            <li><a href="../contact/Contact.html">問い合わせ</a></li>
            </ul>
        </nav>

        <div class="login">
            <?php if(isset($_SESSION['login_user'])) : ?>
                <?php $_SESSION['logout'] = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>
                <form action="/logout/logout.php">
                    <input type="submit" value="ログアウト">
                </form>
            <?php else: ?>
                <form action="/login/login.php">
                    <input type="submit" value="ログイン">
                </form>
            <?php endif; ?>
        </div>

        <div class="openbtn1"><span></span><span></span><span></span></div>
        <nav id="g-nav">
        <div id="g-nav-list"><!--ナビの数が増えた場合縦スクロールする-->
        <ul>
        <li><a href="<?php if(isset($_SESSION['login_user'])){
            $_SESSION['logout'] = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            echo '/logout/logout.php';
        }else{
            echo '/login/login.php';
        }
        ?>">
        <?php echo isset($_SESSION['login_user']) ?  'ログアウト' :  'ログイン'; ?></a></li>     
        <li><a href="/home/home.php">ホーム</a></li>  
        <li><a href="/detail/index.html">コンテストについて</a></li>  
        <li><a href="/reference/reference.html">参考リンク集</a></li>  
        <li><a href="/contact/Contact.html">問い合わせ</a></li>  
        <li><a href="/public/register/imgregister.php">投稿</a></li> 
        <li><a href="/public/vote/imgdisplay.php">投票</a></li> 
        </ul>
        </div>
        </nav>

        <div class="Topics">
            <h1>Topics</h1>
            <dl>
            <dt>2021/11/12</dt>
            <dd>PD？何それ</dd>
            <dt>2021/11/05</dt>
            <dd>PD行きたくない</dd>
            <dt>2021/11/05</dt>
            <dd>人そろわない問題</dd>
            </dl>
        </div>
        <div class="explanation">
            <h2>金沢未来のまち創造館について</h2>
            <p>未来はどこからやってくるのでしょう？<br>

                最先端の技術や研究も必要です。<br>
                でも、そこに金沢らしさがなければ、金沢未来、とはいえない。<br>
                <br>
                金沢の歴史や文化、伝統を見つめ、誇りを持って語れる魅力があるからこそ、<br>
                思い描きたい未来も生まれてくる。そう思うのです。<br>
                <br>
                金沢の未来をみんなで考えたくて、新しい拠点を作りました。<br>
                金沢未来の街創造。ここには、IotやAIなど最先端分野をはじめ、<br>
                金沢市が誇る工芸やものづくり、食やアートなどさまざまな文化、<br>
                未来を担う子供たちのワークショップが一つ屋根の下に集っています。<br>
                <br>
                つくりたいのは、さまざまな枠を超え、多様な価値観をつなぐことで、<br>
                新しい価値観へと繋がる可能性です。<br>
                <br>
                未来は人からやってくる。あなたも、金沢の未来の一人です。<br>
            </p>
        </div>
        <div class="pav">
            <h3>・投稿・投票はこちらから</h3>
        <div class="triangle-bottom"></div>
            <img src="">
            <nav>
                <li><a href="/public/register/imgregister.php" class="btn-icon">投稿フォーム</a></li>
                <li><a href="/public/vote/imgdisplay.php" class="btn-icon">投票フォーム</a></p></li>
            </nav>
        </div>
          
    </div>
    <footer id="footer">
            <p id="page-top"><a href="#">Page Top</a></p> 
        <small>&copy; copyright.</small>  
    </footer>
    
    <script src="../js/app.js"></script>
    <script src="../js/particles.js"></script>
    <script src="../js/pagetop.js"></script>
    <script src="../js/nav.js"></script>
    </body>
    
</html>