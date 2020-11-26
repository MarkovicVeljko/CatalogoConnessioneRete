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

    function page($type) {
        if($type == "utenti") {
            $utenti = $this->getUsers();
            $this->view->render('amministratore/gestione_utenti', false, $utenti);
        }else {
            $cavi = $this->getCables();
            $this->view->render('amministratore/gestione_cavi_dispositivi', false, $cavi);
        }
    }

    function getUsers() {
        return $this->model->getUsers();
    }

    function getCables() {
        return $this->model->getCables();
    }

    function action($type) {
        if(isset($_POST['update'])) {
            if($type == 'user') {
                $this->updateUser();
            }else if($type == 'cable') {
                $this->updateCable();
            }            
        }else if(isset($_POST['delete'])) {
            if($type == 'user') {
                $this->deleteUser();
            }else if($type == 'cable') {
                $this->deleteCable();
            }
        }
    }

    function updateUser() {
        if($this->validPass($_POST['pass']) == false) {
            $this->failure("pass");
            return false;
        }

        if(isset($_POST['selector']) && $_POST['nome_login'] != '' && $_POST['nome'] != '' && $_POST['cognome'] != '' && isset($_POST['ruolo']) && $_POST['selector'] != '-') {
            $old_nome_login = $_POST['selector'];
            $nome_login = htmlspecialchars($_POST['nome_login']);
            $nome = htmlspecialchars($_POST['nome']);
            $cognome = htmlspecialchars($_POST['cognome']);
            $ruolo = $_POST['ruolo'];
            $pass = $_POST['pass'];
            $this->model->updateUser($old_nome_login, $nome_login, $nome, $cognome, $ruolo, $pass);
        }else {
            $this->failure("param_vuoti");
        }
    }

    function createUser() {
        if($this->validPass($_POST['new_pass']) == false) {
            $this->failure("pass");
            return false;
        }

        if($_POST['new_nome_login'] != '' && $_POST['new_nome'] != '' && $_POST['new_cognome'] != '' && isset($_POST['new_ruolo'])) {
            $nome_login = htmlspecialchars($_POST['new_nome_login']);
            $nome = htmlspecialchars($_POST['new_nome']);
            $cognome = htmlspecialchars($_POST['new_cognome']);
            $ruolo = $_POST['new_ruolo'];
            $pass = $_POST['new_pass'];
            $this->model->createUser($nome_login, $nome, $cognome, $ruolo, $pass);
        }else {
            $this->failure("param_vuoti");
        }
    }

    function deleteUser() {
        if(isset($_POST['selector']) && $_POST['selector'] != '-') {
            $nome_login = $_POST['selector'];
            $this->model->deleteUser($nome_login);
        }else {
            $this->failure("delete");
        }
    }

    function createCable() {
        if($_POST['new_tipo'] != '' && isset($_POST['new_id'])) {
            $id = $_POST['new_id'];
            $tipo = htmlspecialchars($_POST['new_tipo']);
            $descrizione = htmlspecialchars($_POST['new_descrizione']);
            $this->model->createCable($id, $tipo, $descrizione);
        }else {
            $this->failure("param_vuoti");
        }
    }

    function updateCable() {
        if($_POST['tipo'] != '' && isset($_POST['id_cavo'])) {
            $old_id = $_POST['old_id'];
            $old_tipo = htmlspecialchars($_POST['old_tipo']);
            $id = $_POST['id_cavo'];
            $tipo = htmlspecialchars($_POST['tipo']);
            $descrizione = htmlspecialchars($_POST['descrizione']);
            $this->model->updateCable($old_id, $old_tipo, $id, $tipo, $descrizione);
        }else {
            $this->failure("param_vuoti");
        }
    }

    function deleteCable() {
        if(isset($_POST['id_cavo']) && $_POST['id_cavo'] != '-') {
            $id = $_POST['id_cavo'];
            $this->model->deleteCable($id);
        }else {
            $this->failure("delete");
        }
    }

    function validPass($pass) {
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);

        if(!$uppercase || !$lowercase || !$number || strlen($pass) < 8) {
            return false;
        }
        return true;
    }

    function success() {
        $this->view->render('amministratore/templates/successo');
    }

    function failure($type) {
        $this->view->render('amministratore/templates/fallimento_' . $type);
    }
}