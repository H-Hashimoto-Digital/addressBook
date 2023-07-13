<?php
    // セッションは C:\xampp\tmp に保存されている
    session_start(); //セッション起動

    require('dbconnect.php'); // 別ファイルに書かれた処理をを実行する

    $user_id = $_SESSION['user_id'];    // 書き換えることはない。セッションから呼んだユーザID

    // mypage.php内フォーム入力値（書き換え予定のプロフィール項目）
    $user_name = $_POST['user_name'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];

    // プロフィール更新 テーブルはひとつずつ書き換える
    $sql_update = "UPDATE user_login L, user_profile P 
                SET L.user_name = ?, 
                P.address = ?,
                P.tel = ?,
                P.mail = ?
                WHERE L.id = P.user_id AND P.user_id = ?";

    

    if($stmt_update = $mysqli->prepare($sql_update)){
        $stmt_update->bind_param('ssssi',$user_name, $address, $tel, $mail, $user_id); // パラメータをセット
        $stmt_update->execute(); // 実行
    }
    

    $mysqli->close();// DB接続解除

    // マイページへ戻る　headerはリダイレクト用関数なのでここで処理は終わってしまう
    // GETするのがheaderなので何もGETしないのにパラメータのためにheaderを使うのは矛盾
    // そもそもメッセージを表示したければ、無駄に複雑なことになるので一旦諦める
    header("Location: ./mypage.php");

    
?>