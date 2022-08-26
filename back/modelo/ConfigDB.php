<?php

class ConfigDB
{
    public static function getConfig(){
        switch ($_SERVER['SERVER_NAME']){
            case 'phpago22.000webhostapp.com':
                $configDB = array(
                    'hostname' => 'localhost',
                    'usuario' => 'id19476556_phpago22',
                    'password' => 'B#IQQG3qcNch)88*nL3*',
                    'base_datos' => 'id19476556_php_curso_ago22',
                    'puerto'=>'3306'
                );
                break;
            default:
                $configDB = array(
                    'hostname' => 'localhost',
                    'usuario' => 'root',
                    'password' => 'hunter43',
                    'bd' => 'php_curso_ago22',
                    'puerto' => '3306'
                );
                break;
        }
        return $configDB;
    }

}