<?php

/*XSS対策 */
function h($str){
    return htmlspecialchars($str, ENT_QUOTES,'UTF-8');
}

 /*CSRF対策*/
function setToken() {
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;
    return $csrf_token;
}