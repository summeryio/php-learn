<?php

class CommentBook {
    const FilePath = 'commentBook.txt';

    public function getAllCommentList() { // 返回所有评论
        return unserialize(file_get_contents(self::FilePath));
    }
    public function write($commentData) { // 写入评论
        $commentList = $this -> getAllCommentList();

        if (is_array($commentList)) {
            array_unshift($commentList, $commentData);
        } else {
            $commentList = [$commentData];
        }
    
        $commentFile = fopen(self::FilePath, 'w');
        fwrite($commentFile, serialize($commentList));
        fclose($commentFile);
    }
    public function view($page, $limit, $link) { // 输出评论
        $commentList = $this -> getAllCommentList();
        $totalCount = count($commentList);

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
            echo "<a href='$link?page=$i&limit=$limit'>$i</a>";
        }
    }
}