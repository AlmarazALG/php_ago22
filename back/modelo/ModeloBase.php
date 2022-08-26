<?php

include_once "BaseDeDatos.php";

class ModeloBase extends BaseDeDatos
{

    private $tabla;

    function __construct($nombreTabla)
    {
        parent::__construct();
        $this->tabla = $nombreTabla;
    }

    public function obtenerListado(){
        return $this->obtenerRegistros($this->tabla);
    }

    public function insertar($campos){
        return $this->insertarRegistro($this->tabla,$campos);
    }

    public function actualizar($valores_update,$condicionales){
        return $this->actualizarRegistro($this->tabla,$valores_update,$condicionales);
    }

    public function eliminar($condicionales){
        return $this->eliminarRegistro($this->tabla,$condicionales);
    }

}

/**
*class ModeloBase extends BaseDeDatos{
*        private $tabla;
*
 *   function __construct($tabla)
  *  {
   *     parent::__construct();
    *    $this->tabla = $tabla;
    *}

    *public function obtenerRegistros($condicionales = array()){
    *    //$consulta = "select * from ".$this->tabla;
    *    $registros = $this->consultaRegistros($this->tabla,$condicionales);
    *    return $registros;
    *}

    *public function actualizar($valoresUpdate,$condicionales){
     *   return $this->actualizarRegistro($this->tabla,$valoresUpdate,$condicionales);
    *}

    *public function insertar($valoresInsertar){
    *    return $this->insertarRegistro($this->tabla,$valoresInsertar);
    *}

    *public function eliminar($condicionalesDelete){
    *    return $this->eliminarRegistro($this->tabla,$condicionalesDelete);
    *}

*}


 */