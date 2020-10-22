<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['username']) && isset($_POST['pass'])) {
            $input_un = $_POST['username'];
            $input_p = $_POST['pass'];
            
            $servername = "localhost:3307";
            $username = "switchroot";
            $password = "Password&1";
            $db = "catalogo_connessioni_rete";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $db);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT nome_login, pass FROM utente";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    if($input_un == $row["nome_login"] && $input_p == $row["pass"]) {
                        echo "Benvenuto!";
                        break;
                    }
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        }
    }
?>