<?php

class Login extends Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
        Session::init();
        if(Session::get('loggedIn') == false) {
            $this->view->render('login/index');
        }else {
            header('location: ' . Session::get('role'));
        }
    }

    function run() {
        $this->model->run();
    }
}