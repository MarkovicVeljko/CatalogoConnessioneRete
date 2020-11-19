<?php

class Amministratore_Model extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function run() {
        if(isset($_POST['nome_login']) && isset($_POST['pass'])) {
            $nome_login = htmlspecialchars($_POST['nome_login']);
            $pass = $_POST['pass'];

            $sth = $this->db->prepare("SELECT nome_login, ruolo FROM utente WHERE
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

                $results = $sth->fetchAll();
                Session::set('user', $results[0][0]);
                
                $controllerToCall = strtolower($results[0][1]);
                Session::set('role', $controllerToCall);
                
                header('location: ../' . $controllerToCall);
            }else {
                header('location: ../login');
            }
        }else {
            echo 1;
        }
    }

    public function getUsers() {
        $sth = $this->db->prepare("SELECT * FROM utente");
        $sth->execute();

        return $sth->fetchAll();
    }

    public function update($old_nome_login, $nome_login, $nome, $cognome, $email, $ruolo, $pass) {
        $sth = $this->db->prepare("SELECT nome_login FROM utente WHERE
            nome_login = :nome_login");
        $sth->execute(array(
            ':nome_login' => $nome_login,
        ));
        
        $count = $sth->rowCount();

        if($count == 0) {
            $sth = $this->db->prepare("UPDATE utente
                SET nome_login = :nome_login nome = :nome cognome = :cognome email = :email ruolo = :ruolo pass = MD5(:pass)
                WHERE nome_login = :old_nome_login");
            $sth->execute(array(
                ':nome_login' => $nome_login,
                ':pass' => $pass,
                ':nome' => $nome,
                ':cognome' => $cognome,
                ':email' => $email,
                ':ruolo' => $ruolo,
                ':pass' => $pass,
                ':old_nome_login' => $old_nome_login
            ));
            echo $sth->rowCount() . " records UPDATED successfully";
        }else {
            return false;
        }
    }
}