<?php

include_once 'ConfigDB.php';
header("Access-Control-Allow-Origin: *");

class BaseDeDatos
{

    private $mysqli;//utf-8
    private $errores;

    function __construct()
    {
        try{
            $configDB = ConfigDB::getConfig();
            $this->mysqli = new mysqli(
                $configDB['hostname'],
                $configDB['usuario'],
                $configDB['password'],
                $configDB['bd'],
                $configDB['puerto']
            );
            if($this->mysqli->connect_errno){
                $this->errores = $this->mysqli->error_list;
                echo 'hubo un error en la conexion a la BD';die;
            }else{
                $this->errores = array();
            }
        }catch (Exception $ex){
            $this->errores[] = $ex->getMessage();
            echo 'Hubo un error en el servidor';die;
        }
        //mysqli::set_charset($configDB, 'utf8'): bool;
        /*if (!$mysqli->set_charset("utf8")) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
            exit();
        } else {
            printf("Conjunto de caracteres actual: %s\n", $mysqli->character_set_name());
        }*/
    }

    public function obtenerCatContacto(){
        try{
            $query = $this->mysqli->query("select * from cat_contacto");
            $cat_contacto = array();
            while($registro = $query->fetch_assoc()){
                $cat_contacto[] = $registro;
            }
            return $cat_contacto;
        }catch (Exception $ex){
            return array();
        }
    }

    public function obtenerRegistros($tabla){
        try{
            $query = $this->mysqli->query("select * from $tabla");
            $registros_retorno = array();
            while($registro = $query->fetch_assoc()){
                $registros_retorno[] = $registro;
            }
            return $registros_retorno;
        }catch (Exception $ex){
            $this->errores[] = $ex->getMessage();
        }
    }

    /**
     * funcion especializada para realizar en insertar datos a la BD
     * @param string nombre_tabla, array parametros (columna_tabla => valor)
     * ej paramentros
     * array(
        'id' => 0,
     *  'nombre' => 'algun dato'
     * )
     */
    public function insertarRegistro($tabla,$valores_insert){
        try{
            $string_llave_valor = $this->obtenerCadenaInsert($valores_insert);
            //var_dump($string_llave_valor);
            $sqlInsert = "insert into $tabla(".$string_llave_valor['columnas'].") values(".$string_llave_valor['values'].")";
            try{
                $query = $this->mysqli->query($sqlInsert);
                if($query !== true){
                    return false;
                }
                return true;
            }catch (Exception $ex){
                return false;
            }
            //culminar el insertado de este SQL a la BD
        }catch (Exception $ex){
            $this->errores[] = $ex->getMessage();
        }
    }

    public function actualizarRegistro($tabla,$valores_update, $condicionales){
        try{
            $sqlCamposUpdate = $this->obtenerColumnaValorUpdate($valores_update);
            $condicionesSQL = $this->obtenerCondicionalesWhereAnd($condicionales);
            $consultaUpdateSQL = "UPDATE $tabla SET $sqlCamposUpdate $condicionesSQL";
            $query = $this->mysqli->query($consultaUpdateSQL);
            if($query !== true){
                $this->errores = $this->mysqli->error_list;
                return false;
            }return true;
        }catch (Exception $ex){
            return false;
        }
    }

    public function eliminarRegistro($tabla, $condicionales){
        try{
            $condicionesSQL = $this->obtenerCondicionalesWhereAnd($condicionales);
            $consultaDeleteSQL = "DELETE FROM $tabla $condicionesSQL";
            $query = $this->mysqli->query($consultaDeleteSQL);
            if($query !== true){
                $this->errores = $this->mysqli->error_list;
                return false;
            }return true;
        }catch (Exception $ex){
            return false;
        }
    }

    public function obtenerCondicionalesWhereAnd($condicionales){
        $condiciones = " WHERE 1=1";
        foreach ($condicionales as $columna => $valor){
            $condiciones .= " AND $columna = '$valor'";
        }
        return $condiciones;
    }

    private function obtenerColumnaValorUpdate($camposUpdate){
        $camposValorSQL = '';
        $iteracionCampos = 1;
        $maxItCampo = sizeof($camposUpdate);
        foreach ($camposUpdate as $columna => $valor){
            $camposValorSQL .= " $columna = '$valor'";
            if($iteracionCampos < $maxItCampo){
                $camposValorSQL .= ',';
            }
            $iteracionCampos++;
        }
        return $camposValorSQL;
    }

    private function obtenerCadenaInsert($valores_insert){
        $retorno = array(
            'columnas' => '',
            'values' => ''
        );
        $contador_index = 1;
        $tam_array_valores = sizeof($valores_insert);
        foreach ($valores_insert as $indice => $valor){
            if($contador_index < $tam_array_valores){
                $retorno['columnas'] .= $indice. ', ';
                $retorno['values'] .= "'$valor'". ', ';
            }else{
                $retorno['columnas'] .= $indice;
                $retorno['values'] .= "'$valor'";
            }
            $contador_index++;
        }
        return $retorno;
    }

    public function getErrores(){
        return $this->errores;
    }

}