<?php

Class Project_model extends InTouch_Test_Model
{


    public $entity = array(
        'id' => array(
            'pk'    => true,
            'type'  => 'int'
        ),
        'projectname' => array(
            'type'      => 'varchar',
            'required'  => true
        ),
        'iduser' => array(
            'type' => 'int',
            'required' => true
        ),
        'actualcost' => array(
            'type'  => 'decima',
            'default' => '0',
            'compare' => array(
                    'field'     => 'budget',
                    'operator'  => '<=',
                    'message'   => 'El precio no puede ser mayor el presupuesto'
            ),
            'save'  => array(
                'is_null' => 'default'
            )
        ),
        'budget' => array(
            'type' => 'decimal',
            'required' => true
        ),
        'startdate' => array(
            'type'  => 'date',
            'required' => true
        ),
        'enddate' => array(
            'type' => 'timestamp',
            'save' => array(
                'field_value' => array(
                    'field' => 'isfinished',
                    'value' => 1,
                    'callback' => 'now'
                )
            )
        ),
        'isfinished' => array(
            'type' => 'int',
            'default' => 0,
            'save' => array(
                'is_null' => 'default',
                /*
                Este hook permite que se setee la fecha de enddate 
                si el valor de isfinished pasa a 1, dejo desactivada
                esta funcionalidad
                'hook'  => array(
                    'before_update' => 'set_end_date'
                )
                */
            )
        )
    );

    public $schema = 'projects';


    /**
     * Hook before update
     */
    public function set_end_date( $data )
    { 
        if( $data['isfinished'] == 1 ) {
            $data['enddate'] = time();
        }
        return $data;
    }

}

