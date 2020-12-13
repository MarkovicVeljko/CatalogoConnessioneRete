<div class="row">
    <script>
        function updatePorts() {
            var ports = <?php echo json_encode($data[1]); ?>;

            var switchh = (document.getElementById('selector').value).split(",")[1];
            var port = document.getElementById("port");
            document.getElementById("id_switch").value = (document.getElementById('selector').value).split(",")[1];
            port.removeAttribute("disabled");

            var temp = port.length;
            for (var i = 0; i < temp; i++) {
                port.remove(1);
            }

            for (var i = 0; i < ports.length; i++) {
                if (ports[i]['switch_id'] == switchh) {
                    var opt = document.createElement('option');
                    opt.appendChild(document.createTextNode(ports[i]['numero_porta']));
                    opt.value = ports[i]['numero_porta'];
                    port.appendChild(opt);
                }
            }
        }

        function updatePortValues() {
            var ports = <?php echo json_encode($data[1]); ?>;

            var port = document.getElementById('port').value;
            var cavo = document.getElementById('cavo');
            var dispositivo = document.getElementById('dispositivo');

            for (var i = 0; i < ports.length; i++) {
                if (ports[i]['numero_porta'] == port && ports[i]['switch_id'] == document.getElementById("id_switch").value) {
                    cavo.value = (ports[i]['cavo_tipo'] != null) ? ports[i]['cavo_tipo'] : '-';
                    dispositivo.value = (ports[i]['dispositivo_tipo'] != null) ? ports[i]['dispositivo_tipo'] : '-';
                    break;
                }
            }
        }
    </script>
    <div class="col-sm-12">
        <h2>Modifica porte</h2>

        <form id="updateForm" class="form-horizontal" action="<?php echo URL; ?>operatore/action/ports" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="selector">Switch:</label>
                <div class="col-sm-10">
                    <select id="selector" class="form-control" name="selector" onchange="updatePorts()">
                        <option selected>-</option>
                        <?php
                        foreach ($data[0] as $key => $value) {
                            echo "<option value='" . $value['modello'] . "," . $value['id'] . "'>" . $value['modello'] . "," . $value['id'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="port">Porta:</label>
                <div class="col-sm-10">
                    <select id="port" class="form-control" name="port" onchange="updatePortValues()" disabled>
                        <option selected>-</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="Cavo">Cavo:</label>
                <div class="col-sm-10">
                    <select id="cavo" class="form-control" name="cavo">
                        <option selected>-</option>
                        <?php
                        foreach ($data[2] as $key => $value) {
                            echo "<option value='" . $value['tipo'] . "'>" . $value['tipo'] . "," . $value['id'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="dispositivo">Dispositivo:</label>
                <div class="col-sm-10">
                    <select id="dispositivo" class="form-control" name="dispositivo">
                        <option selected>-</option>
                        <?php
                        foreach ($data[3] as $key => $value) {
                            echo "<option value='" . $value['tipo'] . "'>" . $value['tipo'] . "," . $value['id'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <input type="hidden" id="id_switch" name="id_switch" value="">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="update" class="btn btn-success">Salva modifiche</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row text-center">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#portsModal">Mostra tutte le porte</button>

    <div class="modal fade" id="portsModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lista completa delle porte</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="text-center">switch_id</th>
                                <th class="text-center">numero_porta</th>
                                <th class="text-center">cavo_tipo</th>
                                <th class="text-center">dispositivo_tipo</th>
                            </tr>
                            <?php
                            foreach ($data[1] as $key => $value) {
                                echo "<tr>";
                                echo "<td value='" . $value['switch_id'] . "'>" . $value['switch_id'] . "</td>";
                                echo "<td value='" . $value['numero_porta'] . "'>" . $value['numero_porta'] . "</td>";
                                echo "<td value='" . $value['cavo_tipo'] . "'>" . $value['cavo_tipo'] . "</td>";
                                echo "<td value='" . $value['dispositivo_tipo'] . "'>" . $value['dispositivo_tipo'] . "</td>";
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