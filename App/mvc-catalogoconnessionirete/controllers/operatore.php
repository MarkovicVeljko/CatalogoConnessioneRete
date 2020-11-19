<?php

class Operatore extends Controller {
    function __construct() {
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        $ruolo = Session::get('role');
        if($logged == false) {
            Session::destroy();
            header('location: login');
            exit;
        }

        if($ruolo != "operatore") {
            header('location: ' . $ruolo);
            exit;
        }
    }

    function index() {
        $this->view->render('operatore/index');
    }

    function run() {
        $this->model->run();
    }
}