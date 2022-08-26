<?php
header('Content-Type: text/html; charset=UTF-8');
include_once "ModeloBase.php";

class CatContactoModelo extends ModeloBase
{

    function __construct()
    {
        parent::__construct('cat_contacto');
    }

    /*public function obtenerListado(){
        $bd = new BaseDeDatos();
        return $bd->obtenerRegistros('cat_contacto');
    }*/

}