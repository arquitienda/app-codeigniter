<?php

class InTouch_Test_Controller extends CI_Controller
{


    public $request;

    public $ui;

    public function __construct()
    {
        parent::__construct();

        $this->request = InTouch_Request::getInstance();
        
        $this->ui = new stdClass();
        $this->ui->box = InTouch_Ui_Box::getInstance();

        $this->ui->box->add( $this->ui->box->load('ui/box/summary.php', ''), 0);
    }

    public function version()
    {
        return '1.0';
    }
    
}