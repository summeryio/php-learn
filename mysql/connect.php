<?php

include ('db.php');

// 连接mysql
$conn = new mysqli($db['server'], $db['user'], $db['pwd'], $db['database']);

if ($conn -> connect_error) {
    die('connect failed: '.$conn -> connect_error);
}



echo '<br><br> ========分割线，查询用户数据========= <br><br>';

$sql = 'select * from user';
$result = $conn -> query($sql);

if ($result -> num_rows > 0) {
    while($row = $result -> fetch_assoc()) {
        print_r($row);
        echo '<br>';
    }
} else {
    echo '无数据！';
}




echo '<br><br> ========分割线，插入数据========= <br><br>';

$username = 'test3';
$password = 'test3';
$select_uname_sql = 'select * from user where username="'.$username.'"';
$result2 = $conn -> query($select_uname_sql);

print_r($result2);

if (!$result2 -> num_rows > 0) {
    $insert_sql = 'insert into user(username, password, is_admin, level) values ("'.$username.'", "'.$password.'", 1, 2)';

    if ($conn -> query($insert_sql) === true) {
        echo '新用户插入成功';
    } else {
        echo 'Error: ' .$sql. '<br>' .$conn -> error;
    }
} else {
    echo '用户名已存在';
}


// 关闭连接
$conn -> close();