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

    function page($type)
    {
        if ($type == "switch") {
            $switch = $this->getSwitches();
            $this->view->render('operatore/gestione_switch', false, $switch);
        }else if($type == "ports") {
            $switch = $this->getSwitches();
            $ports = $this->getPorts();

            require 'models/amministratore_model.php';

            $admin = new Amministratore_Model();

            $cables = $admin->getCables();
            $devices = $admin->getDevices();

            $data = array($switch, $ports, $cables, $devices);
            $this->view->render('operatore/gestione_porte', false, $data);
        }
    }

    function getSwitches() {
        return $this->model->getSwitches();
    }
    
    function getPorts()
    {
        return $this->model->getPorts();
    }

    function action($type) {
        if(isset($_POST['update'])) {
            if($type == 'switch') {
                $this->updateSwitch();
            }else if($type == 'ports') {
                $this->updatePort();
            }
        }else if(isset($_POST['delete'])) {
            if($type == 'switch') {
                $this->deleteSwitch();
            }
        }
    }

    function updateSwitch()
    {
        if ($_POST['id_switch'] != '' && isset($_POST['modello']) && isset($_POST['posizione']) && $_POST['porte'] != '') {
            $old_id = $_POST['old_id'];
            $id = $_POST['id_switch'];
            $modello = htmlspecialchars($_POST['modello']);
            $posizione = htmlspecialchars($_POST['posizione']);
            $porte = $_POST['porte'];
            $this->model->updateSwitch($old_id, $id, $modello, $posizione, $porte);
        } else {
            $this->failure("param_vuoti");
        }
    }

    function deleteSwitch()
    {
        if (isset($_POST['selector']) && $_POST['selector'] != '-') {
            $id = $_POST['id_switch'];
            $this->model->deleteSwitch($id);
        } else {
            $this->failure("delete");
        }
    }

    function createSwitch()
    {
        if ($_POST['new_id'] != '') {
            $id = $_POST['new_id'];
        }else {
            $id = $this->getNewID();
        }

        $modello = htmlspecialchars($_POST['new_modello']);
        $posizione = htmlspecialchars($_POST['new_posizione']);
        $porte = $_POST['new_porte'];
        $this->model->createSwitch($id, $modello, $posizione, $porte);
    }

    function updatePort()
    {
        if ($_POST['port'] != '-') {
            $id = $_POST['id_switch'];
            $porta = $_POST['port'];
            $cavo = $_POST['cavo'];
            $dispositivo = $_POST['dispositivo'];
            $this->model->updatePort($id, $porta, $cavo, $dispositivo);
        } else {
            $this->failure("param_vuoti");
        }
    }

    function getNewID() {
        $ids = $this->model->getAllIDS();

        if(count($ids) == 0) {
            $id = "DFSW-0";
            return $id;
        }else {
            for($i = 0; $i < count($ids); $i++) {
                $temp = explode('-', $ids[$i][0]);
                
                if((int)$temp[1] != $i) {
                    $id = "DFSW-" . $i;
                    return $id;
                }
            }
        }

        $temp = explode('-', $ids[count($ids) - 1][0]);
        $id = "DFSW-" . ((int)$temp[1] + 1);

        return $id;
    }

    function success()
    {
        $this->view->render('operatore/templates/successo');
    }

    function failure($type)
    {
        $this->view->render('operatore/templates/fallimento_' . $type);
    }
}