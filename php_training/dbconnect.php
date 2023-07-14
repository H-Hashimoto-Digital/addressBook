<?php
    // phpMyAdminに接続する。
    // DB接続したいページの先頭に require('dbconnect.php'); と書けば接続できるようにしたい
    // DB接続にはPDO（PHP Data Object）クラスかmysqli_connect()を使う。mysql()は古くて非推奨なので注意。

    // 230712:今回は、mysql()を使う方向で書き直すこと。
    $mysqli = new mysqli("localhost", "root", "", "php_connect_2"); // DB接続

    

    
?>