<?php

require_once '/xampp/htdocs/PD/dbconnect.php';
class Errors
{
    public static function err($posts)
    {
        $err = [];

        if(!filter_input(INPUT_POST,'password')){
            $err['err_password'] = 'パスワードを入力してください。';
        }
        if(!filter_input(INPUT_POST,'email')){
            $err['err_email'] = 'メールアドレスを入力してください。';
        }
        return $err;
    }
}

class Logic{
    public static function login($email,$pass){
        $result = false;

        $user = selfclass::getUserByEmail($email);
        if(!$user){
            $_SESSION['msg'] = 'emailが一致しません。';
            return $result;
        }

        if(password_verify($pass,$user['password'])){
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }else{
            $_SESSION['msg'] = 'パスワードが一致しません。';
            return $result;
        }
        
    }
}

class selfclass{
    public static function getUserByEmail($email){
        $sql = 'SELECT * FROM users WHERE email = ?';
        $arr = [];
        $arr[] = $email;

        try {
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr);
            $result = $stmt->fetch();
            return $result;
        } catch (\Exception $e) {
            return $result;
        }
    }
}