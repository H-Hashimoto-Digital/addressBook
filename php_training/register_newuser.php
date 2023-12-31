<?php
    require('dbconnect.php'); // 別ファイルに書かれた処理をを実行する

    // 新規ユーザーを登録
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $user_id = '';

    //var_dump(file_put_contents("out_register_newuser.txt",[$user_name,$password,$address,$tel,$mail], FILE_APPEND));

    // 最低限の情報（ユーザ名・パスワード）が入力されていない場合
    if(empty($user_name) || empty($password)){
        $mysqli->close();// DB接続解除
        $err_msg = "ユーザ名かパスワードが入力されていない";
        var_dump(file_put_contents("out_register_newuser.txt",$err_msg, FILE_APPEND));
        header("Location: ./index.php");
    }

    // 同じユーザ名を持つ既存のユーザがいる場合（こちらのユーザ名は既に使われています）
    $sql_duplication = "SELECT user_name FROM user_login WHERE user_name = '".$user_name."'";
    $user_name_duplication = '';
    if($result_duplication = $mysqli->query($sql_duplication)){
        while($row = $result_duplication->fetch_assoc()){
            //var_dump(file_put_contents("out_register_newuser.txt",$row, FILE_APPEND));
            $user_name_duplication = $row['user_name'];
        }
    }

    if(!empty($user_name_duplication)){
        $mysqli->close();// DB接続解除
        header("Location: ./index.php");
    }

    //$mysqli->query($sql_duplication);
    //var_dump(file_put_contents("out_register_newuser.txt",$result_duplication, FILE_APPEND));
    // if(!empty($result_duplication)){
    //     $mysqli->close();// DB接続解除
    //     $err_msg = "既存のユーザ名と重複している";
    //     //var_dump(file_put_contents("out_register_newuser.txt",$err_msg, FILE_APPEND));
    //     header("Location: ./index.php");
    // }

    //var_dump(file_put_contents("out_register_newuser.txt",$success_msg, FILE_APPEND));

    // まずはuser_loginへ新規ユーザを登録し、オートインクリメントによってユーザIDを発行する。
    $sql_login = "INSERT INTO user_login (user_name, password) VALUES (?, ?)";
    if($stmt_login = $mysqli->prepare($sql_login)){
        $stmt_login->bind_param('ss', $user_name, $password);
        $stmt_login->execute();
    }

    $sql_user_id = "SELECT id FROM user_login WHERE user_name ='".$user_name."'AND password = '".$password."'";
    if($result_user_id = $mysqli->query($sql_user_id)){

        // SQL実行結果（オートインクリメントされたユーザID）を変数$user_idに格納
        while($row = $result_user_id->fetch_assoc()){
            $user_id = $row["id"];
        }
    }


    // 取得したユーザIDを使って、次はuser_profileにフォーム入力値（新規ユーザのプロフィール）を登録。
    $sql_profile = "INSERT INTO user_profile (user_id, address, tel, mail) VALUES (?,?,?,?)";
    if($stmt_profile = $mysqli->prepare($sql_profile)){
        $user_id_int = (int)$user_id;
        $stmt_profile->bind_param('isss',$user_id_int,$address,$tel, $mail);
        $stmt_profile->execute();
    }

    $mysqli->close();// DB接続解除
    header("Location: ./index.php");
?>