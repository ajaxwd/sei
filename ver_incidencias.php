<h2></h2>
<p></p>
<div style="margin:20px 0;"></div>

<table class="easyui-datagrid" title="Tabla Incidencias" style="width:670px;height:250px"
        data-options="singleSelect:true,collapsible:true,url:'datagrid_data1.json',method:'get'">
    <thead>
        <tr>
            <th data-options="field:'id',width:40">ID</th>
            <th data-options="field:'Fecha Ingreso',width:90">Fecha Ingreso</th>
            <th data-options="field:'Descripcion',width:150">Descripcion</th>
            <th data-options="field:'Detalle',width:200">Detalle</th>
            <th data-options="field:'Departamento',width:100">Departamento</th>
            <th data-options="field:'Estado',width:80,align:'center'">Estado</th>
        </tr>
    </thead>
    <tbody>
      
        <? 
        foreach ($incidencias as $incidencia) {?>
        <tr>  
          <td><?echo $incidencia->ID_Incidencia?></td>
          <td><?echo $incidencia->Fec_Ing?></td>
          <td><?echo $incidencia->Descr?></td>
          <td><?echo $incidencia->Detalle?></td>
          <td><?echo $incidencia->Dependencia?></td>
          <td>QA</td>
        </tr>  
        <?}?>
      

    </tbody>
</table>
