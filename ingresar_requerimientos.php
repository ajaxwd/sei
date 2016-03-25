<h2></h2>
    <p></p>
    <div style="margin:20px 0;"></div>
    <div class="easyui-panel" title="Formulario Requerimiento" style="width:500px">
        <div style="padding:10px 60px 20px 60px">
        <form id="frmrequerimiento" method="post">
            <table cellpadding="5">
                <tr>
                    <td>Codigo del Area:</td>
                    <td>
                        <select class="easyui-combobox" name="language" id="codarea">
                        <?foreach ($cod_areas as $cod_area){?>
                        <option value="<?echo $cod_area->Cod_Tipo?>"><?echo $cod_area->Descr?></option>
                        <?}?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Incidencia:</td>
                    <td>
                        <select class="easyui-combobox" name="language" id="incidencia">
                        <?foreach ($num_incidencias as $num_incidencia){?>
                        <option value="<?echo $num_incidencia->ID_Incidencia?>"><?echo $num_incidencia->ID_Incidencia?></option>
                        <?}?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Observacion:</td>
                    <td><textarea id="observacion" type="text" name="observacion" rows="10"></textarea></td>
                </tr>
                </table>
                <input type="submit" class="link_button" value="Enviar" name="botonEnviar" onclick="ValidarIncidencias();"/>
        
        </form>
        <div style="text-align:center;padding:5px">
            
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">Clear</a>
        </div>
        </div>
    </div>
    <script>
    function submitForm(){
        $('#ff').form('submit');
    }

        function clearForm(){
            $('#ff').form('clear');
        }
    </script>
