<?php

class Login_Model extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function run() {
        if(isset($_POST['nome_login']) && isset($_POST['pass'])) {
            $nome_login = htmlspecialchars($_POST['nome_login']);
            $pass = $_POST['pass'];

            $sth = $this->db->prepare("SELECT nome_login FROM utente WHERE
                nome_login = :nome_login AND pass = MD5(:pass)");
            $sth->execute(array(
                ':nome_login' => $nome_login,
                ':pass' => $pass
            ));
            
            $count = $sth->rowCount();
            
            if($count > 0) {
                // login
                Session::init();
                Session::set('loggedIn', true);

                /*$results = $sth->fetchAll();
                foreach ($results as $data) {
                    foreach ($data as $d) {
                        echo $d . "<br>";
                    }
                }*/

                header('location: ../dashboard');
            }else {
                header('location: ../login');
            }
        }else {
            echo 1;
        }
    }
}