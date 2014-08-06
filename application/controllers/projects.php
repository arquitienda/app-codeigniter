<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Projects extends InTouch_Test_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'User_model');
        $this->load->model('project_model', 'model');
    }

    function index() {
        
        $per_page = 3;
        
        // Si el segundo [ method ] parametro de la redireccion es distinto 
        // al segundo parametro del request uri
        // Esta comprobacion se hace debido a que el segmento es tomado por el request_uri 
        // y para hacer mas agradable la url utilizo una redireccion en el route para acceder
        // mediante ``` projects/:user_id/:page_number
        $segment_user = $this->uri->rsegment(2) !== $this->uri->segment(2) ? 2 : 3; // projects/1   <=> projects/index/1

        // Si no existe el id de usario redireccionamos al home
        // tambien se podria listar todos los proyectos independientemente del usario
        if( ! $this->uri->segment($segment_user) ) {
            header('location: '. base_url());
        }

        $user_id = $this->uri->segment($segment_user);
        
        $segment_page = $this->uri->rsegment(2) !== $this->uri->segment(2) ? 3 : 4; // projects/1/1 <=> projects/index/1/1
        
        $page = $this->uri->segment($segment_page) ? $this->uri->segment($segment_page) : 0;

        $this->load->library('pagination');

        $rows = $this->model->find(array(
            'select' => 'id, projectname, iduser, actualcost, budget, startdate, enddate, isfinished',
            'conditions' => array(
                array(
                    'field'     => 'userid',
                    'operator'  => '=',
                    'value'     => $user_id
                )
            ),
            'limit' =>  array($page, $per_page)
        ));

        $this->pagination->initialize(
            array(
                'base_url'    => base_url() . "projects/" . $user_id,
                'total_rows'  => $this->model->total_rows,
                'per_page'    => $per_page,
                'uri_segment' => $segment_page
            )
        );
       

        $data = array(
                'results'       => $rows,
                'pagination'    => $this->pagination->create_links()
        );

        $this->load->view('structure/header');


        $this->load->view('projects/index.php', $data);
        


        $this->load->view('structure/footer');
    }

    public function add()
    {   

        /**
        * Tarea 2
        * Los usuarios no pueden más proyectos que (`Level` * 5), independientemente del estado en el que se encuentre.
        * 
        */
            $this->users = $this->User_model->find(
                array(
                    'select'    => 'id, name',
                    'conditions' => array(
                        array(
                            'field' => 'level',
                            'operator' => '=',
                            'value' => 5
                        )
                    )
                )
            );

        if( $this->request->request_method == 'POST' ){
            // Guardo el modelo con los datos obtenidos en la peticion
            // 
            if( ! $this->model->validate ( $this->request->post() ) ) {
                
               
                $this->load->view('structure/header');
                $this->load->view  (  'projects/form.php', 
                                        array(
                                            'errors'    => $this->model->errors,
                                            'data'      => $this->request->post()
                                        )
                                    );
                $this->load->view('structure/footer'); 
               
                return;
            }
            $this->model->save( $this->request->post() );

            header('location: ' . base_url() . 'projects/' . $this->request->iduser );
            die;
        } elseif ( $this->request->request_method == 'GET' ) {

           
            
            $this->load->view('structure/header');  
            
            $this->load->view('projects/form.php'); 
            
            $this->load->view('structure/footer');
        }

    }


    public function edit()
    {
        
        /**
        * Tarea 2
        * Los usuarios no pueden más proyectos que (`Level` * 5), independientemente del estado en el que se encuentre.
        * 
        */
        $this->users = $this->User_model->find(
            array(
                'select'    => 'id, name',
                'conditions' => array(
                    array(
                        'field' => 'level',
                        'operator' => '=',
                        'value' => 5
                    )
                )
            )
        );

        // Si no viene el id o no es un entero
        if( ! $this->uri->segment(3) ) {
            header( 'location: ' . base_url() .'projects?error=a');
            return;
        }

        if( $this->request->request_method == 'POST' ){
            // Guardo el modelo con los datos obtenidos en la peticion
            // 
            $this->model->entity['password']['required'] = false;
           
            if( ! $this->model->validate ( $this->request->post(), 'update' ) ) {
                
                $this->load->view ('structure/header');
                $this->load->view  (  'projects/form.php', 
                                        array(
                                            'errors'    => $this->model->errors,
                                            'data'      => $this->request->post()
                                        )
                                    );
                $this->load->view('structure/footer'); 
               
                return;
            }
            
            $this->model->save( $this->request->post() );

           
            header('location: ' . base_url() . 'projects/' . $this->request->iduser );
            die;
        
        } elseif ( $this->request->request_method == 'GET' ) {
        
                $rows = $this->model->find(array(
                    'select' => 'id, projectname, iduser, actualcost, budget, startdate, enddate, isfinished',
                    'conditions' => array(
                        array(
                            'field' => 'id',
                            'operator' => '=',
                            'value' => $this->uri->segment(3)
                        )
                    ),
                    'limit' => '1'
                ));

                if( count( $rows ) == 0 )
                    header('Location: ' . base_url() . 'projects?found=0');

                
                
                $this->load->view ('structure/header');  
                $this->load->view (  'projects/form.php', 
                                        array(
                                            'errors'    => $this->model->errors,
                                            'data'      => (array) $rows[0]
                                        )
                                    ); 
                $this->load->view ( 'structure/footer' );
        }

        

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */