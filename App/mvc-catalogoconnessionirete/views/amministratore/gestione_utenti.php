<div class="row">
    <script>
        function updateValues() {
            var users = <?php echo json_encode($data); ?>;
            
            var user = document.getElementById('selector').value;
            var nome_login = document.getElementById('nome_login');
            var nome = document.getElementById('nome');
            var cognome = document.getElementById('cognome');
            var ruolo = document.getElementById('ruolo');

            for(var i = 0; i < users.length; i++) {
                if(users[i][0] == user) {
                    nome_login.value = users[i][0];
                    nome.value = users[i][2];
                    cognome.value = users[i][3];
                    ruolo.value = users[i][4];
                    break;
                }
            }
        }
    </script>
    <div class="col-sm-6">
        <h2>Modifica utente</h2>
        
        <form id="updateForm" class="form-horizontal" action="<?php echo URL; ?>amministratore/action/user" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="old_nome_login">Utente:</label>
                <div class="col-sm-10">
                    <select id="selector" class="form-control" name="selector" onchange="updateValues()">
                        <option selected>-</option>
                        <?php
                            foreach ($data as $key => $value) {
                                echo "<option value='". $value['nome_login'] ."'>" . $value['nome_login'] ."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="nome_login">Nome login:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nome_login" placeholder="Inserisci il nome utente" name="nome_login">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="nome">Nome:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nome" placeholder="Inserisci il nome" name="nome">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="cognome">Cognome:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cognome" placeholder="Inserisci il cognome" name="cognome">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="ruolo">Ruolo:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="ruolo" name="ruolo">
                        <option value="Amministratore">Amministratore</option>
                        <option value="Operatore">Operatore</option>
                        <option value="Viewer">Viewer</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="pass">Password:</label>
                <div class="col-sm-10">          
                    <input type="password" class="form-control" id="pass" placeholder="Inserisci la password" name="pass">
                </div>
            </div>

            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="update" class="btn btn-success">Salva modifiche</button>
                    <button type="submit" name="delete" class="btn btn-danger">Elimina utente</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-6">
        <h2>Crea utente</h2>

        <form class="form-horizontal" action="<?php echo URL; ?>amministratore/createUser" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="nome_login">Nome login:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_nome_login" placeholder="Inserisci il nome utente" name="new_nome_login">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="nome">Nome:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_nome" placeholder="Inserisci il nome" name="new_nome">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="cognome">Cognome:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_cognome" placeholder="Inserisci il cognome" name="new_cognome">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="ruolo">Ruolo:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="new_ruolo" name="new_ruolo">
                        <option value="Amministratore">Amministratore</option>
                        <option value="Operatore">Operatore</option>
                        <option value="Viewer">Viewer</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="pass">Password:</label>
                <div class="col-sm-10">          
                    <input type="password" class="form-control" id="new_pass" placeholder="Inserisci la password" name="new_pass">
                </div>
            </div>

            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Crea utente</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row text-center">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#usersModal">Mostra tutti gli utenti</button>

    <div class="modal fade" id="usersModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lista degli utenti</h4>
                </div>
                <div class="modal-body">
                <div class="table-responsive">          
                    <table class="table">
                        <tr>
                            <th class="text-center">nome_login</th>
                            <th class="text-center">nome</th>
                            <th class="text-center">cognome</th>
                            <th class="text-center">ruolo</th>
                            <th class="text-center">pass</th>
                        </tr>
                        <?php
                            foreach ($data as $key => $value) {
                                echo "<tr>";
                                echo "<td value='". $value['nome_login'] ."'>" . $value['nome_login'] ."</td>";
                                echo "<td value='". $value['nome'] ."'>" . $value['nome'] ."</td>";
                                echo "<td value='". $value['cognome'] ."'>" . $value['cognome'] ."</td>";
                                echo "<td value='". $value['ruolo'] ."'>" . $value['ruolo'] ."</td>";
                                echo "<td value='". $value['pass'] ."'>" . $value['pass'] ."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
</div>