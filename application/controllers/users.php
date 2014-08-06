<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Users extends InTouch_Test_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'model');
        $this->load->model('user_model', 'model');
    }

    function index() {

        $per_page = 10;

        $page =($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->load->library('pagination');

        $rows = $this->model->find(array(
            'select' => 'id, name, email, level, password, isEnabled',
            /*
            'conditions' => array(
                array(
                    'field' => 'name',
                    'operator' => 'LIKE',
                    'value' => '%Psa%'
                ),
                array(
                    'field' => 'email',
                    'operator'=> 'LIKE',
                    'value' => '%@gmail%',
                    'join'  => 'or'
                )
            ),
            */
            'limit' =>  array($page, $per_page)
        ));



        $this->pagination->initialize( array(
            'base_url' => base_url() . "users/index",
            'total_rows' => $this->model->total_rows,
            'per_page' => $per_page,
            'uri_segment' => 3
            
        ));

        

        $data = array(
                'results'       => $rows,
                'pagination'    => $this->pagination->create_links()
        );

        $this->load->view('structure/header');


        $this->load->view('users/index.php', $data);
        


        $this->load->view('structure/footer');
    }

    public function add()
    {   
        if( $this->request->request_method == 'POST' ){
            // Guardo el modelo con los datos obtenidos en la peticion
            // 
            if( ! $this->model->validate ( $this->request->post() ) ) {
                
                $this->load->view('structure/header');
                $this->load->view  (  'users/form.php', 
                                        array(
                                            'errors'    => $this->model->errors,
                                            'data'      => $this->request->post()
                                        )
                                    );
                $this->load->view('structure/footer'); 
               
                return;
            }
            $this->model->save( $this->request->post() );

            header('location: ' . base_url() . 'users' );
            die;
        } elseif ( $this->request->request_method == 'GET' ) {
              $this->load->view('structure/header');  
              $this->load->view('users/form.php'); 
              $this->load->view('structure/footer');
        }

    }


    public function edit()
    {
        
        // Si no viene el id o no es un entero
        if( ! $this->uri->segment(3) ) {
            header( 'location: ' . base_url() .'users?error=a');
            return;
        }

        if( $this->request->request_method == 'POST' ){
            // Guardo el modelo con los datos obtenidos en la peticion
            // 
            $this->model->entity['password']['required'] = false;
            if( ! $this->model->validate ( $this->request->post(), 'update' ) ) {
                
                $this->load->view ('structure/header');
                $this->load->view  (  'users/form.php', 
                                        array(
                                            'errors'    => $this->model->errors,
                                            'data'      => $this->request->post()
                                        )
                                    );
                $this->load->view('structure/footer'); 
               
                return;
            }
            
            $this->model->save( $this->request->post() );

            header('location: ' . base_url() . 'users' );
            die;
        
        } elseif ( $this->request->request_method == 'GET' ) {
        
                $rows = $this->model->find(array(
                    'select' => 'id, name, email, null as password, null AS confirm_password, level, isEnabled',
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
                    header('Location: ' . base_url() . 'users?found=0');

                
                $this->load->view ('structure/header');  
                $this->load->view (  'users/form.php', 
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