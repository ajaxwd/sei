<h2></h2>
<p></p>
<div style="margin:20px 0;"></div>

<table class="easyui-datagrid" title="Tabla Incidencias" style="width:670px;height:250px"
        data-options="singleSelect:true,collapsible:true,url:'datagrid_data1.json',method:'get'">
    <thead>
        <tr>
            <th data-options="field:'id',width:40">ID</th>
            <th data-options="field:'Cod_Ident',width:90">Cod_Ident</th>
            <th data-options="field:'Descripcion',width:90">Num_Ident</th>
            <th data-options="field:'Detalle',width:100">ID_Usu_Respon</th>
            <th data-options="field:'Estado',width:80,align:'center'">Fec_Solucion</th>
            <th data-options="field:'Estado',width:80,align:'center'">Cod_Estado</th>
        </tr>
    </thead>
    <tbody>
        <? 
        foreach ($monitoreos as $monitoreo) 
        {?>
      <tr>
          <td><?echo $monitoreo->ID_Monitoreo?></td>
          <td><?echo $monitoreo->Cod_Ident?></td>
          <td><?echo $monitoreo->Num_Ident?></td>
          <td><?echo $monitoreo->ID_Usu_Respon?></td>
          <td><?echo $monitoreo->Fec_Solucion?></td>
          <td><?echo $monitoreo->Cod_Estado?></td>
      </tr>
        <?}?>
      </tbody>
</table>