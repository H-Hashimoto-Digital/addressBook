<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!--<link rel="stylesheet" href="./css/index.css">-->
</head>
<body>
    <div class="wrapper">
        <div class="header_index">
            <div class="logo"></div>
        </div>

        <div class="main">
            <div class="main_box">
                <h4>ログインフォーム</h4>
                <form action="login.php" method="POST">
                    <label for="user_name">ユーザ名</label>
                    <input type="text" placeholder="ユーザ名" name="user_name" id="user_name">
                    <label for="password">パスワード</label>
                    <input type="text" placeholder="パスワード" name="password" id="password">
                    
                    <input type="submit" value="ログイン" class="btn_login">

                    <a href="signup.php">サインアップ</a>
                </form>
                
            </div>
        </div>

        

        <footer>
            <p class="copyright"></p>
        </footer>
        
    </div>
    

</body>
</html>