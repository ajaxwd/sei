<?php
/***********************************************
Autor 		: Enrique Quijon
Objetivo	: Definición de Clases Generales
Creación	: 01/06/2014.
************************************************/

/* TABLA - MODULOS */
class Modulos{
    //Atributos
	public $id_modulo;
	public $descr;
	public $url;
	public $estado;
	public $id_mod_padre;

    //Constructor
    public function  __construct($m,$d,$u,$e,$p) {
		$this->id_modulo=$m;
		$this->descr=$d;
		$this->url=$u;
		$this->estado=$e;
		$this->id_mod_padre=$p;
	}

}

/* TABLA - USUARIOS */
class Usuarios{
    //Atributos
	public $id_usuario;
	public $nombre;
	public $email;
	public $cargo;
	public $cod_perfil;
	public $nom_usu;
    public $clave;

    //Constructor
    public function  __construct($u,$n,$e,$g,$p,$s,$c) {
		$this->id_usuario=$u;
		$this->nombre=$n;
		$this->email=$e;
		$this->cargo=$g;
		$this->cod_perfil=$p;
		$this->nom_usu=$s;
        $this->clave=$c;
    }

}

/* TABLA - INCIDENCIAS */
class Incidencias{
//Atributos
public $ID_Incidencia;
public $Fec_Ing;
public $Descr;
public $Detalle;
public $Dependencia;
public $ID_Usuario;

			//Constructor
			public function  __construct($i,$f,$d,$e,$p,$u) {
			$this->ID_Incidencia=$i;
			$this->Fec_Ing=$f;
			$this->Descr=$d;
			$this->Detalle=$e;
			$this->Dependencia=$p;
					$this->ID_Usuario=$u;
			}

}

/**
 * Tabla de requerimientos
 */

class Requerimientos{
    //Atributos
	public $id_req;
	public $fec_ing;
	public $cod_area;
	public $id_incidencia;
	public $observacion;
	public $id_usuario;

    //Constructor
    public function  __construct($r,$f,$a,$i,$o,$u){
    	$this->id_req=$r;
		$this->fec_ing=$f;
		$this->cod_area=$a;
		$this->id_incidencia=$i;
		$this->observacion=$o;
		$this->id_usuario=$u;
	}

}

class Monitoreo
{
public $ID_Monitoreo;
public $Cod_Ident;
public $Num_Ident;
public $ID_Usu_Respon;
public $Fec_Solucion;
public $Cod_Estado;

	public function __construct($m,$c,$n,$u,$f,$e)
	{
			$this->ID_Monitoreo=$m;
			$this->Cod_Ident=$c;
			$this->Num_Ident=$n;
			$this->ID_Usu_Respon=$u;
			$this->Fec_Solucion=$f;
			$this->Cod_Estado=$e;
	}
}



class Codigos
{
	public $cod_tipo;
	public $cod_codigo;
	public $descr;
	public $cod_padre;
	
	public function __construct($t,$c,$d,$p)
	{
		$this->cod_tipo=$t;
		$this->cod_codigo=$c;
		$this->descr=$d;
		$this->cod_padre=$p;
	}
}

/* TABLA - TAREAS */
class Tareas{
    //Atributos
	public $id_tarea;
	public $fec_creacion;
	public $descr;
	public $detalle;
	public $usu_gestor;
	public $usu_asignado;
    public $fec_ini;
	public $fec_fin;
	public $cod_prioridad;
	public $cod_tipo_req;
	public $cod_resolucion;
	public $horas_estimadas;
	public $id_tarea_padre;
	public $id_req;
    
    //Constructor
    public function  __construct($it,$fc,$t,$d,$g,$a,$fi,$ff,$p,$tr,$r,$h,$tp,$rq) {
		$this->id_tarea=$it;
		$this->fec_creacion=$fc;
		$this->descr=$t;
		$this->detalle=$d;
		$this->usu_gestor=$g;
		$this->usu_asignado=$a;
        $this->fec_ini=$fi;
		$this->fec_fin=$ff;
		$this->cod_prioridad=$p;
		$this->cod_tipo_req=$tr;
		$this->cod_resolucion=$r;
		$this->horas_estimadas=$h;
		$this->id_tarea_padre=$tp;
		$this->id_req=$rq;
	}
}

?>
