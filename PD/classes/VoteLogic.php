<?php

require_once '/xampp/htdocs/PD/dbconnect.php';

//画像取得
class Imagedata
{

    /**
     * @return array $result
     */
    public static function readImages($row_count)
    {
        //現在のページ取得
        $page = 1;
        if(isset($_GET['page']) && is_numeric($_GET['page'])){
            $page = (int)$_GET['page'];
        }
        if(!$page){
            $page = 1;
        }
        $result = [];
        $sql = "SELECT * FROM images ORDER BY ID LIMIT ".(($page - 1) * $row_count).", ".$row_count;
        try {
            //sql実行準備
            $stmt = connect()->query($sql);
            //sqlのクリエ実行
            $res = $stmt->execute();
            if($res){
                //データを配列で取得
                $result = $stmt->fetchAll();
            }else{
                $result = 'しっぱい';
            }
            return $result;
        } catch (\Exception $e) {
            return $result;
        }
    }
}

//投票できる画像の総数の取得
class NumberOfimage
{
    public static function countofimage()
    {
        $sql = 'SELECT count(*) as count FROM images';
        try {
            //sql実行準備
            $stmt = connect()->query($sql);
            //sqlのクリエ実行
            $res = $stmt->execute();
            if($res){
                //データを配列で取得
                $result = $stmt->fetchAll();
            }else{
                $result = 'しっぱい';
            }
            return $result;
        } catch (\Exception $e) {
            return $result;
        }
    }
}

//投票
class Vote
{
    /**
     * @param array $_POST
     * @return bool $result
     */
    public static function voting($data)
    {
        $result = false;
        $sql = 'UPDATE images SET count = count + 1 WHERE ID = ?';
        $arr = [];
        $arr[] = intval($data['ID']);
        try {
            //sql実行準備
            $stmt = connect()->prepare($sql);
            //sqlのクリエ実行
            $result = $stmt->execute($arr);
            
            return $result;
        } catch (\Exception $e) {
            return $e;
        }
    }
}

class UserofVote{
    
    /**
     * @param array $_POST
     * @param array $_SESSON['login_user]
     * @return bool $result
     */
    public static function uservote($img, $user,$count){
        $result = false;
        $sql = 'UPDATE users SET vote_count = ?, '.$count.' = ? WHERE userID = ?';
        $next = VoteCount::count($count);
        $arr = [];
        $arr[] = $next;
        $arr[] = intval($img['ID']);
        $arr[] = intval($user['userID']);
        try {
            //sql実行準備
            $stmt = connect()->prepare($sql);
            //sqlのクリエ実行
            $result = $stmt->execute($arr);
            return $result;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
class VoteCount{
    public static function count($count){
        switch($count){
            case "a":
                $result = "b";
                break;
            case "b":
                $result = "c";
                break;
            case "c":
                $result = "d";
                break;
            case "d":
                $result = "e";
                break;
            case "e":
                break;
        }
        return $result;
    }
}