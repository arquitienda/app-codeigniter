<?php

class Intouch_Ui_Box extends Intouch_Unique
{
    
    private $queue = array();

    public function load( $view , $data = array() )
    {
        $ci =& get_instance();
        return $ci->load->view($view, $data , true);
    }

    public function add( $element, $priority = 0 )
    {
        
        $this->queue[$priority][] = $element;
        krsort( $this->queue );
    }

    public function remove( $index, $priority = 0)
    {
        if( isset ( $this->queue[$priority][$index] ) ) 
        {
            unset( $this->queue[$priority][$index] );
        }
        krsort( $this->queue );
    }

    public function display()
    {
        $return = '';

        if( empty( $this->queue ) ) return $return;

  

        foreach( $this->queue AS $priority => $data ) {
            $return .= "<!-- elementos prioridad {$priority} --> \n";
            foreach( $data AS $element ) {
                $return .= $element . "\n\n";
            }
        }

        return $return;
    }


}