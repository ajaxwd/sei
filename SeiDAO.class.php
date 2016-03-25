<?php
/*****************************************
Autor 		: Enrique Quijon
Objetivo	: Capa de Datos
Creación	: 01/06/2014.
******************************************/

require_once ('Sei.class.php');
require_once ('Conexion.class.php');

class SeiDAO{
    public $conexion;


    public function  __construct() {
        $this->conexion = new Conexion();
    }
//********************************************************************
//ingresar incidencias por el usuario
public function ingresarIncidencias($descr,$detalle,$dependencia,$ID_Usuario){
  //Autocommit = 0
  mysql_query("SET AUTOCOMMIT=0;"); //Para InnoDB, mantener la transaccion abierta

  //Inicio de transacción
  mysql_query("BEGIN;");

$sql = "INSERT INTO incidencias VALUES";
$sql .= " (6,now(),'".$descr."','".$detalle."','".$dependencia."','".$ID_Usuario."')";
$result = $this->conexion->ejecutar($sql);

  if(!$result){
    echo "Error en la Transacción: ".mysql_error();
    mysql_query("ROLLBACK;");           //Terminar la transaccion si hay error
    exit();
  }
$incidencias = mysql_insert_id();
    if ($result) {
    mysql_query("COMMIT");      //Terminar la transaccion
  }

  return $incidencias;
  }

//ingresar Requerimiento
public function ingresarRequerimientos($Cod_Area,$ID_Incidencia,$Observacion,$ID_Usuario){

  //Autocommit = 0
  mysql_query("SET AUTOCOMMIT=0;"); //Para InnoDB, mantener la transaccion abierta

  //Inicio de transacción
  mysql_query("BEGIN;");

$sql = "INSERT INTO requerimientos VALUES";
$sql .= " (5,now(),'".$Cod_Area."','".$ID_Incidencia."','".$Observacion."','".$ID_Usuario."')";
$result = $this->conexion->ejecutar($sql);

if(!$result){
  echo "Error en la Transacción: ".mysql_error();
  mysql_query("ROLLBACK;");           //Terminar la transaccion si hay error
  exit();
}
$requerimientos = mysql_insert_id();
  if ($result) {
  mysql_query("COMMIT");      //Terminar la transaccion
}

return $requerimientos;

}

//Mostrar incidencias que tengo al usuario en session_id
public function mostrarIncidencias($ID_Usuario){
  $incidencias = array();
  $sql = "SELECT ID_Incidencia, Fec_Ing, Descr, Detalle, Dependencia, ID_Usuario";
  $sql .= " FROM incidencias WHERE ID_Usuario='".$ID_Usuario."'";
  $result = $this->conexion->ejecutar($sql);
  while($array = mysql_fetch_array($result)){
          //Creo una instanacia de la incidencia y lo almanceo en el array
  $incidencias[] = new Incidencias($array['ID_Incidencia'],$array['Fec_Ing'],$array['Descr'],$array['Detalle'],$array['Dependencia'],$array['ID_Usuario']);
      }
      return $incidencias;
  }


//Numero de incidencia
 public function numeroIncidencias(){
  $num_incidencias = array();
  $sql = "SELECT ID_Incidencia, Fec_Ing, Descr, Detalle, Dependencia, ID_Usuario";
  $sql .= " FROM incidencias" ;
  $result = $this->conexion->ejecutar($sql);
  while($array = mysql_fetch_array($result)){
          //Creo una instanacia de la incidencia y lo almanceo en el array
  $num_incidencias[] = new Incidencias($array['ID_Incidencia'],$array['Fec_Ing'],$array['Descr'],$array['Detalle'],$array['Dependencia'],$array['ID_Usuario']);
  }
      return $num_incidencias;
 }

//codigo de area
 public function codigoArea(){
 	$cod_areas = array();
 	$sql = "SELECT Cod_Tipo, Cod_Codigo, Descr, Cod_Padre";
 	$sql .= " FROM codigos WHERE Cod_Tipo = 2";
 	$result = $this->conexion->ejecutar($sql);
 	while($array = mysql_fetch_array($result)){
          //Creo una instanacia de la incidencia y lo almanceo en el array
  	$cod_areas[] = new Codigos($array['Cod_Tipo'],$array['Cod_Codigo'],$array['Descr'],$array['Cod_Padre']);
      }
    return $cod_areas;
 }


// Mostrar requerimientos que tenga el usuario en session_id
public function mostrarRequerimientos(){
  $requerimientos = array();
  $sql = "SELECT ID_Req, Fec_Ing, Cod_Area, ID_Incidencia, Observacion, ID_Usuario";
  $sql .= " FROM requerimientos";
  $result = $this->conexion->ejecutar($sql);
  while($array = mysql_fetch_array($result)){
  	//$reque[] = new Reques($array['ID_Req'],$array['Fec_Ing'],$array['Cod_Area'],$array['ID_Incidencia'],$array['Observacion'],$array['ID_Usuario']);
  	$requerimientos[] = new Requerimientos($array['ID_Req'],$array['Fec_Ing'],$array['Cod_Area'],$array['ID_Incidencia'],$array['Observacion'],$array['ID_Usuario']);

  }
  return $requerimientos;
}
//mostrar monitoreo de control del usuario en session
public function monitoreoControl(){
	$monitoreos = array();
	$sql = "SELECT ID_Monitoreo, Cod_Ident, Num_Ident, ID_Usu_Respon, Fec_Solucion, Cod_Estado";
	$sql .= " from monitoreo";
	$result = $this->conexion->ejecutar($sql);
	while($array = mysql_fetch_array($result)){
		$monitoreos[] = new Monitoreo($array['ID_Monitoreo'],$array['Cod_Ident'],$array['Num_Ident'],$array['ID_Usu_Respon'],$array['Fec_Solucion'],$array['Cod_Estado']);
	}
	return $monitoreos;
}


//********************************************************************************//
//************************* D A T O S   M O D U L O S ****************************//
//********************************************************************************//

//Recupero en un array del Menu principal
    public function obtenerMenu($cod_perfil){
        $modulos =  array();
		$sql = "SELECT m.ID_Modulo as ID_Modulo, m.Descr as Descr, m.URL as URL, m.Estado as Estado, m.Id_mod_padre as Id_mod_padre";
		$sql .= " FROM modulos m, permisos p WHERE m.Id_modulo=p.Id_modulo AND p.Cod_perfil=$cod_perfil AND m.Id_mod_padre=0 Order By m.ID_Modulo";
		$result = $this->conexion->ejecutar($sql);
		while($array = mysql_fetch_array($result)){
            //Creo una instanacia del cliente y lo almanceo en el array
    		$modulos[] = new Modulos($array['ID_Modulo'],$array['Descr'],$array['URL'],$array['Estado'],$array['Id_mod_padre']);
        }
        return $modulos;
    }

//********************************************************************************//
//************** D A T O S   C O D I G O S   G E N E R A L E S  ******************//
//********************************************************************************//

//Recupero el nombre de la Descripción}
    public function obtenerDescripcion($cod_tipo,$cod_perfil){
        $descripcion = 0;
		$sql="SELECT Descr from codigos WHERE Cod_Tipo=$cod_tipo AND Cod_codigo=$cod_perfil";
		$result = $this->conexion->ejecutar($sql);
		if($array = mysql_fetch_array($result)){
		    $descripcion = $array[0];
        }
        return $descripcion;
    }

