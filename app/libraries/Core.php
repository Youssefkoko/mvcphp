<?php
/*
 *
 *App core class
 *Create URL and Loads core controller
 * URL FORMAT- /Controller/method/params
 *
 **/

class Core
{
 protected $currentController = 'Pages';
 protected $currentMethod    = 'index';
 protected $parama           = [];

 public function __construct()
 {
  // print_r($this->getUrl());
  $url = $this->getUrl();
  // look inncontroller for first value
  if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
   // if exist then set it as current controller
   $this->currentController = ucwords($url[0]);
   //  unset 0 index
   unset($url[0]);
  }
  // require the controller
  require_once '../app/controllers/' . $this->currentController . '.php';
  // instantiate controller class
  $this->currentController = new $this->currentController;
  // check for second part of url 
  if(isset($url[1])){
    // check if method exist in controller 
    if(method_exists($this->currentController, $url[1])){
      $this->currentMethod = $url[1];
      unset($url[1]);
    }
  }
  // get params 

  $this->params = $url ? array_values($url) : [];
  // call a callback with array of params 
  call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
 }
 public function getUrl()
 {
  // echo $_GET['url'];  
  if (isset($_GET['url'])) {
   $url = rtrim($_GET['url'], '/');
   $url = filter_var($url, FILTER_SANITIZE_URL);
   $url = explode('/', $url);
   return $url;
  }
 }
}
