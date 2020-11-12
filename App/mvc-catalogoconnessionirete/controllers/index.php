<?php

class Index extends Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
        Session::init();
        $logged = Session::get('loggedIn');
        if($logged == false) {
            Session::destroy();
            header('location: login');
            exit;
        }else {
            header('location: dashboard');
        }
    }
}