	//Recupero en un array de las listas
    public function obtenerListas($cod_tipo){
        $codigos =  array();
		$sql="SELECT Cod_Tipo, Cod_Codigo, Descr, Cod_Padre from codigos WHERE Cod_Tipo=$cod_tipo Order by Cod_Codigo";
		$result = $this->conexion->ejecutar($sql);
		while($array = mysql_fetch_array($result)){
            //Creo una instanacia de la lista y lo almaceno en el array
    		$codigos[] = new Codigos($array['Cod_Tipo'],$array['Cod_Codigo'],$array['Descr'],$array['Cod_Padre']);
        }
        return $codigos;
    }
	
//********************************************************************************//
//************************* D A T O S   U S U A R I O S **************************//
//********************************************************************************//

	//Recupero en un array de todos los Usuarios
    public function obtenerUsuario($nom_usu, $clave){
        $usuarios =  array();
		$sql = "SELECT ID_Usuario, Nombre, Email, Cargo, Cod_Perfil, Nom_Usu, Clave";
		$sql .= " FROM usuarios WHERE clave='".$clave."' AND Nom_Usu='".$nom_usu."'";
		$result = $this->conexion->ejecutar($sql);
		while($array = mysql_fetch_array($result)){
            //Creo una instanacia del cliente y lo almanceo en el array
    		$usuarios[] = new Usuarios($array['ID_Usuario'],$array['Nombre'],$array['Email'],$array['Cargo'],$array['Cod_Perfil'],$array['Nom_Usu'],$array['Clave']);
        }
        return $usuarios;
    }
	
