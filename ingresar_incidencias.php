<h2></h2>
    <p></p>
    <div style="margin:20px 0;"></div>
    <div class="easyui-panel" title="Formulario Incidencias" style="width:500px">
        <div style="padding:10px 60px 20px 60px">
        <form id="ff" method="post" name="ff" action="usuario.php?action=ingresar">
            <table cellpadding="5">
                <tr>
                    <td>Descripcion:</td>
                    <td><input class="easyui-textbox" id="Descripcion" type="text" name="Descripcion" data-options="required:true" style="width:200px"></input></td>
                </tr>
                <tr>
                    <td>Detalle:</td>
                    <td><input class="easyui-textbox" id="Detalle" type="text" name="Detalle" data-options="required:true,multiline:true" style="height:60px;width=200px;"></input></td>
                </tr>
                <tr>
                    <td>Dependencia:</td>
                    <td><input class="easyui-textbox" id="Dependencia" type="text" name="Dependencia" data-options="required:true" style="width:200px"></input></td>
                </tr>
            </table>
                <input type="submit" class="link_button" value="Enviar" name="botonEnviar" onclick="Vali_Incidencias();"/>
        </form>
        <div style="text-align:center;padding:5px">

          <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">Limpiar</a>
        </div>
        </div>
    </div>
