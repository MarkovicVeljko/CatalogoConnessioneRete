<?php

class Viewer extends Controller {
    function __construct()
    {
        parent::__construct();

        Session::init();
        $logged = Session::get('loggedIn');
        $ruolo = Session::get('role');
        if ($logged == false) {
            Session::destroy();
            header('location: login');
            exit;
        }

        if ($ruolo != "viewer") {
            header('location: ' . $ruolo);
            exit;
        }
    }

    function index()
    {
        $this->view->render('viewer/index');
    }

    function displayInfo() {
        require 'models/operatore_model.php';

        $operatore = new Operatore_Model();

        $switch = $operatore->getSwitches();
        $ports = $operatore->getPorts();

        $data = array($switch, $ports);

        $this->view->render('viewer/vedi_info', false, $data);
    }
}