	//Recupero en un array de todos los Usuarios
    public function obtenerListaUsuario(){
        $usuarios =  array();
		$sql = "SELECT ID_Usuario, Nombre, Email, Cargo, Cod_Perfil, Nom_Usu, Clave FROM usuarios WHERE Cod_Perfil = 4 order by Nombre";
		$result = $this->conexion->ejecutar($sql);
		while($array = mysql_fetch_array($result)){
            //Creo una instanacia del cliente y lo almanceo en el array
    		$usuarios[] = new Usuarios($array['ID_Usuario'],$array['Nombre'],$array['Email'],$array['Cargo'],$array['Cod_Perfil'],$array['Nom_Usu'],$array['Clave']);
        }
        return $usuarios;
    }
	
	//Recupero en un array de todos los Usuarios
    public function obtenerClave($email){
       $usuarios =  array();
		$sql = "SELECT ID_Usuario, Nombre, Email, Cargo, Cod_Perfil, Nom_Usu, Clave";
		$sql .= " FROM usuarios WHERE Email='".$email."'";
		$result = $this->conexion->ejecutar($sql);
		while($array = mysql_fetch_array($result)){
            //Creo una instanacia del cliente y lo almanceo en el array
    		$usuarios[] = new Usuarios($array['ID_Usuario'],$array['Nombre'],$array['Email'],$array['Cargo'],$array['Cod_Perfil'],$array['Nom_Usu'],$array['Clave']);
        }
        return $usuarios;
    }


	function guardarUsuario($nombre, $email, $clave){
		//Autocommit = 0
		mysql_query("SET AUTOCOMMIT=0;"); //Para InnoDB, mantener la transaccion abierta

		//Inicio de transacción
		mysql_query("BEGIN;");

		//Operaciones en pedido
		$sql = "insert into Pond_Usuario (nombre,email,clave) ";
		$sql .= "values ('$nombre','$email','$clave')";
		$rs =$this->conexion->ejecutar($sql);

		if(!$rs){
			echo "Error en la Transacción: ".mysql_error();
			mysql_query("ROLLBACK;");           //Terminar la transaccion si hay error
			exit();
		}

		$usuarios = mysql_insert_id();

        if ($rs) {
			mysql_query("COMMIT");      //Terminar la transaccion
		}

		return $usuarios;
    }

	function modificarUsuario($id, $nombre, $email){
		//Autocommit = 0
		mysql_query("SET AUTOCOMMIT=0;"); //Para InnoDB, mantener la transaccion abierta

		//Inicio de transacción
		mysql_query("BEGIN;");

		$fec_nac = date("Y-m-d",strtotime($fec_nac));

		//Operaciones en pedido
		$sql = "update Pond_Usuario SET";
		$sql .= " nombre = '$nombre',";
		$sql .= " email = '$email'";
		$sql .= " WHERE id_usuario = $id";
		$rs =$this->conexion->ejecutar($sql);

		if(!$rs){
			echo "Error en la Transacción: ".mysql_error();
			mysql_query("ROLLBACK;");           //Terminar la transaccion si hay error
			exit();
		}

		$usuarios = mysql_insert_id();

        if ($rs) {
			mysql_query("COMMIT");      //Terminar la transaccion
		}

		return $usuarios;
    }

