<?php
    // ユーザー検索機能

    // セッションは C:\xampp\tmp に保存されている
    session_start(); //セッション起動

    require('dbconnect.php'); // 別ファイルに書かれた処理をを実行

    // 検索ワードを取得
    $search = $_GET['search'];

    // 検索結果を格納する配列
    $array = array();
    

    // 検索ワードを基にuser_loginからユーザーを検索
    $sql = "SELECT user_name FROM user_login WHERE user_name LIKE '%".$search."%'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 検索結果を配列$arrayに格納
    $i = 0;

    foreach($stmt as $row){
        $array[$i] = $row['user_name'];
        $i++;
    }

    // 検索結果の入った$arrayをhome.phpに渡す
    $url = "./home.php/?search=".$array;
    header("Location:".$url);

?>