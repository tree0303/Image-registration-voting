<?php

require_once '/xampp/htdocs/PD/dbconnect.php';

class UserLogic
{
    /**
     * ユーザーを登録
     * @param array $userData
     * @param array $fileData
     * @return bool $result
     */
    public static function createUser($userData,$fileData)
    {
        $result = false;
        $sql = 'INSERT INTO images (image , file_name,file_type ,image_name ,
        user_Fname,user_Lname,user_email,
          user_address, user_phonenumber, 
         user_school, user_grade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        //ユーザーデータを配列に
        $file = $fileData;
        $arr = [];
        $arr[] = $file['tmp_name'];
        $arr[] = $file['name'];//file['name]
        $arr[] = $file['type'];//file['type]
        $arr[] = $userData['image_name'];
        $arr[] = $userData['image_motif'];
        $arr[] = $userData['user_Fname'];
        $arr[] = $userData['user_Lname'];
        $arr[] = $userData['user_email'];
        $arr[] = $userData['user_address'];
        $arr[] = $userData['user_phonenumber'];
        if(empty($userData['user_school'])){
            $userData['user_school'] = NULL;
        }
        if(empty($userData['user_grade'])){
            $userData['user_grade'] = NULL;
        }
        $arr[] = $userData['user_school'];
        $arr[] = $userData['user_grade'];
        try {
            //sqlインジェクション
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr);
    
            return $result;
        } catch (\Exception $e) {
            return $e;
        }

    }

    
}
class Logic
{
    /**
     * @param string $filename
     * @return bool $result
     */
    public static function checkFile($filename)
    {
        $result = false;
        $sql = "SELECT * from images WHERE file_name = '".$filename."'";

        try {
            $stmt = connect()->prepare($sql);
            $stmt->execute();
            $list = $stmt->fetchAll();
            if(empty($list)){
                $result = true;
            }
            return $result;
        } catch (\Exception $e) {
            return $result;
        }
    }
}

class Errors
{
    public static function err($posts,$files)
    {
        $err = [];

        $file = $files['image'];
        if(!is_uploaded_file($file['tmp_name'])){
            $err['file'] = 'ファイルを登録してください';
        }else{
            $allow_ext = array('jpg', 'jpeg','png');
            $file_ext = pathinfo($file['name'],PATHINFO_EXTENSION);
            if(!in_array(strtolower($file_ext),$allow_ext)){
                $err['file_type'] = 'ファイルの拡張子をjpg, jpeg,pngのいずれかにしてください';
            }
            if($file['size']>16777216){
                $err['file_size'] = 'ファイルのサイズは16MB未満にしてください';
            }
            /*if(!Logic::checkFile($file['name'])){
                $err['file_name'] = 'ファイルの名前を変更してください';
            }*/
        }


        if(!filter_input(INPUT_POST,'image_name')){
            $err['image'] = '画像のタイトルの名前を入力してください';
        }else{
            if(strlen($_POST['image_name'])>21){
                $err['image'] = '20文字以内で入力してください';
            }
        }
        if(!filter_input(INPUT_POST,'image_motif')){
            $err['motif'] = 'モチーフとなった名所を入力してください。';
        }
        if(!filter_input(INPUT_POST,'user_Fname') || !filter_input(INPUT_POST,'user_Lname')){
            $err['name'] = '名前を入力してください。';
        }
        if(!filter_input(INPUT_POST,'user_address')){
            $err['address'] = '住所を入力してください。';
        }
        if(!filter_input(INPUT_POST,'user_email')){
            $err['err_user_email'] = 'emailを入力してください。';
        }
        if(!filter_input(INPUT_POST,'user_phonenumber')){
            $err['phone'] = '電話番号を入力してください。';
        }else{
            if(!is_numeric($posts['user_phonenumber'])){
                $err['phone_str'] = '電話番号は半角数字のみで入力してください。';
            }else{
                /*if(count($posts['user_phonenumber'])<8){
                    $err['phone_num'] = '電話番号は市外局番から入力してください。';
                }*/
            }
            
        }
        $userschool = filter_input(INPUT_POST,'user_school');
        $usergrade = filter_input(INPUT_POST,'user_grade');
        if(($usergrade && !$userschool) || ($userschool && !$usergrade)){
            $err['school'] = '学校名と学年を入力する場合両方入力してください';
        }
        return $err;
    }
}