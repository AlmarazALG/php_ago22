<?php

include_once "modelo/EmpleadoModelo.php";
include_once "modelo/ContactoEmpleadoModelo.php";
include_once "helper/ValidacionFormulario.php";

class EmpleadoControlador
{

    private $codigoRespuesta;
    private $empleadoModelo;
    private $contactoEmpleadoModelo;

    function __construct()
    {
        $this->codigoRespuesta = 400;
        $this->empleadoModelo = new EmpleadoModelo();
        $this->contactoEmpleadoModelo = new ContactoEmpleadoModelo();
    }

    public function obtenerEmpleados(){
        try{
            $respuesta['status'] = true;
            $respuesta['msg'] = array(
                'se obtuvo el listado de empleados correctamente'
            );
            $respuesta['data']['empleado'] = $this->empleadoModelo->obtenerListado();
            $this->codigoRespuesta = 200;
        }catch (Exception $ex){
            $respuesta['status'] = false;
            $respuesta['msg'] = array('Ocurrio un error en el servidor, favor de intentar mas tarde');
            $respuesta['msg'][] = $ex->getMessage();
            $this->codigoRespuesta = 500;
        }
        return $respuesta;
    }

    public function insertarNuevo($parametrosForm){
        try{
            //validaciones de campos para poder guardar un empleado
            $validacion = ValidacionFormulario::empleadoNuevo($parametrosForm);
            if($validacion['status']) {
                $guardar = $this->empleadoModelo->insertar($parametrosForm);
                if($guardar){
                    $respuesta['status'] = true;
                    $respuesta['msg'] = array('Se guardo con exito el empleado');
                    $this->codigoRespuesta = 201;
                }else{
                    $respuesta['status'] = false;
                    $respuesta['msg'] = array('No fue posible guardar el empleados','Ocurrio un error en el sistema');
                    $this->codigoRespuesta = 500;
                }
            }else{
                $respuesta['status'] = false;
                $respuesta['msg'] = $validacion['msg'];
                $this->codigoRespuesta = 400;
            }

        }catch (Exception $ex){
            $respuesta['status'] = false;
            $respuesta['msg'] = array('Ocurrio un error en el servidor, favor de intentar mas tarde');
            $respuesta['msg'][] = $ex->getMessage();
            $this->codigoRespuesta = 500;
        }
        return $respuesta;
    }

    public function actualizar($datosFormulario){
        /*$respuesta = array(
            'success' => false,
            'msg' => array('No fue posible actualizar el empleado'),
        );*/
        try{
            $respuesta['status'] = true;
            $respuesta['msg'] = array(
                'se quedo en el try'
            );
            $datosContacto = $datosFormulario['listado_datos_contacto'];
            unset($datosFormulario['listado_datos_contacto']);
            $validacion = ValidacionFormulario::actualizarEmpleado($datosFormulario);
            if($validacion['status']) {
                //mandar a llamar el modelo de actualizar registro
                $id_empleado = $datosFormulario['id_empleado'];
                unset($datosFormulario['id_empleado']);
                $empleadoActualizar = $this->empleadoModelo->actualizar($datosFormulario,array('id_empleado' => $id_empleado ));
                if($empleadoActualizar){
                    $guardoContacto = true;
                    $this->empleadoModelo->eliminar(array('empleado_id' => $id_empleado ));
                    foreach ($datosContacto as $dc){
                        $dc['empleado_id'] = $id;
                        $guardoContacto = $this->empleadoModelo->insertar($dc);
                    }
                    if($guardoContacto){
                        $respuesta = array(
                            'success' => true,
                            'msg' => array('Se actualizo el empleado correctamente'),
                            //devolver en el data, los datos del empleado agregado, incluido su id
                        );
                    }else{
                        $respuesta = array(
                            'success' => false,
                            'msg' => array('Se actualizo el empleado correctamente pero faltaron los datos de contacto'),
                            //devolver en el data, los datos del empleado agregado, incluido su id
                        );
                    }
                }
            }else{
                $respuesta['status'] = false;
                $respuesta['msg'] = $validacion['msg'];
                $this->codigoRespuesta = 400;
            }
        }catch (Exception $ex){
            $respuesta['status'] = false;
            $respuesta['msg'] = array('Ocurrio un error en el servidor, favor de intentar mas tarde');
            $respuesta['msg'][] = $ex->getMessage();
            $this->codigoRespuesta = 500;
        }
        //return $datosFormulario;
        //return $id_empleado;
        //return $empleadoActualizar;
        //return $validacion;
        return $respuesta;
        $lines1 = explode(utf8_encode($respuesta));
    }


    public function eliminar($datosFormulario){
        $respuesta = array(
            'success' => false,
            'msg' => array('No fue posible actualizar el empleado'),
        );
        $validacion = ValidacionFormulario::validarFormEmpleadoEliminar($datosFormulario);
        if($validacion['status']){
            $empleadoEliminar = $this->empleadoModelo->eliminar(array('id' => $datosFormulario['id_empleado']));
            if($empleadoEliminar){
                $respuesta = array(
                    'success' => true,
                    'msg' => array('Se elimin?? el empleado correctamente'),
                );
            }else{
                $respuesta['success'] = false;
                $respuesta['msg'] = $this->empleadoModelo->getErrores();
            }
        }else{
            $respuesta['success'] = false;
            $respuesta['msg'] = $validacion['msg'];
        }
    }

    public function getCodigoRespuesta(){
        return $this->codigoRespuesta;
    }

}