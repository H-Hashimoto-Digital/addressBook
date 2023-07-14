<?php
    // ユーザー検索機能

    // セッションは C:\xampp\tmp に保存されている
    session_start(); //セッション起動

    require('dbconnect.php'); // 別ファイルに書かれた処理をを実行

    // 検索ワードを取得
    $search = $_GET['search'];

    // 検索結果を格納する配列
    $array = array();
    

    // 検索ワードを基にuser_loginからユーザーを検索。検索対象となったユーザ名を配列$arrayに入れる。
    $sql_search = "SELECT user_name FROM user_login WHERE user_name LIKE '%".$search."%'";
    if($result_search = $mysqli->query($sql_search)){
        $i = 0;
        while($row = $result_search->fetch_assoc()){
            $array[$i] = $row['user_name'];
            $i++;
        }
    }

    // 検索結果の入った$arrayをhome.phpに渡す
    // header(GET用)でパラメータを渡してはならない
    // $url = "./home.php/?search=".$array;
    // header("Location:".$url);

?>