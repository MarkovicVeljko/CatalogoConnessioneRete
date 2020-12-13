<div class="row">
    <script>
        function updateCableValues() {
            var cavi = <?php echo json_encode($data[0]); ?>;

            var cavo = (document.getElementById('selector').value).split(",")[1];
            var id = document.getElementById('id_cavo');
            var old_id = document.getElementById('old_id');
            var tipo = document.getElementById('tipo');
            var old_tipo = document.getElementById('old_tipo');
            var descrizione = document.getElementById('descrizione');

            for (var i = 0; i < cavi.length; i++) {
                if (cavi[i][0] == cavo) {
                    tipo.value = cavi[i][1];
                    old_tipo.value = cavi[i][1];
                    id.value = cavi[i][0];
                    old_id.value = cavi[i][0];
                    descrizione.value = cavi[i][2];
                    break;
                }
            }
        }
    </script>
    <div class="col-sm-6">
        <h2>Modifica cavo</h2>

        <form id="updateForm" class="form-horizontal" action="<?php echo URL; ?>amministratore/action/cable" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="selector">Cavo:</label>
                <div class="col-sm-10">
                    <select id="selector" class="form-control" name="selector" onchange="updateCableValues()">
                        <option selected>-</option>
                        <?php
                        foreach ($data[0] as $key => $value) {
                            echo "<option value='" . $value['tipo'] . "," . $value['id'] . "'>" . $value['tipo'] . "," . $value['id'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="nome">Id:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="id_cavo" placeholder="Inserisci l'id" name="id_cavo">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="tipo">Tipo:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tipo" placeholder="Inserisci il tipo" name="tipo">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="descrizione">Descrizione:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="descrizione" placeholder="Inserisci la descrizione" name="descrizione">
                </div>
            </div>

            <input type="hidden" id="old_id" name="old_id" value="">
            <input type="hidden" id="old_tipo" name="old_tipo" value="">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="update" class="btn btn-success">Salva modifiche</button>
                    <button type="submit" name="delete" class="btn btn-danger">Elimina cavo</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-6">
        <h2>Crea cavo</h2>

        <form class="form-horizontal" action="<?php echo URL; ?>amministratore/createCable" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="new_id">Id:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="new_id" placeholder="Inserisci l'id" name="new_id">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="new_tipo">Tipo:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_tipo" placeholder="Inserisci il tipo" name="new_tipo">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="new_descrizione">Descrizione:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_descrizione" placeholder="Inserisci la descrizione" name="new_descrizione">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Crea cavo</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row text-center">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#cablesModal">Mostra tutti i cavi</button>

    <div class="modal fade" id="cablesModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lista di cavi</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="text-center">id</th>
                                <th class="text-center">tipo</th>
                                <th class="text-center">descrizione</th>
                            </tr>
                            <?php
                            foreach ($data[0] as $key => $value) {
                                echo "<tr>";
                                echo "<td value='" . $value['id'] . "'>" . $value['id'] . "</td>";
                                echo "<td value='" . $value['tipo'] . "'>" . $value['tipo'] . "</td>";
                                echo "<td value='" . $value['descrizione'] . "'>" . $value['descrizione'] . "</td>";
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

<!-- Dispositivi -->

<div class="row">
    <script>
        function updateDeviceValues() {
            var dispositivi = <?php echo json_encode($data[1]); ?>;

            var dispositivo = (document.getElementById('selector_d').value).split(",")[1];
            var id = document.getElementById('id_dispositivo');
            var old_id = document.getElementById('old_id_d');
            var tipo = document.getElementById('tipo_d');
            var old_tipo = document.getElementById('old_tipo_d');
            var descrizione = document.getElementById('descrizione_d');

            for (var i = 0; i < dispositivi.length; i++) {
                if (dispositivi[i][0] == dispositivo) {
                    tipo.value = dispositivi[i][1];
                    old_tipo.value = dispositivi[i][1];
                    id.value = dispositivi[i][0];
                    old_id.value = dispositivi[i][0];
                    descrizione.value = dispositivi[i][2];
                    break;
                }
            }
        }
    </script>
    <div class="col-sm-6">
        <h2>Modifica dispositivo</h2>

        <form id="updateForm" class="form-horizontal" action="<?php echo URL; ?>amministratore/action/device" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="selector">Dispositivo:</label>
                <div class="col-sm-10">
                    <select id="selector_d" class="form-control" name="selector" onchange="updateDeviceValues()">
                        <option selected>-</option>
                        <?php
                        foreach ($data[1] as $key => $value) {
                            echo "<option value='" . $value['tipo'] . "," . $value['id'] . "'>" . $value['tipo'] . "," . $value['id'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="nome">Id:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="id_dispositivo" placeholder="Inserisci l'id" name="id_dispositivo">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="tipo">Tipo:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tipo_d" placeholder="Inserisci il tipo" name="tipo">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="descrizione">Descrizione:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="descrizione_d" placeholder="Inserisci la descrizione" name="descrizione">
                </div>
            </div>

            <input type="hidden" id="old_id_d" name="old_id" value="">
            <input type="hidden" id="old_tipo_d" name="old_tipo" value="">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="update" class="btn btn-success">Salva modifiche</button>
                    <button type="submit" name="delete" class="btn btn-danger">Elimina dispositivo</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-6">
        <h2>Crea dispositivo</h2>

        <form class="form-horizontal" action="<?php echo URL; ?>amministratore/createDevice" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="new_id">Id:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="new_id" placeholder="Inserisci l'id" name="new_id">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="new_tipo">Tipo:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_tipo" placeholder="Inserisci il tipo" name="new_tipo">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="new_descrizione">Descrizione:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_descrizione" placeholder="Inserisci la descrizione" name="new_descrizione">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Crea dispositivo</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row text-center">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#devicesModal">Mostra tutti i dispositivi</button>

    <div class="modal fade" id="devicesModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lista di dispositivi</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="text-center">id</th>
                                <th class="text-center">tipo</th>
                                <th class="text-center">descrizione</th>
                            </tr>
                            <?php
                            foreach ($data[1] as $key => $value) {
                                echo "<tr>";
                                echo "<td value='" . $value['id'] . "'>" . $value['id'] . "</td>";
                                echo "<td value='" . $value['tipo'] . "'>" . $value['tipo'] . "</td>";
                                echo "<td value='" . $value['descrizione'] . "'>" . $value['descrizione'] . "</td>";
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
<br>
<br>