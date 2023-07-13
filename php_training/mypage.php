<?php
    // セッションは C:\xampp\tmp に保存されている
    session_start(); //セッション起動
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="./css/common.css">
<link rel="stylesheet" href="./css/mypage.css">
<!-- BootstrapのCSS読み込み -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><!-- jQuery読み込み -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- BootstrapのJS読み込み -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    <?php
        require('dbconnect.php'); // 別ファイルに書かれた処理をを実行する

        $user_name = '';
        $address = '';
        $tel = '';
        $mail = '';

        // "SELECT L.user_name, P.address, P.tel, P.mail FROM user_profile AS P INNER JOIN user_login AS L ON P.user_id = L.id WHERE L.user_name = '".$_SESSION['user_name']."'"
        $sql_profile = "SELECT L.user_name, P.address, P.tel, P.mail FROM user_profile AS P INNER JOIN user_login AS L ON P.user_id = L.id WHERE L.user_name = '".$_SESSION['user_name']."'";

        if($result_pro1file = $mysqli->query($sql_profile)){
            while($row = $result_pro1file->fetch_assoc()){
                $user_name = $row['user_name'];
                $address = $row['address'];
                $tel = $row['tel'];
                $mail = $row['mail'];
            }
        }

    ?>
    <div class="wrapper">
        <header>
            <div class="logo"></div>
            <div class="header_right">
                <p class="welcome">ようこそ、<?php echo $_SESSION['user_name'] ?>さん</p>
                <div class="link">
                    <a href='mypage.php'>マイページ</a>
                    <a href='logout.php'>ログアウト</a>
                </div>
            </div>
        </header>
        <div class="main">
            <!--自分の情報（名前・住所・電話番号・メール等）を登録・編集する-->
            <!--別ユーザがこのマイページにやってきたとき、ここの「友達登録」を押すと友達登録が出来る。-->
            <h2><?php echo $_SESSION['user_name'] ?>さんのマイページ</h2>

            <p class="upd=msg">
                <!--プロフィールをアップデートしたらここにメッセージが表示される。-->
                <?php if(isset($_GET['upd_msg'])){echo $_GET['upd_msg'];} ?>
            </p>

            <!--現在のプロフィールをtableに表示-->
            <!--ERROR:更新はできるが、更新後再び更新しようとするとエラー。-->
            <?php
                require('dbconnect.php'); // 別ファイルに書かれた処理をを実行する

                $user_name = '';
                $address = '';
                $tel = '';
                $mail = '';

                // "SELECT L.user_name, P.address, P.tel, P.mail FROM user_profile AS P INNER JOIN user_login AS L ON P.user_id = L.id WHERE L.user_name = '".$_SESSION['user_name']."'"
                $sql_profile = "SELECT L.user_name, P.address, P.tel, P.mail FROM user_profile AS P INNER JOIN user_login AS L ON P.user_id = L.id WHERE L.user_name = '".$_SESSION['user_name']."'";

                if($result_profile = $mysqli->query($sql_profile)){
                    while($row = $result_profile->fetch_assoc()){
                        $user_name = $row['user_name'];
                        $address = $row['address'];
                        $tel = $row['tel'];
                        $mail = $row['mail'];
                    }
                }

                $mysqli->close();// DB接続解除

            ?>

            <table class="table_profile">
                <tbody>
                    <tr>
                        <th>ユーザID</th>
                        <td><?php echo $_SESSION['user_id'];?></td>
                    </tr>
                    <tr>
                        <th>名前</th>
                        <td><?php if(!empty($user_name)){echo $user_name;} ?></td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td><?php if(!empty($address)){echo $address;} ?></td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td><?php if(!empty($tel)){echo $tel;} ?></td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td><?php if(!empty($mail)){echo $mail;} ?></td>
                    </tr>
                </tbody>
            </table>

            <!--プロフィールをアップデート-->
            <form action="update_profile.php" method="post">
                <h5>プロフィール更新フォーム</h5>

                <table class="table_update">
                    <tbody>
                        <tr>
                            <th>名前</th>
                            <td><input type="text" name="user_name" value="<?php if(!empty($user_name)){echo $user_name;} ?>"></td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td><input type="text" name="address" value="<?php if(!empty($address)){echo $address;} ?>"></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><input type="text" name="tel" value="<?php if(!empty($tel)){echo $tel;} ?>"></td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td><input type="text" name="mail" value="<?php if(!empty($mail)){echo $mail;} ?>"></td>
                        </tr>
                    </tbody>
                </table>
                
                <input type="submit" value="更新">
            </form>
        </div>

        <footer>
            <p class="copyright"></p>
        </footer>
    </div>


    
</body>
</html>