<?php 
    
    class ParentClass {
        public function __construct() {
            echo '验证登录';
        }
    }

    class ChildClass extends ParentClass {
        public function __construct() {
            parent::__construct();
            echo '验证权限';
        }
    }

    $childClass = new ChildClass();
    
?>