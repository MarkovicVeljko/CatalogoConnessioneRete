<?php

class Handler extends Controller {
    function __construct() {
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        if($logged == false) {
            Session::destroy();
            header('location: login');
            exit;
        }
    }

    function logout() {
        Session::destroy();
        header('location: ../login');
        exit;
    }

}