<?php
    require('dbconnect.php'); // 別ファイルに書かれた処理をを実行する

    // 新規ユーザーを登録
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $user_id = '';

    // 同じユーザ名を持つ既存のユーザがいる場合（こちらのユーザ名は既に使われています）

    // まずはuser_loginへINSERTし、オートインクリメントによってユーザIDを発行する。
    $sql_login = "INSERT INTO user_login (user_name, password) VALUES (?, ?)";
    $stmt_login = $pdo->prepare($sql_login);
    $param_login = array($user_name, $password);
    $stmt_login->execute($param_login);

    $sql_user_id = "SELECT id FROM user_login WHERE user_name = ? AND password = ?";
    $stmt_user_id = $pdo->prepare($sql_user_id);
    $param_user_id = array($user_name, $password);
    $stmt_user_id->execute($param_user_id);

    foreach($stmt_user_id as $row){
        $user_id = $row['id'];
    }

    if($response_user_id){
        $user_id = $stmt_user_id->fetch(); // SQL実行結果からユーザIDを取得
    }

    // 取得したユーザIDを使って、次はuser_profileにフォーム入力値を登録。
    $sql_profile = "INSERT INTO user_profile (user_id, address, tel, mail) VALUES (?,?,?,?)";
    $stmt_profile = $pdo->prepare($sql_profile);
    $param_profile = array((int)$user_id, $address, $tel, $mail);
    $stmt_profile->execute($param_profile);

    $mysqli->close();// DB接続解除
    header("Location: ./index.php");
?>