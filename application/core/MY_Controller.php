<?php
class MY_Controller extends CI_Controller
{

  public $data = array();
  public function __construct()
  {
    parent::__construct();

        //bootstrap
    $this->page->setLoadCss('assets/test/bootstrap/css/bootstrap.min');
    $this->page->setLoadJs('assets/test/jquery/jquery-3.2.1.min');
    $this->page->setLoadJs('assets/test/bootstrap/js/bootstrap.min');

    

       	//template
    $this->page->setLoadCss('assets/dist/vendor/metisMenu/metisMenu.min');
    $this->page->setLoadCss('assets/dist/css/sb-admin-2');
    $this->page->setLoadCss('assets/dist/vendor/font-awesome/css/font-awesome.min');
    $this->page->setLoadCss('assets/dist/vendor/datatables-plugins/dataTables.bootstrap');
    $this->page->setLoadCss('assets/dist/vendor/datatables-responsive/dataTables.responsive');

    $this->page->setLoadCss('assets/tabel/datatables.min');
    $this->page->setLoadJs('assets/tabel/datatables.min');


       	//template


    $this->page->setLoadJs('assets/dist/vendor/metisMenu/metisMenu.min');
    $this->page->setLoadJs('assets/dist/js/sb-admin-2');

         //table
    
    $this->page->setLoadJs('assets/dist/vendor/datatables/js/jquery.dataTables.min');
    $this->page->setLoadJs('assets/dist/vendor/datatables-plugins/dataTables.bootstrap.min');
    $this->page->setLoadJs('assets/dist/vendor/datatables-responsive/dataTables.responsive');









  }


}