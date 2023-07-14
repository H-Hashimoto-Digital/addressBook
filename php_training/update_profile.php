<?php
    // セッションは C:\xampp\tmp に保存されている
    session_start(); //セッション起動

    require('dbconnect.php'); // 別ファイルに書かれた処理をを実行する

    $user_id = $_SESSION['user_id'];    // 書き換えることはない。セッションから呼んだユーザID

    // mypage.php内フォーム入力値（書き換え予定のプロフィール項目）
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];

    var_dump(file_put_contents("out_update_profile.txt", [$user_name,$address,$tel,$mail], FILE_APPEND));

    // プロフィール更新
    // 複数のテーブルにわたって更新するときはひとつのSQLで更新するのではなく、更新したいテーブルごとに別にSQLを発行
    $sql_update = "UPDATE user_profile P 
                SET
                P.address = ?,
                P.tel = ?,
                P.mail = ?
                WHERE P.user_id = ?";

    

    if($stmt_update = $mysqli->prepare($sql_update)){
        $stmt_update->bind_param('sssi', $address, $tel, $mail,$user_id); // パラメータをセット
        $stmt_update->execute(); // 実行
    }
    
    

    $mysqli->close();// DB接続解除

    // headerはリダイレクト用関数なのでここで処理は終わってしまう。
    // 本来、GET（サーバーからデータを入手）するのがheaderなので
    // 何もGETしないのにパラメータを送るためにheaderを使うのは本分に反する。
    // Locationでパラメータを送ると思いもよらないエラーが発生してしまった。
    // そもそもメッセージを表示したければ、無駄に複雑なことになるので一旦諦める
    header("Location: ./mypage.php");   // マイページへ戻る

    
?>