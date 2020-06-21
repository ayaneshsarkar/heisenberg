<?php 
  
  class Pages extends Controller {

    public function __construct() {
      
    }

    public function index() {
      
      $data = ['title' => 'HeisenbergMVC'];
      $this->view('pages/index', $data);

    }

    public function about() {
      $data = ['title' => 'About Us', 'version' => '1.0.0'];
      $this->view('pages/about', $data);
    }
    
  }