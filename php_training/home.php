<?php
    // セッションは C:\xampp\tmp に保存されている
    session_start(); //セッション起動
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<!--<link rel="stylesheet" href="./css/common.css">-->
<!--<link rel="stylesheet" href="./css/home.css">-->
<!-- BootstrapのCSS読み込み -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><!-- jQuery読み込み -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- BootstrapのJS読み込み -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        require('dbconnect.php'); // 別ファイルに書かれた処理をを実行する
        
        // search_user.phpから返ってきたユーザー検索結果を格納
        // if(!empty($_GET['serach'])){
        //     $search = $_GET['search'];
        // }  
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
            

            <div class="search">
                <!--ユーザーを検索-->
                <form action="" method="post">
                    <input type="text" name="search">
                    <input type="submit" value="検索">
                </form>
            </div>

            

            <div class="search_result">
                <!--上記検索窓への入力値を基にユーザ名を検索する-->
                <?php
                    $search = $_POST["search"]; // フォーム入力値（検索ワード）

                    $array = array();   // 検索結果を格納する配列

                    // 検索ワードを基にuser_loginからユーザーを検索。検索対象となったユーザ名を配列$arrayに入れる。
                    $sql_search = "SELECT user_name FROM user_login WHERE user_name LIKE '%".$search."%'";
                    if($result_search = $mysqli->query($sql_search)){
                        $i = 0;
                        while($row = $result_search->fetch_assoc()){
                            $array[$i] = $row['user_name'];
                            $i++;
                        }
                    }


                ?>

                <!--検索結果を表示。検索結果をクリックすると別ユーザのmypageに行ける。友達登録も可能-->
                <p>検索結果：<?php foreach($array as $value){echo $value;} ?></p>
            </div>
            
        </div>

        <footer>
            <p class="copyright"></p>
        </footer>

        <?php
            $mysqli->close();// DB接続解除
        ?>
        
        
    </div>

    
    
</body>
</html>