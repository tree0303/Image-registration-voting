<?php
session_start();
if(!isset($_SESSION['login_user'])){
    header("location:javascript://history.go(-1)");
    exit();
}else{
    unset($_SESSION['login_user']);
    header("location:".$_SESSION['logout']);
    unset($_SESSION['logout']);
    exit();
}


