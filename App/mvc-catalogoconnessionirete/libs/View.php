<?php

class View {
    function __construct() {
        //echo "this is view";
    }

    public function render($name, $noInclude = false, $dataInclude = NULL) {
        if($noInclude) {
            require 'views/' . $name . '.php';
        }else {
            $data = ($dataInclude == NULL) ? array() : $dataInclude;
            require 'views/header.php';
            require 'views/' . $name . '.php';
        }
    }
}