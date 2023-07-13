<?php
    // セッションは C:\xampp\tmp に保存されている
    session_start(); //セッション起動

    require('dbconnect.php'); // 別ファイルに書かれた処理をを実行する

    // DB接続結果を格納する変数
    $user_id = '';

    // テスト：テキストファイルに変数の内容を書き込む
    // var_dump(file_put_contents("out.txt","login"));


    //POSTされたユーザ名・パスワードをセッション変数に格納。ユーザ名が空の場合は分岐
    $user_name_post = $_POST['user_name'];
    $password_post = $_POST['password'];
    if(empty($user_name_post) || empty($password_post)){
        header("Location: ./index.php/?err_msg='ユーザ名とパスワードを入力してください。'");
        exit;
    }

    // POSTされたユーザ名が正しいか調べる。
    // ユーザ名・パスワードが一致するユーザが確認できて初めてセッションにユーザ名を登録。
    if($user_name_post != '' && $password_post != ''){
        // ->（アロー演算子）は、左辺にクラスのインスタンス、右辺に左辺の持つメソッド・プロパティを書くことで
        // インスタンスが持つメソッド・プロパティを呼び出す。
        // "SELECT id FROM user_login WHERE user_name ='".$user_name_post."' AND password = '".$password_post."'"
        $sql_login = "SELECT id FROM user_login WHERE user_name ='".$user_name_post."' AND password = '".$password_post."'";

        if($result_login = $mysqli->query($sql_login)){
            while($row = $result_login->fetch_assoc()){
                $user_id = $row['id'];
            }

            $result_login->close();
        }
    }

    $mysqli->close();// DB接続解除

    // 該当ユーザがいた場合/いなかった場合で分岐
    if(!empty($user_id)){
        var_dump(file_put_contents("out_login.txt","login"));
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name_post;
        header('Location: ./home.php');     // homeへ遷移
    }else{
        header("Location: ./index.php");
    }

    
?>