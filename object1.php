<?php 
    class Comment {
        private $username;
        protected $content;

        public function setUsername($username) {
            $this -> username = $username;
        }
        public function getUsername() {
            return $this->username;
        }

        public function __set($name, $value) {
            $this -> $name = $value;
        }
        public function __get($name) {
            return $this -> $name;
        }
    }

    $comment = new Comment();

    $comment -> username = 'summery';
    echo $comment -> username;
    $comment -> content = ' is 666!';
    echo $comment -> content;

    
    echo '<br />';

    class CommentBook {
        const FilePath = 'commentBook.txt';

        public function getCommentList() {
            return unserialize(file_get_contents(self::FilePath));
        }
        public function write($commentData) {
            $commentList = $this->getCommentList();
        }
    }
    $commentBook = new CommentBook();
    echo $commentBook::FilePath; // 取对象常量值
?>