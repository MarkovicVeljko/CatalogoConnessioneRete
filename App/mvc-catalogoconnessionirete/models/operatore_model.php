<?php

class Operatore_Model extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function getSwitches() {
        $sth = $this->db->prepare("SELECT * FROM switch");
        $sth->execute();

        return $sth->fetchAll();
    }

    public function getPorts()
    {
        $sth = $this->db->prepare("SELECT * FROM porta");
        $sth->execute();

        return $sth->fetchAll();
    }

    public function updateSwitch($old_id, $id, $modello, $posizione, $porte) {
        $canProceed = ($old_id == $id) ? true : $this->uniqueSwitchId($id);

        if($canProceed) {
            $sth = $this->db->prepare("DELETE FROM porta
            WHERE switch_id = :id");
            $sth->execute(array(
                ':id' => $id
            ));

            $sth = $this->db->prepare("UPDATE switch
                SET id = :id, modello = :modello, posizione = :posizione, numero_porte = :porte
                WHERE id = :old_id");
            $sth->execute(array(
                ':old_id' => $old_id,
                ':id' => $id,
                ':modello' => $modello,
                ':posizione' => $posizione,
                ':porte' => max(1, $porte)
            ));

            for ($i = 1; $i <= $porte; $i++) {
                $sth = $this->db->prepare("INSERT INTO porta
                VALUES(:id, :porta, :cavo_tipo, :dispositivo_tipo)");
                $sth->execute(array(
                    ':id' => $id,
                    ':porta' => $i,
                    ':cavo_tipo' => NULL,
                    ':dispositivo_tipo' => NULL
                ));
            }

            if($sth->rowCount() > 0) {
                header('location: ' . URL . 'operatore/success');
            }else {
                header('location: ' . URL . 'operatore/failure/query');
            }
        }else {
            header('location: ' . URL . 'operatore/failure/query');
        }
    }

    public function deleteSwitch($id)
    {
        $sth = $this->db->prepare("DELETE FROM porta
            WHERE switch_id = :id");
        $sth->execute(array(
            ':id' => $id
        ));

        $sth = $this->db->prepare("DELETE FROM switch
            WHERE id = :id");
        $sth->execute(array(
            ':id' => $id
        ));

        if ($sth->rowCount() > 0) {
            header('location: ' . URL . 'operatore/success');
        } else {
            header('location: ' . URL . 'operatore/failure/query');
        }
    }

    public function createSwitch($id, $modello, $posizione, $porte) {
        if($this->uniqueSwitchId($id)) {
            $sth = $this->db->prepare("INSERT INTO switch
                VALUES(:id, :modello, :posizione, :porte)");
            $sth->execute(array(
                ':id' => $id,
                ':modello' => ($modello == '') ? '-' : $modello,
                ':posizione' => ($posizione == '') ? '-' : $posizione,
                ':porte' => ($porte == '') ? 8 : max(1, $porte)
            ));

            for($i = 1; $i <= $porte; $i++) {
                $sth = $this->db->prepare("INSERT INTO porta
                VALUES(:id, :porta, :cavo_tipo, :dispositivo_tipo)");
                $sth->execute(array(
                    ':id' => $id,
                    ':porta' => $i,
                    ':cavo_tipo' => NULL,
                    ':dispositivo_tipo' => NULL
                ));
            }

            if($sth->rowCount() > 0) {
                header('location: ' . URL . 'operatore/success');
            }else {
                header('location: ' . URL . 'operatore/failure/query');
            }
        }else {
            header('location: ' . URL . 'operatore/failure/query');
        }
    }

    public function updatePort($id, $porta, $cavo, $dispositivo)
    {
        $sth = $this->db->prepare("UPDATE porta
            SET cavo_tipo = :cavo, dispositivo_tipo = :dispositivo
            WHERE switch_id = :id AND numero_porta = :porta");
        $sth->execute(array(
            ':id' => $id,
            ':porta' => $porta,
            ':cavo' => ($cavo == '-') ? NULL : $cavo,
            ':dispositivo' => ($dispositivo == '-') ? NULL : $dispositivo
        ));

        if ($sth->rowCount() > 0) {
            header('location: ' . URL . 'operatore/success');
        } else {
            header('location: ' . URL . 'operatore/failure/query');
        }
    }

    public function getAllIDS() {
        $sth = $this->db->prepare("SELECT id FROM switch WHERE id LIKE 'DFSW-%' ORDER BY id ASC");
        $sth->execute();

        return $sth->fetchAll();
    }

    function uniqueSwitchId($id)
    {
        $sth = $this->db->prepare("SELECT id FROM switch WHERE
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