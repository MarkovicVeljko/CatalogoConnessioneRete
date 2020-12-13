<div class="row">
    <script>
        function updateNomeSwitch() {
            var switches = <?php echo json_encode($data[0]); ?>;
            var ports = <?php echo json_encode($data[1]); ?>;
            document.getElementById("nome_switch").innerHTML = document.getElementById("selector").value;
            switchh = (document.getElementById('selector').value).split(",")[1];

            $(".to_delete").remove();

            for (var i = 0; i < switches.length; i++) {
                if (switches[i]['id'] == switchh) {
                    document.getElementById("posizione").innerHTML = switches[i]['posizione'];
                    break;
                }
            }

            for (var i = 0; i < ports.length; i++) {
                if (ports[i]['switch_id'] == switchh) {
                    var tr = document.createElement('tr');
                    tr.className += "to_delete";

                    for (var j = 1; j < 4; j++) {
                        var td = document.createElement('td');
                        var temp = (ports[i][j] == null) ? "-" : ports[i][j];
                        td.appendChild(document.createTextNode(temp));
                        td.value = ports[i][j];
                        tr.appendChild(td);
                    }

                    document.getElementById('info_table').appendChild(tr);
                }
            }
        }
    </script>
    <div class="col-sm-12 text-center">
        <h2>Seleziona lo switch</h2>

        <div class="form-group">
            <div class="col-sm-12">
                <select id="selector" class="form-control" name="selector" onchange="updateNomeSwitch()">
                    <option selected>-</option>
                    <?php
                    foreach ($data[0] as $key => $value) {
                        echo "<option value='" . $value['modello'] . "," . $value['id'] . "'>" . $value['modello'] . "," . $value['id'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>

<br><br>

<div class="row text-center">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#infoModal">Mostra le info</button>

    <div class="modal fade" id="infoModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="nome_switch"></h4>
                    <h4 id="posizione"></h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table" id="info_table">
                            <tr>
                                <th class="text-center">numero_porta</th>
                                <th class="text-center">cavo</th>
                                <th class="text-center">dispositivo</th>
                            </tr>
                            <?php
                            foreach ($data[1] as $key => $value) {
                                if ($value['switch_id'] == $_COOKIE['switch']) {
                                    echo "<tr class='to_delete'>";
                                    echo "<td value='" . $value['numero_porta'] . "'>" . $value['switch_id'] . "</td>";
                                    echo "<td value='" . $value['cavo_tipo'] . "'>" . $value['cavo_tipo'] . "</td>";
                                    echo "<td value='" . $value['dispositivo_tipo'] . "'>" . $value['dispositivo_tipo'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="window.print()">Stampa</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
</div>