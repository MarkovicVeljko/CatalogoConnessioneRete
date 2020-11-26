<?php

class Amministratore extends Controller {
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

        if($ruolo != "amministratore") {
            header('location: ' . $ruolo);
            exit;
        }
    }

    function index() {
        $this->view->render('amministratore/index');
    }

    function run() {
        $this->model->run();
    }

    function action($type) {
        if($type == "utenti") {
            $utenti = $this->getUsers();
            $this->view->render('amministratore/gestione_utenti', false, $utenti);
        }else {
            $this->view->render('amministratore/gestione_cavi_dispositivi');
        }
    }

    function getUsers() {
        return $this->model->getUsers();
    }

    function update() {
        if(isset($_POST['selector']) && $_POST['nome_login'] != '' && $_POST['nome'] != '' && $_POST['cognome'] != '' && isset($_POST['ruolo']) && $_POST['selector'] != '-') {
            $old_nome_login = $_POST['selector'];
            $nome_login = htmlspecialchars($_POST['nome_login']);
            $nome = htmlspecialchars($_POST['nome']);
            $cognome = htmlspecialchars($_POST['cognome']);
            $ruolo = $_POST['ruolo'];
            $pass = $_POST['pass'];
            $this->model->update($old_nome_login, $nome_login, $nome, $cognome, $ruolo, $pass);
        }else {
            header('location: ../amministratore/failure_param');
        }
    }

    function success() {
        $this->view->render('templates/successo');
    }

    function failure_query() {
        $this->view->render('templates/fallimento_query');
    }

    function failure_param() {
        $this->view->render('templates/fallimento_param_vuoti');
    }
}