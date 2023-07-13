<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <h1>サインアップ</h1>
    <form action="register_newuser.php" method="post">
        <label for="user_name">名前</label>
        <input type="text" name="user_name" id="user_name">
        <label for="password">パスワード</label>
        <input type="text" name="password" id="password">
        <label for="address">住所</label>
        <input type="text" name="address" id="address">
        <label for="tel">電話番号</label>
        <input type="text" name="tel" id="tel">
        <label for="mail">メールアドレス</label>
        <input type="text" name="mail" id="mail">
        
        <input type="submit" value="登録">
    </form>

</body>
</html>