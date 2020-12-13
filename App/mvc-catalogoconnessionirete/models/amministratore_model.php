<?php

class Amministratore_Model extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function getUsers() {
        $sth = $this->db->prepare("SELECT * FROM utente");
        $sth->execute();

        return $sth->fetchAll();
    }

    public function getCables() {
        $sth = $this->db->prepare("SELECT * FROM cavo");
        $sth->execute();

        return $sth->fetchAll();
    }

    public function getDevices()
    {
        $sth = $this->db->prepare("SELECT * FROM dispositivo");
        $sth->execute();

        return $sth->fetchAll();
    }

    public function updateUser($old_nome_login, $nome_login, $nome, $cognome, $ruolo, $pass) {
        $canProceed = ($old_nome_login == $nome_login) ? true : $this->uniqueNomeLogin($nome_login);

        if($canProceed) {
            $sth = $this->db->prepare("UPDATE utente
                SET nome_login = :nome_login, nome = :nome, cognome = :cognome, ruolo = :ruolo, pass = MD5(:pass)
                WHERE nome_login = :old_nome_login");
            $sth->execute(array(
                ':old_nome_login' => $old_nome_login,
                ':nome_login' => $nome_login,
                ':nome' => $nome,
                ':cognome' => $cognome,
                ':ruolo' => $ruolo,
                ':pass' => $pass
            ));

            if($sth->rowCount() > 0) {
                header('location: ' . URL . 'amministratore/success');
            }else {
                header('location: ' . URL . 'amministratore/failure/query');
            }
        }else {
            header('location: ' . URL . 'amministratore/failure/query');
        }
    }

    public function createUser($nome_login, $nome, $cognome, $ruolo, $pass) {
        if($this->uniqueNomeLogin($nome_login)) {
            $sth = $this->db->prepare("INSERT INTO utente
                VALUES(:nome_login, MD5(:pass), :nome, :cognome, :ruolo)");
            $sth->execute(array(
                ':nome_login' => $nome_login,
                ':nome' => $nome,
                ':cognome' => $cognome,
                ':ruolo' => $ruolo,
                ':pass' => $pass
            ));

            if($sth->rowCount() > 0) {
                header('location: ' . URL . 'amministratore/success');
            }else {
                header('location: ' . URL . 'amministratore/failure/query');
            }
        }else {
            header('location: ' . URL . 'amministratore/failure/query');
        }
    }

    public function deleteUser($nome_login) {
        $sth = $this->db->prepare("DELETE FROM utente
            WHERE nome_login = :nome_login");
        $sth->execute(array(
            ':nome_login' => $nome_login
        ));

        if($sth->rowCount() > 0) {
            header('location: ' . URL . 'amministratore/success');
        }else {
            header('location: ' . URL . 'amministratore/failure/query');
        }
    }

    function uniqueNomeLogin($nome_login) {
        $sth = $this->db->prepare("SELECT nome_login FROM utente WHERE
            nome_login = :nome_login");
        $sth->execute(array(
            ':nome_login' => $nome_login
        ));
        
        $count = $sth->rowCount();

        if($count == 0) {
            return true;
        }else {
            return false;
        }
    }

    public function createCable($id, $tipo, $descrizione) {
        if($this->uniqueCableId($id)) {
            $sth = $this->db->prepare("INSERT INTO cavo
                VALUES(:id, :tipo, :descrizione)");
            $sth->execute(array(
                ':id' => $id,
                ':tipo' => $tipo,
                ':descrizione' => ($descrizione == '') ? '-' : $descrizione
            ));

            if($sth->rowCount() > 0) {
                header('location: ' . URL . 'amministratore/success');
            }else {
                header('location: ' . URL . 'amministratore/failure/query');
            }
        }else {
            header('location: ' . URL . 'amministratore/failure/query');
        }
    }

    public function updateCable($old_id, $old_tipo, $id, $tipo, $descrizione) {
        $canProceed = ($old_id == $id) ? true : $this->uniqueCableId($id);

        if($canProceed) {
            $sth = $this->db->prepare("UPDATE cavo
                SET id = :id, tipo = :tipo, descrizione = :descrizione
                WHERE id = :old_id AND tipo = :old_tipo");
            $sth->execute(array(
                ':id' => $id,
                ':tipo' => $tipo,
                ':descrizione' => ($descrizione == '') ? '-' : $descrizione,
                ':old_id' => $old_id,
                ':old_tipo' => $old_tipo
            ));

            if($sth->rowCount() > 0) {
                header('location: ' . URL . 'amministratore/success');
            }else {
                header('location: ' . URL . 'amministratore/failure/query');
            }
        }else {
            header('location: ' . URL . 'amministratore/failure/query');
        }
    }

    public function deleteCable($id) {
        $sth = $this->db->prepare("DELETE FROM cavo
            WHERE id = :id");
        $sth->execute(array(
            ':id' => $id
        ));

        if($sth->rowCount() > 0) {
            header('location: ' . URL . 'amministratore/success');
        }else {
            header('location: ' . URL . 'amministratore/failure/query');
        }
    }

    public function createDevice($id, $tipo, $descrizione)
    {
        if ($this->uniqueDeviceId($id)) {
            $sth = $this->db->prepare("INSERT INTO dispositivo
                VALUES(:id, :tipo, :descrizione)");
            $sth->execute(array(
                ':id' => $id,
                ':tipo' => $tipo,
                ':descrizione' => ($descrizione == '') ? '-' : $descrizione
            ));

            if ($sth->rowCount() > 0) {
                header('location: ' . URL . 'amministratore/success');
            } else {
                header('location: ' . URL . 'amministratore/failure/query');
            }
        } else {
            header('location: ' . URL . 'amministratore/failure/query');
        }
    }

    public function updateDevice($old_id, $old_tipo, $id, $tipo, $descrizione)
    {
        $canProceed = ($old_id == $id) ? true : $this->uniqueDeviceId($id);

        if ($canProceed) {
            $sth = $this->db->prepare("UPDATE dispositivo
                SET id = :id, tipo = :tipo, descrizione = :descrizione
                WHERE id = :old_id AND tipo = :old_tipo");
            $sth->execute(array(
                ':id' => $id,
                ':tipo' => $tipo,
                ':descrizione' => ($descrizione == '') ? '-' : $descrizione,
                ':old_id' => $old_id,
                ':old_tipo' => $old_tipo
            ));

            if ($sth->rowCount() > 0) {
                header('location: ' . URL . 'amministratore/success');
            } else {
                header('location: ' . URL . 'amministratore/failure/query');
            }
        } else {
            header('location: ' . URL . 'amministratore/failure/query');
        }
    }

    public function deleteDevice($id)
    {
        $sth = $this->db->prepare("DELETE FROM dispositivo
            WHERE id = :id");
        $sth->execute(array(
            ':id' => $id
        ));

        if ($sth->rowCount() > 0) {
            header('location: ' . URL . 'amministratore/success');
        } else {
            header('location: ' . URL . 'amministratore/failure/query');
        }
    }

    function uniqueCableId($id) {
        $sth = $this->db->prepare("SELECT id FROM cavo WHERE
            id = :id");
        $sth->execute(array(
            ':id' => $id
        ));
        
        $count = $sth->rowCount();

        if($count == 0) {
            return true;
        }else {
            return false;
        }
    }

    function uniqueDeviceId($id)
    {
        $sth = $this->db->prepare("SELECT id FROM dispositivo WHERE
            id = :id");
        $sth->execute(array(
            ':id' => $id
        ));

        $count = $sth->rowCount();

        if ($count == 0) {
            return true;
        } else {
            return false;
        }
    }
}