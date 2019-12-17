<?php

$username = $_POST['username'];
$content = $_POST['content'];

if ($username == '' || $content == '') {
    // echo '用户名或评论内容不能为空<a href="commentBook.php">返回评论区</a>';
    
    echo json_encode(array(
        'code' => 1,
        'msg' => '用户名或评论内容不能为空'
    ));
} else {
    $comment = array('username' => $username, 'content' => $content);
    $filePath = 'commentBook.txt';
    $commentList = unserialize(file_get_contents($filePath));

    if (is_array($commentList)) {
        array_unshift($commentList, $comment);
    } else {
        $commentList = [$comment];
    }

    // 打开存储数据的文件
    $commentFile = fopen($filePath, 'w'); // 'w' 表示写入
    fwrite($commentFile, serialize($commentList));
    fclose($commentFile);

    // echo '评论成功<a href="commentBook.php">返回评论区</a>';
    echo json_encode(array(
        'code' => 0,
        'msg' => '评论成功'
    ));
}