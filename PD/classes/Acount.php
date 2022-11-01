<?php
require_once '/xampp/htdocs/PD/dbconnect.php';
class Errors
{
    public static function err($posts)
    {
        $err = [];

        if(!filter_input(INPUT_POST,'Fname') || !filter_input(INPUT_POST,'Lname')){
            $err['err_name'] = '名前を入力してください。';
        }
        if(!filter_input(INPUT_POST,'email')){
            $err['err_email'] = 'メールアドレスを入力してください。';
        }
        $password = filter_input(INPUT_POST,'password');
        $password_conf = filter_input(INPUT_POST,'password_conf');
        if(!preg_match("/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$/",$password) || !$password){
            $err['err_password'] = 'パスワードをは半角英小文字大文字数字をそれぞれ1種類以上で8文字以上100文字以下で入力してください。';
        }
        if($password!==$password_conf){
            $err['err_password_conf'] = '確認用パスワードと異なっています。';
        }
        return $err;
    }
}

class AccountLogic{
    public static function createAccount($info){
        $result = false;
        $sql = 'INSERT INTO users (Fname,Lname,email,password) VALUES(?,?,?,?)';

        $arr = [];
        $arr[] = $info['Fname'];
        $arr[] = $info['Lname'];
        $arr[] = $info['email'];
        $arr[] = password_hash($info['password'],PASSWORD_DEFAULT);
        
        try {
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr);
            return $result;
        } catch (\Exception $e) {
            return $result;
        }
        
    }
}