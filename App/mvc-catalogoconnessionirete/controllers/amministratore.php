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
        $old_nome_login = $_POST['old_nome_login'];
        $nome_login = htmlspecialchars($_POST['nome_login']);
        $nome = htmlspecialchars($_POST['nome']);
        $cognome = htmlspecialchars($_POST['cognome']);
        $email = htmlspecialchars($_POST['email']);
        $ruolo = $_POST['ruolo'];
        $pass = $_POST['pass'];

        if(isset($nome_login) && isset($nome) && isset($cognome) && isset($email) && isset($ruolo) && isset($pass) && $old_nome_login != '-') {
            $this->model->update($old_nome_login, $nome_login, $nome, $cognome, $email, $ruolo, $pass);
        }
        //header('location: ../amministratore/action/utenti');
    }
}