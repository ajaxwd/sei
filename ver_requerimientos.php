<h2></h2>
<p></p>
<div style="margin:20px 0;"></div>

<table class="easyui-datagrid" title="Tabla Incidencias" style="width:670px;height:250px"
        data-options="singleSelect:true,collapsible:true,url:'datagrid_data1.json',method:'get'">
    <thead>
        <tr>
            <th data-options="field:'id',width:40">ID</th>
            <th data-options="field:'Fecha Ingreso',width:90">Fecha Ingreso</th>
            <th data-options="field:'Descripcion',width:150">Cod_Area</th>
            <th data-options="field:'Detalle',width:200">Observacion</th>
            <th data-options="field:'Estado',width:80,align:'center'">Estado</th>
        </tr>
    </thead>
    <tbody>
      
        <? 
        foreach ($requerimientos as $requerimiento) 
        {?>
        <tr>
          <td><?echo $requerimiento->id_req?></td>
          <td><?echo $requerimiento->fec_ing?></td>
          <td><?echo $requerimiento->cod_area?></td>
          <td><?echo $requerimiento->observacion?></td>
          <td>QA</td>
        </tr>
        <?}?>
      

    </tbody>
</table>
