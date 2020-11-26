<?php

class FrameworkError extends Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
        Session::init();
        Session::destroy();
        $this->view->msg = 'Questa pagina non esiste';
        $this->view->render('error/index');
    }
}