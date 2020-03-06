<?php 

  /* 
    * App Core Class
    * Creates URL and loads core controller
    * URL Format - /controller/method/params
  */

  
  class Core {

    protected $currentController = 'Pages';
    protected $currentMethod = 'Index';
    protected $params = [];

    public function __construct() {
      $url = $this->getURL();

      // Look in controllers for first value
      if (file_exists('../app/controllers/' . $url[0] . '.php')) {
        //If exists set a controller
        $this->currentController = ucwords($url[0]);
        //Unset 0 Index
        unset($url[0]);
      }

      // Rquire the controller
      require_once("../app/controllers/" . $this->currentController . ".php");

      // Instantiate Controller Class
      $this->currentController = new $this->currentController;

      // Check for second part of URL
      if (isset($url[1])) {
        // Check to see if the method exists in the controller
        if (method_exists($this->currentController, $url[1])) {
          $this->currentMethod = $url[1];
          // Unset 1 index
          unset($url[1]);
        }
      }

      // Get Params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getURL() {
      if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
      }
    }

  }



  