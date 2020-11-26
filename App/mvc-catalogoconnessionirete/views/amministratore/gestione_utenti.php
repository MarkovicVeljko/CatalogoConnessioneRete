<div class="row">
    <div class="col-sm-6">
        <h2>Modifica utente</h2>
        
        <form id="updateForm" class="form-horizontal" action="<?php echo URL; ?>amministratore/update" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="old_nome_login">Utente:</label>
                <div class="col-sm-10">
                    <select id="selector" class="form-control" name="selector">
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
                    <button type="submit" class="btn btn-success">Salva modifiche</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-6">
        <h2>Crea utente</h2>
        <form class="form-horizontal" action="amministratore/update" method="post">
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
                    <input type="text" class="form-control" id="ruolo" placeholder="Inserisci il ruolo" name="ruolo">
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
                    <button type="submit" class="btn btn-success">Salva modifiche</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row text-center">
    <button type="button" class="btn btn-info">Mostra tutti gli utenti</button>
</div>