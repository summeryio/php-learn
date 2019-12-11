<?php 
    
    class Tools {
        public static $titleSuffix = 'summeryio';

        public $test = 'test';
        public function test() {
            echo 'test';
            self::parseTitle('test');
        }

        public function parseTitle($title) {
            return $title.'-'.self::$titleSuffix;
        }
    }

    // echo Tools::$titleSuffix; // 取到对象静态属性
    echo Tools::parseTitle('666'); // 调用对象静态函数
    
?>