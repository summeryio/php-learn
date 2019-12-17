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
        include('CommentBook.php');
    
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 3;

        $commentBook = new CommentBook();
        $commentBook -> view($page, $limit, 'viewAjaxComment.php');
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