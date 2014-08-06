<?php

class User_model extends InTouch_Test_Model
{

    /**
     * Definicion de la entidad del modelo
     * datos, tipos de validacion, etc
     * @var array
     */
    public $entity = array (
        
        'id' => array(
            'pk'    => true,
            'type'  => 'INT'
        ),

        'name' => array(
            'type'      => 'varchar',
            'length'    => 100,
            'required'  => true
        ),

        'email' => array (
            'type'      => 'email',
            'required'  => true,
            'unique'    => array(
                'message'       => ' Este correo electronico ya se encuentra registrado ',
                'callback'      => 'check_is_unique'
            )
        ),

        'password' => array (
            'type'          => 'varchar',
            'length'        => 50,
            'required'      => true,
            'equal_data'    => array (
                    'field' => 'confirm_password',
                    'message' => 'Las contraseñas deben coincidir'
            ),
            'save' => array(
                'is_null'  => 'ignore', 
                'merge' => 'name',
                'crypt' => 'sha1'
            )
        ),

        'level'     => array(
            'type'      => 'int',
            'required'  => 'true',
            'default'   => 5
        ),

        'isEnabled' => array (
            'type'      => 'int',
            'required'  => true,
            'default'   => 1
        )
    );

    /**
     * tabla que se usara
     * @var string
     */
    public $schema = 'users';



}