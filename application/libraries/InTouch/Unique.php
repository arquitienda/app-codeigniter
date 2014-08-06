<?php

/**
 * Clase Singleton para el manejo de una unica instancia
 *
 * Cada objeto que no requiera de multiples instancias se extendera de este
 * objeto, tambien es posible crear una sucecion de parentesco en el que al final se extienda de este
 * objeto permitiendo mayor organizacion para el proyecto
 *
 * @author Pablo Samudia <p.a.samu@gmail.com>
 * @package InTouch
 * @subpackage Core
 */
Class InTouch_Unique 
{
    private static $instances = array();

    private static $_initialize = false;

    public static function getInstance()
    {
        $class = get_called_class();
        if ( array_key_exists( $class, self::$instances ) === false ) {
            self::$instances[$class] = new $class();
        }
        return self::$instances[$class];
    }
}