	function cambiarClave($id, $clave){
		//Autocommit = 0
		mysql_query("SET AUTOCOMMIT=0;"); //Para InnoDB, mantener la transaccion abierta

		//Inicio de transacción
		mysql_query("BEGIN;");

		$sql = "update Pond_Usuario SET";
		$sql .= " clave = $clave";
		$sql .= " WHERE id_usuario = $id";
		$rs =$this->conexion->ejecutar($sql);

		if(!$rs){
			echo "Error en la Transacción: ".mysql_error();
			mysql_query("ROLLBACK;");           //Terminar la transaccion si hay error
			exit();
		}

		$cambio_clave = mysql_insert_id();

        if ($rs) {
			mysql_query("COMMIT");      //Terminar la transaccion
		}

		return $cambio_clave;
    }
	
//********************************************************************************//
//*****************************   T A R E A S  ***********************************//
//********************************************************************************//

// Mostrar Listado de Tareas Creadas
public function obtenerListado($id_tarea, $inicio = 0, $nro_paginas = 0){
  $tareas = array();
  if ($id_tarea == 0){
	  $sql = "SELECT ID_Tarea, Fec_Creacion, Descr, Detalle, Usu_Gestor, Usu_Asignado, Fec_Ini, Fec_Fin, Cod_Prioridad, Cod_Tipo_Req, Cod_resolucion, Horas_Estimadas, ID_Tarea_Padre, ID_Req";
	  $sql .= " FROM tareas ORDER by Fec_Creacion LIMIT ".$inicio."," .$nro_paginas."";
  }else{
	  $sql = "SELECT ID_Tarea, Fec_Creacion, Descr, Detalle, Usu_Gestor, Usu_Asignado, Fec_Ini, Fec_Fin, Cod_Prioridad, Cod_Tipo_Req, Cod_resolucion, Horas_Estimadas, ID_Tarea_Padre, ID_Req";
	  $sql .= " FROM tareas WHERE ID_Tarea = ".$id_tarea."";
  }
  $result = $this->conexion->ejecutar($sql);
  while($array = mysql_fetch_array($result)){
  	$tareas[] = new Tareas($array['ID_Tarea'],$array['Fec_Creacion'],$array['Descr'],$array['Detalle'],$array['Usu_Gestor'],$array['Usu_Asignado'],$array['Fec_Ini'],$array['Fec_Fin'],$array['Cod_Prioridad'],$array['Cod_Tipo_Req'],$array['Cod_resolucion'],$array['Horas_Estimadas'],$array['ID_Tarea_Padre'],$array['ID_Req']);

  }
  return $tareas;
}

// Mostrar Listado de Tareas Creadas
public function obtenerPorTarea($id_tarea){
  $tareas = array();
  $sql = "SELECT ID_Tarea, Fec_Creacion, Descr, Detalle, Usu_Gestor, Usu_Asignado, Fec_Ini, Fec_Fin, Cod_Prioridad, Cod_Tipo_Req, Cod_resolucion, Horas_Estimadas, ID_Tarea_Padre, ID_Req";
  $sql .= " FROM tareas WHERE ID_Tarea = ".$id_tarea."";
  
  $result = $this->conexion->ejecutar($sql);
  while($array = mysql_fetch_array($result)){
  	$tareas[] = new Tareas($array['ID_Tarea'],$array['Fec_Creacion'],$array['Descr'],$array['Detalle'],$array['Usu_Gestor'],$array['Usu_Asignado'],$array['Fec_Ini'],$array['Fec_Fin'],$array['Cod_Prioridad'],$array['Cod_Tipo_Req'],$array['Cod_resolucion'],$array['Horas_Estimadas'],$array['ID_Tarea_Padre'],$array['ID_Req']);

  }
  return $tareas;
}

function guardarTarea($id_tarea,$descr,$detalle,$asignado,$fecini,$fecfin,$prioridad,$cod_tipo_req,$gestor,$id_req){
		//Autocommit = 0
		mysql_query("SET AUTOCOMMIT=0;"); //Para InnoDB, mantener la transaccion abierta
		
		//Inicio de transacción
		mysql_query("BEGIN;");
		
		$date= date('Y-m-d', time());
		$fecini = date("Y-m-d",strtotime($fecini));
		$fecfin = date("Y-m-d",strtotime($fecfin));
		
		//Verificamos si Existe el ID de la Tarea
		$sql = "SELECT * FROM tareas WHERE ID_Tarea = ".$id_tarea."";
		$result = $this->conexion->ejecutar($sql);
        if($array = mysql_fetch_array($result)){
			//Actualiza Tarea
			$sql = "UPDATE tareas SET";
			$sql .= " Descr='$descr'";
			$sql .= ", Detalle='$detalle'";
			$sql .= ", Usu_Asignado=$asignado";
			$sql .= ", Fec_Ini='$fecini'";
			$sql .= ", Fec_Fin='$fecfin'";
			$sql .= ", Cod_Prioridad=$prioridad";
			$sql .= ", Cod_Tipo_Req=$cod_tipo_req";
			$sql .= ", ID_Req=$id_req";
			$sql .= " WHERE ID_Tarea = ".$id_tarea."";
		}else{
			//Ingresa Tarea
			$sql = "insert into tareas (Fec_Creacion, Descr, Detalle, Usu_Gestor, Usu_Asignado, Fec_Ini, Fec_Fin, Cod_Prioridad, Cod_Tipo_Req, Cod_resolucion, Horas_Estimadas, ID_Tarea_Padre, ID_Req) ";
			$sql .= "values ('$date','$descr','$detalle',$gestor,$asignado,'$fecini','$fecfin',$prioridad,$cod_tipo_req,0,0,0,$id_req)";
		}	
		$rs =$this->conexion->ejecutar($sql);
		
		if(!$rs){
			echo "Error en la Transacción: ".mysql_error();
			mysql_query("ROLLBACK;");           //Terminar la transaccion si hay error
			exit();
		}
		
		$guardar = mysql_insert_id();

        if ($rs) {
			mysql_query("COMMIT");      //Terminar la transaccion
		}

		return $guardar;
    }	

}
?>
