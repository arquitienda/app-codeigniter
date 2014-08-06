<?php

/**
 * Objeto con los datos del request actual,
 * utilizado para determinar el contexto en que se 
 * llama a un metodo en el controlador
 *
 * @author  Pablo Samuda <p.a.samu@gmail.com>
 * @see  Intouch_Unique
 * @package InTouch
 * @subpackage Request
 */
Class InTouch_Request extends InTouch_Unique implements Iterator
{
    
    /**
     * Coleccion de informacion obtenido del request
     * @var array
     */
    private $data = array();
    
    /**
     * Tipo de request
     * @var string
     */
    public $request_method = 'GET';


    public $uri;

    //public $
    /**
     * Inicializa el request capturando los datos necesarios para la utilizacion
     * de la demostracion, se podria extender a otras opciones, por ejemplo, determinar
     * si es movil, si la peticion viene por ajax, etc.
     */
    public function __construct()
    {
        $this->request_method = strtoupper( $_SERVER['REQUEST_METHOD'] );
      
        $this->uri = $_SERVER['REQUEST_URI'];

        $this->_extractData();

    }

    private function _extractData()
    {
        
        if( isset( $_SERVER['QUERY_STRING'] ) ) {
            parse_str( $_SERVER['QUERY_STRING'], $_get );  
            $this->data['GET'] = !isset( $this->data['GET'] ) ? $_get : array_merge( $this->data['GET'], $_get);
        }

        switch( $this->request_method ) {
            case 'POST': 
                $this->data[$this->request_method] = $_POST;
                break;
            case 'PUT':
            case 'DELETE':

                parse_str( file_get_contents('php://input'), $this->data[$this->request_method] );
                break;
        }
    
    }

    public function __call( $_method, $args = false) {
        $method = strtoupper( $_method );

        if( !$args ) {
            if( isset( $this->data[$method] ) )
                return $this->data[$method];
            return false;
        }

        $key = $args[0];
        if( isset( $this->data[$method][$key] ) )
            return $this->data[$method][$key];
        return false; 
    }

    /**
     * Setea una nuevo item a la coleccion
     * @param string $key   nombre a utilizar ejemplo InTouchRequest->id = 1;
     * @param mixed $value valor del nuevo valor
     */
    public function __set( $key, $value )
    {
        $this->data[$this->request_method][$key] = $value;
    }

    /**
     * Devuelve el item que coincida con la clave, siempre que exista
     * @param  string $key nombre del indice
     * @return mixed      si encuentra devuelve el item, sino devuelve false
     */
    public function __get( $key ) {
        if( isset( $this->data[$this->request_method][$key] ) ) 
            return $this->data[$this->request_method][$key];
        return false;
    }

    /**
     * Determinar si una clave se encuentra seteada en la coleccion
     * @param  string  $key nombre del indice a buscar
     * @return boolean      true si existe false sino.
     */
    public function __isset( $key )
    {
        return isset( $this->data[$this->request_method][$key] ) ;
    }


    /**
     * Implementacion la interface Iterator
     */
    public function valid() {
        return current($this->data[$this->request_method]) !== false;
    }

    /**
     * Implementacion la interface Iterator
     */    
    public function rewind()
    {
        reset( $this->data[$this->request_method] );
    }

    /**
     * Implementacion la interface Iterator
     */
    public function key()
    {
        return key( $this->data[$this->request_method] );
    }

    /**
     * Implementacion la interface Iterator
     */
    public function current() {
        return current( $this->data[$this->request_method] );
    }

    /**
     * Implementacion la interface Iterator
     */
    public function next()
    {
        next( $this->data[$this->request_method] );
    }

    /**
     * Implementacion la interface Iterator
     */
    public function previous()
    {
        previous( $this->data[$this->request_method] );
    }

    public function data( $method = false )
    {
        $_request_method = $method == false ? $this->request_method : $method;

        if( isset ( $this->data[$_request_method] ) ) {
            return $this->data[$_request_method];
        }

        return $this->data;
    }
}