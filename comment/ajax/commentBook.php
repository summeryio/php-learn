<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        a {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    
    <div>
        <label>用户名：</label>
        <input type="text" name="username" size="35" id="username"><br><br>

        <label>评论内容：
        <textarea name="content" cols="30" rows="10" id="content"></textarea>
        
        <br><br>

        <input type="submit" value="提交" id="submit">
    </div>

    <div>
    <?php 
        $commentList = unserialize(file_get_contents('commentBook.txt'));
        $totalCount = count($commentList);
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 3;


        $totalPage = ceil($totalCount / $limit);
        
        $page = $page < 1 ? $page = 1 : $page;
        $page = $page > $totalPage ? $page = $totalPage : $page;

        // 输出评论内容
        $from = ($page - 1) * $limit;
        for ($i = $from; $i < $from + $limit; $i++) { 
            if (isset($commentList[$i])) {
                echo '用户名：'.$commentList[$i]['username'].'<br>评论内容：'.$commentList[$i]['content'].'<hr>';
            } else {
                break;
            }
        }

        // 输出分页
        for ($i = 1; $i <= $totalPage ; $i++) { 
            echo "<a href='commentBook.php?page=$i&limit=$limit'>$i</a>";
        }
    ?>
    </div>


    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $('#submit').click(function () {
            $.ajax({
                type: "POST",
                url: "addComment.php",
                data: {
                    'username': $('#username').val(),
                    'content': $('#content').val()
                },
                dataType: "json",
                success: function (res) {
                    console.log(res);
                    alert(res.msg);
                    if (!res.code) {
                        window.location.reload();
                    }
                }
            });
        })
    </script>
    
</body>
</html>