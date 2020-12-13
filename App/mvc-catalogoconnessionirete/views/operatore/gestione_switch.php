<div class="row">
    <script>
        function updateSwitchValues() {
            var switches = <?php echo json_encode($data); ?>;

            var switchh = (document.getElementById('selector').value).split(",")[1];
            var id = document.getElementById('id_switch');
            var old_id = document.getElementById('old_id');
            var modello = document.getElementById('modello');
            var posizione = document.getElementById('posizione');
            var porte = document.getElementById('porte');

            for (var i = 0; i < switches.length; i++) {
                if (switches[i]['id'] == switchh) {
                    id.value = switches[i]['id'];
                    old_id.value = switches[i]['id'];
                    modello.value = switches[i]['modello'];
                    posizione.value = switches[i]['posizione'];
                    porte.value = switches[i]['numero_porte'];
                    break;
                }
            }
        }
    </script>
    <div class="col-sm-6">
        <h2>Modifica switch</h2>

        <form id="updateForm" class="form-horizontal" action="<?php echo URL; ?>operatore/action/switch" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="selector">Cavo:</label>
                <div class="col-sm-10">
                    <select id="selector" class="form-control" name="selector" onchange="updateSwitchValues()">
                        <option selected>-</option>
                        <?php
                        foreach ($data as $key => $value) {
                            echo "<option value='" . $value['modello'] . "," . $value['id'] . "'>" . $value['modello'] . "," . $value['id'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="nome">Id:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_switch" placeholder="Inserisci l'id" name="id_switch">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="tipo">Modello:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="modello" placeholder="Inserisci il modello" name="modello">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="descrizione">Posizione:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="posizione" placeholder="Inserisci la posizione" name="posizione">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="porte">Porte:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="porte" placeholder="Inserisci il numero di porte" name="porte">
                </div>
            </div>

            <input type="hidden" id="old_id" name="old_id" value="">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="update" class="btn btn-success">Salva modifiche</button>
                    <button type="submit" name="delete" class="btn btn-danger">Elimina switch</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-6">
        <h2>Crea switch</h2>

        <form class="form-horizontal" action="<?php echo URL; ?>operatore/createSwitch" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="new_id">Id:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_id" placeholder="Inserisci l'id" name="new_id">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="new_modello">Modello:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_modello" placeholder="Inserisci il modello" name="new_modello">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="new_posizione">Posizione:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_posizione" placeholder="Inserisci la descrizione" name="new_posizione">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="new_porte">Porte:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="new_porte" placeholder="Inserisci il numero di porte" name="new_porte">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Crea switch</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row text-center">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#switchesModal">Mostra tutti gli switch</button>

    <div class="modal fade" id="switchesModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lista di switch</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="text-center">id</th>
                                <th class="text-center">modello</th>
                                <th class="text-center">posizione</th>
                                <th class="text-center">porte</th>
                            </tr>
                            <?php
                            foreach ($data as $key => $value) {
                                echo "<tr>";
                                echo "<td value='" . $value['id'] . "'>" . $value['id'] . "</td>";
                                echo "<td value='" . $value['modello'] . "'>" . $value['modello'] . "</td>";
                                echo "<td value='" . $value['posizione'] . "'>" . $value['posizione'] . "</td>";
                                echo "<td value='" . $value['numero_porte'] . "'>" . $value['numero_porte'] . "</td>";
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